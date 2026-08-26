<?php

namespace App\Models;

use CodeIgniter\Model;

class FeesModel extends Model
{
    protected $table            = 'fees';
    protected $primaryKey       = 'Fees_Id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    protected $protectFields = true;

    protected $allowedFields = [
        'Fees_Id',
        'Student_Id',
        'Program_Id',
        'Center_Id',
        'Batch_Id',
        'Frequency_Months',
        'From_Date',
        'To_Date',
        'Previous_Pending_Amount',
        'Due_Amount',
        'Late_Fine',
        'Paid_Amount',
        'Paid_Date',
        'Pending_Amount',
        'Remarks',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
}
