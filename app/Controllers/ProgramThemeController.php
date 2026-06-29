<?php

namespace App\Controllers;

use App\Models\ProgramThemeModel;

class ProgramThemeController extends BaseController
{
    public function index()
    {
        $model = new ProgramThemeModel();

        $data['themes'] = $model->findAll();

        return view('ManageProgramtheme/program_theme', $data);
    }

    public function add()
    {
        return view('ManageProgramtheme/add_program_theme');
    }

    public function store()
    {
        $model = new ProgramThemeModel();

        $data = [
            'Program_Theme_Id'    => uniqid('theme_'),
            'Program_Theme_Name'  => $this->request->getPost('Program_Theme_Name'),
            'Theme_Description'   => $this->request->getPost('Theme_Description'),
            'Theme_Status'        => $this->request->getPost('Theme_Status'),
            'Theme_Suggested_By'  => $this->request->getPost('Theme_Suggested_By'),
            'Theme_Added_On'      => $this->request->getPost('Theme_Added_On') ?: date('Y-m-d'),
            'Rec_Added_By'        => session()->get('user_id') ?? 'admin',
            'Rec_Added_On'        => date('Y-m-d')
        ];

        $model->insert($data);

        return redirect()->to('/program_theme')
            ->with('success', 'Program Theme added successfully.');
    }

    public function view($id)
    {
        $model = new ProgramThemeModel();

        $data['theme'] = $model->find($id);

        if (!$data['theme']) {
            return redirect()->to('/program_theme')
                ->with('error', 'Program Theme not found.');
        }

        return view('ManageProgramtheme/view_program_theme', $data);
    }

    public function edit($id)
    {
        $model = new ProgramThemeModel();

        $data['theme'] = $model->find($id);

        if (!$data['theme']) {
            return redirect()->to('/program_theme')
                ->with('error', 'Program Theme not found.');
        }

        return view('ManageProgramtheme/edit_program_theme', $data);
    }

    public function update($id)
    {
        $model = new ProgramThemeModel();

        $data = [
            'Program_Theme_Name'      => $this->request->getPost('Program_Theme_Name'),
            'Theme_Description'       => $this->request->getPost('Theme_Description'),
            'Theme_Status'            => $this->request->getPost('Theme_Status'),
            'Theme_Suggested_By'      => $this->request->getPost('Theme_Suggested_By'),
            'Rec_Updated_By'          => session()->get('user_id') ?? 'admin',
            'Rec_Last_Updated_On'     => date('Y-m-d')
        ];

        $model->update($id, $data);

        return redirect()->to('/program_theme')
            ->with('success', 'Program Theme updated successfully.');
    }

    public function delete($id)
    {
        $model = new ProgramThemeModel();

        $theme = $model->find($id);

        if (!$theme) {
            return redirect()->to('/program_theme')
                ->with('error', 'Program Theme not found.');
        }

        $model->delete($id);

        return redirect()->to('/program_theme')
            ->with('success', 'Program Theme deleted successfully.');
    }
}
