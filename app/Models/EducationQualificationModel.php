<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationQualificationModel extends Model
{
    protected $table = 'education_qualifications';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'education_level_id',
        'name',
        'status'
    ];
}
