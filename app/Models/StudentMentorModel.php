<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentMentorModel extends Model
{
    protected $table            = 'STUDENT_MENTOR';
    protected $primaryKey       = 'Stu_Mentor_Id';
    public    $incrementing     = false;

    protected $allowedFields    = [
        'Stu_Mentor_Id',
        'Student_Id',
        'Program_Id',
        'Mentor_Name',
        'Mentor_Category',
        'Mentor_Status',
        'Mentor_From_Date',
        'Mentor_To_Date',
        'Mentor_For',
        'Remarks',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
    public function getMentorsByProgram($programId)
    {
        return $this->select('student.First_Name, student.Last_Name, student_mentor.*')
            ->join('student', 'student.Student_Id = student_mentor.Student_Id')
            ->where('student_mentor.Program_Id', $programId)
            ->findAll();
    }
}
