<?php

namespace App\Controllers;

use App\Models\FeesModel;
use App\Models\FeePaymentModel;
use Config\CorePrograms;

class Fees extends BaseController
{
    protected $feesModel;
    protected $feePaymentModel;
    protected $db;

    public function __construct()
    {
        $this->feesModel       = new FeesModel();
        $this->feePaymentModel = new FeePaymentModel();
        $this->db              = \Config\Database::connect();
    }

    /**
     * ==========================================
     * FEES MAIN PAGE
     * ==========================================
     */
    public function index()
    {
        /*
         * Load ALL programs from program_m.
         *
         * Do NOT use CorePrograms::all() here because
         * the Fees dropdown should show every program.
         */
        $programs = $this->db
            ->table('program_m')
            ->select('Program_Id, Program_Name')
            ->orderBy('Program_Name', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title'    => 'Manage Fees',
            'programs' => $programs
        ];

        return view('finance/fees', $data);
    }


    /**
     * ==========================================
     * GET CENTERS
     * Program -> Center
     * ==========================================
     */
    public function getCenters()
    {
        $programId = $this->request->getPost('program_id');

        if (!$programId) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Program is required.',
                'data'    => []
            ]);
        }

        try {

            $centers = $this->db
                ->table('program_center_rel pcr')
                ->select('center_m.Center_Id, center_m.Center_Name')
                ->join(
                    'center_m',
                    'center_m.Center_Id = pcr.Center_Id'
                )
                ->where('pcr.Program_Id', $programId)
                ->orderBy('center_m.Center_Name', 'ASC')
                ->get()
                ->getResultArray();

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Centers loaded successfully.',
                'data'    => $centers
            ]);
        } catch (\Throwable $e) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Error loading centers.',
                'error'   => $e->getMessage(),
                'data'    => []
            ]);
        }
    }


    /**
     * ==========================================
     * GET BATCHES
     * Program + Center -> Batch
     * ==========================================
     */
    public function getBatches()
    {
        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');

        if (!$programId || !$centerId) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Program and center are required.',
                'data'    => []
            ]);
        }

        try {

            $batches = $this->db
                ->table('batch_m')
                ->select('Batch_Id, Batch_Name')
                ->where('Program_Id', $programId)
                ->where('Center_Id', $centerId)
                ->orderBy('Batch_Name', 'ASC')
                ->get()
                ->getResultArray();

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Batches loaded successfully.',
                'data'    => $batches
            ]);
        } catch (\Throwable $e) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Error loading batches.',
                'error'   => $e->getMessage(),
                'data'    => []
            ]);
        }
    }


    /**
     * ==========================================
     * GET STUDENTS
     * Program + Center + Batch -> Students
     * ==========================================
     */
    public function getStudents()
    {
        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');
        $batchId   = $this->request->getPost('batch_id');
        $fromDate  = $this->request->getPost('from_date');
        $toDate    = $this->request->getPost('to_date');

        if (
            !$programId ||
            !$centerId ||
            !$batchId ||
            !$fromDate ||
            !$toDate
        ) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Program, center, batch and fee dates are required.',
                'data'    => []
            ]);
        }



        try {

            /*
         * ==========================================
         * GET ACTIVE STUDENTS
         * ==========================================
         */

            $students = $this->db
                ->table('student_program sp')
                ->select('
                sp.Student_Program_Id,
                sp.Student_Id,
                sp.Program_Id,
                sp.Center_Id,
                sp.Batch_Id,
                s.First_Name,
                s.Last_Name,
                s.Phone_No
            ')
                ->join(
                    'student s',
                    's.Student_Id = sp.Student_Id'
                )
                ->where('sp.Program_Id', $programId)
                ->where('sp.Center_Id', $centerId)
                ->where('sp.Batch_Id', $batchId)
                ->where('sp.Student_Status', 'Active')
                ->orderBy('s.First_Name', 'ASC')
                ->get()
                ->getResultArray();


            /*
         * ==========================================
         * ADD FEE DETAILS FOR EVERY STUDENT
         * ==========================================
         */

            foreach ($students as &$student) {

                $studentId = $student['Student_Id'];


                /*
             * DEFAULT VALUES
             */

                $student['existing_fee']            = false;
                $student['existing_fees_id']        = null;

                $student['due_amount']              = 0;
                $student['late_fine']               = 0;
                $student['previous_pending_amount'] = 0;
                $student['paid_amount']             = 0;
                $student['paid_date']               = null;
                $student['pending_amount']          = 0;
                $student['remarks']                 = '';


                /*
             * ==========================================
             * CHECK EXACT CURRENT FEE PERIOD
             *
             * Same Student
             * Same Program
             * Same Center
             * Same Batch
             * Same From Date
             * Same To Date
             * ==========================================
             */

                $existingFee = $this->db
                    ->table('fees')
                    ->where('Student_Id', $studentId)
                    ->where('Program_Id', $programId)
                    ->where('Center_Id', $centerId)
                    ->where('Batch_Id', $batchId)
                    ->where('From_Date', $fromDate)
                    ->where('To_Date', $toDate)
                    ->get()
                    ->getRowArray();


                /*
             * ==========================================
             * IF CURRENT PERIOD RECORD EXISTS
             * RETURN ITS DATA
             * ==========================================
             */

                if ($existingFee) {

                    $student['existing_fee']            = true;
                    $student['existing_fees_id']        = $existingFee['Fees_Id'];

                    $student['due_amount'] =
                        (float) $existingFee['Due_Amount'];

                    $student['late_fine'] =
                        (float) ($existingFee['Late_Fine'] ?? 0);

                    $student['previous_pending_amount'] =
                        (float) ($existingFee['Previous_Pending_Amount'] ?? 0);

                    $student['paid_amount'] =
                        (float) $existingFee['Paid_Amount'];

                    $student['paid_date'] =
                        $existingFee['Paid_Date'];

                    $student['pending_amount'] =
                        (float) $existingFee['Pending_Amount'];

                    $student['remarks'] =
                        $existingFee['Remarks'] ?? '';

                    continue;
                }


                /*
             * ==========================================
             * NO CURRENT RECORD
             *
             * GET LATEST PREVIOUS FEE RECORD
             * BEFORE SELECTED PERIOD
             * ==========================================
             */

                $previousFee = $this->db
                    ->table('fees')
                    ->select('
                    Fees_Id,
                    To_Date,
                    Pending_Amount
                ')
                    ->where('Student_Id', $studentId)
                    ->where('Program_Id', $programId)
                    ->where('Center_Id', $centerId)
                    ->where('Batch_Id', $batchId)
                    ->where('To_Date <', $fromDate)
                    ->orderBy('To_Date', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRowArray();


                /*
             * ==========================================
             * CARRY FORWARD PREVIOUS PENDING
             * ==========================================
             */

                if ($previousFee) {

                    $previousPending =
                        (float) $previousFee['Pending_Amount'];

                    if ($previousPending > 0) {

                        $student['previous_pending_amount'] =
                            $previousPending;
                    }
                }
            }

            unset($student);


            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Students and fee details loaded successfully.',
                'data'    => $students
            ]);
        } catch (\Throwable $e) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Error loading students and fee details.',
                'error'   => $e->getMessage(),
                'data'    => []
            ]);
        }
    }


    /**
     * ==========================================
     * SAVE FEES
     *
     * Receives:
     *
     * students[0][student_id]
     * students[0][due_amount]
     * students[0][paid_amount]
     * students[0][paid_date]
     * students[0][remark]
     *
     * students[1][student_id]
     * ...
     * ==========================================
     */
    public function save()
    {
        $programId       = $this->request->getPost('program_id');
        $centerId        = $this->request->getPost('center_id');
        $batchId         = $this->request->getPost('batch_id');
        $frequencyMonths = $this->request->getPost('frequency_months');
        $fromDate        = $this->request->getPost('from_date');
        $toDate          = $this->request->getPost('to_date');

        $students = $this->request->getPost('students');


        /*
     * ======================================
     * BASIC VALIDATION
     * ======================================
     */

        if (
            !$programId ||
            !$centerId ||
            !$batchId ||
            $frequencyMonths === null ||
            $frequencyMonths === '' ||
            !$fromDate ||
            !$toDate
        ) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please select Program, Center, Batch, Frequency and dates.'
            ]);
        }

        $frequencyMonths = (int) $frequencyMonths;


        if (empty($students) || !is_array($students)) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'No student fee data received.'
            ]);
        }


        /*
     * ======================================
     * DATABASE TRANSACTION
     * ======================================
     */

        $this->db->transStart();


        $savedCount   = 0;
        $updatedCount = 0;


        /*
     * ======================================
     * PROCESS EVERY STUDENT
     * ======================================
     */

        foreach ($students as $student) {

            /*
         * ----------------------------------
         * STUDENT ID
         * ----------------------------------
         */

            $studentId = $student['student_id'] ?? null;

            if (!$studentId) {
                continue;
            }


            /*
         * ----------------------------------
         * CURRENT DUE AMOUNT
         * ----------------------------------
         */

            $dueAmount = isset($student['due_amount'])
                ? (float) $student['due_amount']
                : 0;




            $lateFine = (float) ($student['late_fine'] ?? 0);


            /*
         * ----------------------------------
         * PREVIOUS PENDING AMOUNT
         * ----------------------------------
         */

            $previousPendingAmount =
                isset($student['previous_pending_amount'])
                ? (float) $student['previous_pending_amount']
                : 0;


            /*
         * ----------------------------------
         * PAID AMOUNT
         * ----------------------------------
         */

            $paidAmount = isset($student['paid_amount'])
                ? (float) $student['paid_amount']
                : 0;


            /*
         * ----------------------------------
         * PAID DATE
         * ----------------------------------
         */

            $paidDate = !empty($student['paid_date'])
                ? $student['paid_date']
                : null;


            /*
         * ----------------------------------
         * REMARK
         * ----------------------------------
         */

            $remark = isset($student['remark'])
                ? trim($student['remark'])
                : null;


            /*
         * ======================================
         * VALIDATE AMOUNTS
         * ======================================
         */

            if ($dueAmount <= 0) {
                continue;
            }


            if ($previousPendingAmount < 0) {
                $previousPendingAmount = 0;
            }


            /*
         * TOTAL DUE =
         * PREVIOUS PENDING + CURRENT DUE
         */

            $totalDueAmount = $previousPendingAmount + $dueAmount + $lateFine;


            if ($paidAmount < 0) {
                $paidAmount = 0;
            }


            /*
         * Paid cannot exceed total due
         */

            if ($paidAmount > $totalDueAmount) {
                $paidAmount = $totalDueAmount;
            }


            /*
         * ======================================
         * CALCULATE PENDING
         * ======================================
         */

            $pendingAmount =
                $totalDueAmount - $paidAmount;


            if ($pendingAmount < 0) {
                $pendingAmount = 0;
            }


            /*
         * ======================================
         * CHECK EXACT EXISTING FEE RECORD
         * ======================================
         */

            $existingFee = $this->db
                ->table('fees')
                ->where('Student_Id', $studentId)
                ->where('Program_Id', $programId)
                ->where('Center_Id', $centerId)
                ->where('Batch_Id', $batchId)
                ->where('From_Date', $fromDate)
                ->where('To_Date', $toDate)
                ->get()
                ->getRowArray();


            /*
            * ======================================
            * CHECK FOR OVERLAPPING FEE PERIOD
            *
            * New From Date <= Existing To Date
            * AND
            * New To Date >= Existing From Date
            * ======================================
            */

            if (!$existingFee) {

                $overlappingFee = $this->db
                    ->table('fees')
                    ->select('Fees_Id, From_Date, To_Date')
                    ->where('Student_Id', $studentId)
                    ->where('Program_Id', $programId)
                    ->where('Center_Id', $centerId)
                    ->where('Batch_Id', $batchId)
                    ->groupStart()
                    ->where('From_Date <=', $toDate)
                    ->where('To_Date >=', $fromDate)
                    ->groupEnd()
                    ->orderBy('From_Date', 'ASC')
                    ->get()
                    ->getRowArray();


                /*
                * If another fee period overlaps,
                * do not allow a new record.
                */

                if ($overlappingFee) {

                    $this->db->transRollback();

                    return $this->response->setJSON([
                        'status' => false,
                        'message' =>
                        'Fee period already exists or overlaps for this student. '
                            . 'Existing period: '
                            . date('d-m-Y', strtotime($overlappingFee['From_Date']))
                            . ' to '
                            . date('d-m-Y', strtotime($overlappingFee['To_Date']))
                    ]);
                }
            }


            /*
            * ======================================
            * CASE 1: EXISTING FEE RECORD
            * UPDATE RECORD
            * ======================================
            */

            if ($existingFee) {

                $oldPaidAmount =
                    (float) $existingFee['Paid_Amount'];


                /*
             * Additional payment means:
             *
             * New Paid Amount - Old Paid Amount
             */

                $additionalPayment =
                    $paidAmount - $oldPaidAmount;


                /*
             * Do not allow negative additional
             * payment through this screen.
             *
             * Example:
             * Old = 4000
             * New = 3000
             *
             * Payment history cannot simply be
             * deleted automatically.
             */

                if ($additionalPayment < 0) {

                    $this->db->transRollback();

                    return $this->response->setJSON([
                        'status'  => false,
                        'message' =>
                        'Paid amount cannot be reduced for student ID: '
                            . $studentId
                            . '. Existing paid amount is '
                            . number_format($oldPaidAmount, 2)
                            . '.'
                    ]);
                }


                /*
             * UPDATE MAIN FEES RECORD
             */

                $updateData = [

                    'Frequency_Months' =>
                    $frequencyMonths,

                    'Previous_Pending_Amount' =>
                    $previousPendingAmount,

                    'Due_Amount' =>
                    $dueAmount,

                    'Late_Fine'       => $lateFine,

                    'Paid_Amount' =>
                    $paidAmount,

                    'Paid_Date' =>
                    $paidDate,

                    'Pending_Amount' =>
                    $pendingAmount,

                    'Remarks' =>
                    $remark,

                    'Rec_Updated_By' =>
                    session()->get('User_Id') ?? 'SYSTEM',

                    'Rec_Last_Updated_On' =>
                    date('Y-m-d')
                ];


                $feeUpdated = $this->feesModel
                    ->update(
                        $existingFee['Fees_Id'],
                        $updateData
                    );


                if (!$feeUpdated) {

                    $this->db->transRollback();

                    return $this->response->setJSON([
                        'status'  => false,
                        'message' => 'Unable to update fee record.',
                        'errors'  => $this->feesModel->errors()
                    ]);
                }


                /*
             * ==================================
             * SAVE ONLY ADDITIONAL PAYMENT
             * ==================================
             */

                if ($additionalPayment > 0) {

                    $paymentId =
                        'PAY' .
                        strtoupper(substr(uniqid(), -8));


                    $paymentData = [

                        'Payment_Id' =>
                        $paymentId,

                        'Fees_Id' =>
                        $existingFee['Fees_Id'],

                        'Payment_Date' =>
                        $paidDate ?: date('Y-m-d'),

                        'Paid_Amount' =>
                        $additionalPayment,

                        'Payment_Mode' =>
                        null,

                        'Remarks' =>
                        $remark,

                        'Recorded_By' =>
                        session()->get('User_Id') ?? 'SYSTEM',

                        'Rec_Added_On' =>
                        date('Y-m-d')
                    ];


                    $paymentInserted =
                        $this->feePaymentModel
                        ->insert($paymentData);


                    if (!$paymentInserted) {

                        $this->db->transRollback();

                        return $this->response->setJSON([
                            'status'  => false,
                            'message' =>
                            'Fee updated but additional payment could not be saved.',
                            'errors' =>
                            $this->feePaymentModel->errors()
                        ]);
                    }
                }


                $updatedCount++;

                continue;
            }


            /*
         * ======================================
         * CASE 2: NEW FEE RECORD
         * INSERT RECORD
         * ======================================
         */

            $feesId =
                'FEE' .
                strtoupper(substr(uniqid(), -8));


            $feeData = [

                'Fees_Id' =>
                $feesId,

                'Student_Id' =>
                $studentId,

                'Program_Id' =>
                $programId,

                'Center_Id' =>
                $centerId,

                'Batch_Id' =>
                $batchId,

                'Frequency_Months' =>
                $frequencyMonths,

                'From_Date' =>
                $fromDate,

                'To_Date' =>
                $toDate,

                'Previous_Pending_Amount' =>
                $previousPendingAmount,

                'Due_Amount' =>
                $dueAmount,

                'Late_Fine'      => $lateFine,

                'Paid_Amount' =>
                $paidAmount,

                'Paid_Date' =>
                $paidDate,

                'Pending_Amount' =>
                $pendingAmount,

                'Remarks' =>
                $remark,

                'Rec_Added_By' =>
                session()->get('User_Id') ?? 'SYSTEM',

                'Rec_Added_On' =>
                date('Y-m-d')
            ];


            $feeInserted =
                $this->feesModel->insert($feeData);


            if (!$feeInserted) {

                $this->db->transRollback();

                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Unable to save fee record.',
                    'errors'  => $this->feesModel->errors()
                ]);
            }


            /*
         * ==================================
         * SAVE INITIAL PAYMENT
         * ==================================
         */

            if ($paidAmount > 0) {

                $paymentId =
                    'PAY' .
                    strtoupper(substr(uniqid(), -8));


                $paymentData = [

                    'Payment_Id' =>
                    $paymentId,

                    'Fees_Id' =>
                    $feesId,

                    'Payment_Date' =>
                    $paidDate ?: date('Y-m-d'),

                    'Paid_Amount' =>
                    $paidAmount,

                    'Payment_Mode' =>
                    null,

                    'Remarks' =>
                    $remark,

                    'Recorded_By' =>
                    session()->get('User_Id') ?? 'SYSTEM',

                    'Rec_Added_On' =>
                    date('Y-m-d')
                ];


                $paymentInserted =
                    $this->feePaymentModel
                    ->insert($paymentData);


                if (!$paymentInserted) {

                    $this->db->transRollback();

                    return $this->response->setJSON([
                        'status'  => false,
                        'message' =>
                        'Fee saved but payment could not be saved.',
                        'errors' =>
                        $this->feePaymentModel->errors()
                    ]);
                }
            }


            $savedCount++;
        }


        /*
     * ======================================
     * COMPLETE TRANSACTION
     * ======================================
     */

        $this->db->transComplete();


        if ($this->db->transStatus() === false) {

            return $this->response->setJSON([
                'status'  => false,
                'message' =>
                'Database transaction failed. No records were saved.'
            ]);
        }


        /*
     * ======================================
     * SUCCESS MESSAGE
     * ======================================
     */

        return $this->response->setJSON([
            'status'         => true,
            'message'        => 'Fee records processed successfully.',
            'saved_count'    => $savedCount,
            'updated_count'  => $updatedCount,
            'total_processed' =>
            $savedCount + $updatedCount
        ]);
    }
}
