<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoordinatorModel;
use App\Models\ProgramModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use App\Models\RoleModel;
use App\Models\UserModel;

class Coordinator extends BaseController
{
    protected $coordinatorModel;

    public function __construct()
    {
        $this->coordinatorModel = new CoordinatorModel();
    }

    public function index()
    {
        $data['coordinators'] = $this->coordinatorModel->findAll();
        return view('ManageCoordinators/coordinators', $data);
    }

    public function add()
    {
        $data['programs'] = (new ProgramModel())->findAll();
        $data['centers'] = (new CenterModel())->findAll();
        $data['batches'] = (new BatchModel())->findAll();
        $data['roles'] = (new RoleModel())->findAll();
        $data['users'] = (new UserModel())->findAll();
        return view('ManageCoordinators/add_coordinator', $data);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->coordinatorModel->insert($data);
        return redirect()->to('/coordinators')->with('success', 'Coordinator added successfully');
    }

    public function edit($id)
    {
        $data['coordinator'] = $this->coordinatorModel->find($id);
        $data['programs'] = (new ProgramModel())->findAll();
        $data['centers'] = (new CenterModel())->findAll();
        $data['batches'] = (new BatchModel())->findAll();
        $data['roles'] = (new RoleModel())->findAll();
        $data['users'] = (new UserModel())->findAll();
        return view('ManageCoordinators/edit_coordinator', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $this->coordinatorModel->update($id, $data);
        return redirect()->to('/coordinators')->with('success', 'Coordinator updated successfully');
    }

    public function delete($id)
    {
        $this->coordinatorModel->delete($id);
        return redirect()->to('/coordinators')->with('success', 'Coordinator deleted');
    }

    public function view($id)
    {
        $data['coordinator'] = $this->coordinatorModel->find($id);
        return view('ManageCoordinators/view_coordinator', $data);
    }
}
