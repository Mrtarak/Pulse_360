<?php
namespace App\Models;
use CodeIgniter\Model;

class ProgramThemeModel extends Model
{
    protected $table = 'PROGRAM_THEME_M';
    protected $primaryKey = 'Program_Theme_Id';
    protected $allowedFields = [
        'Program_Theme_Id', 'Program_Theme_Name', 'Theme_Description', 'Theme_Status',
        'Theme_Suggested_By', 'Theme_Added_On',
        'Rec_Added_By', 'Rec_Added_On', 'Rec_Updated_By', 'Rec_Last_Updated_On'
    ];
}
