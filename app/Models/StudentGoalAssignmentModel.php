<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentGoalAssignmentModel extends Model
{
    protected $table            = 'student_goal';
    protected $primaryKey       = 'Student_Goal_Id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'Student_Goal_Id',
        'Goal_Assignment_Id',
        'Student_Id',
        'Goal_Type_Id',
        'Goal_Title',
        'Goal_Assigned_On',
        'Goal_Description',
        'Mentor_Id',
        'Goal_Start_On',
        'Expected_Completion_Date',
        'Actual_Completion_Date',
        'Target_Value',
        'Achieved_Value',
        'Self_Progress',
        'Mentor_Progress',
        'Student_Remark',
        'Mentor_Remark',
        'Goal_Status',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    protected $useTimestamps = false;
}
