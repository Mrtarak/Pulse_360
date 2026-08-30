<?php

namespace App\Controllers\Assessment;

use App\Controllers\BaseController;
use App\Models\BatchModel;
use App\Models\Assessment\StudentAssessmentModel;
use Config\CorePrograms;

class DoosraMauka extends BaseController
{
    protected $programId;

    public function __construct()
    {
        $this->programId = CorePrograms::DOOSRA_MAUKA;
    }


    /**
     * =====================================================
     * DOOSRA MAUKA ASSESSMENT LIST PAGE
     * =====================================================
     */
    public function index()
    {
        $db = \Config\Database::connect();

        $centers = $db->table('program_center_rel pcr')
            ->select('
                c.Center_Id,
                c.Center_Name
            ')
            ->join(
                'center_m c',
                'c.Center_Id = pcr.Center_Id',
                'inner'
            )
            ->where(
                'pcr.Program_Id',
                $this->programId
            )
            ->where(
                'c.Center_Status',
                'Active'
            )
            ->orderBy(
                'c.Center_Name',
                'ASC'
            )
            ->get()
            ->getResultArray();

        $data = [
            'title'     => 'Doosra Mauka Assessment',
            'programId' => $this->programId,
            'centers'   => $centers
        ];

        return view(
            'assessment/doosra_mauka/index',
            $data
        );
    }


    /**
     * =====================================================
     * GET BATCHES BASED ON CENTER
     * =====================================================
     */
    public function getBatches()
    {
        $centerId = $this->request->getPost('center_id');

        if (empty($centerId)) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Center is required.',
                'data'    => []
            ]);
        }

        $batchModel = new BatchModel();

        $batches = $batchModel
            ->where(
                'Program_Id',
                $this->programId
            )
            ->where(
                'Center_Id',
                $centerId
            )
            ->where(
                'Batch_Status',
                'Active'
            )
            ->orderBy(
                'Batch_Name',
                'ASC'
            )
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $batches
        ]);
    }


    /**
     * =====================================================
     * GET DOOSRA MAUKA STUDENTS
     * =====================================================
     */
    public function getStudents()
    {
        $centerId =
            $this->request->getPost('center_id');

        $batchId =
            $this->request->getPost('batch_id');

        $assessmentType =
            $this->request->getPost('assessment_type');


        /*
         * Basic validation
         */
        if (
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType)
        ) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Center, Batch and Assessment Type are required.',
                'data'    => []
            ]);
        }


        /*
         * Doosra Mauka supports:
         * Baseline
         * Endline
         */
        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        if (
            !in_array(
                $assessmentType,
                $allowedTypes,
                true
            )
        ) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Invalid Assessment Type.',
                'data'    => []
            ]);
        }


        $db = \Config\Database::connect();


        /*
         * =================================================
         * GET DOOSRA MAUKA PARTICIPANTS
         * =================================================
         */
        $students = $db->table('doosra_mauka_stu dm')
            ->select('
                dm.Student_Id,
                dm.Program_Id,
                dm.Center_Id,
                dm.Batch_Id,

                s.First_Name,
                s.Last_Name,
                s.Photo_URL,

                sa.Student_Assessment_Id
            ')
            ->join(
                'student s',
                's.Student_Id = dm.Student_Id',
                'inner'
            )
            ->join(
                'student_assessment sa',
                "sa.Student_Id = dm.Student_Id
                 AND sa.Program_Id = dm.Program_Id
                 AND sa.Center_Id = dm.Center_Id
                 AND sa.Batch_Id = dm.Batch_Id
                 AND sa.Assessment_Type = " .
                    $db->escape($assessmentType),
                'left'
            )
            ->where(
                'dm.Program_Id',
                $this->programId
            )
            ->where(
                'dm.Center_Id',
                $centerId
            )
            ->where(
                'dm.Batch_Id',
                $batchId
            )
            ->where(
                'dm.DM_Status',
                'Active'
            )
            ->orderBy(
                's.First_Name',
                'ASC'
            )
            ->get()
            ->getResultArray();


        /*
         * =================================================
         * ADD STATUS + ACTION
         * =================================================
         */
        foreach ($students as &$student) {

            $student['Student_Name'] =
                trim(
                    ($student['First_Name'] ?? '') .
                        ' ' .
                        ($student['Last_Name'] ?? '')
                );


            if (
                !empty(
                    $student['Student_Assessment_Id']
                )
            ) {

                $student['assessment_status'] =
                    'Completed';

                $student['action'] =
                    'view_edit';

            } else {

                $student['assessment_status'] =
                    'Pending';

                $student['action'] =
                    'add';
            }
        }


        return $this->response->setJSON([
            'status' => true,
            'data'   => $students,
            'total'  => count($students)
        ]);
    }


    /**
     * =====================================================
     * SHOW ADD DOOSRA MAUKA ASSESSMENT PAGE
     * =====================================================
     */
    public function add()
    {
        $studentId =
            $this->request->getGet('student_id');

        $centerId =
            $this->request->getGet('center_id');

        $batchId =
            $this->request->getGet('batch_id');

        $assessmentType =
            $this->request->getGet('assessment_type');


        /* =========================================
         * BASIC VALIDATION
         * ========================================= */

        if (
            empty($studentId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType)
        ) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment request.'
                );
        }


        /* =========================================
         * VALIDATE ASSESSMENT TYPE
         * ========================================= */

        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        if (
            !in_array(
                $assessmentType,
                $allowedTypes,
                true
            )
        ) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        /* =========================================
         * GET STUDENT DETAILS
         *
         * Verify student is enrolled
         * in Doosra Mauka.
         * ========================================= */

        $student =
            $db->table(
                'doosra_mauka_stu dm'
            )
                ->select('
                    dm.Student_Id,
                    dm.Program_Id,
                    dm.Center_Id,
                    dm.Batch_Id,

                    s.First_Name,
                    s.Last_Name,
                    s.Photo_URL,

                    c.Center_Name,
                    b.Batch_Name
                ')
                ->join(
                    'student s',
                    's.Student_Id = dm.Student_Id',
                    'inner'
                )
                ->join(
                    'center_m c',
                    'c.Center_Id = dm.Center_Id',
                    'left'
                )
                ->join(
                    'batch_m b',
                    'b.Batch_Id = dm.Batch_Id',
                    'left'
                )
                ->where(
                    'dm.Student_Id',
                    $studentId
                )
                ->where(
                    'dm.Program_Id',
                    $this->programId
                )
                ->where(
                    'dm.Center_Id',
                    $centerId
                )
                ->where(
                    'dm.Batch_Id',
                    $batchId
                )
                ->where(
                    'dm.DM_Status',
                    'Active'
                )
                ->get()
                ->getRowArray();


        /* =========================================
         * STUDENT NOT FOUND
         * ========================================= */

        if (empty($student)) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Student not found in the selected Doosra Mauka Center and Batch.'
                );
        }


        /* =========================================
         * CHECK DUPLICATE ASSESSMENT
         * ========================================= */

        $assessmentModel =
            new StudentAssessmentModel();


        $existingAssessment =
            $assessmentModel
                ->where(
                    'Student_Id',
                    $studentId
                )
                ->where(
                    'Program_Id',
                    $this->programId
                )
                ->where(
                    'Center_Id',
                    $centerId
                )
                ->where(
                    'Batch_Id',
                    $batchId
                )
                ->where(
                    'Assessment_Type',
                    $assessmentType
                )
                ->first();


        if (!empty($existingAssessment)) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Assessment already exists for this student.'
                );
        }


        /* =========================================
         * SEND DATA TO VIEW
         * ========================================= */

        $data = [

            'title' =>
                'Add Doosra Mauka Assessment',

            'student' =>
                $student,

            'assessmentType' =>
                $assessmentType,

            'programId' =>
                $this->programId,

            'today' =>
                date('Y-m-d')

        ];


        return view(
            'assessment/doosra_mauka/add',
            $data
        );
    }


    /**
     * =====================================================
     * SAVE DOOSRA MAUKA ASSESSMENT
     * =====================================================
     */
    public function save()
    {
        $studentId =
            $this->request->getPost('student_id');

        $programId =
            $this->request->getPost('program_id');

        $centerId =
            $this->request->getPost('center_id');

        $batchId =
            $this->request->getPost('batch_id');

        $assessmentType =
            $this->request->getPost('assessment_type');

        $assessmentDate =
            $this->request->getPost('assessment_date');


        /* =========================================
         * BASIC VALIDATION
         * ========================================= */

        if (
            empty($studentId) ||
            empty($programId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType) ||
            empty($assessmentDate)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Required assessment information is missing.'
                );
        }


        /* =========================================
         * SECURITY:
         * USE CURRENT PROGRAM ID
         * ========================================= */

        if (
            (string) $programId !==
            (string) $this->programId
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid program.'
                );
        }


        /* =========================================
         * ASSESSMENT TYPE VALIDATION
         * ========================================= */

        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        if (
            !in_array(
                $assessmentType,
                $allowedTypes,
                true
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid Assessment Type.'
                );
        }


        /* =========================================
         * FUTURE DATE VALIDATION
         * ========================================= */

        if (
            $assessmentDate >
            date('Y-m-d')
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Assessment date cannot be a future date.'
                );
        }


        $db = \Config\Database::connect();


        /* =========================================
         * VERIFY STUDENT ENROLLMENT
         * ========================================= */

        $student =
            $db->table(
                'doosra_mauka_stu'
            )
                ->where(
                    'Student_Id',
                    $studentId
                )
                ->where(
                    'Program_Id',
                    $this->programId
                )
                ->where(
                    'Center_Id',
                    $centerId
                )
                ->where(
                    'Batch_Id',
                    $batchId
                )
                ->where(
                    'DM_Status',
                    'Active'
                )
                ->get()
                ->getRowArray();


        if (empty($student)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Student is not enrolled in the selected Doosra Mauka Center and Batch.'
                );
        }


        $assessmentModel =
            new StudentAssessmentModel();


        /* =========================================
         * DUPLICATE CHECK
         * ========================================= */

        $existingAssessment =
            $assessmentModel
                ->where(
                    'Student_Id',
                    $studentId
                )
                ->where(
                    'Program_Id',
                    $this->programId
                )
                ->where(
                    'Center_Id',
                    $centerId
                )
                ->where(
                    'Batch_Id',
                    $batchId
                )
                ->where(
                    'Assessment_Type',
                    $assessmentType
                )
                ->first();


        if ($existingAssessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'This assessment has already been added for this student.'
                );
        }


        /* =========================================
         * GENERATE ASSESSMENT ID
         *
         * Maximum 20 characters.
         * ========================================= */

        $assessmentId =
            'ASM' .
            date('ymdHis') .
            random_int(10, 99);


        /* =========================================
         * PREPARE DATA
         * ========================================= */

        $data = [

            'Student_Assessment_Id' =>
                $assessmentId,

            'Student_Id' =>
                $studentId,

            'Program_Id' =>
                $this->programId,

            'Center_Id' =>
                $centerId,

            'Batch_Id' =>
                $batchId,

            'Assessment_Type' =>
                $assessmentType,

            'Assessment_Date' =>
                $assessmentDate,


            /* =================================
             * TAILORING
             * ================================= */

            'Tailoring_Grade' =>
                $this->request->getPost(
                    'tailoring_grade'
                ),

            'Tailoring_Remark' =>
                $this->request->getPost(
                    'tailoring_remark'
                ),


            /* =================================
             * LITERACY
             * ================================= */

            'Literacy_Grade' =>
                $this->request->getPost(
                    'literacy_grade'
                ),

            'Literacy_Remark' =>
                $this->request->getPost(
                    'literacy_remark'
                ),


            /* =================================
             * NUMERACY
             * ================================= */

            'Numeracy_Grade' =>
                $this->request->getPost(
                    'numeracy_grade'
                ),

            'Numeracy_Remark' =>
                $this->request->getPost(
                    'numeracy_remark'
                ),


            /* =================================
             * SEL
             * ================================= */

            'Ethics' =>
                $this->request->getPost(
                    'ethics'
                ),

            'Empathy' =>
                $this->request->getPost(
                    'empathy'
                ),

            'Excellence' =>
                $this->request->getPost(
                    'excellence'
                ),

            'Eagerness' =>
                $this->request->getPost(
                    'eagerness'
                ),

            'SEL_Remarks' =>
                $this->request->getPost(
                    'sel_remarks'
                ),


            /* =================================
             * ASSESSED BY
             * ================================= */

            'Assessed_By' =>
                $this->request->getPost(
                    'assessed_by'
                ),


            /* =================================
             * RECORD INFORMATION
             * ================================= */

            'Rec_Added_By' =>
                'Admin',

            'Rec_Added_On' =>
                date('Y-m-d')

        ];


        /* =========================================
         * INSERT
         * ========================================= */

        if (
            !$assessmentModel->insert($data)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to save assessment. Please try again.'
                );
        }


        /* =========================================
         * SUCCESS
         * ========================================= */

        return redirect()
            ->to(
                site_url(
                    'assessment/doosra-mauka'
                )
            )
            ->with(
                'success',
                'Student assessment saved successfully.'
            );
    }


    /**
     * =====================================================
     * VIEW DOOSRA MAUKA STUDENT ASSESSMENT
     * =====================================================
     */
    public function view($assessmentId)
    {
        $db = \Config\Database::connect();


        /* =========================================
         * GET SELECTED ASSESSMENT
         * ========================================= */

        $selectedAssessment =
            $db->table(
                'student_assessment sa'
            )
                ->select('
                    sa.*,

                    s.First_Name,
                    s.Last_Name,
                    s.Photo_URL,

                    pm.Program_Name,
                    cm.Center_Name,
                    bm.Batch_Name
                ')
                ->join(
                    'student s',
                    's.Student_Id = sa.Student_Id',
                    'inner'
                )
                ->join(
                    'program_m pm',
                    'pm.Program_Id = sa.Program_Id',
                    'left'
                )
                ->join(
                    'center_m cm',
                    'cm.Center_Id = sa.Center_Id',
                    'left'
                )
                ->join(
                    'batch_m bm',
                    'bm.Batch_Id = sa.Batch_Id',
                    'left'
                )
                ->where(
                    'sa.Student_Assessment_Id',
                    $assessmentId
                )
                ->where(
                    'sa.Program_Id',
                    $this->programId
                )
                ->get()
                ->getRowArray();


        /* =========================================
         * NOT FOUND
         * ========================================= */

        if (!$selectedAssessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /* =========================================
         * GET ALL DOOSRA MAUKA ASSESSMENTS
         *
         * Only Baseline + Endline
         * ========================================= */

        $allAssessments =
            $db->table(
                'student_assessment sa'
            )
                ->select('sa.*')
                ->where(
                    'sa.Student_Id',
                    $selectedAssessment['Student_Id']
                )
                ->where(
                    'sa.Program_Id',
                    $selectedAssessment['Program_Id']
                )
                ->where(
                    'sa.Center_Id',
                    $selectedAssessment['Center_Id']
                )
                ->where(
                    'sa.Batch_Id',
                    $selectedAssessment['Batch_Id']
                )
                ->whereIn(
                    'sa.Assessment_Type',
                    [
                        'Baseline',
                        'Endline'
                    ]
                )
                ->get()
                ->getResultArray();


        /* =========================================
         * ORGANIZE RESULTS
         * ========================================= */

        $assessments = [

            'Baseline' => null,

            'Endline' => null

        ];


        foreach (
            $allAssessments
            as $assessment
        ) {

            $type =
                trim(
                    $assessment['Assessment_Type']
                );


            if (
                array_key_exists(
                    $type,
                    $assessments
                )
            ) {

                $assessments[$type] =
                    $assessment;
            }
        }


        /* =========================================
         * STUDENT NAME
         * ========================================= */

        $selectedAssessment['Student_Name'] =
            trim(
                ($selectedAssessment['First_Name'] ?? '') .
                ' ' .
                ($selectedAssessment['Last_Name'] ?? '')
            );


        /* =========================================
         * DATA FOR VIEW
         * ========================================= */

        $data = [

            'title' =>
                'Doosra Mauka Student Assessment View',

            'student' =>
                $selectedAssessment,

            'assessments' =>
                $assessments,

            'activeAssessmentType' =>
                trim(
                    $selectedAssessment[
                        'Assessment_Type'
                    ]
                )

        ];


        return view(
            'assessment/doosra_mauka/view',
            $data
        );
    }


    /**
     * =====================================================
     * EDIT DOOSRA MAUKA ASSESSMENT
     * =====================================================
     */
    public function edit(
        $assessmentId,
        $assessmentType
    ) {

        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        /* =========================================
         * VALIDATE ASSESSMENT TYPE
         * ========================================= */

        if (
            !in_array(
                $assessmentType,
                $allowedTypes,
                true
            )
        ) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        /* =========================================
         * GET ASSESSMENT
         * ========================================= */

        $assessment =
            $db->table(
                'student_assessment sa'
            )
                ->select('
                    sa.*,

                    s.First_Name,
                    s.Last_Name,
                    s.Photo_URL,

                    c.Center_Name,
                    b.Batch_Name
                ')
                ->join(
                    'student s',
                    's.Student_Id = sa.Student_Id',
                    'inner'
                )
                ->join(
                    'center_m c',
                    'c.Center_Id = sa.Center_Id',
                    'left'
                )
                ->join(
                    'batch_m b',
                    'b.Batch_Id = sa.Batch_Id',
                    'left'
                )
                ->where(
                    'sa.Student_Assessment_Id',
                    $assessmentId
                )
                ->where(
                    'sa.Assessment_Type',
                    $assessmentType
                )
                ->where(
                    'sa.Program_Id',
                    $this->programId
                )
                ->get()
                ->getRowArray();


        /* =========================================
         * NOT FOUND
         * ========================================= */

        if (!$assessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /* =========================================
         * STUDENT NAME
         * ========================================= */

        $assessment['Student_Name'] =
            trim(
                ($assessment['First_Name'] ?? '') .
                ' ' .
                ($assessment['Last_Name'] ?? '')
            );


        /* =========================================
         * SEND DATA TO EDIT VIEW
         * ========================================= */

        $data = [

            'title' =>
                'Edit Doosra Mauka Assessment',

            'student' =>
                $assessment,

            'assessment' =>
                $assessment,

            'assessmentType' =>
                $assessmentType,

            'today' =>
                date('Y-m-d')

        ];


        return view(
            'assessment/doosra_mauka/edit',
            $data
        );
    }


    /**
     * =====================================================
     * UPDATE DOOSRA MAUKA ASSESSMENT
     * =====================================================
     */
    public function update()
    {
        $assessmentId =
            $this->request->getPost(
                'student_assessment_id'
            );

        $assessmentType =
            $this->request->getPost(
                'assessment_type'
            );

        $assessmentDate =
            $this->request->getPost(
                'assessment_date'
            );


        /* =========================================
         * BASIC VALIDATION
         * ========================================= */

        if (
            empty($assessmentId) ||
            empty($assessmentType) ||
            empty($assessmentDate)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Required assessment information is missing.'
                );
        }


        /* =========================================
         * VALIDATE ASSESSMENT TYPE
         * ========================================= */

        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        if (
            !in_array(
                $assessmentType,
                $allowedTypes,
                true
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        /* =========================================
         * FUTURE DATE VALIDATION
         * ========================================= */

        if (
            $assessmentDate >
            date('Y-m-d')
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Assessment date cannot be a future date.'
                );
        }


        $assessmentModel =
            new StudentAssessmentModel();


        /* =========================================
         * GET EXISTING ASSESSMENT
         * ========================================= */

        $existingAssessment =
            $assessmentModel
                ->where(
                    'Student_Assessment_Id',
                    $assessmentId
                )
                ->where(
                    'Program_Id',
                    $this->programId
                )
                ->where(
                    'Assessment_Type',
                    $assessmentType
                )
                ->first();


        if (!$existingAssessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/doosra-mauka'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /* =========================================
         * UPDATE DATA
         * ========================================= */

        $data = [

            'Assessment_Date' =>
                $assessmentDate,


            /* =================================
             * TAILORING
             * ================================= */

            'Tailoring_Grade' =>
                $this->request->getPost(
                    'tailoring_grade'
                ),

            'Tailoring_Remark' =>
                $this->request->getPost(
                    'tailoring_remark'
                ),


            /* =================================
             * LITERACY
             * ================================= */

            'Literacy_Grade' =>
                $this->request->getPost(
                    'literacy_grade'
                ),

            'Literacy_Remark' =>
                $this->request->getPost(
                    'literacy_remark'
                ),


            /* =================================
             * NUMERACY
             * ================================= */

            'Numeracy_Grade' =>
                $this->request->getPost(
                    'numeracy_grade'
                ),

            'Numeracy_Remark' =>
                $this->request->getPost(
                    'numeracy_remark'
                ),


            /* =================================
             * SEL
             * ================================= */

            'Ethics' =>
                $this->request->getPost(
                    'ethics'
                ),

            'Empathy' =>
                $this->request->getPost(
                    'empathy'
                ),

            'Excellence' =>
                $this->request->getPost(
                    'excellence'
                ),

            'Eagerness' =>
                $this->request->getPost(
                    'eagerness'
                ),

            'SEL_Remarks' =>
                $this->request->getPost(
                    'sel_remarks'
                ),


            /* =================================
             * ASSESSED BY
             * ================================= */

            'Assessed_By' =>
                $this->request->getPost(
                    'assessed_by'
                ),


            /* =================================
             * UPDATE INFORMATION
             * ================================= */

            'Rec_Updated_By' =>
                'Admin',

            'Rec_Last_Updated_On' =>
                date('Y-m-d')

        ];


        /* =========================================
         * UPDATE RECORD
         * ========================================= */

        if (
            !$assessmentModel->update(
                $assessmentId,
                $data
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to update assessment. Please try again.'
                );
        }


        /* =========================================
         * SUCCESS
         * ========================================= */

        return redirect()
            ->to(
                site_url(
                    'assessment/doosra-mauka/view/' .
                    $assessmentId
                )
            )
            ->with(
                'success',
                $assessmentType .
                ' assessment updated successfully.'
            );
    }
}