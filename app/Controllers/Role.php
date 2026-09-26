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
        $this->roleModel     = new RoleModel();
        $this->rightModel    = new RightModel();
        $this->roleRightModel = new RoleRightRelModel();
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE MANAGEMENT
    |--------------------------------------------------------------------------
    */

    /**
     * Role List
     */
    public function index()
    {
        $roles = $this->roleModel
            ->orderBy('Role_Name', 'ASC')
            ->findAll();

        return view('ManageRole/role', [
            'roles' => $roles
        ]);
    }

    /**
     * Add Role Page
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
        $roleName    = trim($this->request->getPost('Role_Name'));
        $description = trim($this->request->getPost('Role_Description'));
        $status      = $this->request->getPost('Role_Status');

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if ($roleName === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role name is required.');
        }

        if ($status === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role status is required.');
        }

        /*
        |--------------------------------------------------------------------------
        | Duplicate Role Name Check
        |--------------------------------------------------------------------------
        */

        $existingRole = $this->roleModel
            ->where('Role_Name', $roleName)
            ->first();

        if ($existingRole) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role name already exists.');
        }

        /*
        |--------------------------------------------------------------------------
        | Create Role ID
        |--------------------------------------------------------------------------
        */

        $roleId = 'ROLE_' . strtoupper(substr(uniqid(), -8));

        /*
        |--------------------------------------------------------------------------
        | Insert Role
        |--------------------------------------------------------------------------
        |
        | Is_System_Role is NOT taken from the form.
        |
        | Every newly created role is a NORMAL role.
        | Database default = 0.
        |
        */

        $data = [
            'Role_Id'          => $roleId,
            'Role_Name'        => $roleName,
            'Role_Description' => $description,
            'Role_Status'      => $status,
            'Record_Added_By'  => 'Admin',
            'Rec_Added_On'     => date('Y-m-d H:i:s')
        ];

        if (!$this->roleModel->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create role.');
        }

        return redirect()->to('roles')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Edit Role Page
     */
    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()->to('roles')
                ->with('error', 'Role not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN PROTECTION
        |--------------------------------------------------------------------------
        */

        if ((int) $role['Is_System_Role'] === 1) {
            return redirect()->to('roles/view/' . $id)
                ->with(
                    'error',
                    'Super Admin is a protected system role and cannot be edited.'
                );
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
        /*
        |--------------------------------------------------------------------------
        | Get Existing Role
        |--------------------------------------------------------------------------
        */

        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()->to('roles')
                ->with('error', 'Role not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN PROTECTION
        |--------------------------------------------------------------------------
        |
        | This is important because somebody can manually POST:
        |
        | roles/update/ROLE001
        |
        | even if the Edit button is hidden.
        |
        */

        if ((int) $role['Is_System_Role'] === 1) {
            return redirect()->to('roles/view/' . $id)
                ->with(
                    'error',
                    'Super Admin is a protected system role and cannot be modified.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Form Data
        |--------------------------------------------------------------------------
        */

        $roleName    = trim($this->request->getPost('Role_Name'));
        $description = trim($this->request->getPost('Role_Description'));
        $status      = $this->request->getPost('Role_Status');

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if ($roleName === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role name is required.');
        }

        if ($status === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role status is required.');
        }

        /*
        |--------------------------------------------------------------------------
        | Duplicate Role Name Check
        |--------------------------------------------------------------------------
        */

        $existingRole = $this->roleModel
            ->where('Role_Name', $roleName)
            ->where('Role_Id !=', $id)
            ->first();

        if ($existingRole) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role name already exists.');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Role
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | We do NOT update Is_System_Role here.
        |
        */

        $data = [
            'Role_Name'           => $roleName,
            'Role_Description'    => $description,
            'Role_Status'         => $status,
            'Rec_Updated_By'      => 'Admin',
            'Rec_Last_Updated_On' => date('Y-m-d H:i:s')
        ];

        if (!$this->roleModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update role.');
        }

        return redirect()->to('roles')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * View Role
     */
    public function view($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()->to('roles')
                ->with('error', 'Role not found.');
        }

        return view('ManageRole/view_role', [
            'role' => $role
        ]);
    }

    /**
     * Delete Role
     */
    public function delete($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Existing Role
        |--------------------------------------------------------------------------
        */

        $role = $this->roleModel->find($id);

        if (!$role) {
            return redirect()->to('roles')
                ->with('error', 'Role not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN PROTECTION
        |--------------------------------------------------------------------------
        */

        if ((int) $role['Is_System_Role'] === 1) {
            return redirect()->to('roles/view/' . $id)
                ->with(
                    'error',
                    'Super Admin is a protected system role and cannot be deleted.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Role
        |--------------------------------------------------------------------------
        */

        if (!$this->roleModel->delete($id)) {
            return redirect()->to('roles')
                ->with('error', 'Failed to delete role.');
        }

        return redirect()->to('roles')
            ->with('success', 'Role deleted successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | ASSIGN RIGHTS MODULE
    |--------------------------------------------------------------------------
    */

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
     *
     * Normal Role:
     *      Existing assigned rights are checked.
     *      Page is editable.
     *
     * Super Admin:
     *      All active rights are checked.
     *      All checkboxes are disabled.
     *      Save button is hidden.
     */
    public function assignRights($roleId)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Role
        |--------------------------------------------------------------------------
        */

        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()->to('roles/assign-rights')
                ->with('error', 'Role not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | Get All Active Rights
        |--------------------------------------------------------------------------
        */

        $rights = $this->rightModel
            ->where('Right_Status', 'Active')
            ->orderBy('Right_Id', 'ASC')
            ->findAll();

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        |
        | Super Admin automatically has every active right.
        |
        | We do NOT read role_right_rel.
        |
        */

        if ((int) $role['Is_System_Role'] === 1) {

            $assignedRightIds = [];

            foreach ($rights as $right) {
                $assignedRightIds[] = $right['Right_Id'];
            }

            return view('ManageRole/assign_rights', [
                'role'             => $role,
                'rights'           => $rights,
                'assignedRightIds' => $assignedRightIds,
                'readOnly'         => true
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NORMAL ROLE
        |--------------------------------------------------------------------------
        |
        | Read manually assigned rights from role_right_rel.
        |
        */

        $assignedRows = $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->findAll();

        $assignedRightIds = [];

        foreach ($assignedRows as $row) {
            $assignedRightIds[] = $row['Right_Id'];
        }

        return view('ManageRole/assign_rights', [
            'role'             => $role,
            'rights'           => $rights,
            'assignedRightIds' => $assignedRightIds,
            'readOnly'         => false
        ]);
    }

    /**
     * View Assigned Rights
     */
    public function viewRights($roleId)
    {
        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()->to('roles/assign-rights')
                ->with('error', 'Role not found.');
        }

        /*
     * =====================================================
     * SUPER ADMIN / SYSTEM ROLE
     * =====================================================
     * Super Admin automatically has ALL active rights.
     */
        if ((int) $role['Is_System_Role'] === 1) {

            $rights = $this->rightModel
                ->where('Right_Status', 'Active')
                ->orderBy('Right_Id', 'ASC')
                ->findAll();

            /*
         * Super Admin has every active right,
         * so populate assignedRightIds with all active Right IDs.
         */
            $assignedRightIds = [];

            foreach ($rights as $right) {
                $assignedRightIds[] = $right['Right_Id'];
            }

            return view('ManageRole/view_assigned_rights', [
                'role'             => $role,
                'rights'           => $rights,
                'assignedRightIds' => $assignedRightIds,
                'readOnly'         => true,
                'isSystemRole'     => true
            ]);
        }

        /*
     * =====================================================
     * NORMAL ROLE
     * =====================================================
     */

        $assignedRows = $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->findAll();

        $assignedRightIds = [];

        foreach ($assignedRows as $row) {
            $assignedRightIds[] = $row['Right_Id'];
        }

        /*
     * No rights assigned
     */
        if (empty($assignedRightIds)) {
            return view('ManageRole/view_assigned_rights', [
                'role'             => $role,
                'rights'            => [],
                'assignedRightIds' => [],
                'readOnly'          => true,
                'isSystemRole'      => false
            ]);
        }

        /*
     * Get assigned active rights
     */
        $rights = $this->rightModel
            ->whereIn('Right_Id', $assignedRightIds)
            ->where('Right_Status', 'Active')
            ->orderBy('Right_Id', 'ASC')
            ->findAll();

        /*
     * Get all active rights so that parent rights
     * can also be displayed in the hierarchy.
     */
        $allRights = $this->rightModel
            ->where('Right_Status', 'Active')
            ->findAll();

        $rightsById = [];

        foreach ($allRights as $right) {
            $rightsById[$right['Right_Id']] = $right;
        }

        /*
     * Add assigned rights + their parent rights
     */
        $displayRights = [];

        foreach ($rights as $right) {

            $displayRights[$right['Right_Id']] = $right;

            $parentId = $right['Parent_Right_Id'] ?? null;

            while (!empty($parentId)) {

                if (!isset($rightsById[$parentId])) {
                    break;
                }

                $parent = $rightsById[$parentId];

                $displayRights[$parent['Right_Id']] = $parent;

                $parentId = $parent['Parent_Right_Id'] ?? null;
            }
        }

        $rights = array_values($displayRights);

        /*
     * Keep the same Right_Id ordering
     */
        usort($rights, function ($a, $b) {
            return strcmp(
                $a['Right_Id'],
                $b['Right_Id']
            );
        });

        return view('ManageRole/view_assigned_rights', [
            'role'             => $role,
            'rights'           => $rights,
            'assignedRightIds' => $assignedRightIds,
            'readOnly'         => true,
            'isSystemRole'     => false
        ]);
    }


    /**
     * Save Assigned Rights
     */
    public function saveRights($roleId)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Role
        |--------------------------------------------------------------------------
        */

        $role = $this->roleModel->find($roleId);

        if (!$role) {
            return redirect()->to('roles/assign-rights')
                ->with('error', 'Role not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN PROTECTION
        |--------------------------------------------------------------------------
        |
        | Even if someone manually submits:
        |
        | roles/assign-rights/save/ROLE001
        |
        | Super Admin rights cannot be changed.
        |
        */

        if ((int) $role['Is_System_Role'] === 1) {

            return redirect()->to(
                'roles/assign-rights/view/' . $roleId
            )->with(
                'error',
                'Super Admin rights are managed automatically and cannot be changed.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Submitted Rights
        |--------------------------------------------------------------------------
        */

        $rightIds = $this->request->getPost('right_ids');

        if (!is_array($rightIds)) {
            $rightIds = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Duplicate IDs
        |--------------------------------------------------------------------------
        */

        $rightIds = array_unique($rightIds);

        /*
        |--------------------------------------------------------------------------
        | Database Connection
        |--------------------------------------------------------------------------
        */

        $db = \Config\Database::connect();

        /*
        |--------------------------------------------------------------------------
        | Start Transaction
        |--------------------------------------------------------------------------
        */

        $db->transStart();

        /*
        |--------------------------------------------------------------------------
        | Delete Existing Rights
        |--------------------------------------------------------------------------
        */

        $this->roleRightModel
            ->where('Role_Id', $roleId)
            ->delete();

        /*
        |--------------------------------------------------------------------------
        | Insert New Rights
        |--------------------------------------------------------------------------
        */

        foreach ($rightIds as $rightId) {

            $this->roleRightModel->insert([
                'Role_Id'         => $roleId,
                'Right_Id'        => $rightId,
                'Record_Added_By' => 'Admin',
                'Rec_Added_On'    => date('Y-m-d H:i:s')
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Complete Transaction
        |--------------------------------------------------------------------------
        */

        $db->transComplete();

        /*
        |--------------------------------------------------------------------------
        | Check Transaction
        |--------------------------------------------------------------------------
        */

        if ($db->transStatus() === false) {

            return redirect()->back()
                ->with(
                    'error',
                    'Failed to save rights.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()->to('roles/assign-rights')
            ->with(
                'success',
                'Rights updated successfully.'
            );
    }
}
