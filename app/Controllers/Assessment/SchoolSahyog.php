<?php

namespace App\Controllers\Assessment;

use App\Controllers\BaseController;
use App\Models\BatchModel;
use App\Models\Assessment\StudentAssessmentModel;
use Config\CorePrograms;

class SchoolSahyog extends BaseController
{
    protected $programId;

    public function __construct()
    {
        $this->programId = CorePrograms::SCHOOL_SAHYOG;
    }

    /**
     * SCHOOL SAHYOG ASSESSMENT LIST PAGE
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
            'title'     => 'School Sahyog Assessment',
            'programId' => $this->programId,
            'centers'   => $centers
        ];

        return view(
            'assessment/school_sahyog/index',
            $data
        );
    }


    /**
     * GET SCHOOL SAHYOG BATCHES
     * Based on selected Center
     */
    public function getBatches()
    {
        $centerId = $this->request->getPost(
            'center_id'
        );

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
     * GET SCHOOL SAHYOG STUDENTS
     *
     * Center + Batch + Assessment Type
     */
    public function getStudents()
    {
        $centerId = $this->request->getPost(
            'center_id'
        );

        $batchId = $this->request->getPost(
            'batch_id'
        );

        $assessmentType = $this->request->getPost(
            'assessment_type'
        );

        if (
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType)
        ) {

            return $this->response->setJSON([
                'status'  => false,
                'message' =>
                'Center, Batch and Assessment Type are required.',
                'data' => []
            ]);
        }


        /*
         * School Sahyog supports:
         *
         * Baseline
         * Midline
         * Endline
         */
        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];

        if (!in_array(
            $assessmentType,
            $allowedTypes,
            true
        )) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Invalid Assessment Type.',
                'data'    => []
            ]);
        }


        $db = \Config\Database::connect();


        /*
         * Get students enrolled in School Sahyog
         *
         * IMPORTANT:
         * We are using school_sahyog_stu
         * instead of learning_adda_stu.
         */
        $students = $db->table(
            'school_sahyog_stu ss'
        )
            ->select('
                ss.Student_Id,
                ss.Program_Id,
                ss.Center_Id,
                ss.Batch_Id,
                ss.Student_Class,

                s.First_Name,
                s.Last_Name,
                s.Photo_URL,

                sa.Student_Assessment_Id
            ')
            ->join(
                'student s',
                's.Student_Id = ss.Student_Id',
                'inner'
            )
            ->join(
                'student_assessment sa',
                "sa.Student_Id = ss.Student_Id
                 AND sa.Program_Id = ss.Program_Id
                 AND sa.Center_Id = ss.Center_Id
                 AND sa.Batch_Id = ss.Batch_Id
                 AND sa.Assessment_Type = " .
                    $db->escape($assessmentType),
                'left'
            )
            ->where(
                'ss.Program_Id',
                $this->programId
            )
            ->where(
                'ss.Center_Id',
                $centerId
            )
            ->where(
                'ss.Batch_Id',
                $batchId
            )
            ->where(
                'ss.SS_Status',
                'Active'
            )
            ->orderBy(
                's.First_Name',
                'ASC'
            )
            ->get()
            ->getResultArray();


        /*
         * Add display information
         */
        foreach ($students as &$student) {

            $student['Student_Name'] = trim(
                $student['First_Name'] .
                    ' ' .
                    $student['Last_Name']
            );


            if (
                !empty($student['Student_Assessment_Id'])
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
     * SHOW ADD SCHOOL SAHYOG ASSESSMENT PAGE
     */
    public function add()
    {
        $studentId = $this->request->getGet(
            'student_id'
        );

        $centerId = $this->request->getGet(
            'center_id'
        );

        $batchId = $this->request->getGet(
            'batch_id'
        );

        $assessmentType = $this->request->getGet(
            'assessment_type'
        );


        if (
            empty($studentId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType)
        ) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment request.'
                );
        }


        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];


        if (!in_array(
            $assessmentType,
            $allowedTypes,
            true
        )) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        /*
         * Get School Sahyog student
         *
         * + Verify enrollment
         */
        $student = $db->table(
            'school_sahyog_stu ss'
        )
            ->select('
                ss.Student_Id,
                ss.Program_Id,
                ss.Center_Id,
                ss.Batch_Id,
                ss.Student_Class,

                s.First_Name,
                s.Last_Name,
                s.Photo_URL,

                c.Center_Name,
                b.Batch_Name
            ')
            ->join(
                'student s',
                's.Student_Id = ss.Student_Id',
                'inner'
            )
            ->join(
                'center_m c',
                'c.Center_Id = ss.Center_Id',
                'left'
            )
            ->join(
                'batch_m b',
                'b.Batch_Id = ss.Batch_Id',
                'left'
            )
            ->where(
                'ss.Student_Id',
                $studentId
            )
            ->where(
                'ss.Program_Id',
                $this->programId
            )
            ->where(
                'ss.Center_Id',
                $centerId
            )
            ->where(
                'ss.Batch_Id',
                $batchId
            )
            ->where(
                'ss.SS_Status',
                'Active'
            )
            ->get()
            ->getRowArray();


        if (empty($student)) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Student not found in the selected School Sahyog Center and Batch.'
                );
        }


        /*
         * CHECK DUPLICATE ASSESSMENT
         */
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
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Assessment already exists for this student.'
                );
        }


        $data = [
            'title' =>
            'Add School Sahyog Assessment',

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
            'assessment/school_sahyog/add',
            $data
        );
    }


    /**
     * SAVE SCHOOL SAHYOG ASSESSMENT
     */
    public function save()
    {
        $studentId =
            $this->request->getPost(
                'student_id'
            );

        $programId =
            $this->request->getPost(
                'program_id'
            );

        $centerId =
            $this->request->getPost(
                'center_id'
            );

        $batchId =
            $this->request->getPost(
                'batch_id'
            );

        $assessmentType =
            $this->request->getPost(
                'assessment_type'
            );

        $assessmentDate =
            $this->request->getPost(
                'assessment_date'
            );


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


        /*
         * IMPORTANT:
         * Do not trust program_id from the form.
         *
         * School Sahyog controller must always
         * save using PRG_SS.
         */
        if (
            $programId !== $this->programId
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid program.'
                );
        }


        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];


        if (!in_array(
            $assessmentType,
            $allowedTypes,
            true
        )) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid Assessment Type.'
                );
        }


        if (
            $assessmentDate > date('Y-m-d')
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


        /*
         * DUPLICATE CHECK
         *
         * One student can have only:
         *
         * Baseline
         * Midline
         * Endline
         *
         * for the same Program + Center + Batch.
         */
        $existingAssessment =
            $assessmentModel
            ->where(
                'Student_Id',
                $studentId
            )
            ->where(
                'Program_Id',
                $programId
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
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'This assessment has already been added for this student.'
                );
        }


        /*
         * Generate Assessment ID
         */
        $assessmentId =
            'ASM-' .
            date('YmdHis') .
            '-' .
            random_int(
                100,
                999
            );


        /*
         * SAME AS LEARNING ADDA
         *
         * School Sahyog assessment uses
         * the same assessment fields.
         */
        $data = [

            'Student_Assessment_Id' =>
            $assessmentId,

            'Student_Id' =>
            $studentId,

            'Program_Id' =>
            $programId,

            'Center_Id' =>
            $centerId,

            'Batch_Id' =>
            $batchId,

            'Assessment_Type' =>
            $assessmentType,

            'Assessment_Date' =>
            $assessmentDate,


            // English
            'English_Level' =>
            $this->request->getPost(
                'english_level'
            ),

            'English_Grade' =>
            $this->request->getPost(
                'english_grade'
            ),

            'English_Remark' =>
            $this->request->getPost(
                'english_remark'
            ),


            // Math
            'Math_Level' =>
            $this->request->getPost(
                'math_level'
            ),

            'Math_Grade' =>
            $this->request->getPost(
                'math_grade'
            ),

            'Math_Remark' =>
            $this->request->getPost(
                'math_remark'
            ),


            // Hindi
            'Hindi_Level' =>
            $this->request->getPost(
                'hindi_level'
            ),

            'Hindi_Grade' =>
            $this->request->getPost(
                'hindi_grade'
            ),

            'Hindi_Remark' =>
            $this->request->getPost(
                'hindi_remark'
            ),


            // Marathi
            'Marathi_Level' =>
            $this->request->getPost(
                'marathi_level'
            ),

            'Marathi_Grade' =>
            $this->request->getPost(
                'marathi_grade'
            ),

            'Marathi_Remark' =>
            $this->request->getPost(
                'marathi_remark'
            ),


            // Digital Shakti
            'Digital_Shakti_Grade' =>
            $this->request->getPost(
                'digital_shakti_grade'
            ),

            'Digital_Shakti_Remark' =>
            $this->request->getPost(
                'digital_shakti_remark'
            ),


            // SEL
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


            'Assessed_By' =>
            $this->request->getPost(
                'assessed_by'
            ),


            'Rec_Added_By' =>
            'Admin',

            'Rec_Added_On' =>
            date('Y-m-d H:i:s')
        ];


        if (
            !$assessmentModel->insert(
                $data
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to save assessment. Please try again.'
                );
        }


        return redirect()
            ->to(
                site_url(
                    'assessment/school-sahyog'
                )
            )
            ->with(
                'success',
                'Student assessment saved successfully.'
            );
    }


    /**
     * VIEW SCHOOL SAHYOG ASSESSMENT
     */
    public function view($assessmentId)
    {
        $db = \Config\Database::connect();


        $selectedAssessment =
            $db->table(
                'student_assessment sa'
            )
            ->select('
                    sa.*,

                    s.First_Name,
                    s.Last_Name,
                    s.Photo_URL,

                    ss.Student_Class,

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
                'school_sahyog_stu ss',
                'ss.Student_Id = sa.Student_Id
                     AND ss.Program_Id = sa.Program_Id
                     AND ss.Center_Id = sa.Center_Id
                     AND ss.Batch_Id = sa.Batch_Id',
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


        if (!$selectedAssessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /*
         * Get all assessments of this student
         */
        $allAssessments =
            $db->table(
                'student_assessment sa'
            )
            ->select(
                'sa.*'
            )
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


        /*
         * Organize assessments
         */
        $assessments = [

            'Baseline' => null,

            'Midline' => null,

            'Endline' => null
        ];


        foreach (
            $allAssessments
            as $assessment
        ) {

            $assessmentType =
                trim(
                    $assessment['Assessment_Type']
                );


            if (
                array_key_exists(
                    $assessmentType,
                    $assessments
                )
            ) {

                $assessments[$assessmentType] = $assessment;
            }
        }


        /*
         * Student Name
         */
        $selectedAssessment['Student_Name'] = trim(
            (
                $selectedAssessment['First_Name'] ?? ''
            ) .
                ' ' .
                (
                    $selectedAssessment['Last_Name'] ?? ''
                )
        );


        /*
         * Student Class
         */
        if (
            isset(
                $selectedAssessment['Student_Class']
            ) &&
            $selectedAssessment['Student_Class'] !== null &&
            $selectedAssessment['Student_Class'] !== ''
        ) {

            $selectedAssessment['Display_Student_Class'] =
                'Class ' .
                $selectedAssessment['Student_Class'];
        } else {

            $selectedAssessment['Display_Student_Class'] = 'N/A';
        }


        $data = [

            'title' =>
            'Student Assessment View',

            'student' =>
            $selectedAssessment,

            'assessments' =>
            $assessments,

            'activeAssessmentType' =>
            trim(
                $selectedAssessment['Assessment_Type']
            )
        ];


        return view(
            'assessment/school_sahyog/view',
            $data
        );
    }


    /**
     * EDIT SCHOOL SAHYOG ASSESSMENT
     */
    public function edit(
        $assessmentId,
        $assessmentType
    ) {

        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];


        if (!in_array(
            $assessmentType,
            $allowedTypes,
            true
        )) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        $db = \Config\Database::connect();


        $assessment =
            $db->table(
                'student_assessment sa'
            )
            ->select('
                    sa.*,

                    s.First_Name,
                    s.Last_Name,
                    s.Photo_URL,

                    ss.Student_Class,

                    c.Center_Name,
                    b.Batch_Name
                ')
            ->join(
                'student s',
                's.Student_Id = sa.Student_Id',
                'inner'
            )
            ->join(
                'school_sahyog_stu ss',
                'ss.Student_Id = sa.Student_Id
                     AND ss.Program_Id = sa.Program_Id
                     AND ss.Center_Id = sa.Center_Id
                     AND ss.Batch_Id = sa.Batch_Id',
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


        if (!$assessment) {

            return redirect()
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /*
         * Student Name
         */
        $assessment['Student_Name'] = trim(
            (
                $assessment['First_Name'] ?? ''
            ) .
                ' ' .
                (
                    $assessment['Last_Name'] ?? ''
                )
        );


        /*
         * Student Class
         */
        if (
            isset(
                $assessment['Student_Class']
            ) &&
            $assessment['Student_Class'] !== null &&
            $assessment['Student_Class'] !== ''
        ) {

            $assessment['Display_Student_Class'] =
                'Class ' .
                $assessment['Student_Class'];
        } else {

            $assessment['Display_Student_Class'] = 'N/A';
        }


        $data = [

            'title' =>
            'Edit School Sahyog Assessment',

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
            'assessment/school_sahyog/edit',
            $data
        );
    }


    /**
     * UPDATE SCHOOL SAHYOG ASSESSMENT
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


        $allowedTypes = [
            'Baseline',
            'Midline',
            'Endline'
        ];


        if (!in_array(
            $assessmentType,
            $allowedTypes,
            true
        )) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid assessment type.'
                );
        }


        if (
            $assessmentDate > date('Y-m-d')
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


        /*
         * Find existing assessment
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
                ->to(
                    site_url(
                        'assessment/school-sahyog'
                    )
                )
                ->with(
                    'error',
                    'Assessment record not found.'
                );
        }


        /*
         * Update assessment
         */
        $data = [

            'Assessment_Date' =>
            $assessmentDate,


            // English
            'English_Level' =>
            $this->request->getPost(
                'english_level'
            ),

            'English_Grade' =>
            $this->request->getPost(
                'english_grade'
            ),

            'English_Remark' =>
            $this->request->getPost(
                'english_remark'
            ),


            // Math
            'Math_Level' =>
            $this->request->getPost(
                'math_level'
            ),

            'Math_Grade' =>
            $this->request->getPost(
                'math_grade'
            ),

            'Math_Remark' =>
            $this->request->getPost(
                'math_remark'
            ),


            // Hindi
            'Hindi_Level' =>
            $this->request->getPost(
                'hindi_level'
            ),

            'Hindi_Grade' =>
            $this->request->getPost(
                'hindi_grade'
            ),

            'Hindi_Remark' =>
            $this->request->getPost(
                'hindi_remark'
            ),


            // Marathi
            'Marathi_Level' =>
            $this->request->getPost(
                'marathi_level'
            ),

            'Marathi_Grade' =>
            $this->request->getPost(
                'marathi_grade'
            ),

            'Marathi_Remark' =>
            $this->request->getPost(
                'marathi_remark'
            ),


            // Digital Shakti
            'Digital_Shakti_Grade' =>
            $this->request->getPost(
                'digital_shakti_grade'
            ),

            'Digital_Shakti_Remark' =>
            $this->request->getPost(
                'digital_shakti_remark'
            ),


            // SEL
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


            'Assessed_By' =>
            $this->request->getPost(
                'assessed_by'
            ),


            'Rec_Updated_By' =>
            'Admin',

            'Rec_Last_Updated_On' =>
            date('Y-m-d H:i:s')
        ];


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


        return redirect()
            ->to(
                site_url(
                    'assessment/school-sahyog/view/' .
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
