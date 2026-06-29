<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\DoosraMaukaModel;
use App\Models\StudentModel;
use App\Models\ProgramModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\StudentProgramModel;
use Config\CorePrograms;

class DoosraMauka extends BaseController
{
    public function index()
    {
        $model = new DoosraMaukaModel();

        $data['students'] = $model->getAllStudents();

        return view(
            'ManageStudents/DoosraMauka/doosra_mauka',
            $data
        );
    }

    public function view($id)
    {
        $model = new DoosraMaukaModel();

        $data['student'] = $model->getStudentDetails($id);

        return view(
            'ManageStudents/DoosraMauka/view_doosra',
            $data
        );
    }

    public function add()
    {
        $centerModel = new \App\Models\CenterModel();
        $batchModel  = new \App\Models\BatchModel();

        //------------------------------------
        // Get Doosra Mauka batches
        //------------------------------------

        $data['batches'] = $batchModel
            ->where('Program_Id', \Config\CorePrograms::DOOSRA_MAUKA)
            ->where('Batch_Status', 'Active')
            ->findAll();

        //------------------------------------
        // If batches exist → load related centers
        //------------------------------------

        if (!empty($data['batches'])) {

            $centerIds = array_unique(
                array_column($data['batches'], 'Center_Id')
            );

            $data['centers'] = $centerModel
                ->whereIn('Center_Id', $centerIds)
                ->where('Center_Status', 'Active')
                ->findAll();
        } else {

            //------------------------------------
            // No batches yet
            // Show all active centers
            //------------------------------------

            $data['centers'] = $centerModel
                ->where('Center_Status', 'Active')
                ->findAll();
        }

        return view(
            'ManageStudents/DoosraMauka/add_doosra',
            $data
        );
    }

    public function store()
    {

        $db = \Config\Database::connect();

        $db->transStart();

        //--------------------------------
        // Generate IDs
        //--------------------------------

        $studentId = 'STU' . date('YmdHis');
        $dmId      = 'DM' . date('YmdHis');
        $spId      = 'SP' . date('YmdHis');

        //--------------------------------
        // STUDENT TABLE
        //--------------------------------

        $studentModel = new StudentModel();

        $studentModel->insert([

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
        ]);

        //--------------------------------
        // DOOSRA MAUKA TABLE
        //--------------------------------

        $model = new DoosraMaukaModel();

        $result = $model->insert([

            'DM_Stu_Id' => $dmId,

            'Student_Id' => $studentId,

            'Marital_Status' =>
            $this->request->getPost('marital_status'),

            'Education' =>
            $this->request->getPost('highest_edu'),

            'Student_Caste' =>
            $this->request->getPost('caste'),

            'User_Siblings' =>
            $this->request->getPost('siblings'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Completion_Date' =>
            $this->request->getPost('prog_till'),

            'DM_Status' =>
            $this->request->getPost('program_status'),

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Program_Id' =>
            CorePrograms::DOOSRA_MAUKA,

            'Remarks' =>
            $this->request->getPost('remarks'),

            'Rec_Added_By' => null,
            'Rec_Added_On' => date('Y-m-d')
        ]);


        //--------------------------------
        // STUDENT PROGRAM TABLE
        //--------------------------------

        $studentProgramModel = new StudentProgramModel();

        $studentProgramModel->insert([

            'Student_Program_Id' => $spId,

            'Student_Id' => $studentId,

            'Program_Id' =>
            CorePrograms::DOOSRA_MAUKA,

            'Center_Id' =>
            $this->request->getPost('center_id'),

            'Batch_Id' =>
            $this->request->getPost('batch_id'),

            'Enrollment_Date' =>
            $this->request->getPost('enroll_date'),

            'Student_Status' =>
            $this->request->getPost('program_status')
        ]);


        //--------------------------------
        // COMMIT
        //--------------------------------

        $db->transComplete();

        if ($db->transStatus() === false) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to save student');
        }

        return redirect()
            ->to('/ManageStudents/DoosraMauka')
            ->with('success', 'Student Added Successfully');
    }


    public function edit($id)
    {
        $model = new DoosraMaukaModel();

        $centerModel = new CenterModel();
        $batchModel  = new BatchModel();

        $data['student'] = $model->getStudentDetails($id);

        $data['centers'] = $centerModel
            ->where('Center_Status', 'Active')
            ->findAll();

        $data['batches'] = $batchModel
            ->where('Program_Id', \Config\CorePrograms::DOOSRA_MAUKA)
            ->findAll();

        return view(
            'ManageStudents/DoosraMauka/edit_doosra',
            $data
        );
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->transStart();

        $doosraModel = new DoosraMaukaModel();
        $studentModel = new StudentModel();
        $studentProgramModel = new StudentProgramModel();

        //----------------------------------
        // Get Student Record
        //----------------------------------

        $dmStudent = $doosraModel
            ->where('DM_Stu_Id', $id)
            ->first();

        if (!$dmStudent) {
            return redirect()->back()
                ->with('error', 'Student not found');
        }

        $studentId = $dmStudent['Student_Id'];

        //----------------------------------
        // STUDENT TABLE
        //----------------------------------

        $studentModel
            ->where('Student_Id', $studentId)
            ->set([

                'First_Name' => $this->request->getPost('first_name'),
                'Last_Name'  => $this->request->getPost('last_name'),

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
            ])
            ->update();

        //----------------------------------
        // DOOSRA MAUKA TABLE
        //----------------------------------

        $doosraModel
            ->update($id, [

                'Marital_Status' =>
                $this->request->getPost('marital_status'),

                'Education' =>
                $this->request->getPost('highest_edu'),

                'Student_Caste' =>
                $this->request->getPost('caste'),

                'User_Siblings' =>
                $this->request->getPost('siblings'),

                'Center_Id' =>
                $this->request->getPost('center_id'),

                'Batch_Id' =>
                $this->request->getPost('batch_id'),

                'Enrollment_Date' =>
                $this->request->getPost('enroll_date'),

                'Completion_Date' =>
                $this->request->getPost('prog_till'),

                'DM_Status' =>
                $this->request->getPost('program_status'),

                'Remarks' =>
                $this->request->getPost('remarks'),

                'Rec_Last_Updated_On' => date('Y-m-d')
            ]);

        //----------------------------------
        // STUDENT PROGRAM TABLE
        //----------------------------------

        $studentProgramModel
            ->where('Student_Id', $studentId)
            ->where('Program_Id', \Config\CorePrograms::DOOSRA_MAUKA)
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

        //----------------------------------
        // COMMIT
        //----------------------------------

        $db->transComplete();

        return redirect()
            ->to('/ManageStudents/DoosraMauka')
            ->with('success', 'Student Updated Successfully');
    }

    public function delete($id)
    {
        $model = new DoosraMaukaModel();
        $model->delete($id);
        return redirect()->to('/ManageStudents/DoosraMauka');
    }
}
