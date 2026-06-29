<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ProgramModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->getUsersWithRoleAndProgram();

        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();

        return view('ManageUsers/users', $data);
    }

    public function add()
    {
        $roleModel = new RoleModel();
        $programModel = new ProgramModel();

        $data['roles'] = $roleModel->findAll();
        $data['programs'] = $programModel->findAll();

        return view('ManageUsers/add_user', $data);
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'User_Id'             => 'USER_' . uniqid(),
            'User_FirstName'      => $this->request->getPost('User_FirstName'),
            'User_LastName'       => $this->request->getPost('User_LastName'),
            'User_Gender'         => $this->request->getPost('User_Gender'),
            'User_DOB'            => $this->request->getPost('User_DOB'),
            'User_FatherName'     => $this->request->getPost('User_FatherName'),
            'User_MotherName'     => $this->request->getPost('User_MotherName'),
            'User_Aadhar_No'      => $this->request->getPost('User_Aadhar_No'),
            'User_Phone_No'       => $this->request->getPost('User_Phone_No'),
            'User_Village_City'   => $this->request->getPost('User_Village_City'),
            'User_District'       => $this->request->getPost('User_District'),
            'User_State'          => $this->request->getPost('User_State'),
            'User_Nationality'    => $this->request->getPost('User_Nationality'),
            'User_Joining_Date'   => $this->request->getPost('User_Joining_Date'),
            'User_Address'        => $this->request->getPost('User_Address'),
            'User_Status'         => $this->request->getPost('User_Status'),
            'Role_Id'             => $this->request->getPost('Role_Id'),
            'Program_Id'          => $this->request->getPost('Program_Id'),
            'Record_Added_By' => 'ADMIN',
            'Rec_Added_On'        => date('Y-m-d'),
            'Rec_Updated_By' => 'ADMIN',
            'User_Password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
        ];

        $userModel->insert($data);
        return redirect()->to(site_url('users'))->with('success', 'User added successfully.');
    }

    public function view($id)
    {
        $model = new UserModel();

        $data['user'] = $model
            ->select('user_m.*, role_m.Role_Name, program_m.Program_Name')
            ->join('role_m', 'role_m.Role_Id = user_m.Role_Id', 'left')
            ->join('program_m', 'program_m.Program_Id = user_m.Program_Id', 'left')
            ->where('user_m.User_Id', $id)
            ->first();

        if (!$data['user']) {
            return redirect()->to('users')
                ->with('error', 'User not found.');
        }

        return view('ManageUsers/view_user', $data);
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $programModel = new ProgramModel();

        $data['user'] = $userModel->find($id);
        $data['roles'] = $roleModel->findAll();
        $data['programs'] = $programModel->findAll();

        return view('ManageUsers/edit_user', $data);
    }

    public function update($id)
    {
        $model = new UserModel();

        $data = [
            'User_FirstName'      => $this->request->getPost('User_FirstName'),
            'User_LastName'       => $this->request->getPost('User_LastName'),
            'User_Gender'         => $this->request->getPost('User_Gender'),
            'User_DOB'            => $this->request->getPost('User_DOB'),
            'User_Login_MailID'   => $this->request->getPost('User_Login_MailID'),
            'User_Phone_No'       => $this->request->getPost('User_Phone_No'),
            'User_Aadhar_No'      => $this->request->getPost('User_Aadhar_No'),
            'User_Village_City'   => $this->request->getPost('User_Village_City'),
            'User_District'       => $this->request->getPost('User_District'),
            'User_State'          => $this->request->getPost('User_State'),
            'User_Pincode'        => $this->request->getPost('User_Pincode'),
            'User_Nationality'    => $this->request->getPost('User_Nationality'),
            'User_Address'        => $this->request->getPost('User_Address'),
            'User_Joining_Date'   => $this->request->getPost('User_Joining_Date'),
            'User_Leaving_Date'   => $this->request->getPost('User_Leaving_Date'),
            'User_Status'         => $this->request->getPost('User_Status'),
            'Role_Id'             => $this->request->getPost('Role_Id'),
            'Program_Id'          => $this->request->getPost('Program_Id'),
            'Rec_Updated_By'      => 'ADMIN',
            'Rec_Last_Updated_On' => date('Y-m-d')
        ];

        // Update password only if entered
        $password = $this->request->getPost('User_Password');

        if (!empty($password)) {
            $data['User_Password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to(site_url('users'))
            ->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('users')->with('success', 'User deleted successfully.');
    }
}
