<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;

use App\Models\DigitalShaktiModel;
use App\Models\StudentModel;

use App\Models\ProgramModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\StudentProgramModel;
use Config\CorePrograms;

class DigitalShakti extends BaseController
{
    protected $digitalModel;
    protected $studentModel;

    public function __construct()
    {
        $this->digitalModel = new DigitalShaktiModel();
        $this->studentModel = new StudentModel();
    }

    /**
     * List Page
     */
    public function index()
    {
        $data['students'] = $this->digitalModel->getAllStudents();

        return view(
            'ManageStudents/DigitalShakti/digital_shakti',
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
            ->where('Program_Id', 'PRG_DS')
            ->where('Batch_Status', 'Active')
            ->findAll();

        $db = \Config\Database::connect();

        $data['centers'] = $db->table('program_center_rel pcr')
            ->select('cm.*')
            ->join('center_m cm', 'cm.Center_Id = pcr.Center_Id')
            ->where('pcr.Program_Id', CorePrograms::DIGITAL_SHAKTI)
            ->where('cm.Center_Status', 'Active')
            ->get()
            ->getResultArray();

        return view(
            'ManageStudents/DigitalShakti/add_digitalShakti',
            $data
        );
    }

    /**
     * Save Student
     */
    public function save()
    {
        $db = \Config\Database::connect();

        $db->transStart();

        //------------------------------------
        // Generate IDs
        //------------------------------------

        $studentId = 'STU' . date('YmdHis');
        $dsId      = 'DS' . date('YmdHis');
        $spId      = 'SP' . date('YmdHis');


        //--------------------------------
        // Upload Student Photo
        //--------------------------------

        $photo = $this->request->getFile('photo');
        $photoName = null;

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $photo->getRandomName();

            $photo->move(
                FCPATH . 'uploads/students/photos',
                $photoName
            );
        }

        //--------------------------------
        // Upload Aadhaar Photo
        //--------------------------------

        $aadharPhoto = $this->request->getFile('aadhar_photo');
        $aadharPhotoName = null;

        if (
            $aadharPhoto &&
            $aadharPhoto->isValid() &&
            !$aadharPhoto->hasMoved()
        ) {

            $aadharPhotoName = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                FCPATH . 'uploads/students/aadhar',
                $aadharPhotoName
            );
        }

        //------------------------------------
        // STUDENT TABLE
        //------------------------------------

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

        //------------------------------------
        // DIGITAL SHAKTI TABLE
        //------------------------------------

        $digitalData = [

            'DS_Stu_Id' => $dsId,

            'Student_Id' => $studentId,

            'Skill_level' =>
            $this->request->getPost('program_level'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Completion_Date' =>
            $this->request->getPost('prog_till'),

            'DS_Status' =>
            $this->request->getPost('program_status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Added_By' => 'Admin',
            'Rec_Added_On' => date('Y-m-d')
        ];

        $this->digitalModel->insert($digitalData);

        //------------------------------------
        // STUDENT PROGRAM TABLE
        //------------------------------------

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel->insert([

            'Student_Program_Id' => $spId,

            'Student_Id' => $studentId,

            'Program_Id' => CorePrograms::DIGITAL_SHAKTI,

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Student_Status' =>
            $this->request->getPost('program_status')
        ]);

        //------------------------------------
        // Commit Transaction
        //------------------------------------

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to save student');
        }

        return redirect()->to('/digitalshakti')
            ->with('success', 'Student Added Successfully');
    }

    /**
     * View
     */
    public function view($id)
    {
        $data['student'] =
            $this->digitalModel->getStudentDetails($id);

        return view(
            'ManageStudents/DigitalShakti/view_digitalShakti',
            $data
        );
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        $data['student'] = $this->digitalModel->getStudentDetails($id);

        $centerModel  = new \App\Models\CenterModel();
        $batchModel   = new \App\Models\BatchModel();

        $data['batches'] = $batchModel
            ->where('Program_Id', 'PRG_DS')
            ->findAll();

        $centerIds = $batchModel
            ->select('Center_Id')
            ->where('Program_Id', 'PRG_DS')
            ->findAll();

        $centerIds = array_unique(
            array_column($centerIds, 'Center_Id')
        );

        $data['centers'] = $centerModel
            ->whereIn('Center_Id', $centerIds)
            ->findAll();
        return view(
            'ManageStudents/DigitalShakti/edit_digitalShakti',
            $data
        );
    }

    /**
     * Update
     */
    public function update($id)
    {
        $student = $this->digitalModel
            ->where('DS_Stu_Id', $id)
            ->first();

        if (!$student) {
            return redirect()->back()
                ->with('error', 'Student not found');
        }

        $studentId = $student['Student_Id'];

        $db = \Config\Database::connect();

        $db->transStart();

        $uploadPathPhoto  = FCPATH . 'uploads/students/photos/';
        $uploadPathAadhar = FCPATH . 'uploads/students/aadhar/';

        // Existing Student
        $studentData = $this->studentModel
            ->where('Student_Id', $studentId)
            ->first();

        $studentPhotoName = $studentData['Photo_URL'] ?? null;
        $aadharPhotoName  = $studentData['Aadhar_Photo_URL'] ?? null;


        $studentPhoto = $this->request->getFile('student_photo');

        if ($studentPhoto && $studentPhoto->isValid() && !$studentPhoto->hasMoved()) {

            if (!is_dir($uploadPathPhoto)) {
                mkdir($uploadPathPhoto, 0777, true);
            }

            $newStudentPhoto = $studentPhoto->getRandomName();

            $studentPhoto->move(
                $uploadPathPhoto,
                $newStudentPhoto
            );

            if (
                !empty($studentPhotoName) &&
                file_exists($uploadPathPhoto . $studentPhotoName)
            ) {
                unlink($uploadPathPhoto . $studentPhotoName);
            }

            $studentPhotoName = $newStudentPhoto;
        }


        $aadharPhoto = $this->request->getFile('aadhar_photo');

        if ($aadharPhoto && $aadharPhoto->isValid() && !$aadharPhoto->hasMoved()) {

            if (!is_dir($uploadPathAadhar)) {
                mkdir($uploadPathAadhar, 0777, true);
            }

            $newAadharPhoto = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                $uploadPathAadhar,
                $newAadharPhoto
            );

            if (
                !empty($aadharPhotoName) &&
                file_exists($uploadPathAadhar . $aadharPhotoName)
            ) {
                unlink($uploadPathAadhar . $aadharPhotoName);
            }

            $aadharPhotoName = $newAadharPhoto;
        }

        //-----------------------------------
        // Update Student Table
        //-----------------------------------

        $this->studentModel
            ->where('Student_Id', $studentId)
            ->set([
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

                'Photo_URL' => $studentPhotoName,

                'Aadhar_Photo_URL' => $aadharPhotoName,


                'Current_Education_level' =>
                $this->request->getPost('current_edu'),

                'Highest_Education_Completed' =>
                $this->request->getPost('highest_edu'),

                'Student_Caste' =>
                $this->request->getPost('caste'),

                'Student_Status' =>
                $this->request->getPost('status'),

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
                $this->request->getPost('siblings')

            ])
            ->update();

        //-----------------------------------
        // Update Digital Shakti Table
        //-----------------------------------

        $this->digitalModel
            ->update($id, [
                'Skill_level' =>
                $this->request->getPost('program_level'),

                'Enrollment_Date' =>
                $this->request->getPost('enroll_date'),

                'Completion_Date' =>
                $this->request->getPost('prog_till'),

                'DS_Status' =>
                $this->request->getPost('program_status')
            ]);

        //-----------------------------------
        // Update Student Program Table
        //-----------------------------------

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel
            ->where('Student_Id', $studentId)
            ->set([
                'Center_Id' =>
                $this->request->getPost('center_id'),

                'Batch_Id' =>
                $this->request->getPost('batch_id'),

                'Enrollment_Date' =>
                $this->request->getPost('enroll_date'),

                'Student_Status' =>
                $this->request->getPost('program_status')
            ])
            ->update();

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update student');
        }

        // ADD THIS
        return redirect()
            ->to('/digitalshakti')
            ->with('success', 'Student Updated Successfully');
    }
    public function delete($id)
    {
        $student = $this->digitalModel
            ->where('DS_Stu_Id', $id)
            ->first();

        if (!$student) {
            return redirect()->back()
                ->with('error', 'Student not found');
        }

        $studentId = $student['Student_Id'];

        $studentInfo = $this->studentModel
            ->where('Student_Id', $studentId)
            ->first();

        if ($studentInfo) {

            if (
                !empty($studentInfo['Photo_URL']) &&
                file_exists(FCPATH . 'uploads/students/photos/' . $studentInfo['Photo_URL'])
            ) {
                unlink(FCPATH . 'uploads/students/photos/' . $studentInfo['Photo_URL']);
            }

            if (
                !empty($studentInfo['Aadhar_Photo_URL']) &&
                file_exists(FCPATH . 'uploads/students/aadhar/' . $studentInfo['Aadhar_Photo_URL'])
            ) {
                unlink(FCPATH . 'uploads/students/aadhar/' . $studentInfo['Aadhar_Photo_URL']);
            }
        }

        $this->digitalModel->delete($id);

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel
            ->where('Student_Id', $studentId)
            ->where('Program_Id', CorePrograms::DIGITAL_SHAKTI)
            ->delete();

        $this->studentModel
            ->where('Student_Id', $studentId)
            ->delete();

        return redirect()
            ->to('/digitalshakti')
            ->with('success', 'Student Deleted Successfully');
    }
}
