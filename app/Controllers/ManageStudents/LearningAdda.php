<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\LearningAddaModel;
use App\Models\StudentModel;
use App\Models\ProgramModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\StudentProgramModel;
use Config\CorePrograms;

class LearningAdda extends BaseController
{
    protected $learningModel;
    protected $studentModel;
    protected $programModel;
    protected $centerModel;
    protected $batchModel;

    public function __construct()
    {
        $this->learningModel = new LearningAddaModel();
        $this->studentModel  = new StudentModel();
        $this->programModel  = new ProgramModel();
        $this->centerModel   = new CenterModel();
        $this->batchModel    = new BatchModel();
    }

    /**
     * List All Learning Adda Students
     */
    public function index()
    {
        $data['students'] = $this->learningModel->getLearningAddaStudents();

        return view(
            'ManageStudents/LearningAdda/learning_adda_students',
            $data
        );
    }



    public function view($id)
    {
        $data['student'] = $this->learningModel->getStudentDetails($id);

        if (!$data['student']) {
            return redirect()
                ->to('/students/learning_adda')
                ->with('error', 'Student not found');
        }

        return view(
            'ManageStudents/LearningAdda/view_learning_adda_student',
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
            ->where('Program_Id', \Config\CorePrograms::LEARNING_ADDA)
            ->where('Batch_Status', 'Active')
            ->findAll();

        $centerIds = $batchModel
            ->select('Center_Id')
            ->where('Program_Id', \Config\CorePrograms::LEARNING_ADDA)
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
            'ManageStudents/LearningAdda/add_learning_adda_student',
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
        $laId      = 'LA' . date('YmdHis');
        $spId      = 'SP' . date('YmdHis');

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
        // LEARNING ADDA TABLE
        //-------------------------------------

        $this->learningModel->insert([

            'LA_Stu_Id' => $laId,

            'Student_Id' => $studentId,

            'Program_Id' => \Config\CorePrograms::LEARNING_ADDA,

            'Center_Id' => $this->request->getPost('center_id'),

            'Batch_Id' => $this->request->getPost('batch_id'),

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

            'LA_Status' =>
            $this->request->getPost('program_status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Added_By' => null,
            'Rec_Added_On' => date('Y-m-d')
        ]);



        //-------------------------------------
        // STUDENT PROGRAM TABLE
        //-------------------------------------

        $studentProgramModel = new \App\Models\StudentProgramModel();

        $studentProgramModel->insert([

            'Student_Program_Id' => $spId,

            'Student_Id' => $studentId,

            'Program_Id' => \Config\CorePrograms::LEARNING_ADDA,

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

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to save student');
        }

        return redirect()
            ->to('/students/learning_adda')
            ->with('success', 'Learning Adda Student Added Successfully');
    }


    /**
     * Edit Student
     */
    public function edit($id)
    {
        $data['student'] = $this->learningModel->getStudentDetails($id);

        $data['centers'] = $this->centerModel
            ->where('Center_Status', 'Active')
            ->findAll();

        $data['batches'] = $this->batchModel
            ->where('Program_Id', \Config\CorePrograms::LEARNING_ADDA)
            ->findAll();

        return view(
            'ManageStudents/LearningAdda/edit_learning_adda_student',
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
        // Get Learning Adda Record
        //------------------------------------------------

        $laStudent = $this->learningModel->find($id);

        if (!$laStudent) {

            return redirect()
                ->back()
                ->with('error', 'Student not found');
        }

        $studentId = $laStudent['Student_Id'];

        //------------------------------------------------
        // UPDATE STUDENT TABLE
        //------------------------------------------------

        $this->studentModel->update($studentId, [

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

            'Rec_Last_Updated_On' => date('Y-m-d')
        ]);

        //------------------------------------------------
        // UPDATE LEARNING ADDA TABLE
        //------------------------------------------------

        $this->learningModel->update($id, [

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

            'LA_Status' =>
            $this->request->getPost('program_status'),

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Last_Updated_On' => date('Y-m-d')
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
            ->to('/students/learning_adda')
            ->with('success', 'Student Updated Successfully');
    }

    /**
     * Delete Student
     */
    public function delete($id)
    {
        $this->learningModel->delete($id);

        return redirect()
            ->to('/students/learning_adda')
            ->with('success', 'Student Deleted Successfully');
    }
}
