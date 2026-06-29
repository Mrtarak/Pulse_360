<?php
namespace App\Models;
use CodeIgniter\Model;

class EventTypeModel extends Model
{
    protected $table = 'eventtype_m';
    protected $primaryKey = 'EventType_Id';
    protected $allowedFields = ['EventType_Id', 'Event_Type_Name', 'Event_Type_About', 
                                'Rec_Added_By', 'Rec_Added_On', 'Rec_Updated_By',
                                'Rec_Last_Updated_On'];
    protected $returnType = 'array';
}
