<?php

namespace App\Controllers\ManageStudents;

use App\Controllers\BaseController;

use App\Models\DoosraMaukaModel;
use App\Models\StudentModel;
use App\Models\CenterModel;
use App\Models\BatchModel;
use Config\CorePrograms;

class DoosraMauka extends BaseController
{
    protected $dmModel;
    protected $studentModel;

    public function __construct()
    {
        $this->dmModel = new DoosraMaukaModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $data['students'] = $this->dmModel->getAllStudents();

        return view(
            'ManageStudents/DoosraMauka/doosra_mauka',
            $data
        );
    }

    public function add()
{
    $centerModel = new CenterModel();
    $batchModel  = new BatchModel();

    $data['batches'] = $batchModel
        ->where('Program_Id', CorePrograms::DOOSRA_MAUKA)
        ->where('Batch_Status', 'Active')
        ->findAll();

    $centerIds = $batchModel
        ->select('Center_Id')
        ->where('Program_Id', CorePrograms::DOOSRA_MAUKA)
        ->findAll();

    $centerIds = array_unique(
        array_column($centerIds, 'Center_Id')
    );

    $data['centers'] = $centerModel
        ->whereIn('Center_Id', $centerIds)
        ->where('Center_Status', 'Active')
        ->findAll();

    return view(
        'ManageStudents/DoosraMauka/add_doosra_mauka',
        $data
    );
}
}
