<?php

namespace App\Controllers;

use App\Models\GoalTypeModel;
use App\Models\GoalModel;
use CodeIgniter\Controller;

class GoalType extends BaseController
{
    public function GoalTypes()
    {
        $model = new GoalTypeModel();
        $data['types'] = $model->findAll();
        return view('ManageGoalType/goal_types', $data);
    }

    public function addGoalType()
    {
        return view('ManageGoalType/add_goal_type');
    }

    public function saveGoalType()
    {
        $db = \Config\Database::connect();

        // Generate new Goal Type ID
        $last = $db->table('goaltype_m')
            ->select('Goal_Type_Id')
            ->orderBy('Goal_Type_Id', 'DESC')
            ->get()
            ->getFirstRow('array');

        if ($last) {
            $num = (int) preg_replace('/[^0-9]/', '', $last['Goal_Type_Id']);
            $newId = 'GT' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'GT001';
        }

        $data = [
            'Goal_Type_Id'          => $newId,
            'Goal_Type_Name'        => $this->request->getPost('Goal_Type_Name'),
            'Goal_Type_Description' => $this->request->getPost('Goal_Type_Description'),
            'Rec_Added_By'          => 'ADMIN',
            'Rec_Added_On'          => date('Y-m-d')
        ];

        $db->table('goaltype_m')->insert($data);

        return redirect()->to(site_url('goals/types'))
            ->with('success', 'Goal Type Added Successfully');
    }

    public function editGoalType($id)
    {
        $model = new GoalTypeModel();
        $data['type'] = $model->find($id);
        return view('ManageGoalType/edit_goal_type', $data);
    }

    public function updateGoalType($id)
    {
        $model = new GoalTypeModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('goals/types')->with('success', 'Goal Type updated');
    }

    public function view($id)
    {
        $model = new \App\Models\GoalTypeModel();
        $data['goalType'] = $model->find($id);

        if (!$data['goalType']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Goal Type not found.");
        }

        return view('ManageGoalType/view_goal_type', $data);
    }


    public function deleteGoalType($id)
    {
        $model = new GoalTypeModel();
        $model->delete($id);
        return redirect()->to('goals/types')->with('success', 'Goal Type deleted');
    }
}
