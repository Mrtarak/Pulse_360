<?php

namespace App\Controllers\Assessment;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\StudentProgramModel;
use App\Models\Assessment\StudentAssessmentModel;
use Config\CorePrograms;

class LearningAdda extends BaseController
{
    protected $programId;

    public function __construct()
    {
        $this->programId = CorePrograms::LEARNING_ADDA;
    }

    /**
     * LA Assessment List Page
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
            ->where('pcr.Program_Id', $this->programId)
            ->where('c.Center_Status', 'Active')
            ->orderBy('c.Center_Name', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title'     => 'Learning Adda Assessment',
            'programId' => $this->programId,
            'centers'   => $centers
        ];

        return view(
            'assessment/learning_adda/index',
            $data
        );
    }

    /**
     * Get LA batches based on selected Center
     */
    public function getBatches()
    {
        $centerId = $this->request->getPost('center_id');

        if (empty($centerId)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Center is required.',
                'data' => []
            ]);
        }

        $batchModel = new BatchModel();

        $batches = $batchModel
            ->where('Program_Id', $this->programId)
            ->where('Center_Id', $centerId)
            ->where('Batch_Status', 'Active')
            ->orderBy('Batch_Name', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $batches
        ]);
    }


    /**
     * Get LA students based on Center + Batch + Assessment Type
     */
    public function getStudents()
    {
        $centerId = $this->request->getPost('center_id');
        $batchId = $this->request->getPost('batch_id');
        $assessmentType = $this->request->getPost('assessment_type');

        if (empty($centerId) || empty($batchId) || empty($assessmentType)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Center, Batch and Assessment Type are required.',
                'data' => []
            ]);
        }

        $allowedTypes = ['Baseline', 'Midline', 'Endline'];

        if (!in_array($assessmentType, $allowedTypes)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid Assessment Type.',
                'data' => []
            ]);
        }

        $db = \Config\Database::connect();

        /*
         * Get students enrolled in Learning Adda
         * for the selected Center and Batch.
         */
        $students = $db->table('student_program sp')
            ->select('
                sp.Student_Id,
                sp.Program_Id,
                sp.Center_Id,
                sp.Batch_Id,
                s.First_Name,
                s.Last_Name,
                s.Photo_URL,
                sa.Student_Assessment_Id
            ')
            ->join(
                'student s',
                's.Student_Id = sp.Student_Id',
                'inner'
            )
            ->join(
                'student_assessment sa',
                "sa.Student_Id = sp.Student_Id
                 AND sa.Program_Id = sp.Program_Id
                 AND sa.Center_Id = sp.Center_Id
                 AND sa.Batch_Id = sp.Batch_Id
                 AND sa.Assessment_Type = " . $db->escape($assessmentType),
                'left'
            )
            ->where('sp.Program_Id', $this->programId)
            ->where('sp.Center_Id', $centerId)
            ->where('sp.Batch_Id', $batchId)
            ->where('sp.Student_Status', 'Active')
            ->orderBy('s.First_Name', 'ASC')
            ->get()
            ->getResultArray();


        /*
         * Add assessment status and action information.
         */
        foreach ($students as &$student) {

            $student['Student_Name'] = trim(
                $student['First_Name'] . ' ' . $student['Last_Name']
            );

            if (!empty($student['Student_Assessment_Id'])) {

                $student['assessment_status'] = 'Completed';
                $student['action'] = 'view_edit';
            } else {

                $student['assessment_status'] = 'Pending';
                $student['action'] = 'add';
            }
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $students,
            'total' => count($students)
        ]);
    }


    /**
     * Show Add Learning Adda Assessment Page
     */
    public function add()
    {
        $studentId = $this->request->getGet('student_id');
        $centerId = $this->request->getGet('center_id');
        $batchId = $this->request->getGet('batch_id');
        $assessmentType = $this->request->getGet('assessment_type');


        /* =========================================
       BASIC VALIDATION
    ========================================= */

        if (
            empty($studentId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType)
        ) {
            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Invalid assessment request.'
                );
        }


        /* =========================================
       VALIDATE ASSESSMENT TYPE
    ========================================= */

        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];

        if (!in_array($assessmentType, $allowedTypes)) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        /* =========================================
       GET STUDENT DETAILS
       + VERIFY LEARNING ADDA ENROLLMENT
    ========================================= */

        $student = $db->table('learning_adda_stu la')
            ->select('
            la.Student_Id,
            la.Program_Id,
            la.Center_Id,
            la.Batch_Id,
            la.Student_Class,

            s.First_Name,
            s.Last_Name,
            s.Photo_URL,

            c.Center_Name,
            b.Batch_Name
        ')
            ->join(
                'student s',
                's.Student_Id = la.Student_Id',
                'inner'
            )
            ->join(
                'center_m c',
                'c.Center_Id = la.Center_Id',
                'left'
            )
            ->join(
                'batch_m b',
                'b.Batch_Id = la.Batch_Id',
                'left'
            )
            ->where('la.Student_Id', $studentId)
            ->where('la.Program_Id', $this->programId)
            ->where('la.Center_Id', $centerId)
            ->where('la.Batch_Id', $batchId)
            ->where('la.LA_Status', 'Active')
            ->get()
            ->getRowArray();


        /* =========================================
       STUDENT NOT FOUND
    ========================================= */

        if (empty($student)) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Student not found in the selected Learning Adda Center and Batch.'
                );
        }


        /* =========================================
       CHECK DUPLICATE ASSESSMENT
    ========================================= */

        $assessmentModel = new StudentAssessmentModel();

        $existingAssessment = $assessmentModel
            ->where('Student_Id', $studentId)
            ->where('Program_Id', $this->programId)
            ->where('Center_Id', $centerId)
            ->where('Batch_Id', $batchId)
            ->where('Assessment_Type', $assessmentType)
            ->first();


        /*
     * If already assessed, do not allow Add again.
     * Later we can redirect to View page.
     */
        if (!empty($existingAssessment)) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Assessment already exists for this student.'
                );
        }


        /* =========================================
            SEND DATA TO VIEW
            ========================================= */

        $data = [
            'title'           => 'Add Learning Adda Assessment',
            'student'         => $student,
            'assessmentType'  => $assessmentType,
            'programId'       => $this->programId,
            'today'           => date('Y-m-d')
        ];


        return view(
            'assessment/learning_adda/add',
            $data
        );
    }



    /**
     * Save Learning Adda Assessment
     */
    public function save()
    {
        $studentId = $this->request->getPost('student_id');
        $programId = $this->request->getPost('program_id');
        $centerId = $this->request->getPost('center_id');
        $batchId = $this->request->getPost('batch_id');
        $assessmentType = $this->request->getPost('assessment_type');
        $assessmentDate = $this->request->getPost('assessment_date');


        /* =========================================
       BASIC VALIDATION
    ========================================= */

        if (
            empty($studentId) ||
            empty($programId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType) ||
            empty($assessmentDate)
        ) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Required assessment information is missing.'
                );
        }


        /* =========================================
       ASSESSMENT TYPE VALIDATION
    ========================================= */

        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];

        if (!in_array($assessmentType, $allowedTypes, true)) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid Assessment Type.'
                );
        }


        /* =========================================
       FUTURE DATE VALIDATION
    ========================================= */

        if ($assessmentDate > date('Y-m-d')) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Assessment date cannot be a future date.'
                );
        }


        $assessmentModel = new StudentAssessmentModel();


        /* =========================================
       DUPLICATE CHECK

       One student can have only one:
       Baseline / Midline / Endline

       for the same Program + Center + Batch.
    ========================================= */

        $existingAssessment = $assessmentModel
            ->where('Student_Id', $studentId)
            ->where('Program_Id', $programId)
            ->where('Center_Id', $centerId)
            ->where('Batch_Id', $batchId)
            ->where('Assessment_Type', $assessmentType)
            ->first();


        if ($existingAssessment) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'This assessment has already been added for this student.'
                );
        }


        /* =========================================
       GENERATE ASSESSMENT ID
    ========================================= */

        $assessmentId = 'ASM-' . date('YmdHis') . '-' . random_int(100, 999);


        /* =========================================
       SAVE DATA
    ========================================= */

        $data = [

            'Student_Assessment_Id' => $assessmentId,

            'Student_Id' => $studentId,
            'Program_Id' => $programId,
            'Center_Id' => $centerId,
            'Batch_Id' => $batchId,

            'Assessment_Type' => $assessmentType,
            'Assessment_Date' => $assessmentDate,


            /* ============ ENGLISH ============ */

            'English_Level' =>
            $this->request->getPost('english_level'),

            'English_Grade' =>
            $this->request->getPost('english_grade'),

            'English_Remark' =>
            $this->request->getPost('english_remark'),


            /* ============ MATH ============ */

            'Math_Level' =>
            $this->request->getPost('math_level'),

            'Math_Grade' =>
            $this->request->getPost('math_grade'),

            'Math_Remark' =>
            $this->request->getPost('math_remark'),


            /* ============ HINDI ============ */

            'Hindi_Level' =>
            $this->request->getPost('hindi_level'),

            'Hindi_Grade' =>
            $this->request->getPost('hindi_grade'),

            'Hindi_Remark' =>
            $this->request->getPost('hindi_remark'),


            /* ============ MARATHI ============ */

            'Marathi_Level' =>
            $this->request->getPost('marathi_level'),

            'Marathi_Grade' =>
            $this->request->getPost('marathi_grade'),

            'Marathi_Remark' =>
            $this->request->getPost('marathi_remark'),


            /* ======== DIGITAL SHAKTI ======== */

            'Digital_Shakti_Grade' =>
            $this->request->getPost('digital_shakti_grade'),

            'Digital_Shakti_Remark' =>
            $this->request->getPost('digital_shakti_remark'),


            /* ================ SEL ================ */

            'Ethics' =>
            $this->request->getPost('ethics'),

            'Empathy' =>
            $this->request->getPost('empathy'),

            'Excellence' =>
            $this->request->getPost('excellence'),

            'Eagerness' =>
            $this->request->getPost('eagerness'),

            'SEL_Remarks' =>
            $this->request->getPost('sel_remarks'),


            /* ============ ASSESSMENT ============ */

            'Assessed_By' =>
            $this->request->getPost('assessed_by'),


            /* ============ RECORD INFO ============ */

            'Rec_Added_By' => 'Admin',

            'Rec_Added_On' => date('Y-m-d H:i:s'),

        ];


        /* =========================================
       INSERT
    ========================================= */

        if (!$assessmentModel->insert($data)) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to save assessment. Please try again.'
                );
        }


        return redirect()
            ->to(site_url('assessment/learning-adda'))
            ->with(
                'success',
                'Student assessment saved successfully.'
            );
    }

    /**
     * View Learning Adda Student Assessment
     */
    public function view($assessmentId)
    {
        $db = \Config\Database::connect();


        /* =====================================================
       1. GET THE ASSESSMENT THAT WAS CLICKED
    ===================================================== */

        $selectedAssessment = $db->table('student_assessment sa')
            ->select('
            sa.*,

            s.First_Name,
            s.Last_Name,
            s.Photo_URL,

            las.Student_Class,

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
                'learning_adda_stu las',
                'las.Student_Id = sa.Student_Id
             AND las.Program_Id = sa.Program_Id
             AND las.Center_Id = sa.Center_Id
             AND las.Batch_Id = sa.Batch_Id',
                'left'
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


        /* =====================================================
       2. IF ASSESSMENT DOES NOT EXIST
    ===================================================== */

        if (!$selectedAssessment) {

            return redirect()
                ->to(
                    site_url('assessment/learning-adda')
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /* =====================================================
       3. GET ALL ASSESSMENTS OF THIS STUDENT

       Important:
       We use the EXACT Student + Program + Center + Batch
       from the clicked assessment.
    ===================================================== */

        $allAssessments = $db->table('student_assessment sa')
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
                    'Midline',
                    'Endline'
                ]
            )
            ->get()
            ->getResultArray();


        /* =====================================================
       4. ORGANIZE RESULTS BY ASSESSMENT TYPE
    ===================================================== */

        $assessments = [

            'Baseline' => null,
            'Midline'  => null,
            'Endline'  => null

        ];


        foreach ($allAssessments as $assessment) {

            $assessmentType =
                trim($assessment['Assessment_Type']);


            if (array_key_exists(
                $assessmentType,
                $assessments
            )) {

                $assessments[$assessmentType] =
                    $assessment;
            }
        }


        /* =====================================================
       5. STUDENT NAME
    ===================================================== */

        $selectedAssessment['Student_Name'] = trim(

            ($selectedAssessment['First_Name'] ?? '') .
                ' ' .
                ($selectedAssessment['Last_Name'] ?? '')

        );


        /* =====================================================
       6. FORMAT LEARNING ADDA STUDENT CLASS

       learning_adda_stu.Student_Class is stored as:
       5

       We convert it to:
       Class 5

       If NULL, show N/A.
    ===================================================== */

        if (
            isset($selectedAssessment['Student_Class']) &&
            $selectedAssessment['Student_Class'] !== null &&
            $selectedAssessment['Student_Class'] !== ''
        ) {

            $selectedAssessment['Display_Student_Class'] =
                'Class ' .
                $selectedAssessment['Student_Class'];
        } else {

            $selectedAssessment['Display_Student_Class'] =
                'N/A';
        }


        /* =====================================================
       7. DATA FOR VIEW
    ===================================================== */

        $data = [

            'title' => 'Student Assessment View',

            'student' => $selectedAssessment,

            'assessments' => $assessments,

            'activeAssessmentType' =>
            trim(
                $selectedAssessment['Assessment_Type']
            )

        ];


        return view(
            'assessment/learning_adda/view',
            $data
        );
    }



    /**
     * =====================================================
     * EDIT LEARNING ADDA ASSESSMENT
     * =====================================================
     */
    public function edit($assessmentId, $assessmentType)
    {
        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];

        /*
     * Validate assessment type.
     */
        if (!in_array($assessmentType, $allowedTypes, true)) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        /*
     * =================================================
     * GET ASSESSMENT + STUDENT DETAILS
     * =================================================
     */

        $assessment = $db->table('student_assessment sa')

            ->select('
            sa.*,

            s.First_Name,
            s.Last_Name,
            s.Photo_URL,

            la.Student_Class,

            c.Center_Name,
            b.Batch_Name
        ')

            ->join(
                'student s',
                's.Student_Id = sa.Student_Id',
                'inner'
            )

            ->join(
                'learning_adda_stu la',
                'la.Student_Id = sa.Student_Id
             AND la.Program_Id = sa.Program_Id
             AND la.Center_Id = sa.Center_Id
             AND la.Batch_Id = sa.Batch_Id',
                'left'
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


        /*
     * =================================================
     * ASSESSMENT NOT FOUND
     * =================================================
     */

        if (!$assessment) {

            return redirect()
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /*
     * =================================================
     * STUDENT NAME
     * =================================================
     */

        $assessment['Student_Name'] = trim(

            ($assessment['First_Name'] ?? '') .
                ' ' .
                ($assessment['Last_Name'] ?? '')

        );


        /*
     * =================================================
     * DISPLAY CLASS
     *
     * Student_Class is stored as:
     * 5
     *
     * Display:
     * Class 5
     * =================================================
     */

        if (
            isset($assessment['Student_Class']) &&
            $assessment['Student_Class'] !== null &&
            $assessment['Student_Class'] !== ''
        ) {

            $assessment['Display_Student_Class'] =
                'Class ' . $assessment['Student_Class'];
        } else {

            $assessment['Display_Student_Class'] = 'N/A';
        }


        /*
     * =================================================
     * SEND DATA TO EDIT VIEW
     * =================================================
     */

        $data = [

            'title' => 'Edit Learning Adda Assessment',

            'student' => $assessment,

            'assessment' => $assessment,

            'assessmentType' => $assessmentType,

            'today' => date('Y-m-d')

        ];


        return view(
            'assessment/learning_adda/edit',
            $data
        );
    }



    /**
     * =====================================================
     * UPDATE LEARNING ADDA ASSESSMENT
     * =====================================================
     */
    public function update()
    {
        $assessmentId =
            $this->request->getPost('student_assessment_id');

        $assessmentType =
            $this->request->getPost('assessment_type');

        $assessmentDate =
            $this->request->getPost('assessment_date');


        /*
     * =================================================
     * BASIC VALIDATION
     * =================================================
     */

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


        /*
     * =================================================
     * VALIDATE ASSESSMENT TYPE
     * =================================================
     */

        $allowedTypes = [
            'Baseline',
            'Midline',
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


        /*
     * =================================================
     * FUTURE DATE VALIDATION
     * =================================================
     */

        if ($assessmentDate > date('Y-m-d')) {

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


        /*
     * =================================================
     * CHECK EXISTING RECORD
     * =================================================
     */

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
                ->to(site_url('assessment/learning-adda'))
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /*
     * =================================================
     * UPDATE DATA
     * =================================================
     */

        $data = [

            'Assessment_Date' =>
            $assessmentDate,


            /* ============ ENGLISH ============ */

            'English_Level' =>
            $this->request->getPost('english_level'),

            'English_Grade' =>
            $this->request->getPost('english_grade'),

            'English_Remark' =>
            $this->request->getPost('english_remark'),


            /* ============ MATH ============ */

            'Math_Level' =>
            $this->request->getPost('math_level'),

            'Math_Grade' =>
            $this->request->getPost('math_grade'),

            'Math_Remark' =>
            $this->request->getPost('math_remark'),


            /* ============ HINDI ============ */

            'Hindi_Level' =>
            $this->request->getPost('hindi_level'),

            'Hindi_Grade' =>
            $this->request->getPost('hindi_grade'),

            'Hindi_Remark' =>
            $this->request->getPost('hindi_remark'),


            /* ============ MARATHI ============ */

            'Marathi_Level' =>
            $this->request->getPost('marathi_level'),

            'Marathi_Grade' =>
            $this->request->getPost('marathi_grade'),

            'Marathi_Remark' =>
            $this->request->getPost('marathi_remark'),


            /* ============ DIGITAL SHAKTI ============ */

            'Digital_Shakti_Grade' =>
            $this->request->getPost('digital_shakti_grade'),

            'Digital_Shakti_Remark' =>
            $this->request->getPost('digital_shakti_remark'),


            /* ============ SEL ============ */

            'Ethics' =>
            $this->request->getPost('ethics'),

            'Empathy' =>
            $this->request->getPost('empathy'),

            'Excellence' =>
            $this->request->getPost('excellence'),

            'Eagerness' =>
            $this->request->getPost('eagerness'),

            'SEL_Remarks' =>
            $this->request->getPost('sel_remarks'),


            /* ============ ASSESSED BY ============ */

            'Assessed_By' =>
            $this->request->getPost('assessed_by'),


            /* ============ UPDATE INFO ============ */

            'Rec_Updated_By' => 'Admin',

            'Rec_Last_Updated_On' =>
            date('Y-m-d H:i:s')

        ];


        /*
     * =================================================
     * UPDATE RECORD
     * =================================================
     */

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


        /*
     * =================================================
     * SUCCESS
     * =================================================
     */

        return redirect()
            ->to(
                site_url(
                    'assessment/learning-adda/view/' .
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
