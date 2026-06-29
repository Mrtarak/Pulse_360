<?php
namespace App\Models;
use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'role_m';
    protected $primaryKey = 'Role_Id';
    protected $allowedFields = ['Role_Id', 'Role_Name', 'Role_Description', 'Right_Id', 
                                'Record_Added_By', 'Rec_Added_On', 'Rec_Updated_By',
                                'Rec_Last_Updated_On'];
                                public $useAutoIncrement = false;
}
