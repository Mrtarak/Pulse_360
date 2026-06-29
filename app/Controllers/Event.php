<?php

namespace App\Controllers;
use App\Models\EventDetailModel;

class Event extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventDetailModel();
        helper(['form']);
    }

    public function eventList()
    {
        $data['events'] = $this->eventModel
            ->select('event_detail.*, eventtype_m.Event_TypeName')
            ->join('eventtype_m', 'eventtype_m.EventType_Id = event_detail.EventType_Id')
            ->findAll();

        return view('ManageEvents/events', $data);
    }

    public function addEvent()
    {
        $data['types'] = $this->eventTypeModel->findAll();
        return view('ManageEvents/add_events', $data);
    }

    public function saveEvent()
    {
        $this->eventModel->insert($this->request->getPost());
        return redirect()->to('events/list')->with('success', 'Event Created');
    }

    public function editEvent($id)
    {
        $data['event'] = $this->eventModel->find($id);
        $data['types'] = $this->eventTypeModel->findAll();
        return view('ManageEvents/edit_events', $data);
    }

    public function updateEvent($id)
    {
        $this->eventModel->update($id, $this->request->getPost());
        return redirect()->to('events/list')->with('success', 'Event Updated');
    }

    public function deleteEvent($id)
    {
        $this->eventModel->delete($id);
        return redirect()->to('events/list')->with('success', 'Event Deleted');
    }
}
