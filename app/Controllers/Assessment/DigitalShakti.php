<?php

namespace App\Controllers\Assessment;

use App\Controllers\BaseController;
use App\Models\BatchModel;
use App\Models\Assessment\StudentAssessmentModel;
use Config\CorePrograms;

class DigitalShakti extends BaseController
{
    protected $programId;

    public function __construct()
    {
        $this->programId = CorePrograms::DIGITAL_SHAKTI;
    }


    /**
     * =====================================================
     * DIGITAL SHAKTI ASSESSMENT PAGE
     * =====================================================
     */
    public function index()
    {
        $db = \Config\Database::connect();

        /*
         * Get centers assigned to Digital Shakti
         */
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
            'title'     => 'Digital Shakti Assessment',
            'programId' => $this->programId,
            'centers'   => $centers
        ];


        return view(
            'assessment/digital_shakti/add',
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
     * GET DIGITAL SHAKTI STUDENTS
     *
     * Also fetch existing assessment data.
     * =====================================================
     */
    public function getStudents()
    {
        $centerId = $this->request->getPost('center_id');
        $batchId = $this->request->getPost('batch_id');
        $assessmentType = $this->request->getPost('assessment_type');


        /*
     * =====================================================
     * BASIC VALIDATION
     * =====================================================
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
     * =====================================================
     * DIGITAL SHAKTI HAS ONLY 2 ASSESSMENTS
     * =====================================================
     */

        $allowedTypes = [
            'Baseline',
            'Endline'
        ];


        if (!in_array($assessmentType, $allowedTypes, true)) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Invalid Assessment Type.',
                'data'    => []
            ]);
        }


        $db = \Config\Database::connect();


        /*
     * =====================================================
     * GET DIGITAL SHAKTI STUDENTS
     *
     * student_program is used for:
     *
     * Program_Id
     * Center_Id
     * Batch_Id
     *
     * digital_shakti_stu is used to confirm:
     *
     * Digital Shakti enrollment
     * DS_Status = Active
     * =====================================================
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

            ds.DS_Stu_Id,
            ds.DS_Status,

            sa.Student_Assessment_Id,
            sa.Assessment_Date,
            sa.Digital_Shakti_Grade,
            sa.Digital_Shakti_Remark
        ')

            /*
         * Student
         */
            ->join(
                'student s',
                's.Student_Id = sp.Student_Id',
                'inner'
            )

            /*
         * Digital Shakti Enrollment
         */
            ->join(
                'digital_shakti_stu ds',
                'ds.Student_Id = sp.Student_Id
             AND ds.DS_Status = \'Active\'',
                'inner'
            )

            /*
         * Existing Assessment
         */
            ->join(
                'student_assessment sa',
                "sa.Student_Id = sp.Student_Id
             AND sa.Program_Id = sp.Program_Id
             AND sa.Center_Id = sp.Center_Id
             AND sa.Batch_Id = sp.Batch_Id
             AND sa.Assessment_Type = " .
                    $db->escape($assessmentType),
                'left'
            )

            /*
         * Digital Shakti Program
         */
            ->where(
                'sp.Program_Id',
                $this->programId
            )

            /*
         * Selected Center
         */
            ->where(
                'sp.Center_Id',
                $centerId
            )

            /*
         * Selected Batch
         */
            ->where(
                'sp.Batch_Id',
                $batchId
            )

            /*
         * Active Student Program
         */
            ->where(
                'sp.Student_Status',
                'Active'
            )

            /*
         * Sort by Student Name
         */
            ->orderBy(
                's.First_Name',
                'ASC'
            )

            ->get()
            ->getResultArray();


        /*
     * =====================================================
     * ADD STUDENT NAME + ASSESSMENT STATUS
     * =====================================================
     */

        foreach ($students as &$student) {

            $student['Student_Name'] = trim(
                ($student['First_Name'] ?? '') .
                    ' ' .
                    ($student['Last_Name'] ?? '')
            );


            if (!empty($student['Student_Assessment_Id'])) {

                $student['assessment_status'] = 'Completed';
            } else {

                $student['assessment_status'] = 'Pending';
            }
        }


        /*
     * =====================================================
     * RETURN DATA
     * =====================================================
     */

        return $this->response->setJSON([
            'status' => true,
            'data'   => $students,
            'total'  => count($students)
        ]);
    }


    /**
     * =====================================================
     * SAVE / UPDATE DIGITAL SHAKTI ASSESSMENTS
     *
     * Multiple students are submitted together.
     * =====================================================
     */
    public function save()
    {
        $centerId =
            $this->request->getPost('center_id');

        $batchId =
            $this->request->getPost('batch_id');

        $assessmentType =
            $this->request->getPost('assessment_type');

        $studentIds =
            $this->request->getPost('student_id');

        $assessmentDates =
            $this->request->getPost('assessment_date');

        $grades =
            $this->request->getPost('digital_shakti_grade');

        $remarks =
            $this->request->getPost('digital_shakti_remark');


        /*
     * =================================================
     * BASIC VALIDATION
     * =================================================
     */

        if (
            empty($centerId) ||
            empty($batchId) ||
            empty($assessmentType) ||
            empty($studentIds)
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
     * ASSESSMENT TYPE VALIDATION
     * =================================================
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

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid Assessment Type.'
                );
        }


        $assessmentModel =
            new StudentAssessmentModel();

        $db =
            \Config\Database::connect();


        /*
     * =================================================
     * PROCESS EACH STUDENT
     * =================================================
     */

        foreach (
            $studentIds as $index => $studentId
        ) {

            $assessmentDate =
                $assessmentDates[$index] ?? null;

            $grade =
                $grades[$index] ?? null;

            $remark =
                $remarks[$index] ?? null;


            /*
         * =================================================
         * SKIP COMPLETELY EMPTY ROW
         * =================================================
         */

            if (
                empty($assessmentDate) &&
                empty($grade) &&
                empty($remark)
            ) {

                continue;
            }


            /*
         * =================================================
         * FUTURE DATE VALIDATION
         * =================================================
         */

            if (
                !empty($assessmentDate) &&
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


            /*
         * =================================================
         * VERIFY STUDENT IN STUDENT_PROGRAM
         *
         * Center / Batch / Program come from
         * student_program.
         * =================================================
         */

            $studentProgram =
                $db->table('student_program sp')

                ->select('
                sp.Student_Id,
                sp.Program_Id,
                sp.Center_Id,
                sp.Batch_Id,
                sp.Student_Status
            ')

                ->where(
                    'sp.Student_Id',
                    $studentId
                )

                ->where(
                    'sp.Program_Id',
                    $this->programId
                )

                ->where(
                    'sp.Center_Id',
                    $centerId
                )

                ->where(
                    'sp.Batch_Id',
                    $batchId
                )

                ->where(
                    'sp.Student_Status',
                    'Active'
                )

                ->get()
                ->getRowArray();


            /*
         * Student is not enrolled in the selected
         * Digital Shakti program / center / batch.
         */

            if (empty($studentProgram)) {

                continue;
            }


            /*
         * =================================================
         * VERIFY DIGITAL SHAKTI ENROLLMENT
         *
         * digital_shakti_stu is only used to confirm
         * that this student is actually enrolled in
         * Digital Shakti and is Active.
         *
         * We DO NOT check Center_Id / Batch_Id here
         * because those fields are empty in your table.
         * =================================================
         */

            $digitalShaktiStudent =
                $db->table('digital_shakti_stu')

                ->where(
                    'Student_Id',
                    $studentId
                )

                ->where(
                    'DS_Status',
                    'Active'
                )

                ->get()
                ->getRowArray();


            /*
         * Student is not an active Digital Shakti
         * student.
         */

            if (empty($digitalShaktiStudent)) {

                continue;
            }


            /*
         * =================================================
         * CHECK EXISTING ASSESSMENT
         * =================================================
         */

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


            /*
         * =================================================
         * UPDATE EXISTING ASSESSMENT
         * =================================================
         */

            if ($existingAssessment) {

                $updateData = [

                    'Assessment_Date' =>
                    $assessmentDate,

                    'Digital_Shakti_Grade' =>
                    $grade,

                    'Digital_Shakti_Remark' =>
                    $remark,

                    'Rec_Updated_By' =>
                    'Admin',

                    'Rec_Last_Updated_On' =>
                    date('Y-m-d')
                ];


                $assessmentModel->update(
                    $existingAssessment['Student_Assessment_Id'],
                    $updateData
                );


                continue;
            }


            /*
         * =================================================
         * CREATE NEW ASSESSMENT ID
         * =================================================
         */

            $assessmentId =
                'ASM' .
                date('ymdHis') .
                random_int(10, 99);


            /*
         * =================================================
         * INSERT NEW ASSESSMENT
         * =================================================
         */

            $insertData = [

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

                'Digital_Shakti_Grade' =>
                $grade,

                'Digital_Shakti_Remark' =>
                $remark,

                'Rec_Added_By' =>
                'Admin',

                'Rec_Added_On' =>
                date('Y-m-d')
            ];


            $assessmentModel->insert(
                $insertData
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
                    'assessment/digital-shakti'
                )
            )
            ->with(
                'success',
                'Digital Shakti student assessments saved successfully.'
            );
    }
}
