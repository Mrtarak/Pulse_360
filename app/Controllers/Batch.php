<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BatchModel;
use App\Models\ProgramModel;
use App\Models\CenterModel;

class Batch extends BaseController
{
    protected $batchModel;

    public function __construct()
    {
        $this->batchModel = new BatchModel();
    }

    // ================= LIST =================
    public function index()
    {
        $data['batches'] = $this->batchModel->getAllBatches();

        return view('ManageBatches/batches', $data);
    }

    // ================= ADD PAGE =================
    public function add()
    {
        $data['programs'] = (new ProgramModel())->findAll();
        $data['centers']  = (new CenterModel())->findAll();

        return view('ManageBatches/add_batch', $data);
    }

    // ================= STORE =================
    public function store()
    {
        $data = $this->request->getPost();

        // IMPORTANT FIX: ensure system fields exist
        $data['Rec_Added_On'] = date('Y-m-d');
        $data['Rec_Updated_By'] = $data['Rec_Added_By'] ?? 'admin';
        $data['Rec_Last_Updated_On'] = date('Y-m-d');

        // If Batch_Id not provided, generate one (VERY IMPORTANT because no auto increment)
        if (empty($data['Batch_Id'])) {
            $data['Batch_Id'] = 'BATCH' . time();
        }

        $this->batchModel->insert($data);

        return redirect()->to(site_url('batches'))
            ->with('success', 'Batch added successfully');
    }

    // ================= EDIT PAGE =================
    public function edit($id)
    {
        $data['batch'] = $this->batchModel->find($id);

        if (!$data['batch']) {
            return redirect()->to(site_url('batches'))
                ->with('error', 'Batch not found');
        }

        $data['programs'] = (new ProgramModel())->findAll();
        $data['centers']  = (new CenterModel())->findAll();

        return view('ManageBatches/edit_batch', $data);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $data = $this->request->getPost();

        $data['Rec_Updated_By'] = $data['Rec_Updated_By'] ?? 'admin';
        $data['Rec_Last_Updated_On'] = date('Y-m-d');

        $this->batchModel->update($id, $data);

        return redirect()->to(site_url('batches'))
            ->with('success', 'Batch updated successfully');
    }

    // ================= VIEW =================
    public function view($id)
    {
        $data['batch'] = $this->batchModel->find($id);

        if (!$data['batch']) {
            return redirect()->to(site_url('batches'))
                ->with('error', 'Batch not found');
        }

        return view('ManageBatches/view_batch', $data);
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->batchModel->delete($id);

        return redirect()->to(site_url('batches'))
            ->with('success', 'Batch deleted successfully');
    }
}
