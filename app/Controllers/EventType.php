<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventTypeModel;

class EventType extends BaseController
{
    public function index()
    {
        $model = new EventTypeModel();
        $data['eventtypes'] = $model->findAll();
        return view('ManageEventType/event_type', $data);
    }

    public function add()
    {
        return view('ManageEventType/add_event_type');
    }

    public function store()
    {
        $model = new EventTypeModel();
        $data = [
            'EventType_Id'        => $this->request->getPost('EventType_Id'),
            'Event_Type_Name'     => $this->request->getPost('Event_Type_Name'),
            'Event_Type_About'    => $this->request->getPost('Event_Type_About'),
            'Rec_Added_By'        => session()->get('username') ?? 'Admin',
            'Rec_Added_On'        => date('Y-m-d'),
        ];

        $model->insert($data);
        return redirect()->to('/eventtype');
    }

    public function view($id)
    {
        $model = new EventTypeModel();
        $data['eventtype'] = $model->find($id);
        return view('ManageEventType/view_event_type', $data);
    }

    public function edit($id)
    {
        $model = new EventTypeModel();
        $data['eventtype'] = $model->find($id);
        return view('ManageEventType/edit_event_type', $data);
    }

    public function update($id)
    {
        $model = new EventTypeModel();
        $data = [
            'Event_Type_Name'      => $this->request->getPost('Event_Type_Name'),
            'Event_Type_About'     => $this->request->getPost('Event_Type_About'),
            'Rec_Updated_By'       => session()->get('username') ?? 'Admin',
            'Rec_Last_Updated_On'  => date('Y-m-d'),
        ];

        $model->update($id, $data);
        return redirect()->to('/eventtype');
    }

    public function delete($id)
    {
        $model = new EventTypeModel();
        $model->delete($id);
        return redirect()->to('/eventtype');
    }
}
