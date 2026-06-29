<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_m';
    protected $primaryKey = 'User_Id';
    public $useAutoIncrement = false;

    protected $allowedFields = [
        'User_Id',
        'User_FirstName',
        'User_LastName',
        'User_Gender',
        'User_DOB',
        'User_Aadhar_No',
        'User_Phone_No',
        'User_Login_MailID',
        'User_Password',
        'User_Village_City',
        'User_District',
        'User_State',
        'User_Pincode',
        'User_Nationality',
        'User_Address',
        'User_Joining_Date',
        'User_Leaving_Date',
        'User_Photo_URL',
        'User_Aadhar_Photo_URL',
        'User_Status',
        'Program_Id',
        'Role_Id',
        'Record_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    protected $useTimestamps = false;
    public function getUsersWithRoleAndProgram()
    {
        return $this->select('user_m.*, role_m.Role_Name, program_m.Program_Name')
            ->join('role_m', 'role_m.Role_Id = user_m.Role_Id', 'left')
            ->join('program_m', 'program_m.Program_Id = user_m.Program_Id', 'left')
            ->findAll();
    }
}
