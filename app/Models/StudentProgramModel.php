<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentProgramModel extends Model
{
    protected $table = 'student_program';

    protected $primaryKey = 'Student_Program_Id';

    public $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = [
        'Student_Program_Id',
        'Student_Id',
        'Program_Id',
        'Center_Id',
        'Batch_Id',
        'Enrollment_Date',
        'Student_Status'
    ];
}