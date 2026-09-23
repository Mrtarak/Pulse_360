<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;

use App\Models\StudentModel;
use App\Models\VijetaasModel;
use App\Models\UserModel;

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
        vijetaas_stu.Highest_Education_Level,
        vijetaas_stu.Highest_Qualification,
        vijetaas_stu.Highest_Specialization_Subject,
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
        $educationLevelModel = new \App\Models\EducationLevelModel();

        $data['educationLevels'] = $educationLevelModel
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view(
            'ManageStudents/vijetaas/add',
            $data
        );
    }

    public function getQualifications($levelId)
    {
        $qualificationModel =
            new \App\Models\EducationQualificationModel();

        $qualifications = $qualificationModel
            ->where('education_level_id', $levelId)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response->setJSON($qualifications);
    }


    public function store()
    {
        $studentModel  = new StudentModel();
        $vijetaasModel = new VijetaasModel();

        // Student ID
        $studentId = 'STU' . date('YmdHis');

        // Vijetaas ID
        $vijetaasId = 'VJ' . date('YmdHis');


        $validation = \Config\Services::validation();

        $validation->setRules([
            'photo' => [
                'rules' => 'permit_empty|is_image[photo]|max_size[photo,2048]|mime_in[photo,image/jpg,image/jpeg,image/png]',
            ],
            'aadhar_photo' => [
                'rules' => 'permit_empty|is_image[aadhar_photo]|max_size[aadhar_photo,2048]|mime_in[aadhar_photo,image/jpg,image/jpeg,image/png]',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {

            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validation->getErrors()));
        }


        //-------------------------------------
        // Upload Student Photo
        //-------------------------------------

        $photoName = null;

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $photo->getRandomName();

            $photo->move(
                FCPATH . 'uploads/students/photos/',
                $photoName
            );
        }


        //-------------------------------------
        // Upload Aadhaar Photo
        //-------------------------------------

        $aadharPhotoName = null;

        $aadharPhoto = $this->request->getFile('aadhar_photo');

        if ($aadharPhoto && $aadharPhoto->isValid() && !$aadharPhoto->hasMoved()) {

            $aadharPhotoName = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                FCPATH . 'uploads/students/aadhar/',
                $aadharPhotoName
            );
        }

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

            'Photo_URL' => $photoName,

            'Aadhar_Photo_URL' => $aadharPhotoName,

            'Student_Status'
            => $this->request->getPost('Student_Status'),

            'Fathers_Name'
            => $this->request->getPost('father_name'),

            'Guardian_Relation'
            => $this->request->getPost('Guardian_Relation'),

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

            'Goal_Id' => null,

            'Mentor_Id' => null,

            'Vijetas_Mail_Id'
            => $this->request->getPost('Email_Id'),

            'Current_Education_Level'
            => $this->request->getPost('Current_Education_Level'),

            'Current_Qualification'
            => $this->request->getPost('Current_Qualification'),

            'Current_Education_Status'
            => $this->request->getPost('Current_Education_Status'),

            'Current_Specialization_Subject'
            => $this->request->getPost('Current_Specialization_Subject'),

            'Highest_Education_Level'
            => $this->request->getPost('Highest_Education_Level'),

            'Highest_Qualification'
            => $this->request->getPost('Highest_Qualification'),

            'Highest_Specialization_Subject'
            => $this->request->getPost('Highest_Specialization_Subject'),

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

        return view(
            'ManageStudents/vijetaas/view',
            $data
        );
    }

    public function edit($id)
    {
        $vijetaasModel = new VijetaasModel();

        $educationLevelModel =
            new \App\Models\EducationLevelModel();

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
    | Education Levels
    |--------------------------------------------------------------------------
    */

        $data['educationLevels'] = $educationLevelModel

            ->where('status', 1)

            ->orderBy('name', 'ASC')

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

        $studentRecord = $studentModel->find($studentId);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'photo' => [
                'rules' => 'permit_empty|is_image[photo]|max_size[photo,2048]|mime_in[photo,image/jpg,image/jpeg,image/png]',
            ],
            'aadhar_photo' => [
                'rules' => 'permit_empty|is_image[aadhar_photo]|max_size[aadhar_photo,2048]|mime_in[aadhar_photo,image/jpg,image/jpeg,image/png]',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {

            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validation->getErrors()));
        }


        //-------------------------------------
        // Student Photo Upload
        //-------------------------------------

        $photoName = $studentRecord['Photo_URL'];

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            if (!empty($studentRecord['Photo_URL'])) {

                $oldPhoto = FCPATH . 'uploads/students/photos/' . $studentRecord['Photo_URL'];

                if (file_exists($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            $photoName = $photo->getRandomName();

            $photo->move(
                FCPATH . 'uploads/students/photos/',
                $photoName
            );
        }


        //-------------------------------------
        // Aadhaar Photo Upload
        //-------------------------------------

        $aadharPhotoName = $studentRecord['Aadhar_Photo_URL'];

        $aadharPhoto = $this->request->getFile('aadhar_photo');

        if ($aadharPhoto && $aadharPhoto->isValid() && !$aadharPhoto->hasMoved()) {

            if (!empty($studentRecord['Aadhar_Photo_URL'])) {

                $oldAadhar = FCPATH . 'uploads/students/aadhar/' . $studentRecord['Aadhar_Photo_URL'];

                if (file_exists($oldAadhar)) {
                    unlink($oldAadhar);
                }
            }

            $aadharPhotoName = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                FCPATH . 'uploads/students/aadhar/',
                $aadharPhotoName
            );
        }

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

            'Photo_URL' => $photoName,

            'Aadhar_Photo_URL' => $aadharPhotoName,

            'Student_Status'
            => $this->request->getPost('student_status'),

            'Fathers_Name'
            => $this->request->getPost('father_name'),

            'Guardian_Relation'
            => $this->request->getPost('Guardian_Relation'),

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

            'Goal_Id' => null,

            'Mentor_Id' => null,

            'Vijetas_Mail_Id'
            => $this->request->getPost('vijetaas_email'),

            'Current_Education_Level'
            => $this->request->getPost('Current_Education_Level'),

            'Current_Qualification'
            => $this->request->getPost('Current_Qualification'),

            'Current_Education_Status'
            => $this->request->getPost('Current_Education_Status'),

            'Current_Specialization_Subject'
            => $this->request->getPost('Current_Specialization_Subject'),

            'Highest_Education_Level'
            => $this->request->getPost('Highest_Education_Level'),

            'Highest_Qualification'
            => $this->request->getPost('Highest_Qualification'),

            'Highest_Specialization_Subject'
            => $this->request->getPost('Highest_Specialization_Subject'),

            'Enrollment_Date'
            => $this->request->getPost('enroll_date'),

            'Completion_Date'
            => $this->request->getPost('completion_date'),

            'Vijeta_Status'
            => $this->request->getPost('vijeta_status'),

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
