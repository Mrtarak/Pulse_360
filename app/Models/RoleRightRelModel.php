<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleRightRelModel extends Model
{
    protected $table = 'role_right_rel';

    protected $returnType = 'array';

    protected $allowedFields = [
        'Role_Id',
        'Right_Id',
        'Record_Added_By',
        'Rec_Added_On'
    ];
}
