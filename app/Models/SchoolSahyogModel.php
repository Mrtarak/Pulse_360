<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolSahyogModel extends Model
{
    protected $table = 'school_sahyog_stu';

    protected $primaryKey = 'SS_Stu_Id';

    protected $returnType = 'array';

    protected $useAutoIncrement = false;

    protected $allowedFields = [

        'SS_Stu_Id',
        'Student_Id',
        'Program_Id',
        'Center_Id',
        'Event_Id',
        'Batch_Id',
        'Attendance_Id',
        'Fees_Id',

        'Student_Class',
        'School_Name',
        'School_Type',
        'School_Medium',

        'User_Siblings',
        'User_Family_MonthlyIncome',
        'Student_Caste',

        'Enrollment_Date',
        'Completion_Date',

        'SS_Status',
        'Remarks',

        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];


    /**
     * School Sahyog Student List
     */
    public function getSchoolSahyogStudents()
    {
        return $this->db->table('school_sahyog_stu ss')

            ->select("
                ss.*,

                s.First_Name,
                s.Last_Name,
                s.Gender,
                s.Phone_No,
                s.Email_Id,

                p.Program_Name,

                c.Center_Name,
                b.Batch_Name
            ")

            ->join(
                'program_m p',
                'p.Program_Id = ss.Program_Id',
                'left'
            )

            ->join(
                'student s',
                's.Student_Id = ss.Student_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = ss.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = ss.Batch_Id',
                'left'
            )

            ->where(
                'ss.Program_Id',
                \Config\CorePrograms::SCHOOL_SAHYOG
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
        return $this->db->table('school_sahyog_stu ss')

            ->select("
                ss.*,

                s.*,

                p.Program_Name,

                c.Center_Name,
                b.Batch_Name
            ")

            ->join(
                'program_m p',
                'p.Program_Id = ss.Program_Id',
                'left'
            )

            ->join(
                'student s',
                's.Student_Id = ss.Student_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = ss.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = ss.Batch_Id',
                'left'
            )

            ->where(
                'ss.SS_Stu_Id',
                $id
            )

            ->get()

            ->getRowArray();
    }


    /**
     * Generate School Sahyog ID
     *
     * Example:
     * SS1000
     * SS1001
     * SS1002
     */
    public function generateId()
    {
        $last = $this->orderBy('SS_Stu_Id', 'DESC')->first();

        if (!$last) {
            return 'SS1000';
        }

        $number = (int) substr($last['SS_Stu_Id'], 2);

        return 'SS' . ($number + 1);
    }
}
