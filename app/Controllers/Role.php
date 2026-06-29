<?php

namespace App\Controllers;
use App\Models\RoleModel;
use CodeIgniter\Controller;

class Role extends Controller {

    public function index() {
        $roleModel = new \App\Models\RoleModel();
    $builder = $roleModel->builder();
    $builder->select('ROLE_M.*, RIGHTS_M.Rights_Summary');
    $builder->join('RIGHTS_M', 'ROLE_M.Right_Id = RIGHTS_M.Right_Id', 'left');
    $query = $builder->get();
    $data['roles'] = $query->getResultArray();
        return view('ManageRole/role', $data);
    }

    public function insert()
{
    $roleModel = new RoleModel();
    $rightsModel = new RightsModel();

    // Step 1: Create an empty rights row
    $rightsData = [
        'Program_Info' => '',
        'Event_Info' => '',
        'Center_Info' => '',
        'Asset_Info' => '',
        'User_Info' => '',
        'Fees_Info' => 0,
        'Salary_Info' => 0,
        'Expenses_Info' => 0,
        'Can_Edit' => 'No',
        'Can_Delete' => 'No',
        'Record_Added_By' => session()->get('User_Id'),
        'Rec_Added_On' => date('Y-m-d'),
    ];

    $rightId = $rightsModel->insert($rightsData, true); // returns new Right_Id

    // Step 2: Save role with assigned right_id
    $roleData = [
        'Role_Id' => uniqid('ROLE_'),
        'Role_Name' => $this->request->getPost('Role_Name'),
        'Role_Description' => $this->request->getPost('Role_Description'),
        'Right_Id' => $rightId,
        'Record_Added_By' => session()->get('User_Id'),
        'Rec_Added_On' => date('Y-m-d'),
    ];

    $roleModel->insert($roleData);

    return redirect()->to('roles')->with('success', 'Role created successfully!');
}


    public function add() {
        $rightsModel = new \App\Models\RightsModel();
        $data['rights'] = $rightsModel->findAll();
        return view('ManageRole/add_role', $data);
    }

    public function store()
{
    $model = new \App\Models\RoleModel();

    $data = [
        'Role_Id'           => $this->request->getPost('Role_Id'),
        'Role_Name'         => $this->request->getPost('Role_Name'),
        'Role_Description'  => $this->request->getPost('Role_Description'),
        'Right_Id'          => $this->request->getPost('Right_Id'),
        'Record_Added_By'   => $this->request->getPost('Record_Added_By'),
        'Rec_Added_On'      => $this->request->getPost('Rec_Added_On'),
        'Rec_Updated_By'    => $this->request->getPost('Rec_Updated_By'),
        'Rec_Last_Updated_On' => $this->request->getPost('Rec_Last_Updated_On'),
    ];

    $model->insert($data);

    return redirect()->to(site_url('roles'))->with('success', 'Role Added');
}

public function edit($id)
{
    $roleModel = new \App\Models\RoleModel();
    $rightsModel = new \App\Models\RightsModel();

    $role = $roleModel->find($id);
    $rights = $rightsModel->findAll(); // Fetch all available rights

    if (!$role) {
        return redirect()->to('roles')->with('error', 'Role not found.');
    }

    return view('ManageRole/edit_role', [
        'role' => $role,
        'rights' => $rights
    ]);
}

public function update($id)
    {
        helper(['form']);

        $rules = [
            'Role_Name' => 'required|min_length[3]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return view('ManageRole/edit_role', [
                'validation' => $this->validator,
                'role'       => ['Role_Id' => $id] + $this->request->getPost()
            ]);
        }

        $model = new RoleModel();

        $data = [
            'Role_Name'          => $this->request->getPost('Role_Name'),
            'Role_About'         => $this->request->getPost('Role_About'),
            'Role_Description'   => $this->request->getPost('Role_Description'),
            'Rec_Updated_By'     => session()->get('user_id') ?? 'system',
            'Rec_Last_Updated_On'=> date('Y-m-d')
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Update failed.');
        }

        return redirect()->to('roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $model = new \App\Models\RoleModel();
        $model->delete($id);
        return redirect()->to(\site_url('roles'))->with('success', 'Roles deleted successfully.');
    }

}
