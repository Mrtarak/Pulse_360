<?php

namespace App\Controllers;
use App\Models\RightsModel;
use App\Models\RoleModel;
use CodeIgniter\Controller;

class Rights extends Controller {
    public function index() {
        $rightsModel = new \App\Models\RightsModel();
    $data['rights'] = $rightsModel->findAll();

        return view('ManageRights/rights', $data);
    }

    public function add() {
        $rightsModel = new \App\Models\RightsModel();
        $data['rights'] = $rightsModel->findAll();
        return view('ManageRights/add_rights', $data);
    }

    public function save()
    {
        helper(['form', 'url']);

        $rightsModel = new RightsModel();

        $data = [
            'Right_Id'        => $this->request->getPost('Right_Id'),
            'Rights_Title'     => $this->request->getPost('Rights_Title'),
            'Right_Summary'   => $this->request->getPost('Right_Summary'),
            'Can_View'    => $this->request->getPost('Can_View'),
            'Can_Add'      => $this->request->getPost('Can_Add'),
            'Can_Edit'        => $this->request->getPost('Can_Edit'),
            'Can_Delete'      => $this->request->getPost('Can_Delete'),
            'Record_Added_By' => $this->request->getPost('Record_Added_By'),
            'Rec_Added_On'    => $this->request->getPost('Rec_Added_On'),
        ];

        if ($rightsModel->insert($data)) {
            return redirect()->to(site_url('rights/manage'))->with('success', 'Rights saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to save rights.');
        }
    }

    public function update() {
        $rightsModel = new RightsModel();
        $rightId = $this->request->getPost('Right_Id');
        $data = $this->request->getPost();

        unset($data['Right_Id']);  

        $rightsModel->update($rightId, $data);
        return redirect()->to(site_url('rights/manage?role_id=' . $this->request->getPost('Role_Id')));
    }

    public function edit($id)
{
    $rightsModel = new \App\Models\RightsModel();  
    $roleModel = new \App\Models\RoleModel();

    $data['right'] = $rightsModel->find($id);
    $data['roles'] = $roleModel->findAll(); 

    if (!$data['right']) {
        return redirect()->to(site_url('rights/manage'))->with('error', 'Rights not found.');
    }

    return view('ManageRights/edit_rights', $data); 
}

    public function delete($id)
    {
        $model = new \App\Models\RightsModel();
        $model->delete($id);
        return redirect()->to(site_url('rights'))->with('success', 'Rights deleted successfully.');
    }

}
