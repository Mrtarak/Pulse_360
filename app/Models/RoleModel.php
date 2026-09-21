<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role_m';

    protected $primaryKey = 'Role_Id';

    protected $returnType = 'array';

    public $useAutoIncrement = false;

    protected $allowedFields = [
        'Role_Id',
        'Role_Name',
        'Role_Description',
        'Role_Status',
        'Record_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
}
