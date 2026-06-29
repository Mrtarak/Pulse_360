<?php

namespace App\Models;

use CodeIgniter\Model;

class LearningAddaModel extends Model
{
    protected $table = 'learning_adda_stu';

    protected $primaryKey = 'LA_Stu_Id';

    protected $returnType = 'array';

    protected $useAutoIncrement = false;

    protected $allowedFields = [

        'LA_Stu_Id',
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

        'LA_Status',
        'Remarks',

        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    /**
     * Learning Adda Student List
     */
    public function getLearningAddaStudents()
    {
        return $this->db->table('learning_adda_stu la')

            ->select("
                la.*,

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
                'p.Program_Id = la.Program_Id',
                'left'
            )

            ->join(
                'student s',
                's.Student_Id = la.Student_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = la.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = la.Batch_Id',
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
        return $this->db->table('learning_adda_stu la')

            ->select("
                la.*,

                s.*,

                p.Program_Name,

                c.Center_Name,
                b.Batch_Name
            ")

            ->join(
                'program_m p',
                'p.Program_Id = la.Program_Id',
                'left'
            )

            ->join(
                'student s',
                's.Student_Id = la.Student_Id',
                'left'
            )

            ->join(
                'center_m c',
                'c.Center_Id = la.Center_Id',
                'left'
            )

            ->join(
                'batch_m b',
                'b.Batch_Id = la.Batch_Id',
                'left'
            )

            ->where('la.LA_Stu_Id', $id)

            ->get()

            ->getRowArray();
    }

    /**
     * Generate Learning Adda ID
     * Example:
     * LA1000
     * LA1001
     * LA1002
     */
    public function generateId()
    {
        $last = $this->orderBy('LA_Stu_Id', 'DESC')->first();

        if (!$last) {
            return 'LA1000';
        }

        $number = (int) substr($last['LA_Stu_Id'], 2);

        return 'LA' . ($number + 1);
    }
}
