<?php
namespace App\Models;
use CodeIgniter\Model;

class EventDetailModel extends Model
{
    protected $table = 'event_detail';
    protected $primaryKey = 'Event_Id';
    protected $allowedFields = ['Event_Id', 'EventType_Id', 'Event_Date', 'Event_Description', 
                                'Event_ChiefGuest', 'Event_Place', 'Event_Start_At', 'Event_End_At',
                                'Event_Mode', 'Event_Status',
                                'Rec_Added_By', 'Rec_Added_On', 'Rec_Updated_By',
                                'Rec_Last_Updated_On'];
    public $useAutoIncrement = false;
}
