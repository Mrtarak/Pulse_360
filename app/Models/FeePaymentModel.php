<?php

namespace App\Models;

use CodeIgniter\Model;

class FeePaymentModel extends Model
{
    protected $table            = 'fee_payment';
    protected $primaryKey       = 'Payment_Id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';

    protected $protectFields = true;

    protected $allowedFields = [
        'Payment_Id',
        'Fees_Id',
        'Payment_Date',
        'Paid_Amount',
        'Payment_Mode',
        'Remarks',
        'Recorded_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
}