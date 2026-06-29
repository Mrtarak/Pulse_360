<?php

namespace App\Models;

use CodeIgniter\Model;

class DigitalShaktiModel extends Model
{
    protected $table = 'digital_shakti_stu';

    protected $primaryKey = 'DS_Stu_Id';

    protected $returnType = 'array';

    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'DS_Stu_Id',
        'Student_Id',
        'Skill_level',
        'Student_Class',
        'Enrollment_Date',
        'Completion_Date',
        'DS_Status',
        'Remarks',
        'Fees_Id',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    protected $useTimestamps = false;

    /**
     * Get all Digital Shakti students with related details
     */
    public function getAllStudents()
    {
        return $this->db->table('digital_shakti_stu ds')
            ->select("
            ds.DS_Stu_Id,
            ds.Student_Id,
            ds.DS_Status,

            s.First_Name,
            s.Last_Name,
            s.Gender,
            s.DOB,
            s.Email_Id,
            

            p.Program_Name,
            c.Center_Name,
            b.Batch_Name
        ")

            ->join(
                'student s',
                's.Student_Id = ds.Student_Id',
                'left'
            )

            ->join(
                'student_program sp',
                'sp.Student_Id = ds.Student_Id',
                'left'
            )

            ->join(
                'program_m p',
                'p.Program_Id = sp.Program_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = sp.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = sp.Batch_Id',
                'left'
            )

            ->orderBy('s.First_Name', 'ASC')

            ->get()
            ->getResultArray();
    }

    /**
     * Get single student full details
     */
    public function getStudentDetails($id)
    {
        return $this->db->table('digital_shakti_stu ds')

            ->select("
            ds.*,

            s.*,

            sp.Student_Program_Id,
            sp.Program_Id,
            sp.Center_Id,
            sp.Batch_Id,
            sp.Student_Status,

            p.Program_Name,

            c.Center_Name,

            b.Batch_Name,

            f.Total_Fees_Amount,
            f.Paid_Amount,
            f.Fee_Status,

            sm.Mentor_Status,
            sm.From_Date,
            sm.To_Date,
            sm.Mentor_For,

            CONCAT(
                um.User_FirstName,
                ' ',
                um.User_LastName
            ) AS Mentor_Name,

            
        ")

            ->join(
                'student s',
                's.Student_Id = ds.Student_Id',
                'left'
            )

            ->join(
                'student_program sp',
                'sp.Student_Id = ds.Student_Id',
                'left'
            )

            ->join(
                'program_m p',
                'p.Program_Id = sp.Program_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = sp.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = sp.Batch_Id',
                'left'
            )

            ->join(
                'fees f',
                'f.Fees_Id = ds.Fees_Id',
                'left'
            )

            ->join(
                'student_mentor sm',
                'sm.Student_Id = ds.Student_Id',
                'left'
            )

            ->join(
                'user_m um',
                'um.User_Id = sm.Mentor_Id',
                'left'
            )


            ->where('ds.DS_Stu_Id', $id)

            ->get()

            ->getRowArray();
    }
};
