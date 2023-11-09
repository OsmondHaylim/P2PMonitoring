<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\p2pModel;

class Home extends BaseController
{
    public function index($page = 1): string
    {
        $model = new p2pModel();
        
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['current_page'] = $page;
        $data['total_rows'] = $model->countAll();
        $data['total_pages'] = ceil($data['total_rows'] / $limit);

        $uko = $model->limit($limit, $offset)->getAllUko();
        $data['uko'] = $uko;

        return view('uko', $data);
    }

    public function kc($id = 1, $page = 2): string
    {
        $model = new p2pModel();
        
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['current_page'] = $page;
        $data['total_rows'] = $model->countAll();
        $data['total_pages'] = ceil($data['total_rows'] / $limit);

        $uko = $model->limit($limit, $offset)->getAllUko();
        $data['uko'] = $uko;

        return view('uko', $data);
    }
}
