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
        'Enrollment_Date',
        'Completion_Date',
        'Vijeta_Status',
        'Remarks',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    /**
     * Get all Vijetaas Students
     */
    public function getAllStudents()
    {
        return $this->select(
            '
                vijetaas_stu.*,
                student.First_Name,
                student.Last_Name,
                student.Phone_No,
                student.Email_Id,
                program_m.Program_Name,
                role_m.Role_Name,
                goal_m.Goal_Title,
                CONCAT(
                    user_m.User_FirstName,
                    " ",
                    user_m.User_LastName
                ) as Mentor_Name
                '
        )
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
                'student_goal',
                'student_goal.Student_Goal_Id = vijetaas_stu.Goal_Id',
                'left'
            )
            ->join(
                'goal_m',
                'goal_m.Goal_Id = student_goal.Goal_Id',
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
     * Get Single Student Details
     */
    public function getStudentDetails($id)
    {
        return $this->select(
            '
                vijetaas_stu.*,

                student.*,

                program_m.Program_Name,

                role_m.Role_Name,

                goal_m.Goal_Title,

                student_goal.Goal_Start_On,
                student_goal.Expected_Completion_Date,
                student_goal.Actual_Completion_Date,
                student_goal.Target_Value,
                student_goal.Achieved_Value,
                student_goal.Self_Progress,
                student_goal.Mentor_Progress,
                student_goal.Student_Remark,
                student_goal.Mentor_Remark,

                CONCAT(
                    user_m.User_FirstName,
                    " ",
                    user_m.User_LastName
                ) as Mentor_Name,

                user_m.User_Login_MailID as Mentor_Email
                '
        )
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
                'student_goal',
                'student_goal.Student_Goal_Id = vijetaas_stu.Goal_Id',
                'left'
            )
            ->join(
                'goal_m',
                'goal_m.Goal_Id = student_goal.Goal_Id',
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
