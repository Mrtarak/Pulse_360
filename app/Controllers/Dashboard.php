<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['totalPrograms'] = $this->db
            ->table('program_m')
            ->countAllResults();

        $data['totalCenters'] = $this->db
            ->table('center_m')
            ->countAllResults();

        $data['totalBatches'] = $this->db
            ->table('batch_m')
            ->countAllResults();

        $data['totalVijetaas'] = $this->db
            ->table('vijetaas_stu')
            ->countAllResults();

        return view('dashboard', $data);
    }
}
