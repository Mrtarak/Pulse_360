<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\ProgramModel;

class Center extends BaseController
{
    protected $centerModel;

    public function __construct()
    {
        $this->centerModel = new CenterModel();
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $data['center'] = $this->centerModel->find($id);

        if (!$data['center']) {
            return redirect()->to('/center')->with('error', 'Center not found');
        }

        // Get Programs assigned to this Center
        $data['programs'] = $db->table('program_center_rel pcr')
            ->select('pm.Program_Name')
            ->join('program_m pm', 'pm.Program_Id = pcr.Program_Id')
            ->where('pcr.Center_Id', $id)
            ->get()
            ->getResultArray();

        return view('ManageCenter/view_center', $data);
    }

    public function index()
    {
        $centerName = $this->request->getGet('center_filter');

        if ($centerName) {
            $data['center'] = $this->centerModel
                ->like('Center_Name', $centerName)
                ->findAll();
        } else {
            $data['center'] = $this->centerModel->findAll();
        }

        return view('ManageCenter/center', $data);
    }

    public function add()
    {
        $programModel = new ProgramModel();

        $data['programs'] = $programModel->findAll();

        return view('ManageCenter/add_Center', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        // 🔥 AUTO GENERATE Center_Id
        $last = $db->table('center_m')
            ->select('Center_Id')
            ->orderBy('Center_Id', 'DESC')
            ->get()
            ->getRow();

        if ($last) {
            $num = (int)substr($last->Center_Id, 3) + 1;
            $newId = 'CEN' . str_pad($num, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'CEN001';
        }

        $data = [
            'Center_Id' => $newId,
            'Center_Name' => $this->request->getPost('Center_Name'),
            'Center_Status' => $this->request->getPost('Center_Status'),
            'Center_Description' => $this->request->getPost('Center_Description'),
            'Center_Inaugurated_By' => $this->request->getPost('Center_Inaugurated_By'),
            'Center_Opening_Date' => $this->request->getPost('Center_Opening_Date'),
            'Center_Address' => $this->request->getPost('Center_Address'),
            'Center_City' => $this->request->getPost('Center_City'),
            'Center_State' => $this->request->getPost('Center_State'),
            'Center_Pincode' => $this->request->getPost('Center_Pincode'),
            'Center_Capacity' => $this->request->getPost('Center_Capacity'),

            // 🔥 SAFE DEFAULT VALUES
            'Rec_Added_By' => 'USER_6a29461b2852a',
            'Rec_Added_On' => date('Y-m-d'),
            'Rec_Updated_By' => 'USER_6a29461b2852a',
            'Rec_Last_Updated_On' => date('Y-m-d')
        ];

        // ✅ Save Center
        $db->table('center_m')->insert($data);
        // Get selected programs
        $programIds = $this->request->getPost('Program_Id');

        if (!empty($programIds)) {

            // Get last relation id
            $lastRel = $db->table('program_center_rel')
                ->select('PC_Rel_Id')
                ->orderBy('PC_Rel_Id', 'DESC')
                ->get()
                ->getRow();

            if ($lastRel) {
                $num = (int) substr($lastRel->PC_Rel_Id, 3) + 1;
            } else {
                $num = 1;
            }

            foreach ($programIds as $programId) {

                $pcRelId = 'PCR' . str_pad($num, 3, '0', STR_PAD_LEFT);

                $db->table('program_center_rel')->insert([
                    'PC_Rel_Id'            => $pcRelId,
                    'Program_Id'           => $programId,
                    'Center_Id'            => $newId,
                    'Rec_Added_By'         => 'USER_6a29461b2852a',
                    'Rec_Added_On'         => date('Y-m-d'),
                    'Rec_Updated_By'       => 'USER_6a29461b2852a',
                    'Rec_Last_Updated_On'  => date('Y-m-d')
                ]);

                $num++;
            }
        }

        return redirect()->to('/center')->with('success', 'Center added successfully');
    }

    public function edit($id)
    {
        $data['center'] = $this->centerModel->find($id);

        if (!$data['center']) {
            return redirect()->to('/center')->with('error', 'Center not found');
        }

        return view('ManageCenter/edit_center', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['Rec_Last_Updated_On'] = date('Y-m-d');

        $this->centerModel->update($id, $data);

        return redirect()->to('/center')->with('success', 'Center updated successfully');
    }

    public function delete($id)
    {
        if (!$this->centerModel->find($id)) {
            return redirect()->to('/center')->with('error', 'Center not found');
        }

        $this->centerModel->delete($id);

        return redirect()->to('/center')->with('success', 'Center deleted successfully');
    }
}
