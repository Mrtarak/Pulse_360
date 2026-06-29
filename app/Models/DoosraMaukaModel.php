<?php

namespace App\Models;

use CodeIgniter\Model;

class DoosraMaukaModel extends Model
{
    protected $table = 'doosra_mauka_stu';

    protected $primaryKey = 'DM_Stu_Id';

    protected $returnType = 'array';

    protected $useAutoIncrement = false;

    protected $allowedFields = [

        'DM_Stu_Id',
        'Student_Id',
        'Program_Id',
        'Center_Id',
        'Batch_Id',

        'Donation_Id',
        'Asset_Id',
        'Attendance_Id',
        'Fees_Id',

        'Marital_Status',
        'User_Siblings',
        'Education',
        'Student_Caste',

        'Enrollment_Date',
        'Completion_Date',

        'DM_Status',
        'Remarks',

        'Rec_Added_By',
        'Rec_Added_On',

        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    /**
     * Student List
     */
    public function getAllStudents()
    {
        return $this->db->table('doosra_mauka_stu dm')

            ->select("
                dm.*,

                s.First_Name,
                s.Last_Name,
                s.Gender,
                s.DOB,
                s.Email_Id,
                s.Phone_No,

                c.Center_Name,
                b.Batch_Name
            ")

            ->join(
                'student s',
                's.Student_Id = dm.Student_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = dm.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = dm.Batch_Id',
                'left'
            )

            ->orderBy('s.First_Name', 'ASC')

            ->get()
            ->getResultArray();
    }

    /**
     * Single Student Details
     */
    public function getStudentDetails($id)
    {
        return $this->db->table('doosra_mauka_stu dm')

            ->select("
                dm.*,

                s.*,
                p.Program_Name,
                c.Center_Name,
                b.Batch_Name
            ")

            ->join(
                'student s',
                's.Student_Id = dm.Student_Id',
                'left'
            )

            ->join(
                'program_m p',
                'p.Program_Id = dm.Program_Id',
                'left'
            )


            ->join(
                'center_m c',
                'c.Center_Id = dm.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = dm.Batch_Id',
                'left'
            )

            ->where('dm.DM_Stu_Id', $id)

            ->get()

            ->getRowArray();
    }
}
