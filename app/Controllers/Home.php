<?php

namespace App\Controllers;

use App\Models\centralizedModel;
use App\Models\updatedModel;
use App\Models\monthlyModel;
use App\Models\cabangModel;
use App\Models\kcModel;
use CodeIgniter\Controller;
use App\Models\p2pModel;

use function PHPUnit\Framework\isNull;

class Home extends BaseController
{
    public function index2($page = 1, $limit = 10):string{
        $model = new updatedModel();
        $offset = ((int)$page - 1) * $limit;
        $uko = $model->limit($limit, $offset)->home();
        $data['uko'] = array_slice($uko, $offset, $limit);

        $data['limit'] = $limit;
        $data['date'] = date('d F Y', strtotime($model->getLatestDate()->periode));

        $data['current_page'] = $page;
        $data['total_rows'] = count($uko);
        $data['total_pages'] = ceil($data['total_rows'] / $limit);
        return view('uko', $data);
    }
    public function index3($page = 1, $limit = 10):string{
        $model = new updatedModel();
        $offset = ((int)$page - 1) * $limit;
        $uko = $model->limit($limit, $offset)->home3();
        $data['uko'] = array_slice($uko, $offset, $limit);

        $data['limit'] = $limit;
        $data['date'] = date('d F Y', strtotime($model->getLatestDate()->periode));

        $data['current_page'] = $page;
        $data['total_rows'] = count($uko);
        $data['total_pages'] = ceil($data['total_rows'] / $limit);
        return view('uko', $data);
    }

    public function kc2($fk, $page = 1, $limit = 10):string{
        $model = new updatedModel();
        $offset = ((int)$page - 1) * $limit;
        $kc = $model->limit($limit, $offset)->kc3($fk);
        $data['kc'] = array_slice($kc, $offset, $limit);

        $data['limit'] = $limit;
        $data['fk'] = $fk;
        $data['current_page'] = $page;
        $data['total_rows'] = count($kc);
        $data['total_pages'] = ceil($data['total_rows'] / $limit);
        return view('kc', $data);
    }

    public function rm2($rm, $page = 1, $limit = 10):string{
        $model = new updatedModel();
        $model1 = new updatedModel();
        $offset = ((int)$page - 1) * $limit;
        
        $data['current_page'] = $page;

        $result = $model1->rm3($rm);
        $data['rm'] = array_slice($result, $offset, $limit);
        $result2 = $model->rmData($rm);
        $data['total_rows'] = count($result);
        $data['date'] = date('d F Y', strtotime($model->getLatestDate()->periode));

        $data['total_pages'] = ceil($data['total_rows'] / $limit);
        $data['rmData'] = $result2;
        if($result2['count_pinjaman'] == 0 || $result2['total_os'] == 0){
            $data['float_done'] = 0;
            $data['os_float_done'] = 0;
        }else{
            $data['float_done'] = $result2['count_done'] * 100/($result2['count_pinjaman']);
            $data['os_float_done'] = $result2['os_done'] * 100/($result2['total_os']);
        }
        
        $data['total_not_done'] = $result2['count_pinjaman'] - $result2['count_done'];
        $data['os_not_done'] = $result2['total_os'] - $result2['os_done'];
        $data['nama_pn'] = $rm;
        $data['limit'] = $limit;
        return view('rm', $data);
    }

    public function admin():string{
        return view('admin');
    }

    public function addByCSV(){
        $file = $this->request->getFile('csv_file');

        if ($file->isValid() && $file->getExtension() === 'csv') {
            $contents = file_get_contents($file->getTempName());
            $model = new centralizedModel(); 
            $this->CsvToDatabase($contents, $model);
            return redirect()->to('/rm/all');
        } else {
            return redirect()->to('/kc/100');
        }
    }
    public function updatedCSV(){
        $file = $this->request->getFile('csv_file_updated');
        if($file != null){
            if ($file->isValid() && $file->getExtension() === 'csv') {
                $contents = file_get_contents($file->getTempName());
                $db = \Config\Database::connect();
                $db->table('daily')->truncate();
                $model = new updatedModel(); 
                $this->CsvToDatabase($contents, $model);
                return redirect()->to('/');
            } else {
                return redirect()->to('/');
            }
        }else {
            return redirect()->to('/');
        }
        
    }
    public function monthlyCSV(){
        $file = $this->request->getFile('csv_file_monthly');

        if ($file->isValid() && $file->getExtension() === 'csv') {
            $contents = file_get_contents($file->getTempName());
            $db = \Config\Database::connect();
            $db->table('monthly')->truncate();
            $model = new monthlyModel(); 
            $this->CsvToDatabase($contents, $model);
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }
    public function cabangCSV(){
        $file = $this->request->getFile('csv_file_cabang');

        if ($file->isValid() && $file->getExtension() === 'csv') {
            $contents = file_get_contents($file->getTempName());
            $db = \Config\Database::connect();
            $db->table('cabang')->truncate();
            $model = new cabangModel(); 
            $lines = explode(PHP_EOL, $contents);
            if(count($lines)){
                array_shift($lines);
                foreach ($lines as $line) {
                    $data = explode(';', $line);
                    if (isset($data[1])&& !empty($data[1])) {
                        $record = [
                            'id' => $data[0],
                            'kd_cabang' => $data[1],
                            'cabang' => $data[2],
                            'kd_uker' => $data[3],
                            'uker' => $data[4],
                        ];
                        $model->insert($record);
                    }
                }
            }
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }
    public function addP2p($rm){
        $norek = $this->request->getPost('no_rek');
        $keterangan = $this->request->getPost('keterangan');
        $model = new p2pModel(); 
        date_default_timezone_set("Asia/Bangkok");
        
        $data = [
            'no_rek' => $norek,
            'tanggal_update' => date("Y-m-d h:i:sa"),
            'keterangan' => $keterangan,
        ];
        $model->protect(false)->replace($data);
        
        return redirect()->to("/rm/$rm");
    }
    
    public function CsvToDatabase($contents, $model){
        $lines = explode(PHP_EOL, $contents);
        if(count($lines)){
            foreach ($lines as $line) {
                $data = explode(';', $line);
                if (isset($data[1])&& !empty($data[1])) {
                    $record = [
                        'periode' => $data[0],
                        'cabang' => $data[1],
                        'mata_uang' => $data[2],
                        'marketing' => $data[3],
                        'tipe_pinjaman' => $data[4],
                        'no_rek' => $data[5],
                        'debitur' => $data[6],
                        'pinjaman' => $data[7],
                        'tanggal_bayar' => $this->StandardizeDate($data[8]),
                        'tanggal_bunga_bayar' => $this->StandardizeDate($data[9]),
                        'suku_bunga' => $data[10],
                        'tanggal_menunggak' => $this->StandardizeDate($data[11]),
                        'tanggal_realisasi' => $this->StandardizeDate($data[12]),
                        'tanggal_jatuh_tempo' => $this->StandardizeDate($data[13]),
                        'jangka_waktu' => $data[14],
                        'flag' => $data[15],
                        'cif' => $data[16],
                        'os1' => $data[17],
                        'os2' => $data[18],
                        'os3' => $data[19],
                        'os4' => $data[20],
                        'os5' => $data[21],
                        'tunggakan_pokok' => $data[22],
                        'tunggakan_bunga' => $data[23],
                        'tunggakan_pinalti' => $data[24],
                        'personal_number' => $data[25],
                        'nama_pn' => $data[26],
                        'kode' => $data[27],
                        'deskripsi' => $data[28],
                        'kol' => $data[29],
                        'rata_os' => $data[30],
                        'kecamatan' => $data[31],
                        'kelurahan' => $data[32],
                        'kode_pos' => $data[33],
                        'kecamatan_usaha' => $data[34],
                        'kelurahan_usaha' => $data[35],
                        'kode_pos_usaha' => $data[36],
                    ];
                    $model->insert($record);
                }
            }
        }
    }

    public function add(){
        $validation =  \Config\Services::validation();
        $validation->setRules(['nama_pn' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if($isDataValid){
            $model = new centralizedModel();
            $rm = $this->request->getPost('nama_pn');
            $model->insert([
                "periode" => $this->request->getPost('periode'),
                "cabang" => $this->request->getPost('cabang'),
                "mata_uang" => $this->request->getPost('mata_uang'),
                "marketing" => $this->request->getPost('marketing'),
                "tipe_pinjaman" => $this->request->getPost('tipe_pinjaman'),
                "no_rek" => $this->request->getPost('no_rek'),
                "debitur" => $this->request->getPost('debitur'),
                "pinjaman" => $this->request->getPost('pinjaman'),
                "tanggal_bayar" => $this->request->getPost('tanggal_bayar'),
                "tanggal_bunga_bayar" => $this->request->getPost('tanggal_bunga_bayar'),
                "suku_bunga" => $this->request->getPost('suku_bunga'),
                "tanggal_menunggak" => $this->request->getPost('tanggal_menunggak'),
                "tanggal_realisasi" => $this->request->getPost('tanggal_realisasi'),
                "tanggal_jatuh_tempo" => $this->request->getPost('tanggal_jatuh_tempo'),
                "jangka_waktu" => $this->request->getPost('jangka_waktu'),
                "flag" => $this->request->getPost('flag'),
                "cif" => $this->request->getPost('cif'),
                "1" => $this->request->getPost('1'),
                "2" => $this->request->getPost('2'),
                "3" => $this->request->getPost('3'),
                "4" => $this->request->getPost('4'),
                "5" => $this->request->getPost('5'),
                "tunggakan_pokok" => $this->request->getPost('tunggakan_pokok'),
                "tunggakan_bunga" => $this->request->getPost('tunggakan_bunga'),
                "tunggakan_pinalti" => $this->request->getPost('tunggakan_pinalti'),
                "personal_number" => $this->request->getPost('personal_number'),
                "nama_pn" => $this->request->getPost('nama_pn'),
                "kode" => $this->request->getPost('kode'),
                "deskripsi" => $this->request->getPost('deskripsi'),
                "kol" => $this->request->getPost('kol'),
                "rata_os" => $this->request->getPost('rata_os'),
                "kecamatan" => $this->request->getPost('kecamatan'),
                "kelurahan" => $this->request->getPost('kelurahan'),
                "kode_pos" => $this->request->getPost('kode_pos'),
                "kecamatan_usaha" => $this->request->getPost('kecamatan_usaha'),
                "kelurahan_usaha" => $this->request->getPost('kelurahan_usaha'),
                "kode_pos_usaha" => $this->request->getPost('kode_pos_usaha'),
            ]);

            $redirectURL = site_url("controller/method/$rm");
            return redirect()->to($redirectURL);
        }

    }

    public function delete($id){
        $model = new centralizedModel();
        $model->delete($id);
        return redirect('/rm/all');
    }

    public function edit($id){
        $model = new centralizedModel();
        $rm = $this->request->getPost('nama_pn');
        $model->update([$id,
            "periode" => $this->request->getPost('periode'),
            "cabang" => $this->request->getPost('cabang'),
            "mata_uang" => $this->request->getPost('mata_uang'),
            "marketing" => $this->request->getPost('marketing'),
            "tipe_pinjaman" => $this->request->getPost('tipe_pinjaman'),
            "no_rek" => $this->request->getPost('no_rek'),
            "debitur" => $this->request->getPost('debitur'),
            "pinjaman" => $this->request->getPost('pinjaman'),
            "tanggal_bayar" => $this->request->getPost('tanggal_bayar'),
            "tanggal_bunga_bayar" => $this->request->getPost('tanggal_bunga_bayar'),
            "suku_bunga" => $this->request->getPost('suku_bunga'),
            "tanggal_menunggak" => $this->request->getPost('tanggal_menunggak'),
            "tanggal_realisasi" => $this->request->getPost('tanggal_realisasi'),
            "tanggal_jatuh_tempo" => $this->request->getPost('tanggal_jatuh_tempo'),
            "jangka_waktu" => $this->request->getPost('jangka_waktu'),
            "flag" => $this->request->getPost('flag'),
            "cif" => $this->request->getPost('cif'),
            "1" => $this->request->getPost('1'),
            "2" => $this->request->getPost('2'),
            "3" => $this->request->getPost('3'),
            "4" => $this->request->getPost('4'),
            "5" => $this->request->getPost('5'),
            "tunggakan_pokok" => $this->request->getPost('tunggakan_pokok'),
            "tunggakan_bunga" => $this->request->getPost('tunggakan_bunga'),
            "tunggakan_pinalti" => $this->request->getPost('tunggakan_pinalti'),
            "personal_number" => $this->request->getPost('personal_number'),
            "nama_pn" => $this->request->getPost('nama_pn'),
            "kode" => $this->request->getPost('kode'),
            "deskripsi" => $this->request->getPost('deskripsi'),
            "kol" => $this->request->getPost('kol'),
            "rata_os" => $this->request->getPost('rata_os'),
            "kecamatan" => $this->request->getPost('kecamatan'),
            "kelurahan" => $this->request->getPost('kelurahan'),
            "kode_pos" => $this->request->getPost('kode_pos'),
            "kecamatan_usaha" => $this->request->getPost('kecamatan_usaha'),
            "kelurahan_usaha" => $this->request->getPost('kelurahan_usaha'),
            "kode_pos_usaha" => $this->request->getPost('kode_pos_usaha'),
        ]);
        $redirectURL = site_url("controller/method/$rm");
        return redirect()->to($redirectURL);
        
    }

    function StandardizeDate($inputDate) {
        $date = \DateTime::createFromFormat('d/m/Y', $inputDate);
        if ($date !== false) {
            return $date->format('Y-m-d');
        } else {
            return $inputDate;
        }
    }
}
