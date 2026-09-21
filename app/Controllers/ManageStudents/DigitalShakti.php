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
     * ---------------------------------------------------------
     * List Page
     * ---------------------------------------------------------
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
     * ---------------------------------------------------------
     * Add Page
     * ---------------------------------------------------------
     */
    public function add()
    {
        $batchModel = new BatchModel();

        $data['batches'] = $batchModel
            ->where('Program_Id', CorePrograms::DIGITAL_SHAKTI)
            ->where('Batch_Status', 'Active')
            ->findAll();

        $db = \Config\Database::connect();

        $data['centers'] = $db->table('program_center_rel pcr')
            ->select('cm.*')
            ->join(
                'center_m cm',
                'cm.Center_Id = pcr.Center_Id'
            )
            ->where(
                'pcr.Program_Id',
                CorePrograms::DIGITAL_SHAKTI
            )
            ->where(
                'cm.Center_Status',
                'Active'
            )
            ->get()
            ->getResultArray();

        return view(
            'ManageStudents/DigitalShakti/add_digitalShakti',
            $data
        );
    }


    /**
     * ---------------------------------------------------------
     * Save Student
     * ---------------------------------------------------------
     */
    public function save()
    {
        $db = \Config\Database::connect();

        $db->transStart();


        // -----------------------------------------------------
        // Generate IDs
        // -----------------------------------------------------

        $studentId = 'STU' . date('YmdHis');
        $dsId      = 'DS' . date('YmdHis');
        $spId      = 'SP' . date('YmdHis');


        // -----------------------------------------------------
        // Upload Student Photo
        // -----------------------------------------------------

        $photo = $this->request->getFile('photo');

        $photoName = null;

        if (
            $photo &&
            $photo->isValid() &&
            !$photo->hasMoved()
        ) {

            $uploadPath = FCPATH . 'uploads/students/photos/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $photoName = $photo->getRandomName();

            $photo->move(
                $uploadPath,
                $photoName
            );
        }


        // -----------------------------------------------------
        // Upload Aadhaar Photo
        // -----------------------------------------------------

        $aadharPhoto = $this->request->getFile('aadhar_photo');

        $aadharPhotoName = null;

        if (
            $aadharPhoto &&
            $aadharPhoto->isValid() &&
            !$aadharPhoto->hasMoved()
        ) {

            $uploadPath = FCPATH . 'uploads/students/aadhar/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $aadharPhotoName = $aadharPhoto->getRandomName();

            $aadharPhoto->move(
                $uploadPath,
                $aadharPhotoName
            );
        }


        // =====================================================
        // STUDENT TABLE
        // =====================================================

        $studentData = [

            'Student_Id' =>
            $studentId,

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


            // -------------------------------------------------
            // Personal Details
            // -------------------------------------------------

            'Marital_Status' =>
            $this->request->getPost('marital_status'),

            'Student_Caste' =>
            $this->request->getPost('caste'),


            // -------------------------------------------------
            // Address
            // -------------------------------------------------

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


            // -------------------------------------------------
            // Documents
            // -------------------------------------------------

            'Photo_URL' =>
            $photoName,

            'Aadhar_Photo_URL' =>
            $aadharPhotoName,


            // -------------------------------------------------
            // Education
            // -------------------------------------------------

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Current_Education_level' =>
            $this->request->getPost('current_edu'),

            'Highest_Education_Completed' =>
            $this->request->getPost('highest_edu'),

            'Student_Status' =>
            $this->request->getPost('status'),


            // -------------------------------------------------
            // Remarks
            // -------------------------------------------------

            'Remarks' =>
            $this->request->getPost('remarks'),


            // -------------------------------------------------
            // Guardian Details
            // -------------------------------------------------

            'Fathers_Name' =>
            $this->request->getPost('father_name'),

            'Guardian_Relation' =>
            $this->request->getPost('guardian_relation'),

            'Father_Contact_Number' =>
            $this->request->getPost('father_contact'),

            'Father_Email_ID' =>
            $this->request->getPost('father_email'),

            'Father_Occupation' =>
            $this->request->getPost('father_occupation'),


            // -------------------------------------------------
            // Mother Details
            // -------------------------------------------------

            'Mothers_Name' =>
            $this->request->getPost('mother_name'),

            'Mother_Contact_Number' =>
            $this->request->getPost('mother_contact'),

            'Mother_Email_ID' =>
            $this->request->getPost('mother_email'),

            'Mother_Occupation' =>
            $this->request->getPost('mother_occupation'),


            // -------------------------------------------------
            // Family Details
            // -------------------------------------------------

            'Family_Monthly_Income' =>
            $this->request->getPost('income'),

            'Sibling_Number' =>
            $this->request->getPost('siblings'),


            // -------------------------------------------------
            // Record Details
            // -------------------------------------------------

            'Rec_Added_By' =>
            'Admin',

            'Rec_Added_On' =>
            date('Y-m-d')
        ];


        $this->studentModel->insert($studentData);


        // =====================================================
        // DIGITAL SHAKTI TABLE
        // =====================================================

        $digitalData = [

            'DS_Stu_Id' =>
            $dsId,

            'Student_Id' =>
            $studentId,

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

            'Rec_Added_By' =>
            'Admin',

            'Rec_Added_On' =>
            date('Y-m-d')
        ];


        $this->digitalModel->insert($digitalData);


        // =====================================================
        // STUDENT PROGRAM TABLE
        // =====================================================

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel->insert([

            'Student_Program_Id' =>
            $spId,

            'Student_Id' =>
            $studentId,

            'Program_Id' =>
            CorePrograms::DIGITAL_SHAKTI,

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Student_Status' =>
            $this->request->getPost('program_status')
        ]);


        // =====================================================
        // Complete Transaction
        // =====================================================

        $db->transComplete();


        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to save student'
                );
        }


        return redirect()
            ->to('/digitalshakti')
            ->with(
                'success',
                'Student Added Successfully'
            );
    }


    /**
     * ---------------------------------------------------------
     * View
     * ---------------------------------------------------------
     */
    public function view($id)
    {
        $data['student'] =
            $this->digitalModel->getStudentDetails($id);


        if (!$data['student']) {

            return redirect()
                ->to('/digitalshakti')
                ->with(
                    'error',
                    'Student not found'
                );
        }


        return view(
            'ManageStudents/DigitalShakti/view_digitalShakti',
            $data
        );
    }


    /**
     * ---------------------------------------------------------
     * Edit Page
     * ---------------------------------------------------------
     */
    public function edit($id)
    {
        $data['student'] =
            $this->digitalModel->getStudentDetails($id);


        if (!$data['student']) {

            return redirect()
                ->to('/digitalshakti')
                ->with(
                    'error',
                    'Student not found'
                );
        }


        $centerModel = new CenterModel();
        $batchModel  = new BatchModel();


        // -----------------------------------------------------
        // Active Digital Shakti Batches
        // -----------------------------------------------------

        $data['batches'] = $batchModel
            ->where(
                'Program_Id',
                CorePrograms::DIGITAL_SHAKTI
            )
            ->where(
                'Batch_Status',
                'Active'
            )
            ->findAll();


        // -----------------------------------------------------
        // Digital Shakti Centers
        // -----------------------------------------------------

        $db = \Config\Database::connect();

        $data['centers'] = $db->table('program_center_rel pcr')
            ->select('cm.*')
            ->join(
                'center_m cm',
                'cm.Center_Id = pcr.Center_Id'
            )
            ->where(
                'pcr.Program_Id',
                CorePrograms::DIGITAL_SHAKTI
            )
            ->where(
                'cm.Center_Status',
                'Active'
            )
            ->get()
            ->getResultArray();


        return view(
            'ManageStudents/DigitalShakti/edit_digitalShakti',
            $data
        );
    }


    /**
     * ---------------------------------------------------------
     * Update
     * ---------------------------------------------------------
     */
    public function update($id)
    {
        // -----------------------------------------------------
        // Find Digital Shakti Student
        // -----------------------------------------------------

        $student = $this->digitalModel
            ->where(
                'DS_Stu_Id',
                $id
            )
            ->first();


        if (!$student) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Student not found'
                );
        }


        $studentId =
            $student['Student_Id'];


        $db = \Config\Database::connect();

        $db->transStart();


        // =====================================================
        // EXISTING STUDENT DATA
        // =====================================================

        $studentData = $this->studentModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->first();


        if (!$studentData) {

            $db->transRollback();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Student profile not found'
                );
        }


        // =====================================================
        // FILE PATHS
        // =====================================================

        $uploadPathPhoto =
            FCPATH . 'uploads/students/photos/';

        $uploadPathAadhar =
            FCPATH . 'uploads/students/aadhar/';


        // Existing file names
        $studentPhotoName =
            $studentData['Photo_URL'] ?? null;

        $aadharPhotoName =
            $studentData['Aadhar_Photo_URL'] ?? null;


        // =====================================================
        // UPDATE STUDENT PHOTO
        // =====================================================

        $studentPhoto =
            $this->request->getFile('student_photo');


        if (
            $studentPhoto &&
            $studentPhoto->isValid() &&
            !$studentPhoto->hasMoved()
        ) {

            if (!is_dir($uploadPathPhoto)) {

                mkdir(
                    $uploadPathPhoto,
                    0777,
                    true
                );
            }


            $newStudentPhoto =
                $studentPhoto->getRandomName();


            $studentPhoto->move(
                $uploadPathPhoto,
                $newStudentPhoto
            );


            // Delete old photo
            if (
                !empty($studentPhotoName) &&
                file_exists(
                    $uploadPathPhoto . $studentPhotoName
                )
            ) {

                unlink(
                    $uploadPathPhoto . $studentPhotoName
                );
            }


            $studentPhotoName =
                $newStudentPhoto;
        }


        // =====================================================
        // UPDATE AADHAAR PHOTO
        // =====================================================

        $aadharPhoto =
            $this->request->getFile('aadhar_photo');


        if (
            $aadharPhoto &&
            $aadharPhoto->isValid() &&
            !$aadharPhoto->hasMoved()
        ) {

            if (!is_dir($uploadPathAadhar)) {

                mkdir(
                    $uploadPathAadhar,
                    0777,
                    true
                );
            }


            $newAadharPhoto =
                $aadharPhoto->getRandomName();


            $aadharPhoto->move(
                $uploadPathAadhar,
                $newAadharPhoto
            );


            // Delete old Aadhaar photo
            if (
                !empty($aadharPhotoName) &&
                file_exists(
                    $uploadPathAadhar . $aadharPhotoName
                )
            ) {

                unlink(
                    $uploadPathAadhar . $aadharPhotoName
                );
            }


            $aadharPhotoName =
                $newAadharPhoto;
        }


        // =====================================================
        // UPDATE STUDENT TABLE
        // =====================================================

        $studentUpdateData = [

            // -------------------------------------------------
            // Personal
            // -------------------------------------------------

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

            'Marital_Status' =>
            $this->request->getPost('marital_status'),

            'Student_Caste' =>
            $this->request->getPost('caste'),


            // -------------------------------------------------
            // Address
            // -------------------------------------------------

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


            // -------------------------------------------------
            // Documents
            // -------------------------------------------------

            'Photo_URL' =>
            $studentPhotoName,

            'Aadhar_Photo_URL' =>
            $aadharPhotoName,


            // -------------------------------------------------
            // Education
            // -------------------------------------------------

            'Current_Education_level' =>
            $this->request->getPost('current_edu'),

            'Highest_Education_Completed' =>
            $this->request->getPost('highest_edu'),

            'Student_Status' =>
            $this->request->getPost('status'),


            // -------------------------------------------------
            // Remarks
            // -------------------------------------------------

            'Remarks' =>
            $this->request->getPost('remarks'),


            // -------------------------------------------------
            // Guardian
            // -------------------------------------------------

            'Fathers_Name' =>
            $this->request->getPost('father_name'),

            'Guardian_Relation' =>
            $this->request->getPost('guardian_relation'),

            'Father_Contact_Number' =>
            $this->request->getPost('father_contact'),

            'Father_Email_ID' =>
            $this->request->getPost('father_email'),

            'Father_Occupation' =>
            $this->request->getPost('father_occupation'),


            // -------------------------------------------------
            // Mother
            // -------------------------------------------------

            'Mothers_Name' =>
            $this->request->getPost('mother_name'),

            'Mother_Contact_Number' =>
            $this->request->getPost('mother_contact'),

            'Mother_Email_ID' =>
            $this->request->getPost('mother_email'),

            'Mother_Occupation' =>
            $this->request->getPost('mother_occupation'),


            // -------------------------------------------------
            // Family
            // -------------------------------------------------

            'Family_Monthly_Income' =>
            $this->request->getPost('income'),

            'Sibling_Number' =>
            $this->request->getPost('siblings')
        ];


        $this->studentModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->set($studentUpdateData)
            ->update();


        // =====================================================
        // UPDATE DIGITAL SHAKTI TABLE
        // =====================================================

        $this->digitalModel
            ->where(
                'DS_Stu_Id',
                $id
            )
            ->set([

                'Skill_level' =>
                $this->request->getPost('program_level'),

                'Enrollment_Date' =>
                $this->request->getPost('enroll_date'),

                'Completion_Date' =>
                $this->request->getPost('prog_till'),

                'DS_Status' =>
                $this->request->getPost('program_status'),

                'Remarks' =>
                $this->request->getPost('remarks')

            ])
            ->update();


        // =====================================================
        // UPDATE STUDENT PROGRAM TABLE
        // =====================================================

        $studentProgramModel =
            new StudentProgramModel();


        $studentProgramModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->where(
                'Program_Id',
                CorePrograms::DIGITAL_SHAKTI
            )
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


        // =====================================================
        // COMPLETE TRANSACTION
        // =====================================================

        $db->transComplete();


        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to update student'
                );
        }


        return redirect()
            ->to('/digitalshakti')
            ->with(
                'success',
                'Student Updated Successfully'
            );
    }


    /**
     * ---------------------------------------------------------
     * Delete
     * ---------------------------------------------------------
     */
    public function delete($id)
    {
        $student = $this->digitalModel
            ->where(
                'DS_Stu_Id',
                $id
            )
            ->first();


        if (!$student) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Student not found'
                );
        }


        $studentId =
            $student['Student_Id'];


        // -----------------------------------------------------
        // Get Student Information
        // -----------------------------------------------------

        $studentInfo = $this->studentModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->first();


        if ($studentInfo) {

            // Delete Student Photo
            if (
                !empty($studentInfo['Photo_URL']) &&
                file_exists(
                    FCPATH .
                        'uploads/students/photos/' .
                        $studentInfo['Photo_URL']
                )
            ) {

                unlink(
                    FCPATH .
                        'uploads/students/photos/' .
                        $studentInfo['Photo_URL']
                );
            }


            // Delete Aadhaar Photo
            if (
                !empty($studentInfo['Aadhar_Photo_URL']) &&
                file_exists(
                    FCPATH .
                        'uploads/students/aadhar/' .
                        $studentInfo['Aadhar_Photo_URL']
                )
            ) {

                unlink(
                    FCPATH .
                        'uploads/students/aadhar/' .
                        $studentInfo['Aadhar_Photo_URL']
                );
            }
        }


        // -----------------------------------------------------
        // Delete Digital Shakti Record
        // -----------------------------------------------------

        $this->digitalModel
            ->where(
                'DS_Stu_Id',
                $id
            )
            ->delete();


        // -----------------------------------------------------
        // Delete Student Program Record
        // -----------------------------------------------------

        $studentProgramModel =
            new StudentProgramModel();


        $studentProgramModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->where(
                'Program_Id',
                CorePrograms::DIGITAL_SHAKTI
            )
            ->delete();


        // -----------------------------------------------------
        // Delete Student Record
        // -----------------------------------------------------

        $this->studentModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->delete();


        return redirect()
            ->to('/digitalshakti')
            ->with(
                'success',
                'Student Deleted Successfully'
            );
    }
}
