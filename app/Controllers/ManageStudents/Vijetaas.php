<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\VijetaasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Vijetaas extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Common Helpers
    |--------------------------------------------------------------------------
    */

    private function getEducationLevels()
    {
        $educationLevelModel = new \App\Models\EducationLevelModel();

        return $educationLevelModel
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    private function getActiveMentors()
    {
        return db_connect()
            ->table('user_m')
            ->select('User_Id, User_FirstName, User_LastName')
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->orderBy('User_FirstName', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function getStudentRecord($id)
    {
        return (new VijetaasModel())
            ->select('vijetaas_stu.*, student.*')
            ->join(
                'student',
                'student.Student_Id = vijetaas_stu.Student_Id'
            )
            ->where('vijetaas_stu.Vijetaas_Stu_Id', $id)
            ->first();
    }

    private function getMentorIds($id)
    {
        $rows = db_connect()
            ->table('vijetaas_mentor_map')
            ->select('Mentor_User_Id')
            ->where('Vijetaas_Stu_Id', $id)
            ->get()
            ->getResultArray();

        return array_column($rows, 'Mentor_User_Id');
    }

    private function getAssignedMentors($id)
    {
        return db_connect()
            ->table('vijetaas_mentor_map map')
            ->select('mentor.User_Id, mentor.User_FirstName, mentor.User_LastName')
            ->join(
                'user_m mentor',
                'mentor.User_Id = map.Mentor_User_Id',
                'left'
            )
            ->where('map.Vijetaas_Stu_Id', $id)
            ->orderBy('mentor.User_FirstName', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function getPostValue($field)
    {
        $value = $this->request->getPost($field);

        if ($value === '' || $value === null) {
            return null;
        }

        return is_string($value) ? trim($value) : $value;
    }

    private function getSelectedMentorIds()
    {
        $mentorIds = $this->request->getPost('Mentor_Ids');

        if (!is_array($mentorIds)) {
            return [];
        }

        $mentorIds = array_map('strval', $mentorIds);

        return array_values(array_unique(array_filter(
            $mentorIds,
            static function ($id) {
                return trim($id) !== '';
            }
        )));
    }

    private function validateMentorIds(array $mentorIds)
    {
        if (empty($mentorIds)) {
            return true;
        }

        $validMentors = db_connect()
            ->table('user_m')
            ->select('User_Id')
            ->where('Role_Id', 'ROLE005')
            ->where('User_Status', 'Active')
            ->whereIn('User_Id', $mentorIds)
            ->get()
            ->getResultArray();

        $validIds = array_column($validMentors, 'User_Id');

        return count($validIds) === count($mentorIds);
    }

    /*
    |--------------------------------------------------------------------------
    | File Upload Helper
    |--------------------------------------------------------------------------
    */

    private function uploadStudentFile(
        string $field,
        string $directory,
        array &$uploadedFiles
    ) {
        $file = $this->request->getFile($field);

        if (!$file || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if (!$file->isValid() || $file->hasMoved()) {
            throw new \RuntimeException(
                'Invalid file uploaded for ' . $field . '.'
            );
        }

        $uploadPath = FCPATH . trim($directory, '/') . DIRECTORY_SEPARATOR;

        if (
            !is_dir($uploadPath) &&
            !mkdir($uploadPath, 0755, true) &&
            !is_dir($uploadPath)
        ) {
            throw new \RuntimeException(
                'Unable to create upload directory.'
            );
        }

        $fileName = $file->getRandomName();

        $file->move($uploadPath, $fileName);

        $uploadedFiles[] = $uploadPath . $fileName;

        return $fileName;
    }

    private function removeUploadedFiles(array $uploadedFiles)
    {
        foreach ($uploadedFiles as $filePath) {
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }

    private function deleteOldFile($directory, $fileName)
    {
        if (empty($fileName)) {
            return;
        }

        $path = FCPATH
            . trim($directory, '/')
            . DIRECTORY_SEPARATOR
            . basename($fileName);

        if (is_file($path)) {
            unlink($path);
        }
    }

    private function validateStudentUploads()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'photo' => [
                'rules' => 'permit_empty|is_image[photo]|max_size[photo,2048]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Student photo must be a valid image.',
                    'max_size' => 'Student photo must not exceed 2 MB.',
                    'mime_in' => 'Student photo must be JPG, JPEG or PNG.',
                ],
            ],

            'aadhar_photo' => [
                'rules' => 'permit_empty|is_image[aadhar_photo]|max_size[aadhar_photo,2048]|mime_in[aadhar_photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Aadhaar document must be a valid image.',
                    'max_size' => 'Aadhaar document must not exceed 2 MB.',
                    'mime_in' => 'Aadhaar document must be JPG, JPEG or PNG.',
                ],
            ],

            'declaration_certificate' => [
                'rules' => 'permit_empty|max_size[declaration_certificate,5120]|ext_in[declaration_certificate,pdf,jpg,jpeg,png]|mime_in[declaration_certificate,application/pdf,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Declaration certificate must not exceed 5 MB.',
                    'ext_in' => 'Declaration certificate must be PDF, JPG, JPEG or PNG.',
                    'mime_in' => 'Invalid declaration certificate file type.',
                ],
            ],
        ]);

        return $validation;
    }

    /*
    |--------------------------------------------------------------------------
    | Student List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $vijetaasModel = new VijetaasModel();

        /*
        |----------------------------------------------------------------------
        | Personal Details
        |----------------------------------------------------------------------
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
| Goal Details
|--------------------------------------------------------------------------
| Goals are now managed separately through the Goal Assignment module.
*/
        $data['goalDetails'] = [];


        /*
        |----------------------------------------------------------------------
        | Mentor Details
        |----------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | Add Student Page
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        $data['educationLevels'] = $this->getEducationLevels();
        $data['mentors'] = $this->getActiveMentors();

        return view(
            'ManageStudents/vijetaas/add',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Get Qualifications According To Education Level
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Store Vijetaas Student
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $db = db_connect();

        $uploadedFiles = [];
        $transactionStarted = false;

        $validation = $this->validateStudentUploads();

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    implode('<br>', $validation->getErrors())
                );
        }

        try {
            /*
            |------------------------------------------------------------------
            | Declaration Acceptance
            |------------------------------------------------------------------
            */

            $declarationAccepted = $this->request->getPost(
                'Declaration_Accepted'
            ) ? 1 : 0;

            if ($declarationAccepted !== 1) {
                throw new \RuntimeException(
                    'Please accept the declaration before submitting the form.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Mentor Selection
            |------------------------------------------------------------------
            */

            $mentorIds = $this->getSelectedMentorIds();

            if (!$this->validateMentorIds($mentorIds)) {
                throw new \RuntimeException(
                    'One or more selected mentors are invalid or inactive.'
                );
            }

            $primaryMentorId = !empty($mentorIds)
                ? $mentorIds[0]
                : null;

            /*
            |------------------------------------------------------------------
            | Generate IDs
            |------------------------------------------------------------------
            */

            $studentId = 'STU' . date('YmdHis') . random_int(10, 99);
            $vijetaasId = 'VJ' . date('YmdHis') . random_int(10, 99);

            /*
            |------------------------------------------------------------------
            | Upload Documents
            |------------------------------------------------------------------
            */

            $photoName = $this->uploadStudentFile(
                'photo',
                'uploads/students/photos/',
                $uploadedFiles
            );

            $aadharPhotoName = $this->uploadStudentFile(
                'aadhar_photo',
                'uploads/students/aadhar/',
                $uploadedFiles
            );

            $declarationCertificateName = $this->uploadStudentFile(
                'declaration_certificate',
                'uploads/students/declaration/',
                $uploadedFiles
            );

            /*
            |------------------------------------------------------------------
            | Begin Transaction
            |------------------------------------------------------------------
            */

            $db->transBegin();
            $transactionStarted = true;

            /*
            |------------------------------------------------------------------
            | Student Table Data
            |------------------------------------------------------------------
            */

            $studentData = [

                'Student_Id' => $studentId,

                // Personal Information
                'First_Name' => $this->getPostValue('First_Name'),
                'Last_Name' => $this->getPostValue('Last_Name'),
                'Gender' => $this->getPostValue('Gender'),
                'DOB' => $this->getPostValue('DOB'),
                'Student_Caste' => $this->getPostValue('caste'),

                'Aadhar_No' => $this->getPostValue('Aadhar_No'),
                'Phone_No' => $this->getPostValue('Phone_No'),
                'Email_Id' => $this->getPostValue('Email_Id'),
                'Nationality' => $this->getPostValue('Nationality'),

                // Current Address
                'Address' => $this->getPostValue('Address'),
                'Village_City' => $this->getPostValue('Village_City'),
                'District' => $this->getPostValue('District'),
                'State' => $this->getPostValue('State'),
                'Pincode' => $this->getPostValue('Pincode'),

                // Permanent Address
                'Permanent_Address' => $this->getPostValue('Permanent_Address'),
                'Permanent_Village_City' => $this->getPostValue('Permanent_Village_City'),
                'Permanent_District' => $this->getPostValue('Permanent_District'),
                'Permanent_State' => $this->getPostValue('Permanent_State'),
                'Permanent_Pincode' => $this->getPostValue('Permanent_Pincode'),

                // Documents
                'Photo_URL' => $photoName,
                'Aadhar_Photo_URL' => $aadharPhotoName,

                // Student Status
                'Student_Status' => $this->getPostValue('Student_Status'),

                // Guardian Information
                'Fathers_Name' => $this->getPostValue('father_name'),
                'Guardian_Relation' => $this->getPostValue('Guardian_Relation'),
                'Father_Contact_Number' => $this->getPostValue('father_contact'),
                'Father_Email_ID' => $this->getPostValue('father_email'),
                'Father_Occupation' => $this->getPostValue('father_occupation'),

                // Mother Information
                'Mothers_Name' => $this->getPostValue('mother_name'),
                'Mother_Contact_Number' => $this->getPostValue('mother_contact'),
                'Mother_Email_ID' => $this->getPostValue('mother_email'),
                'Mother_Occupation' => $this->getPostValue('mother_occupation'),

                // Family Information
                'Family_Monthly_Income' => $this->getPostValue('income'),
                'Sibling_Number' => $this->getPostValue('siblings'),

                'Rec_Added_By' => session()->get('User_Id') ?? 'Admin',
                'Rec_Added_On' => date('Y-m-d'),
            ];

            if (!$db->table('student')->insert($studentData)) {
                throw new \RuntimeException(
                    'Unable to save student information.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Vijetaas Table Data
            |------------------------------------------------------------------
            */

            $courseType = $this->getPostValue('Course_Type');

            $vijetaasData = [

                'Vijetaas_Stu_Id' => $vijetaasId,
                'Student_Id' => $studentId,

                'Role_Id' => 'ROLE005',
                'Program_Id' => \Config\CorePrograms::VIJEETAS,
                'Goal_Id' => null,

                // Primary Mentor
                'Mentor_Id' => $primaryMentorId,

                // Current Education
                'Current_Education_Level' => $this->getPostValue('Current_Education_Level'),
                'Current_Qualification' => $this->getPostValue('Current_Qualification'),
                'College_Institution_Name' => $this->getPostValue('College_Institution_Name'),
                'University_Name' => $this->getPostValue('University_Name'),
                'Current_Education_Status' => $this->getPostValue('Current_Education_Status'),
                'Current_Specialization_Subject' => $this->getPostValue('Current_Specialization_Subject'),

                // Course Information
                'Course_Type' => $courseType,

                'Number_of_Semesters' => $courseType === 'Semester'
                    ? $this->getPostValue('Number_of_Semesters')
                    : null,

                'Number_of_Years' => $courseType === 'Year'
                    ? $this->getPostValue('Number_of_Years')
                    : null,

                'Expected_Course_Completion_Date' =>
                $this->getPostValue('Expected_Course_Completion_Date'),

                // Highest Education
                'Highest_Education_Level' => $this->getPostValue('Highest_Education_Level'),
                'Highest_Qualification' => $this->getPostValue('Highest_Qualification'),
                'Highest_Specialization_Subject' => $this->getPostValue('Highest_Specialization_Subject'),

                // Program Information
                'Enrollment_Date' => $this->getPostValue('Enrollment_Date'),
                'Completion_Date' => $this->getPostValue('Completion_Date'),
                'Vijeta_Status' => $this->getPostValue('Vijeta_Status'),

                // Referral Information
                'Referral_Source' => $this->getPostValue('Referral_Source'),
                'Referral_Person_Organisation' =>
                $this->getPostValue('Referral_Person_Organisation'),

                // Declaration
                'Declaration_Accepted' => $declarationAccepted,
                'Declaration_Accepted_On' => date('Y-m-d H:i:s'),
                'Declaration_Certificate_URL' => $declarationCertificateName,

                'Rec_Added_By' => session()->get('User_Id') ?? 'Admin',
                'Rec_Added_On' => date('Y-m-d'),
            ];

            if (!$db->table('vijetaas_stu')->insert($vijetaasData)) {
                throw new \RuntimeException(
                    'Unable to save Vijetaas student information.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Save Multiple Mentor Assignments
            |------------------------------------------------------------------
            */

            foreach ($mentorIds as $mentorId) {
                $mentorData = [
                    'Vijetaas_Stu_Id' => $vijetaasId,
                    'Mentor_User_Id' => $mentorId,
                    'Rec_Added_By' => session()->get('User_Id') ?? 'Admin',
                    'Rec_Added_On' => date('Y-m-d'),
                ];

                if (!$db->table('vijetaas_mentor_map')->insert($mentorData)) {
                    throw new \RuntimeException(
                        'Unable to save mentor assignments.'
                    );
                }
            }

            /*
            |------------------------------------------------------------------
            | Commit Transaction
            |------------------------------------------------------------------
            */

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Database transaction failed.'
                );
            }

            $db->transCommit();
            $transactionStarted = false;

            return redirect()
                ->to('/students/vijetaas')
                ->with(
                    'success',
                    'Vijetaas Student Added Successfully'
                );
        } catch (\Throwable $e) {

            if ($transactionStarted) {
                $db->transRollback();
            }

            $this->removeUploadedFiles($uploadedFiles);

            log_message(
                'error',
                'Vijetaas student registration failed: ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to register student. Please check the submitted information and try again.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | View Student
    |--------------------------------------------------------------------------
    */

    public function view($id)
    {
        $data['student'] = $this->getStudentRecord($id);

        if (!$data['student']) {
            throw PageNotFoundException::forPageNotFound(
                'Student not found'
            );
        }

        // Multiple assigned mentors for the individual view page.
        $data['assignedMentors'] = $this->getAssignedMentors($id);

        return view(
            'ManageStudents/vijetaas/view',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Student
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['student'] = $this->getStudentRecord($id);

        if (!$data['student']) {
            throw PageNotFoundException::forPageNotFound(
                'Student not found'
            );
        }

        $data['educationLevels'] = $this->getEducationLevels();
        $data['mentors'] = $this->getActiveMentors();

        // Existing mentor assignments for pre-checked edit checkboxes.
        $data['assignedMentorIds'] = $this->getMentorIds($id);

        return view(
            'ManageStudents/vijetaas/edit',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Student
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $db = db_connect();

        $vijetaasModel = new VijetaasModel();
        $studentModel = new StudentModel();

        $uploadedFiles = [];
        $oldFilesToDelete = [];
        $transactionStarted = false;

        /*
        |----------------------------------------------------------------------
        | Existing Records
        |----------------------------------------------------------------------
        */

        $vijetaasRecord = $vijetaasModel
            ->where('Vijetaas_Stu_Id', $id)
            ->first();

        if (!$vijetaasRecord) {
            return redirect()
                ->to('/students/vijetaas')
                ->with('error', 'Student not found.');
        }

        $studentId = $vijetaasRecord['Student_Id'];

        $studentRecord = $studentModel->find($studentId);

        if (!$studentRecord) {
            return redirect()
                ->to('/students/vijetaas')
                ->with('error', 'Student information not found.');
        }

        /*
        |----------------------------------------------------------------------
        | File Validation
        |----------------------------------------------------------------------
        */

        $validation = $this->validateStudentUploads();

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    implode('<br>', $validation->getErrors())
                );
        }

        try {
            /*
            |------------------------------------------------------------------
            | Declaration Acceptance
            |------------------------------------------------------------------
            */

            $declarationAccepted = $this->request->getPost(
                'Declaration_Accepted'
            ) ? 1 : 0;

            if ($declarationAccepted !== 1) {
                throw new \RuntimeException(
                    'Please accept the declaration before updating the form.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Mentor Selection
            |------------------------------------------------------------------
            */

            $mentorIds = $this->getSelectedMentorIds();

            if (!$this->validateMentorIds($mentorIds)) {
                throw new \RuntimeException(
                    'One or more selected mentors are invalid or inactive.'
                );
            }

            $primaryMentorId = !empty($mentorIds)
                ? $mentorIds[0]
                : null;

            /*
            |------------------------------------------------------------------
            | Existing Document Names
            |------------------------------------------------------------------
            */

            $photoName = $studentRecord['Photo_URL'] ?? null;
            $aadharPhotoName = $studentRecord['Aadhar_Photo_URL'] ?? null;

            $declarationCertificateName =
                $vijetaasRecord['Declaration_Certificate_URL'] ?? null;

            /*
            |------------------------------------------------------------------
            | New Student Photo
            |------------------------------------------------------------------
            */

            $newPhoto = $this->uploadStudentFile(
                'photo',
                'uploads/students/photos/',
                $uploadedFiles
            );

            if ($newPhoto) {
                if (!empty($photoName)) {
                    $oldFilesToDelete[] = [
                        'directory' => 'uploads/students/photos/',
                        'file' => $photoName,
                    ];
                }

                $photoName = $newPhoto;
            }

            /*
            |------------------------------------------------------------------
            | New Aadhaar Document
            |------------------------------------------------------------------
            */

            $newAadharPhoto = $this->uploadStudentFile(
                'aadhar_photo',
                'uploads/students/aadhar/',
                $uploadedFiles
            );

            if ($newAadharPhoto) {
                if (!empty($aadharPhotoName)) {
                    $oldFilesToDelete[] = [
                        'directory' => 'uploads/students/aadhar/',
                        'file' => $aadharPhotoName,
                    ];
                }

                $aadharPhotoName = $newAadharPhoto;
            }

            /*
            |------------------------------------------------------------------
            | New Declaration Certificate
            |------------------------------------------------------------------
            */

            $newDeclarationCertificate = $this->uploadStudentFile(
                'declaration_certificate',
                'uploads/students/declaration/',
                $uploadedFiles
            );

            if ($newDeclarationCertificate) {
                if (!empty($declarationCertificateName)) {
                    $oldFilesToDelete[] = [
                        'directory' => 'uploads/students/declaration/',
                        'file' => $declarationCertificateName,
                    ];
                }

                $declarationCertificateName = $newDeclarationCertificate;
            }

            /*
            |------------------------------------------------------------------
            | Begin Transaction
            |------------------------------------------------------------------
            */

            $db->transBegin();
            $transactionStarted = true;

            /*
            |------------------------------------------------------------------
            | Update Student Table
            |------------------------------------------------------------------
            */

            $studentData = [

                // Personal Information
                'First_Name' => $this->getPostValue('First_Name'),
                'Last_Name' => $this->getPostValue('Last_Name'),
                'Gender' => $this->getPostValue('Gender'),
                'DOB' => $this->getPostValue('DOB'),
                'Student_Caste' => $this->getPostValue('caste'),

                'Aadhar_No' => $this->getPostValue('Aadhar_No'),
                'Phone_No' => $this->getPostValue('Phone_No'),
                'Email_Id' => $this->getPostValue('Email_Id'),
                'Nationality' => $this->getPostValue('Nationality'),

                // Current Address
                'Address' => $this->getPostValue('Address'),
                'Village_City' => $this->getPostValue('Village_City'),
                'District' => $this->getPostValue('District'),
                'State' => $this->getPostValue('State'),
                'Pincode' => $this->getPostValue('Pincode'),

                // Permanent Address
                'Permanent_Address' => $this->getPostValue('Permanent_Address'),
                'Permanent_Village_City' => $this->getPostValue('Permanent_Village_City'),
                'Permanent_District' => $this->getPostValue('Permanent_District'),
                'Permanent_State' => $this->getPostValue('Permanent_State'),
                'Permanent_Pincode' => $this->getPostValue('Permanent_Pincode'),

                // Documents
                'Photo_URL' => $photoName,
                'Aadhar_Photo_URL' => $aadharPhotoName,

                // Student Status
                'Student_Status' => $this->getPostValue('Student_Status'),

                // Guardian Information
                'Fathers_Name' => $this->getPostValue('father_name'),
                'Guardian_Relation' => $this->getPostValue('Guardian_Relation'),
                'Father_Contact_Number' => $this->getPostValue('father_contact'),
                'Father_Email_ID' => $this->getPostValue('father_email'),
                'Father_Occupation' => $this->getPostValue('father_occupation'),

                // Mother Information
                'Mothers_Name' => $this->getPostValue('mother_name'),
                'Mother_Contact_Number' => $this->getPostValue('mother_contact'),
                'Mother_Email_ID' => $this->getPostValue('mother_email'),
                'Mother_Occupation' => $this->getPostValue('mother_occupation'),

                // Family Information
                'Family_Monthly_Income' => $this->getPostValue('income'),
                'Sibling_Number' => $this->getPostValue('siblings'),

                'Rec_Updated_By' => session()->get('User_Id') ?? 'Admin',
                'Rec_Last_Updated_On' => date('Y-m-d'),
            ];

            if (!$db->table('student')
                ->where('Student_Id', $studentId)
                ->update($studentData)) {
                throw new \RuntimeException(
                    'Unable to update student information.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Update Vijetaas Table
            |------------------------------------------------------------------
            */

            $courseType = $this->getPostValue('Course_Type');

            $vijetaasData = [

                'Role_Id' => 'ROLE005',
                'Program_Id' => \Config\CorePrograms::VIJEETAS,
                'Goal_Id' => null,

                // Primary Mentor
                'Mentor_Id' => $primaryMentorId,

                // Current Education
                'Current_Education_Level' => $this->getPostValue('Current_Education_Level'),
                'Current_Qualification' => $this->getPostValue('Current_Qualification'),
                'College_Institution_Name' => $this->getPostValue('College_Institution_Name'),
                'University_Name' => $this->getPostValue('University_Name'),
                'Current_Education_Status' => $this->getPostValue('Current_Education_Status'),
                'Current_Specialization_Subject' => $this->getPostValue('Current_Specialization_Subject'),

                // Course Information
                'Course_Type' => $courseType,

                'Number_of_Semesters' => $courseType === 'Semester'
                    ? $this->getPostValue('Number_of_Semesters')
                    : null,

                'Number_of_Years' => $courseType === 'Year'
                    ? $this->getPostValue('Number_of_Years')
                    : null,

                'Expected_Course_Completion_Date' =>
                $this->getPostValue('Expected_Course_Completion_Date'),

                // Highest Education
                'Highest_Education_Level' => $this->getPostValue('Highest_Education_Level'),
                'Highest_Qualification' => $this->getPostValue('Highest_Qualification'),
                'Highest_Specialization_Subject' => $this->getPostValue('Highest_Specialization_Subject'),

                // Program Information
                'Enrollment_Date' => $this->getPostValue('Enrollment_Date'),
                'Completion_Date' => $this->getPostValue('Completion_Date'),
                'Vijeta_Status' => $this->getPostValue('Vijeta_Status'),

                // Referral Information
                'Referral_Source' => $this->getPostValue('Referral_Source'),
                'Referral_Person_Organisation' =>
                $this->getPostValue('Referral_Person_Organisation'),

                // Declaration
                'Declaration_Accepted' => $declarationAccepted,
                'Declaration_Accepted_On' => date('Y-m-d H:i:s'),
                'Declaration_Certificate_URL' => $declarationCertificateName,

                'Rec_Updated_By' => session()->get('User_Id') ?? 'Admin',
                'Rec_Last_Updated_On' => date('Y-m-d'),
            ];

            if (!$db->table('vijetaas_stu')
                ->where('Vijetaas_Stu_Id', $id)
                ->update($vijetaasData)) {
                throw new \RuntimeException(
                    'Unable to update Vijetaas information.'
                );
            }

            /*
            |------------------------------------------------------------------
            | Replace Mentor Assignments
            |------------------------------------------------------------------
            */

            if (!$db->table('vijetaas_mentor_map')
                ->where('Vijetaas_Stu_Id', $id)
                ->delete()) {
                throw new \RuntimeException(
                    'Unable to update previous mentor assignments.'
                );
            }

            foreach ($mentorIds as $mentorId) {
                $mentorData = [
                    'Vijetaas_Stu_Id' => $id,
                    'Mentor_User_Id' => $mentorId,
                    'Rec_Added_By' => session()->get('User_Id') ?? 'Admin',
                    'Rec_Added_On' => date('Y-m-d'),
                ];

                if (!$db->table('vijetaas_mentor_map')->insert($mentorData)) {
                    throw new \RuntimeException(
                        'Unable to save mentor assignments.'
                    );
                }
            }

            /*
            |------------------------------------------------------------------
            | Commit Transaction
            |------------------------------------------------------------------
            */

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Database transaction failed.'
                );
            }

            $db->transCommit();
            $transactionStarted = false;

            /*
            |------------------------------------------------------------------
            | Remove Replaced Files After Successful Update
            |------------------------------------------------------------------
            */

            foreach ($oldFilesToDelete as $oldFile) {
                $this->deleteOldFile(
                    $oldFile['directory'],
                    $oldFile['file']
                );
            }

            return redirect()
                ->to('/students/vijetaas')
                ->with(
                    'success',
                    'Vijetaas Student Updated Successfully'
                );
        } catch (\Throwable $e) {

            if ($transactionStarted) {
                $db->transRollback();
            }

            // Keep the old files and remove only newly uploaded files.
            $this->removeUploadedFiles($uploadedFiles);

            log_message(
                'error',
                'Vijetaas student update failed: ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to update student. Please check the submitted information and try again.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Student
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $db = db_connect();

        $vijetaasModel = new VijetaasModel();

        $record = $vijetaasModel
            ->where('Vijetaas_Stu_Id', $id)
            ->first();

        if (!$record) {
            return redirect()
                ->to('/students/vijetaas')
                ->with('error', 'Record not found.');
        }

        $db->transBegin();

        try {
            /*
            |------------------------------------------------------------------
            | Delete Mentor Mappings
            |------------------------------------------------------------------
            */

            $db->table('vijetaas_mentor_map')
                ->where('Vijetaas_Stu_Id', $id)
                ->delete();

            /*
            |------------------------------------------------------------------
            | Delete Vijetaas Registration
            |------------------------------------------------------------------
            */

            $vijetaasModel->delete($id);

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Unable to delete Vijetaas student.'
                );
            }

            $db->transCommit();

            return redirect()
                ->to('/students/vijetaas')
                ->with(
                    'success',
                    'Vijetaas Student Deleted Successfully'
                );
        } catch (\Throwable $e) {

            $db->transRollback();

            log_message(
                'error',
                'Vijetaas student deletion failed: ' . $e->getMessage()
            );

            return redirect()
                ->to('/students/vijetaas')
                ->with(
                    'error',
                    'Unable to delete student.'
                );
        }
    }
}
