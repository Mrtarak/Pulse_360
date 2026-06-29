<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchModel extends Model
{
    protected $table = 'batch_m';
    protected $primaryKey = 'Batch_Id';

    public $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $allowedFields = [
        'Batch_Id',
        'Center_Id',
        'Program_Id',
        'Batch_Name',
        'Batch_Status',
        'Duration_Hours',
        'Batch_Start_Date',
        'Batch_Last_Date',
        'Remarks',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    public function getAllBatches()
    {
        return $this->db->table('batch_m b')
            ->select('
                b.*,
                p.Program_Name,
                c.Center_Name
            ')
            ->join('program_m p', 'p.Program_Id = b.Program_Id', 'left')
            ->join('center_m c', 'c.Center_Id = b.Center_Id', 'left')
            ->get()
            ->getResultArray();
    }
}