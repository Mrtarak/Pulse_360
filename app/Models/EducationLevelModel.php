<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationLevelModel extends Model
{
    protected $table = 'education_levels';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'name',
        'status'
    ];
}
