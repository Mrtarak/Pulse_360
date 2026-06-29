<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\StudentModel;
use App\Models\VijetaasModel;
use App\Models\UserModel;
use App\Models\StudentGoalsModel;
use App\Models\GoalModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;


class Vijetaas extends BaseController
{
    public function index()
    {
        $vijetaasModel = new VijetaasModel();

        /*
|--------------------------------------------------------------------------
| Personal Details Tab
|--------------------------------------------------------------------------
*/

        $data['personalDetails'] = $vijetaasModel

            ->select("
        vijetaas_stu.Vijetaas_Stu_Id,

        student.First_Name,
        student.Last_Name,
        student.Email_Id,
        student.Phone_No,
        student.Current_Education_level,
        student.Student_Status,
        student.Village_City,
        student.State
    ")

            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )

            ->findAll();


        /*
|--------------------------------------------------------------------------
| Goal Details Tab
|--------------------------------------------------------------------------
*/

        $data['goalDetails'] = $vijetaasModel

            ->select("
        vijetaas_stu.Vijetaas_Stu_Id,

        student.First_Name,
        student.Last_Name,

        goal_m.Goal_Title,

        student_goal.Target_Value,
        student_goal.Achieved_Value,
        student_goal.Self_Progress,
        student_goal.Mentor_Progress,
        student_goal.Goal_Start_On,
        student_goal.Expected_Completion_Date,
        student_goal.Actual_Completion_Date
    ")

            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )

            ->join(
                'goal_m',
                'goal_m.Goal_Id = vijetaas_stu.Goal_Id',
                'left'
            )

            ->join(
                'student_goal',
                'student_goal.Goal_Id = goal_m.Goal_Id
         AND student_goal.Student_Id = student.Student_Id',
                'left'
            )

            ->findAll();


        /*
|--------------------------------------------------------------------------
| Mentor Details Tab
|--------------------------------------------------------------------------
*/

        $data['mentorDetails'] = $vijetaasModel

            ->select("
        vijetaas_stu.Vijetaas_Stu_Id,

        student.First_Name,
        student.Last_Name,

        mentor.User_FirstName,
        mentor.User_LastName,

        vijetaas_stu.Vijeta_Status,
        vijetaas_stu.Enrollment_Date
    ")

            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )

            ->join(
                'user_m mentor',
                'mentor.User_Id = vijetaas_stu.Mentor_Id',
                'left'
            )

            ->findAll();

        return view(
            'ManageStudents/vijetaas/list',
            $data
        );
    }


    public function add()
    {
        $goalModel = new GoalModel();
        $userModel = new UserModel();

        $data['goals'] = $goalModel
            ->where('Goal_Status', 'Active')
            ->findAll();

        $data['mentors'] = $userModel
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->findAll();

        return view(
            'ManageStudents/vijetaas/add',
            $data
        );
    }

    public function store()
    {
        $studentModel  = new StudentModel();
        $vijetaasModel = new VijetaasModel();

        // Student ID
        $studentId = 'STU' . date('YmdHis');

        // Vijetaas ID
        $vijetaasId = 'VJ' . date('YmdHis');

        /*
    |--------------------------------------------------------------------------
    | Save Student
    |--------------------------------------------------------------------------
    */
        $studentModel->insert([

            'Student_Id' => $studentId,

            'First_Name' => $this->request->getPost('First_Name'),
            'Last_Name' => $this->request->getPost('Last_Name'),
            'Gender' => $this->request->getPost('Gender'),
            'DOB' => $this->request->getPost('DOB'),

            'Aadhar_No' => $this->request->getPost('Aadhar_No'),
            'Phone_No' => $this->request->getPost('Phone_No'),
            'Email_Id' => $this->request->getPost('Email_Id'),

            'Village_City' => $this->request->getPost('Village_City'),
            'District' => $this->request->getPost('District'),
            'State' => $this->request->getPost('State'),
            'Pincode' => $this->request->getPost('Pincode'),
            'Nationality' => $this->request->getPost('Nationality'),
            'Address' => $this->request->getPost('Address'),

            'Current_Education_level'
            => $this->request->getPost('Current_Education_level'),

            'Highest_Education_Completed'
            => $this->request->getPost('Highest_Education_Completed'),

            'Student_Status'
            => $this->request->getPost('Student_Status'),

            'Fathers_Name'
            => $this->request->getPost('father_name'),

            'Father_Contact_Number'
            => $this->request->getPost('father_contact'),

            'Father_Email_ID'
            => $this->request->getPost('father_email'),

            'Father_Occupation'
            => $this->request->getPost('father_occupation'),

            'Mothers_Name'
            => $this->request->getPost('mother_name'),

            'Mother_Contact_Number'
            => $this->request->getPost('mother_contact'),

            'Mother_Email_ID'
            => $this->request->getPost('mother_email'),

            'Mother_Occupation'
            => $this->request->getPost('mother_occupation'),

            'Family_Monthly_Income'
            => $this->request->getPost('income'),

            'Sibling_Number'
            => $this->request->getPost('siblings'),

            'Remarks'
            => $this->request->getPost('Remarks'),

            'Rec_Added_By' => 'Admin',
            'Rec_Added_On' => date('Y-m-d')
        ]);

        /*
    |--------------------------------------------------------------------------
    | Save Vijetaas Student
    |--------------------------------------------------------------------------
    */

        $vijetaasModel->insert([

            'Vijetaas_Stu_Id' => $vijetaasId,

            'Student_Id' => $studentId,

            // ROLE005 = Mentor
            'Role_Id' => 'ROLE005',

            'Program_Id' => \Config\CorePrograms::VIJEETAS,

            'Goal_Id'
            => $this->request->getPost('Goal_Id'),

            'Mentor_Id'
            => $this->request->getPost('Mentor_Id'),

            'Vijetas_Mail_Id'
            => $this->request->getPost('Email_Id'),

            'Education'
            => $this->request->getPost('Current_Education_level'),

            'Enrollment_Date'
            => $this->request->getPost('Enrollment_Date'),

            'Completion_Date'
            => null,

            'Vijeta_Status'
            => 'Active',

            'Remarks'
            => $this->request->getPost('Remarks'),

            'Rec_Added_By'
            => null,

            'Rec_Added_On'
            => date('Y-m-d')
        ]);

        return redirect()
            ->to('/students/vijetaas')
            ->with(
                'success',
                'Vijetaas Student Added Successfully'
            );
    }

    public function view($id)
    {
        $vijetaasModel = new VijetaasModel();

        $data['student'] = $vijetaasModel

            ->select("
            vijetaas_stu.*,

            student.*,

            mentor.User_FirstName AS Mentor_FirstName,
            mentor.User_LastName AS Mentor_LastName,

            goal_m.Goal_Title,
            goal_m.Goal_Description,

            goaltype_m.Goal_Type_Name,

            student_goal.Student_Goal_Id,
            student_goal.Goal_Start_On,
            student_goal.Expected_Completion_Date,
            student_goal.Actual_Completion_Date,
            student_goal.Target_Value,
            student_goal.Achieved_Value,
            student_goal.Self_Progress,
            student_goal.Mentor_Progress,
            student_goal.Student_Remark,
            student_goal.Mentor_Remark,
            student_goal.Goal_Status
        ")

            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )

            ->join(
                'user_m mentor',
                'mentor.User_Id = vijetaas_stu.Mentor_Id',
                'left'
            )

            ->join(
                'goal_m',
                'goal_m.Goal_Id = vijetaas_stu.Goal_Id',
                'left'
            )

            ->join(
                'goaltype_m',
                'goaltype_m.Goal_Type_Id = goal_m.Goal_Type_Id',
                'left'
            )

            ->join(
                'student_goal',
                'student_goal.Goal_Id = vijetaas_stu.Goal_Id
             AND student_goal.Student_Id = vijetaas_stu.Student_Id',
                'left'
            )

            ->where(
                'vijetaas_stu.Vijetaas_Stu_Id',
                $id
            )

            ->first();

        if (!$data['student']) {

            throw PageNotFoundException::forPageNotFound(
                'Student not found'
            );
        }

        return view(
            'ManageStudents/vijetaas/view',
            $data
        );
    }

    public function edit($id)
    {

        $vijetaasModel = new VijetaasModel();
        $userModel     = new UserModel();
        $goalModel     = new StudentGoalsModel();

        /*
    |--------------------------------------------------------------------------
    | Current Student Record
    |--------------------------------------------------------------------------
    */

        $data['student'] = $vijetaasModel

            ->select("
            vijetaas_stu.*,

            student.*
        ")

            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )

            ->where(
                'vijetaas_stu.Vijetaas_Stu_Id',
                $id
            )

            ->first();

        if (!$data['student']) {
            throw PageNotFoundException::forPageNotFound(
                'Student not found'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Mentor Dropdown
    |--------------------------------------------------------------------------
    */

        $data['mentors'] = $userModel

            ->where('Role_Id', 'ROLE005')

            ->where('User_Status', 'Active')

            ->findAll();

        /*
    |--------------------------------------------------------------------------
    | Goal Dropdown
    |--------------------------------------------------------------------------
    */

        $data['goals'] = (new \App\Models\GoalModel())

            ->select("
        Goal_Id,
        Goal_Title
    ")

            ->where('Goal_Status', 'Active')

            ->findAll();

        return view(
            'ManageStudents/vijetaas/edit',
            $data
        );
    }

    public function update($id)
    {
        $vijetaasModel = new VijetaasModel();
        $studentModel  = new StudentModel();

        /*
    |--------------------------------------------------------------------------
    | Get Existing Record
    |--------------------------------------------------------------------------
    */

        $record = $vijetaasModel
            ->where('Vijetaas_Stu_Id', $id)
            ->first();

        if (!$record) {
            return redirect()
                ->back()
                ->with('error', 'Student not found');
        }

        $studentId = $record['Student_Id'];

        /*
    |--------------------------------------------------------------------------
    | Update STUDENT TABLE
    |--------------------------------------------------------------------------
    */

        $studentModel->update($studentId, [

            'First_Name' => $this->request->getPost('first_name'),

            'Last_Name' => $this->request->getPost('last_name'),

            'Gender' => $this->request->getPost('gender'),

            'DOB' => $this->request->getPost('dob'),

            'Aadhar_No' => $this->request->getPost('aadhar_no'),

            'Phone_No' => $this->request->getPost('phone'),

            'Email_Id' => $this->request->getPost('email'),

            'Village_City' => $this->request->getPost('city'),

            'District' => $this->request->getPost('district'),

            'State' => $this->request->getPost('state'),

            'Pincode' => $this->request->getPost('pincode'),

            'Nationality' => $this->request->getPost('nationality'),

            'Address' => $this->request->getPost('address'),

            'Current_Education_level'
            => $this->request->getPost('current_edu'),

            'Highest_Education_Completed'
            => $this->request->getPost('highest_edu'),

            'Student_Status'
            => $this->request->getPost('status'),

            'Fathers_Name'
            => $this->request->getPost('father_name'),

            'Father_Contact_Number'
            => $this->request->getPost('father_contact'),

            'Father_Email_ID'
            => $this->request->getPost('father_email'),

            'Father_Occupation'
            => $this->request->getPost('father_occupation'),

            'Mothers_Name'
            => $this->request->getPost('mother_name'),

            'Mother_Contact_Number'
            => $this->request->getPost('mother_contact'),

            'Mother_Email_ID'
            => $this->request->getPost('mother_email'),

            'Mother_Occupation'
            => $this->request->getPost('mother_occupation'),

            'Family_Monthly_Income'
            => $this->request->getPost('income'),

            'Sibling_Number'
            => $this->request->getPost('siblings'),
        ]);

        /*
    |--------------------------------------------------------------------------
    | Update VIJETAAS TABLE
    |--------------------------------------------------------------------------
    */

        $vijetaasModel->update($id, [

            'Role_Id' => 'ROLE005',

            'Goal_Id'
            => $this->request->getPost('goal_id'),

            'Mentor_Id'
            => $this->request->getPost('mentor_id'),

            'Vijetas_Mail_Id'
            => $this->request->getPost('email'),

            'Education'
            => $this->request->getPost('current_edu'),

            'Enrollment_Date'
            => $this->request->getPost('enroll_date'),

            'Completion_Date'
            => $this->request->getPost('completion_date'),

            'Vijeta_Status'
            => $this->request->getPost('status'),

            'Remarks'
            => $this->request->getPost('remarks'),

            'Rec_Updated_By'
            => null,

            'Rec_Last_Updated_On'
            => date('Y-m-d')
        ]);

        return redirect()
            ->to('/students/vijetaas')
            ->with('success', 'Vijetaas Student Updated Successfully');
    }

    public function delete($id)
    {
        $vijetaasModel = new VijetaasModel();

        /*
    |--------------------------------------------------------------------------
    | Find Record
    |--------------------------------------------------------------------------
    */

        $record = $vijetaasModel
            ->where('Vijetaas_Stu_Id', $id)
            ->first();

        if (!$record) {

            return redirect()
                ->to('/students/vijetaas')
                ->with('error', 'Record not found');
        }

        /*
    |--------------------------------------------------------------------------
    | Delete Vijetaas Record
    |--------------------------------------------------------------------------
    */

        $vijetaasModel->delete($id);

        return redirect()
            ->to('/students/vijetaas')
            ->with(
                'success',
                'Vijetaas Student Deleted Successfully'
            );
    }
}
