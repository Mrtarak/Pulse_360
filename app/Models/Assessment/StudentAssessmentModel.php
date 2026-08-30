<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class StudentAssessmentModel extends Model
{
    protected $table = 'student_assessment';

    protected $primaryKey = 'Student_Assessment_Id';

    public $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = [

        'Student_Assessment_Id',

        'Student_Id',
        'Program_Id',
        'Center_Id',
        'Batch_Id',

        'Assessment_Type',
        'Assessment_Date',


        /* =========================================
         * LEARNING ADDA FIELDS
         * ========================================= */

        'English_Level',
        'English_Grade',
        'English_Remark',

        'Math_Level',
        'Math_Grade',
        'Math_Remark',

        'Hindi_Level',
        'Hindi_Grade',
        'Hindi_Remark',

        'Marathi_Level',
        'Marathi_Grade',
        'Marathi_Remark',


        /* =========================================
         * DIGITAL SHAKTI
         * ========================================= */

        'Digital_Shakti_Grade',
        'Digital_Shakti_Remark',


        /* =========================================
         * DOOSRA MAUKA
         * ========================================= */

        'Tailoring_Grade',
        'Tailoring_Remark',

        'Literacy_Grade',
        'Literacy_Remark',

        'Numeracy_Grade',
        'Numeracy_Remark',


        /* =========================================
         * SEL
         * ========================================= */

        'Ethics',
        'Empathy',
        'Excellence',
        'Eagerness',

        'SEL_Remarks',


        /* =========================================
         * RECORD INFORMATION
         * ========================================= */

        'Assessed_By',

        'Rec_Added_By',
        'Rec_Added_On',

        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
}