<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\SchoolSahyogModel;
use App\Models\StudentModel;
use App\Models\ProgramModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\StudentProgramModel;
use Config\CorePrograms;

class SchoolSahyog extends BaseController
{
    protected $schoolSahyogModel;
    protected $studentModel;
    protected $programModel;
    protected $centerModel;
    protected $batchModel;

    public function __construct()
    {
        $this->schoolSahyogModel = new SchoolSahyogModel();
        $this->studentModel      = new StudentModel();
        $this->programModel      = new ProgramModel();
        $this->centerModel       = new CenterModel();
        $this->batchModel        = new BatchModel();
    }

    /**
     * List All School Sahyog Students
     */
    public function index()
    {
        $data['students'] = $this->schoolSahyogModel->getSchoolSahyogStudents();

        return view(
            'ManageStudents/SchoolSahyog/school_sahyog_students',
            $data
        );
    }


    /**
     * View Student
     */
    public function view($id)
    {
        $data['student'] = $this->schoolSahyogModel->getStudentDetails($id);

        if (!$data['student']) {
            return redirect()
                ->to('/students/school_sahyog')
                ->with('error', 'Student not found');
        }

        return view(
            'ManageStudents/SchoolSahyog/view_school_sahyog_student',
            $data
        );
    }


    /**
     * Add Page
     */
    public function add()
    {
        $centerModel = new CenterModel();
        $batchModel  = new BatchModel();

        $data['batches'] = $batchModel
            ->where('Program_Id', CorePrograms::SCHOOL_SAHYOG)
            ->where('Batch_Status', 'Active')
            ->findAll();

        $centerIds = $batchModel
            ->select('Center_Id')
            ->where('Program_Id', CorePrograms::SCHOOL_SAHYOG)
            ->findAll();

        $centerIds = array_unique(
            array_column($centerIds, 'Center_Id')
        );

        if (!empty($centerIds)) {

            $data['centers'] = $centerModel
                ->whereIn('Center_Id', $centerIds)
                ->where('Center_Status', 'Active')
                ->findAll();
        } else {

            $data['centers'] = [];
        }

        return view(
            'ManageStudents/SchoolSahyog/add_school_sahyog_student',
            $data
        );
    }


    /**
     * Store New Record
     */
    public function store()
    {
        $db = \Config\Database::connect();

        $db->transStart();

        //-------------------------------------
        // Generate IDs
        //-------------------------------------

        $studentId = 'STU' . date('YmdHis');
        $ssId      = 'SS' . date('YmdHis');
        $spId      = 'SP' . date('YmdHis');


        //-------------------------------------
        // Validation
        //-------------------------------------

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

            return redirect()
                ->back()
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
                FCPATH . 'uploads/students/photos',
                $photoName
            );
        }


        //-------------------------------------
        // Upload Aadhar Photo
        //-------------------------------------

        $aadharPhotoName = null;

        $aadharPhoto = $this->request->getFile('aadhar_photo');

        if ($aadharPhoto && $aadharPhoto->isValid() && !$aadharPhoto->hasMoved()) {

            $aadharPhotoName = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                FCPATH . 'uploads/students/aadhar',
                $aadharPhotoName
            );
        }


        //-------------------------------------
        // STUDENT TABLE
        //-------------------------------------

        $studentData = [

            'Student_Id' => $studentId,

            'First_Name' => $this->request->getPost('first_name'),
            'Last_Name'  => $this->request->getPost('last_name'),

            'Gender' => $this->request->getPost('gender'),
            'DOB'    => $this->request->getPost('dob'),

            'Aadhar_No' => $this->request->getPost('aadhar_no'),

            'Phone_No' => $this->request->getPost('phone'),
            'Email_Id' => $this->request->getPost('email'),

            'Village_City' => $this->request->getPost('city'),
            'District'     => $this->request->getPost('district'),
            'State'        => $this->request->getPost('state'),
            'Pincode'      => $this->request->getPost('pincode'),

            'Nationality' => $this->request->getPost('nationality'),
            'Address'     => $this->request->getPost('address'),

            'Photo_URL' => $photoName,

            'Aadhar_Photo_URL' => $aadharPhotoName,

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Current_Education_level' =>
            $this->request->getPost('current_edu'),

            'Highest_Education_Completed' =>
            $this->request->getPost('highest_edu'),

            'Student_Caste' =>
            $this->request->getPost('caste'),

            'Student_Status' =>
            $this->request->getPost('status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Fathers_Name' =>
            $this->request->getPost('father_name'),

            'Father_Contact_Number' =>
            $this->request->getPost('father_contact'),

            'Father_Email_ID' =>
            $this->request->getPost('father_email'),

            'Father_Occupation' =>
            $this->request->getPost('father_occupation'),

            'Mothers_Name' =>
            $this->request->getPost('mother_name'),

            'Mother_Contact_Number' =>
            $this->request->getPost('mother_contact'),

            'Mother_Email_ID' =>
            $this->request->getPost('mother_email'),

            'Mother_Occupation' =>
            $this->request->getPost('mother_occupation'),

            'Family_Monthly_Income' =>
            $this->request->getPost('income'),

            'Sibling_Number' =>
            $this->request->getPost('siblings'),

            'Rec_Added_By' => 'Admin',

            'Rec_Added_On' => date('Y-m-d')
        ];

        $this->studentModel->insert($studentData);


        //-------------------------------------
        // SCHOOL SAHYOG TABLE
        //-------------------------------------

        $this->schoolSahyogModel->insert([

            'SS_Stu_Id' => $ssId,

            'Student_Id' => $studentId,

            'Program_Id' => CorePrograms::SCHOOL_SAHYOG,

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Student_Class' =>
            $this->request->getPost('student_class'),

            'School_Name' =>
            $this->request->getPost('school_name'),

            'School_Type' =>
            $this->request->getPost('school_type'),

            'School_Medium' =>
            $this->request->getPost('school_medium'),

            'User_Siblings' =>
            $this->request->getPost('siblings'),

            'User_Family_MonthlyIncome' =>
            $this->request->getPost('income'),

            'Student_Caste' =>
            $this->request->getPost('caste'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Completion_Date' =>
            $this->request->getPost('prog_till'),

            'SS_Status' =>
            $this->request->getPost('program_status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Added_By' => null,

            'Rec_Added_On' => date('Y-m-d')
        ]);


        //-------------------------------------
        // STUDENT PROGRAM TABLE
        //-------------------------------------

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel->insert([

            'Student_Program_Id' => $spId,

            'Student_Id' => $studentId,

            'Program_Id' => CorePrograms::SCHOOL_SAHYOG,

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Student_Status' =>
            $this->request->getPost('program_status')
        ]);


        //-------------------------------------
        // Commit
        //-------------------------------------

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to save student');
        }

        return redirect()
            ->to('/students/school_sahyog')
            ->with(
                'success',
                'School Sahyog Student Added Successfully'
            );
    }


    /**
     * Edit Student
     */
    public function edit($id)
    {
        $data['student'] =
            $this->schoolSahyogModel->getStudentDetails($id);

        $data['centers'] = $this->centerModel
            ->where('Center_Status', 'Active')
            ->findAll();

        $data['batches'] = $this->batchModel
            ->where(
                'Program_Id',
                CorePrograms::SCHOOL_SAHYOG
            )
            ->findAll();

        return view(
            'ManageStudents/SchoolSahyog/edit_school_sahyog_student',
            $data
        );
    }


    /**
     * Update Student
     */
    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->transStart();


        //------------------------------------------------
        // Get School Sahyog Record
        //------------------------------------------------

        $ssStudent = $this->schoolSahyogModel->find($id);

        if (!$ssStudent) {

            return redirect()
                ->back()
                ->with('error', 'Student not found');
        }

        $studentId = $ssStudent['Student_Id'];


        $currentStudent = $this->studentModel->find($studentId);

        $photoName =
            $currentStudent['Photo_URL'];

        $aadharPhotoName =
            $currentStudent['Aadhar_Photo_URL'];


        //-------------------------------------
        // Update Student Photo
        //-------------------------------------

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            if (!empty($photoName)) {

                $oldPhoto =
                    FCPATH .
                    'uploads/students/photos/' .
                    $photoName;

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
        // Update Aadhar Photo
        //-------------------------------------

        $aadharPhoto =
            $this->request->getFile('aadhar_photo');

        if (
            $aadharPhoto &&
            $aadharPhoto->isValid() &&
            !$aadharPhoto->hasMoved()
        ) {

            if (!empty($aadharPhotoName)) {

                $oldAadhar =
                    FCPATH .
                    'uploads/students/aadhar/' .
                    $aadharPhotoName;

                if (file_exists($oldAadhar)) {
                    unlink($oldAadhar);
                }
            }

            $aadharPhotoName =
                $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                FCPATH . 'uploads/students/aadhar/',
                $aadharPhotoName
            );
        }


        //------------------------------------------------
        // UPDATE STUDENT TABLE
        //------------------------------------------------

        $this->studentModel->update($studentId, [

            'First_Name' =>
            $this->request->getPost('first_name'),

            'Last_Name' =>
            $this->request->getPost('last_name'),

            'Gender' =>
            $this->request->getPost('gender'),

            'DOB' =>
            $this->request->getPost('dob'),

            'Aadhar_No' =>
            $this->request->getPost('aadhar_no'),

            'Phone_No' =>
            $this->request->getPost('phone'),

            'Email_Id' =>
            $this->request->getPost('email'),

            'Village_City' =>
            $this->request->getPost('city'),

            'District' =>
            $this->request->getPost('district'),

            'State' =>
            $this->request->getPost('state'),

            'Pincode' =>
            $this->request->getPost('pincode'),

            'Nationality' =>
            $this->request->getPost('nationality'),

            'Address' =>
            $this->request->getPost('address'),

            'Photo_URL' =>
            $photoName,

            'Aadhar_Photo_URL' =>
            $aadharPhotoName,

            'Current_Education_level' =>
            $this->request->getPost('current_edu'),

            'Highest_Education_Completed' =>
            $this->request->getPost('highest_edu'),

            'Student_Caste' =>
            $this->request->getPost('caste'),

            'Student_Status' =>
            $this->request->getPost('status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Fathers_Name' =>
            $this->request->getPost('father_name'),

            'Father_Contact_Number' =>
            $this->request->getPost('father_contact'),

            'Father_Email_ID' =>
            $this->request->getPost('father_email'),

            'Father_Occupation' =>
            $this->request->getPost('father_occupation'),

            'Mothers_Name' =>
            $this->request->getPost('mother_name'),

            'Mother_Contact_Number' =>
            $this->request->getPost('mother_contact'),

            'Mother_Email_ID' =>
            $this->request->getPost('mother_email'),

            'Mother_Occupation' =>
            $this->request->getPost('mother_occupation'),

            'Family_Monthly_Income' =>
            $this->request->getPost('income'),

            'Sibling_Number' =>
            $this->request->getPost('siblings'),

            'Rec_Last_Updated_On' =>
            date('Y-m-d')
        ]);


        //------------------------------------------------
        // UPDATE SCHOOL SAHYOG TABLE
        //------------------------------------------------

        $this->schoolSahyogModel->update($id, [

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Student_Class' =>
            $this->request->getPost('student_class'),

            'School_Name' =>
            $this->request->getPost('school_name'),

            'School_Type' =>
            $this->request->getPost('school_type'),

            'School_Medium' =>
            $this->request->getPost('school_medium'),

            'User_Siblings' =>
            $this->request->getPost('siblings'),

            'User_Family_MonthlyIncome' =>
            $this->request->getPost('income'),

            'Student_Caste' =>
            $this->request->getPost('caste'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Completion_Date' =>
            $this->request->getPost('prog_till'),

            'SS_Status' =>
            $this->request->getPost('program_status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Last_Updated_On' =>
            date('Y-m-d')
        ]);


        //------------------------------------------------
        // COMMIT
        //------------------------------------------------

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Update failed');
        }

        return redirect()
            ->to('/students/school_sahyog')
            ->with(
                'success',
                'Student Updated Successfully'
            );
    }


    /**
     * Delete Student
     */
    public function delete($id)
    {
        $this->schoolSahyogModel->delete($id);

        return redirect()
            ->to('/students/school_sahyog')
            ->with(
                'success',
                'Student Deleted Successfully'
            );
    }
}
