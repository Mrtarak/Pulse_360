<?php

namespace App\Controllers;

use App\Models\ProgramModel;

class Attendance extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    /*
    |--------------------------------------------------------------------------
    | ATTENDANCE PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $programId = $this->request->getGet('program_id');

        /*
         * Program is mandatory.
         * If somebody opens /attendance/class directly,
         * don't allow them to access an unfiltered attendance page.
         */
        if (empty($programId)) {

            return redirect()
                ->to(site_url('/'))
                ->with('error', 'Please select a program first.');
        }


        /*
         * Verify that this program actually exists.
         */
        $programModel = new ProgramModel();

        $program = $programModel
            ->where('Program_Id', $programId)
            ->first();


        if (!$program) {

            return redirect()
                ->to(site_url('/'))
                ->with('error', 'Invalid program selected.');
        }


        /*
         * Send only the selected program to the view.
         */
        $data = [
            'program' => $program,
            'program_id' => $programId
        ];


        return view('attendance/class', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | GET CENTERS
    |--------------------------------------------------------------------------
    */

    public function getCenters()
    {
        $programId = $this->request->getPost('program_id');


        if (empty($programId)) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Program is required.',
                'centers' => []
            ]);
        }


        /*
         * Verify program exists.
         */
        $programExists = $this->db
            ->table('program_m')
            ->where('Program_Id', $programId)
            ->countAllResults();


        if (!$programExists) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid program.',
                'centers' => []
            ]);
        }


        /*
         * Get only centers which have batches
         * belonging to this program.
         */
        $centers = $this->db
            ->table('batch_m b')
            ->distinct()
            ->select('c.Center_Id, c.Center_Name')
            ->join(
                'center_m c',
                'c.Center_Id = b.Center_Id'
            )
            ->where('b.Program_Id', $programId)
            ->orderBy('c.Center_Name', 'ASC')
            ->get()
            ->getResultArray();


        return $this->response->setJSON([
            'status' => true,
            'program_id' => $programId,
            'centers' => $centers
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | GET BATCHES
    |--------------------------------------------------------------------------
    */

    public function getBatches()
    {
        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');


        if (empty($programId) || empty($centerId)) {

            return $this->response->setJSON([]);
        }


        /*
         * IMPORTANT VALIDATION
         *
         * First check that this center actually belongs
         * to the selected program.
         */
        $centerValid = $this->db
            ->table('batch_m')
            ->where('Program_Id', $programId)
            ->where('Center_Id', $centerId)
            ->countAllResults();


        if (!$centerValid) {

            return $this->response->setJSON([]);
        }


        /*
         * Get batches only for:
         *
         * Selected Program
         * +
         * Selected Center
         */
        $batches = $this->db
            ->table('batch_m')
            ->select('Batch_Id, Batch_Name')
            ->where('Program_Id', $programId)
            ->where('Center_Id', $centerId)
            ->orderBy('Batch_Name', 'ASC')
            ->get()
            ->getResultArray();


        return $this->response->setJSON($batches);
    }


    /*
    |--------------------------------------------------------------------------
    | GET STUDENTS
    |--------------------------------------------------------------------------
    */

    public function getStudents()
    {
        $programId = $this->request->getPost('program_id');
        $batchId   = $this->request->getPost('batch_id');
        $date      = $this->request->getPost('attendance_date');


        if (
            empty($programId) ||
            empty($batchId) ||
            empty($date)
        ) {

            return $this->response
                ->setStatusCode(400)
                ->setBody('Invalid attendance request.');
        }


        /*
         * Validate that the selected batch actually belongs
         * to the selected program.
         */
        $batch = $this->db
            ->table('batch_m')
            ->where('Batch_Id', $batchId)
            ->where('Program_Id', $programId)
            ->get()
            ->getRowArray();


        if (!$batch) {

            return $this->response
                ->setStatusCode(403)
                ->setBody('Invalid batch for selected program.');
        }


        /*
         * Get students belonging to:
         *
         * Program
         * +
         * Batch
         */
        $students = $this->db
            ->table('student_program sp')
            ->select("
                sp.Student_Id,
                s.First_Name,
                s.Last_Name,
                sa.Attendance_Status,
                sa.Remarks
            ")
            ->join(
                'student s',
                's.Student_Id = sp.Student_Id'
            )
            ->join(
                'stu_attendance sa',
                "sa.Student_Id = sp.Student_Id
                 AND sa.Batch_Id = sp.Batch_Id
                 AND sa.Program_Id = sp.Program_Id
                 AND sa.Attendance_Date = " . $this->db->escape($date),
                'left'
            )
            ->where('sp.Program_Id', $programId)
            ->where('sp.Batch_Id', $batchId)
            ->get()
            ->getResultArray();


        return view(
            'attendance/student_rows',
            [
                'students' => $students
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE ATTENDANCE
    |--------------------------------------------------------------------------
    */

    public function saveAttendance()
    {
        $attendance = $this->request->getPost('attendance');
        $remarks    = $this->request->getPost('remark');

        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');
        $batchId   = $this->request->getPost('batch_id');
        $date      = $this->request->getPost('attendance_date');


        /*
         * Basic validation
         */
        if (
            empty($programId) ||
            empty($centerId) ||
            empty($batchId) ||
            empty($date) ||
            empty($attendance)
        ) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Please select Program, Center, Batch and Attendance Date.'
            ]);
        }


        /*
         * IMPORTANT SECURITY VALIDATION
         *
         * Verify that the selected batch belongs
         * to the selected program AND center.
         */
        $batch = $this->db
            ->table('batch_m')
            ->where('Batch_Id', $batchId)
            ->where('Program_Id', $programId)
            ->where('Center_Id', $centerId)
            ->get()
            ->getRowArray();


        if (!$batch) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid Program, Center or Batch combination.'
            ]);
        }


        /*
         * Process every student.
         */
        foreach ($attendance as $studentId => $status) {


            /*
             * Verify that this student actually belongs
             * to the selected program and batch.
             *
             * This prevents manually sending another
             * student's ID through the browser.
             */
            $studentValid = $this->db
                ->table('student_program')
                ->where('Student_Id', $studentId)
                ->where('Program_Id', $programId)
                ->where('Batch_Id', $batchId)
                ->countAllResults();


            if (!$studentValid) {
                continue;
            }


            /*
             * Validate attendance status.
             */
            if (!in_array($status, ['Present', 'Absent'])) {
                continue;
            }


            /*
             * Check existing attendance.
             */
            $existing = $this->db
                ->table('stu_attendance')
                ->where('Student_Id', $studentId)
                ->where('Batch_Id', $batchId)
                ->where('Program_Id', $programId)
                ->where('Center_Id', $centerId)
                ->where('Attendance_Date', $date)
                ->get()
                ->getRow();


            /*
             * UPDATE
             */
            if ($existing) {

                $this->db
                    ->table('stu_attendance')
                    ->where(
                        'Stu_Attendance_Id',
                        $existing->Stu_Attendance_Id
                    )
                    ->update([

                        'Attendance_Status' => $status,

                        'Remarks' =>
                        $remarks[$studentId] ?? '',

                        'Rec_Updated_By' => 'Admin',

                        'Rec_Last_Updated_On' =>
                        date('Y-m-d')

                    ]);
            }


            /*
             * INSERT
             */ else {

                $attendanceId =
                    'ATT' .
                    time() .
                    rand(100, 999);


                $data = [

                    'Stu_Attendance_Id' =>
                    $attendanceId,

                    'Student_Id' =>
                    $studentId,

                    'Batch_Id' =>
                    $batchId,

                    'Program_Id' =>
                    $programId,

                    'Center_Id' =>
                    $centerId,

                    'Attendance_Date' =>
                    $date,

                    'Attendance_Status' =>
                    $status,

                    'Remarks' =>
                    $remarks[$studentId] ?? '',

                    'Rec_Added_By' =>
                    'Admin',

                    'Rec_Added_On' =>
                    date('Y-m-d'),

                    'Rec_Updated_By' =>
                    'Admin',

                    'Rec_Last_Updated_On' =>
                    date('Y-m-d')
                ];


                $this->db
                    ->table('stu_attendance')
                    ->insert($data);
            }
        }


        return $this->response->setJSON([
            'status' => true,
            'message' => 'Attendance Saved Successfully'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | GET ATTENDANCE DATES
    |--------------------------------------------------------------------------
    */

    public function getAttendanceDates()
    {
        $programId = $this->request->getPost('program_id');
        $batchId   = $this->request->getPost('batch_id');


        if (
            empty($programId) ||
            empty($batchId)
        ) {

            return $this->response->setJSON([]);
        }


        /*
         * Make sure batch belongs to program.
         */
        $batchValid = $this->db
            ->table('batch_m')
            ->where('Batch_Id', $batchId)
            ->where('Program_Id', $programId)
            ->countAllResults();


        if (!$batchValid) {

            return $this->response->setJSON([]);
        }


        $dates = $this->db
            ->table('stu_attendance')
            ->select('Attendance_Date')
            ->where('Batch_Id', $batchId)
            ->where('Program_Id', $programId)
            ->groupBy('Attendance_Date')
            ->orderBy('Attendance_Date', 'ASC')
            ->get()
            ->getResultArray();


        return $this->response->setJSON($dates);
    }
}
