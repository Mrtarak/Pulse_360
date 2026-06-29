<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'student';
    protected $primaryKey       = 'Student_Id';

    protected $allowedFields    = [
        'Student_Id',
        'First_Name',
        'Last_Name',
        'Gender',
        'DOB',
        'Aadhar_No',
        'Phone_No',
        'Email_Id',
        'Village_City',
        'District',
        'State',
        'Pincode',
        'Nationality',
        'Address',
        'Photo_URL',
        'Aadhar_Photo_URL',
        'Enrollment_Date',
        'Current_Education_level',
        'Highest_Education_Completed',
        'Student_Caste',
        'Student_Status',
        'Remarks',
        'Fathers_Name',
        'Father_Contact_Number',
        'Father_Email_ID',
        'Father_Occupation',
        'Mothers_Name',
        'Mother_Contact_Number',
        'Mother_Email_ID',
        'Mother_Occupation',
        'Family_Monthly_Income',
        'Sibling_Number',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
public function getVijetaasStudents()
    {
        return $this->select('student.*, sp.Program_Id, sp.Program_Status, sm.Mentor_Name')
            ->join('student_program sp', 'student.Student_Id = sp.Student_Id', 'left')
            ->join('student_mentor sm', 'student.Student_Id = sm.Student_Id AND sp.Program_Id = sm.Program_Id', 'left')
            ->where('sp.Program_Id', 'VIJETAAS') // Your program ID for Vijetaas
            ->findAll();
    }
public function getStudentById($id)
{
    return $this->select('student.*, sp.Program_Id, sp.Program_Status, sm.Mentor_Name')
        ->join('student_program sp', 'student.Student_Id = sp.Student_Id', 'left')
        ->join('student_mentor sm', 'student.Student_Id = sm.Student_Id AND sp.Program_Id = sm.Program_Id', 'left')
        ->where('student.Student_Id', $id)
        ->first();
}
}
