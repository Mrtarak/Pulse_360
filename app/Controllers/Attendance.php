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

    public function index()
    {
        $programModel = new ProgramModel();

        $data['programs'] = $programModel->findAll();

        return view('attendance/class', $data);
    }

    public function getCenters()
    {
        $programId = $this->request->getPost('program_id');

        $centers = $this->db
            ->table('batch_m b')
            ->distinct()
            ->select('c.Center_Id, c.Center_Name')
            ->join('center_m c', 'c.Center_Id = b.Center_Id')
            ->where('b.Program_Id', $programId)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'program_id' => $programId,
            'centers' => $centers
        ]);
    }

    public function getBatches()
    {
        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');

        $batches = $this->db
            ->table('batch_m')
            ->select('Batch_Id,Batch_Name')
            ->where('Program_Id', $programId)
            ->where('Center_Id', $centerId)
            ->get()
            ->getResultArray();

        return $this->response->setJSON($batches);
    }

    public function getStudents()
    {

        $programId = $this->request->getPost('program_id');
        $batchId   = $this->request->getPost('batch_id');
        $date      = $this->request->getPost('attendance_date');

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
                AND sa.Attendance_Date = '{$date}'",
                'left'
            )
            ->where('sp.Program_Id', $programId)
            ->where('sp.Batch_Id', $batchId)
            ->get()
            ->getResultArray();



        return view(
            'attendance/student_rows',
            ['students' => $students]
        );
    }
    public function saveAttendance()
    {
        $attendance = $this->request->getPost('attendance');
        $remarks    = $this->request->getPost('remark');

        $programId = $this->request->getPost('program_id');
        $centerId  = $this->request->getPost('center_id');
        $batchId   = $this->request->getPost('batch_id');
        $date      = $this->request->getPost('attendance_date');

        foreach ($attendance as $studentId => $status) {

            // Check if attendance already exists
            $existing = $this->db
                ->table('stu_attendance')
                ->where('Student_Id', $studentId)
                ->where('Batch_Id', $batchId)
                ->where('Program_Id', $programId)
                ->where('Center_Id', $centerId)
                ->where('Attendance_Date', $date)
                ->get()
                ->getRow();

            // UPDATE
            if ($existing) {

                $this->db
                    ->table('stu_attendance')
                    ->where(
                        'Stu_Attendance_Id',
                        $existing->Stu_Attendance_Id
                    )
                    ->update([

                        'Attendance_Status' => $status,
                        'Remarks' => $remarks[$studentId] ?? '',
                        'Rec_Updated_By' => 'Admin',
                        'Rec_Last_Updated_On' => date('Y-m-d')

                    ]);
            }

            // INSERT
            else {

                $attendanceId =
                    'ATT' . time() . rand(100, 999);

                $data = [

                    'Stu_Attendance_Id' => $attendanceId,
                    'Student_Id' => $studentId,
                    'Batch_Id' => $batchId,
                    'Program_Id' => $programId,
                    'Center_Id' => $centerId,
                    'Attendance_Date' => $date,
                    'Attendance_Status' => $status,
                    'Remarks' => $remarks[$studentId] ?? '',

                    'Rec_Added_By' => 'Admin',
                    'Rec_Added_On' => date('Y-m-d'),

                    'Rec_Updated_By' => 'Admin',
                    'Rec_Last_Updated_On' => date('Y-m-d')

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

    public function getAttendanceDates()
    {
        $batchId = $this->request->getPost('batch_id');

        if (empty($batchId)) {
            return $this->response->setJSON([]);
        }

        $db = \Config\Database::connect();

        $dates = $db->table('stu_attendance')
            ->select('Attendance_Date')
            ->where('Batch_Id', $batchId)
            ->groupBy('Attendance_Date')
            ->orderBy('Attendance_Date', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($dates);
    }
}
