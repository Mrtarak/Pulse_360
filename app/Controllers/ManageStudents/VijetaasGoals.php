<?php
namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;
use App\Models\StudentGoalsModel;

class VijetaasGoals extends BaseController
{
    public function index()
    {
        $model = new StudentGoalsModel();
        $programId = 'PROG_685153f441971';
        $data['goals'] = $model->getGoalsByProgram($programId);

        return view('ManageStudents/vijetaas/goals_list', $data);
    }

     public function addGoal()
    {
        return view('ManageStudents/vijetaas/add_goal');
    }

    public function storeGoal()
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->insert($this->request->getPost());
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal added successfully');
    }

    public function viewGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $data['goal'] = $goalModel->find($id);
        return view('ManageStudents/vijetaas/view_goal', $data);
    }

    public function editGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $data['goal'] = $goalModel->find($id);
        return view('ManageStudents/vijetaas/edit_goal', $data);
    }

    public function updateGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->update($id, $this->request->getPost());
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal updated successfully');
    }

    public function deleteGoal($id)
    {
        $goalModel = new StudentGoalsModel();
        $goalModel->delete($id);
        return redirect()->to('students/vijetaas/goals')->with('success', 'Goal deleted successfully');
    }
}