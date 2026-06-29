<?php

namespace App\Models;

use CodeIgniter\Model;

class GoalModel extends Model
{
    protected $table = 'goal_m';

    protected $primaryKey = 'Goal_Id';

    protected $useAutoIncrement = false;

    protected $returnType = 'array';

    protected $protectFields = true;

    protected $allowedFields = [
        'Goal_Id',
        'Goal_Type_Id',
        'Goal_Title',
        'Goal_Description',
        'Default_Target_Value',
        'Goal_Status',
        'Rec_Added_By',
        'Rec_Added_On',
        'Rec_Updated_By',
        'Rec_Last_Updated_On'
    ];

    protected $useTimestamps = false;

    public function getGoals()
    {
        return $this->select('goal_m.*, goaltype_m.Goal_Type_Name')
                    ->join(
                        'goaltype_m',
                        'goaltype_m.Goal_Type_Id = goal_m.Goal_Type_Id',
                        'left'
                    )
                    ->findAll();
    }
}