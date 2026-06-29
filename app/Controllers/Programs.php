<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProgramModel;
use App\Models\ProgramThemeModel;

class Programs extends BaseController
{
    protected $programModel;

    public function __construct()
    {
        $this->programModel = new ProgramModel();
    }

    public function view($id)
{
    $program = $this->programModel
        ->select('PROGRAM_M.*, PROGRAM_THEME_M.Program_Theme_Name')
        ->join('PROGRAM_THEME_M', 'PROGRAM_THEME_M.Program_Theme_Id = PROGRAM_M.Program_Theme_Id', 'left')
        ->where('PROGRAM_M.Program_Id', $id)
        ->first();
    
    if (!$program) {
        return redirect()->to('/programs')->with('error', 'Program not found');
    }

    return view('ManagePrograms/view_program', ['program' => $program]);
}

    public function index()
    {
    $programName = $this->request->getGet('program_filter');

    $query = $this->programModel
        ->select('PROGRAM_M.*, PROGRAM_THEME_M.Program_Theme_Name')
        ->join('PROGRAM_THEME_M', 'PROGRAM_THEME_M.Program_Theme_Id = PROGRAM_M.Program_Theme_Id', 'left');

    if ($programName) {
        $query->like('Program_Name', $programName);
    }

    $data['programs'] = $query->findAll();

    return view('ManagePrograms/programs', $data);
    }

    public function add()
    {
        $themeModel = new ProgramThemeModel();
    $themes = $themeModel->findAll();
        return view('ManagePrograms/add_programs', ['themes' => $themes]);
    }

    public function store()
    {
        helper(['form']);

    $model = new ProgramModel();

        $data = [
            'Program_Id' => 'PROG_' . uniqid(),
            'Program_Name' => $this->request->getPost('Program_Name'),
            'Program_About' => $this->request->getPost('Program_About'),
            'Program_Start_Date' => $this->request->getPost('Program_Start_Date'),
            'Program_End_Date' => $this->request->getPost('Program_End_Date'),
            'Program_Theme_Id' => $this->request->getPost('Program_Theme_Id'),
            'Applicable_For' => $this->request->getPost('Applicable_For'),
            'Program_Status' => $this->request->getPost('Program_Status'),
            'Rec_Added_By'       => 'admin',  
            'Rec_Added_On'       => date('Y-m-d')
        ];

        if (!$model->insert($data)) {
        log_message('error', 'Program insert failed: ' . json_encode($model->errors()));
        return redirect()->back()->withInput()->with('error', 'Insert failed. Please check logs.');
    }
    return redirect()->to(site_url('/programs'))->with('success', 'Program added successfully');
}

    public function edit($id)
{
    $programModel = new ProgramModel();
    $program = $programModel->find($id); 

    if (!$program) {
        return redirect()->to('/programs')->with('error', 'Program not found.');
    }

    $themeModel = new ProgramThemeModel();
    $themes = $themeModel->findAll();
    return view('ManagePrograms/edit_programs', [
        'program' => $program,
        'themes' => $themes
    ]);
}


    public function update($id)
    {
        log_message('debug', 'Inside update function for ID: ' . $id);

        helper(['form']);

    $model = new ProgramModel();

        $data = [
            'Program_Name' => $this->request->getPost('Program_Name'),
            'Program_About' => $this->request->getPost('Program_About'),
            'Program_Start_Date' => $this->request->getPost('Program_Start_Date'),
            'Program_End_Date' => $this->request->getPost('Program_End_Date'),
            'Program_Theme_Id' => $this->request->getPost('Program_Theme_Id'),
            'Applicable_For' => $this->request->getPost('Applicable_For'),
            'Program_Status' => $this->request->getPost('Program_Status'),
            'Rec_Updated_By'     => 'admin',
            'Rec_Last_Updated_On'=> date('Y-m-d')
        ];

        if (!$model->update($id, $data)) {
        log_message('error', 'Update failed: ' . json_encode($model->errors()));
        return redirect()->back()->withInput()->with('error', 'Update failed.');
    }
        return redirect()->to('/programs')->with('success', 'Program updated successfully!');

}

    public function delete($id)
    {
        if (!$this->programModel->find($id)) {
            return redirect()->to('/programs')->with('error', 'Program not found');
        }
        $this->programModel->delete($id);
        return redirect()->to('/programs')->with('success', 'Program deleted successfully');
    }



}