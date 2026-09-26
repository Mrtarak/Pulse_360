<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\RightModel;
use App\Models\RoleRightRelModel;

class Role extends BaseController
{
    protected $roleModel;
    protected $rightModel;
    protected $roleRightModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->rightModel = new RightModel();
        $this->roleRightModel = new RoleRightRelModel();
    }
    /**
     * Role List
     */
    public function index()
    {
        $data['roles'] = $this->roleModel
            ->orderBy('Role_Name', 'ASC')
            ->findAll();

        return view('ManageRole/role', $data);
    }

    /**
     * Role Add Page
     */
    public function add()
    {
        return view('ManageRole/add_role');
    }

    /**
     * Store New Role
     */
    public function store()
    {
        $roleName = trim($this->request->getPost('Role_Name'));
        $description = trim($this->request->getPost('Role_Description'));
        $status = $this->request->getPost('Role_Status');

        $rules = [
            'Role_Name' => 'required|min_length[3]|max_length[200]',
            'Role_Status' => 'required|in_list[Active,Inactive]'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        // Check duplicate role name
        $existingRole = $this->roleModel
            ->where('Role_Name', $roleName)
            ->first();

        if ($existingRole) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Role name already exists.');
        }

        $roleId = 'ROLE_' . strtoupper(substr(uniqid(), -8));

        $data = [
            'Role_Id' => $roleId,
            'Role_Name' => $roleName,
            'Role_Description' => $description,
            'Role_Status' => $status,

            'Record_Added_By' => session()->get('User_Id') ?? 'system',
            'Rec_Added_On' => date('Y-m-d H:i:s')
        ];

        if (!$this->roleModel->insert($data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unable to create role.');
        }

        return redirect()
            ->to(site_url('roles'))
            ->with('success', 'Role created successfully.');
    }

    /**
     * Role Edit Page
     */
    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        return view('ManageRole/edit_role', [
            'role' => $role
        ]);
    }

    /**
     * Update Role
     */
    public function update($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        $roleName = trim($this->request->getPost('Role_Name'));
        $description = trim($this->request->getPost('Role_Description'));
        $status = $this->request->getPost('Role_Status');

        $rules = [
            'Role_Name' => 'required|min_length[3]|max_length[200]',
            'Role_Status' => 'required|in_list[Active,Inactive]'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        // Check duplicate role name excluding current role
        $existingRole = $this->roleModel
            ->where('Role_Name', $roleName)
            ->where('Role_Id !=', $id)
            ->first();

        if ($existingRole) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Another role with this name already exists.');
        }

        $data = [
            'Role_Name' => $roleName,
            'Role_Description' => $description,
            'Role_Status' => $status,

            'Rec_Updated_By' => session()->get('User_Id') ?? 'system',
            'Rec_Last_Updated_On' => date('Y-m-d H:i:s')
        ];

        if (!$this->roleModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unable to update role.');
        }

        return redirect()
            ->to(site_url('roles'))
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Role View
     */
    public function view($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        return view('ManageRole/view_role', [
            'role' => $role
        ]);
    }


    /**
     * Assign Rights - Role List
     */
    public function assignRightsIndex()
    {
        $roles = $this->roleModel
            ->orderBy('Role_Name', 'ASC')
            ->findAll();

        return view('ManageRole/assign_rights_list', [
            'roles' => $roles
        ]);
    }


    /**
     * Assign Rights Page
     */
    public function assignRights($roleId)
    {
        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        // Get all active rights
        $rights = $this->rightModel
            ->where('Right_Status', 'Active')
            ->orderBy('Right_Id', 'ASC')
            ->findAll();

        // Get rights already assigned to this role
        $assignedRows = $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->findAll();

        $assignedRightIds = [];

        foreach ($assignedRows as $row) {
            $assignedRightIds[] = $row['Right_Id'];
        }

        return view('ManageRole/assign_rights', [
            'role' => $role,
            'rights' => $rights,
            'assignedRightIds' => $assignedRightIds,
            'readOnly' => false
        ]);
    }

    /**
     * View Assigned Rights
     */
    public function viewRights($roleId)
    {
        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()
                ->to(site_url('roles/assign-rights'))
                ->with('error', 'Role not found.');
        }

        /*
     * STEP 1:
     * Get ONLY the rights actually assigned to this role.
     */
        $assignedRows = $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->findAll();

        $assignedRightIds = [];

        foreach ($assignedRows as $row) {
            $assignedRightIds[] = $row['Right_Id'];
        }


        /*
     * STEP 2:
     * If nothing is assigned, show empty page.
     */
        if (empty($assignedRightIds)) {

            return view('ManageRole/view_assigned_rights', [
                'role' => $role,
                'rights' => [],
                'assignedRightIds' => []
            ]);
        }


        /*
     * STEP 3:
     * Get the assigned rights.
     */
        $assignedRights = $this->rightModel
            ->whereIn('Right_Id', $assignedRightIds)
            ->where('Right_Status', 'Active')
            ->findAll();


        /*
     * STEP 4:
     * We also need the parent rights only to show
     * the hierarchy/path.
     *
     * Example:
     *
     * Manage Programs
     *     Programs
     *
     * If only "Programs" is assigned, we still
     * show "Manage Programs" as its parent.
     */
        $allDisplayRights = [];

        foreach ($assignedRights as $right) {

            $allDisplayRights[$right['Right_Id']] = $right;

            $parentId = $right['Parent_Right_Id'] ?? null;

            while (!empty($parentId)) {

                /*
             * Stop if parent is already loaded.
             */
                if (isset($allDisplayRights[$parentId])) {
                    $parentId =
                        $allDisplayRights[$parentId]['Parent_Right_Id']
                        ?? null;

                    continue;
                }


                /*
             * Find parent.
             */
                $parent = $this->rightModel
                    ->where('Right_Id', $parentId)
                    ->where('Right_Status', 'Active')
                    ->first();


                /*
             * Parent does not exist.
             */
                if (!$parent) {
                    break;
                }


                /*
             * Add parent only for display hierarchy.
             */
                $allDisplayRights[$parent['Right_Id']] = $parent;


                /*
             * Continue upward.
             */
                $parentId = $parent['Parent_Right_Id'] ?? null;
            }
        }


        /*
     * Convert associative array back to normal array.
     */
        $rights = array_values($allDisplayRights);


        /*
     * Sort by Right_Id so hierarchy remains consistent.
     */
        usort($rights, function ($a, $b) {

            return strcmp(
                $a['Right_Id'],
                $b['Right_Id']
            );
        });


        return view('ManageRole/view_assigned_rights', [
            'role' => $role,
            'rights' => $rights,
            'assignedRightIds' => $assignedRightIds
        ]);
    }


    /**
     * Save / Update Role Rights
     */
    public function saveRights($roleId)
    {
        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        $rightIds = $this->request->getPost('right_ids');

        if (!is_array($rightIds)) {
            $rightIds = [];
        }

        // Remove duplicate IDs
        $rightIds = array_unique($rightIds);

        $db = \Config\Database::connect();

        $db->transStart();

        /*
     * Remove existing rights
     */
        $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->delete();

        /*
     * Insert currently selected rights
     */
        foreach ($rightIds as $rightId) {

            $this->roleRightModel->insert([
                'Role_Id' => $roleId,
                'Right_Id' => $rightId,
                'Record_Added_By' => session()->get('User_Id') ?? 'system',
                'Rec_Added_On' => date('Y-m-d H:i:s')
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()
                ->to(site_url('roles/assign-rights/edit/' . $roleId))
                ->with('error', 'Unable to save rights.');
        }

        return redirect()
            ->to(site_url('roles/assign-rights'))
            ->with('success', 'Rights updated successfully.');
    }

    /**
     * Delete Role
     */
    public function delete($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()
                ->to(site_url('roles'))
                ->with('error', 'Role not found.');
        }

        // We will later add a check here to prevent deleting
        // a role that is already assigned to users.

        if (!$this->roleModel->delete($id)) {
            return redirect()
                ->back()
                ->with('error', 'Unable to delete role.');
        }

        return redirect()
            ->to(site_url('roles'))
            ->with('success', 'Role deleted successfully.');
    }
}
