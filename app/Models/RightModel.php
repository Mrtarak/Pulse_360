<?php

namespace App\Models;

use CodeIgniter\Model;

class RightModel extends Model
{
  protected $table = 'right_m';

  protected $primaryKey = 'Right_Id';

  protected $returnType = 'array';

  protected $useAutoIncrement = false;

  protected $allowedFields = [
    'Right_Id',
    'Parent_Right_Id',
    'Right_Key',
    'Right_Name',
    'Right_Status',
    'Record_Added_By',
    'Rec_Added_On',
    'Rec_Updated_By',
    'Rec_Last_Updated_On'
  ];
}
