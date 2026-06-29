<?php

namespace App\Models;

use CodeIgniter\Model;

class CenterModel extends Model
{
    protected $table = 'center_m';
    protected $primaryKey = 'Center_Id';

    public $useAutoIncrement = false;
    protected $returnType = 'array';

    protected $allowedFields = [
        'Center_Id',
        'Center_Name',
        'Center_Status',
        'Center_Description',
        'Center_Inaugurated_By',
        'Center_Opening_Date',
        'Center_Address',
        'Center_City',
        'Center_State',
        'Center_Pincode',
        'Center_Capacity',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    // 🔥 IMPORTANT FIX (prevents CI4 insert confusion)
    protected $useTimestamps = false;
}