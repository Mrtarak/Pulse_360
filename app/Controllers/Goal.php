<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GoalModel;
use App\Models\GoalTypeModel;

class Goal extends BaseController
{
    protected $goalModel;
    protected $goalTypeModel;

    public function __construct()
    {
        $this->goalModel = new GoalModel();
        $this->goalTypeModel = new GoalTypeModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Goal List
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['goals'] = $this->goalModel
            ->select('goal_m.*, goaltype_m.Goal_Type_Name')
            ->join(
                'goaltype_m',
                'goaltype_m.Goal_Type_Id = goal_m.Goal_Type_Id',
                'left'
            )
            ->findAll();

        return view('ManageStudents/vijetaas/goals_list', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Add Goal Page
    |--------------------------------------------------------------------------
    */
    public function add()
    {
        $data['types'] = $this->goalTypeModel->findAll();

        return view('ManageStudents/vijetaas/add_goal', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Save Goal
    |--------------------------------------------------------------------------
    */
    public function save()
    {
        $data = [

            'Goal_Id'              => $this->request->getPost('Goal_Id'),
            'Goal_Type_Id'         => $this->request->getPost('Goal_Type_Id'),
            'Goal_Title'           => $this->request->getPost('Goal_Title'),
            'Goal_Description'     => $this->request->getPost('Goal_Description'),
            'Default_Target_Value' => $this->request->getPost('Default_Target_Value'),
            'Goal_Status'          => $this->request->getPost('Goal_Status'),

            'Rec_Added_By'         => 'Admin',
            'Rec_Added_On'         => date('Y-m-d'),

            'Rec_Updated_By'       => 'Admin',
            'Rec_Last_Updated_On'  => date('Y-m-d'),
        ];

        $this->goalModel->insert($data);

        return redirect()
            ->to(site_url('goals'))
            ->with('success', 'Goal created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | View Goal
    |--------------------------------------------------------------------------
    */
    public function view($id)
    {
        $goal = $this->goalModel
            ->select('goal_m.*, goaltype_m.Goal_Type_Name')
            ->join(
                'goaltype_m',
                'goaltype_m.Goal_Type_Id = goal_m.Goal_Type_Id',
                'left'
            )
            ->where('goal_m.Goal_Id', $id)
            ->first();

        if (!$goal) {
            return redirect()->to('goals')
                ->with('error', 'Goal not found');
        }

        $data['goal'] = $goal;

        return view('ManageStudents/vijetaas/view_goal', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Goal
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $goal = $this->goalModel->find($id);

        if (!$goal) {
            return redirect()
                ->to(site_url('goals'))
                ->with('error', 'Goal not found');
        }

        $data['goal'] = $goal;
        $data['types'] = $this->goalTypeModel->findAll();

        return view('ManageStudents/vijetaas/edit_goal', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Goal
    |--------------------------------------------------------------------------
    */
    public function update($id)
    {
        $data = [

            'Goal_Type_Id'         => $this->request->getPost('Goal_Type_Id'),
            'Goal_Title'           => $this->request->getPost('Goal_Title'),
            'Goal_Description'     => $this->request->getPost('Goal_Description'),
            'Default_Target_Value' => $this->request->getPost('Default_Target_Value'),
            'Goal_Status'          => $this->request->getPost('Goal_Status'),

            'Rec_Updated_By'       => 'Admin',
            'Rec_Last_Updated_On'  => date('Y-m-d'),
        ];

        $this->goalModel->update($id, $data);

        return redirect()
            ->to(site_url('goals'))
            ->with('success', 'Goal updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Goal
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {
        $this->goalModel->delete($id);

        return redirect()
            ->to(site_url('goals'))
            ->with('success', 'Goal deleted successfully.');
    }
}
