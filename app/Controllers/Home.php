<?php

namespace App\Controllers;

use App\Models\kcModel;
use CodeIgniter\Controller;
use App\Models\p2pModel;

class Home extends BaseController
{
    public function index($page = 1, $limit = 10):string
    {
        $model = new p2pModel();

        $data['current_page'] = $page;
        $data['total_rows'] = $model->countAll();
        $data['total_pages'] = ceil($data['total_rows'] / $limit);

        $offset = ((int)$page - 1) * $limit;
        $uko = $model->limit($limit, $offset)->getAllUko();
        $data['uko'] = $uko;
        $data['limit'] = $limit;

        return view('uko', $data);
    }

    public function kc($fk = 100, $page = 1, $limit = 10):string
    {
        $model = new kcModel();
        $offset = ((int)$page - 1) * $limit;

        $data['current_page'] = $page;
        $data['total_rows'] = $model->countAll();
        $data['total_pages'] = ceil($data['total_rows'] / $limit);

        $kc = $model->limit($limit, $offset)->getKc($fk);
        $kc = $model->getKc($fk);
        $data['kc'] = $kc;
        $data['fk'] = $fk;
        $data['limit'] = $limit;

        return view('kc', $data);
    }
}
