<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentGoalsModel extends Model
{
    protected $table            = 'student_goal';
    protected $primaryKey       = 'Goal_Id';

    protected $allowedFields    = [ 
        'Goal_Id',
        'Student_Id',
        'Goal_Type_Id',
        'Mentor_Id',
        'Goal_Start_On',
        'Goal_Expected_completion_Date',
        'Goal_Actual_completion_Date',
        'Goal_Target_Value',
        'Goal_Achieved',
        'Student_Remark',
        'Mentor_Remark',
        'Self_Progress_Percentage',
        'Mentor_Progress_Percentage',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
    public function getGoalsByProgram($programId)
    {
        return $this->select('student_goals.*, student.First_Name, student.Last_Name')
            ->join('student', 'student.Student_Id = student_goals.Student_Id', 'left')
            ->join('student_program sp', 'sp.Student_Id = student.Student_Id', 'left')
            ->where('sp.Program_Id', 'VIJETAAS')
            ->findAll();
    }
}
