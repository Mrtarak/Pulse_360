<?php
namespace App\Models;
use CodeIgniter\Model;

class CoordinatorModel extends Model
{
    protected $table = 'coordinator';
    protected $primaryKey = 'Coordinator_Id';
    protected $allowedFields = [
        'Coordinator_Id', 'User_Id', 'Program_Id', 'Center_Id', 'Batch_Id',
        'Salary_Id', 'Role_Id', 'Attendance_Id', 'Coordinator_Email_Id',
        'Coordinator_Qualification', 'Assigned_On', 'Rec_Added_By',
        'Rec_Added_On', 'Rec_Updated_By', 'Rec_Last_Updated_On'
    ];
}
