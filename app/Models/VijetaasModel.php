<?php

namespace App\Models;

use CodeIgniter\Model;

class VijetaasModel extends Model
{
    protected $table            = 'vijetaas_stu';
    protected $primaryKey       = 'Vijetaas_Stu_Id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'Vijetaas_Stu_Id',
        'Student_Id',
        'Role_Id',
        'Program_Id',
        'Goal_Id',
        'Mentor_Id',
        'Vijetas_Mail_Id',
        'Education',

        // Current education details
        'Current_Education_Level',
        'Current_Qualification',
        'College_Institution_Name',
        'University_Name',
        'Current_Education_Status',
        'Current_Specialization_Subject',

        // Course details
        'Course_Type',
        'Number_of_Semesters',
        'Number_of_Years',
        'Course_Start_Date',
        'Expected_Course_Completion_Date',

        // Highest education details
        'Highest_Education_Level',
        'Highest_Qualification',
        'Highest_Specialization_Subject',

        // Program details
        'Enrollment_Date',
        'Completion_Date',
        'Vijeta_Status',
        'Remarks',

        // Referral details
        'Referral_Source',
        'Referral_Person_Organisation',

        // Declaration details
        'Declaration_Accepted',
        'Declaration_Accepted_On',
        'Declaration_Certificate_URL',

        // Audit fields
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    /**
     * Get all Vijetaas students.
     */
    public function getAllStudents()
    {
        return $this->select('
                vijetaas_stu.*,
                student.First_Name,
                student.Last_Name,
                student.Phone_No,
                student.Email_Id,
                program_m.Program_Name,
                role_m.Role_Name,
                CONCAT(
                    user_m.User_FirstName,
                    " ",
                    user_m.User_LastName
                ) as Mentor_Name
            ')
            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id',
                'left'
            )
            ->join(
                'program_m',
                'program_m.Program_Id = vijetaas_stu.Program_Id',
                'left'
            )
            ->join(
                'role_m',
                'role_m.Role_Id = vijetaas_stu.Role_Id',
                'left'
            )
            ->join(
                'user_m',
                'user_m.User_Id = vijetaas_stu.Mentor_Id',
                'left'
            )
            ->findAll();
    }

    /**
     * Get single student details.
     */
    public function getStudentDetails($id)
    {
        return $this->select('
                vijetaas_stu.*,
                student.*,
                program_m.Program_Name,
                role_m.Role_Name,
                CONCAT(
                    user_m.User_FirstName,
                    " ",
                    user_m.User_LastName
                ) as Mentor_Name,
                user_m.User_Login_MailID as Mentor_Email
            ')
            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id',
                'left'
            )
            ->join(
                'program_m',
                'program_m.Program_Id = vijetaas_stu.Program_Id',
                'left'
            )
            ->join(
                'role_m',
                'role_m.Role_Id = vijetaas_stu.Role_Id',
                'left'
            )
            ->join(
                'user_m',
                'user_m.User_Id = vijetaas_stu.Mentor_Id',
                'left'
            )
            ->where(
                'vijetaas_stu.Vijetaas_Stu_Id',
                $id
            )
            ->first();
    }
}
