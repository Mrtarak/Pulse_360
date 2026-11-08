<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'program_m';
    protected $primaryKey = 'Program_Id';
    protected $returnType = 'array';
    protected $useAutoIncrement = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        'Program_Id',
        'Program_Name',
        'Program_About',
        'Banner_Image',
        'Thumbnail_Image',
        'Banner_Head',
        'Banner_Subhead',
        'Highlight_Points',
        'Program_Start_Date',
        'Program_End_Date',
        'Program_Theme_Id',
        'Applicable_For',
        'Program_Status',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];
}
