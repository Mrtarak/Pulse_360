<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;

class Role extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
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
