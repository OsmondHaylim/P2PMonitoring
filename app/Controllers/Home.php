<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\p2pModel;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new p2pModel();
        $uko = $model->getAllUko();
        $data['uko'] = $uko;

        return view('uko', $data);
    }
}
