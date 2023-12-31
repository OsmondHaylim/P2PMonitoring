<?php
namespace App\Models;
use CodeIgniter\Model;

class monthlyModel extends Model{
    protected $table = 'monthly';
    protected $primaryKey = 'id';

    protected $allowedFields = ['periode', 'cabang', 'mata_uang', 'marketing', 
    'tipe_pinjaman', 'no_rek', 'debitur', 'pinjaman', 'tanggal_bayar', 'tanggal_bunga_bayar', 
    'suku_bunga', 'tanggal_menunggak', 'tanggal_realisasi', 'tanggal_jatuh_tempo', 'jangka_waktu', 
    'flag', 'cif', 'os1', 'os2', 'os3', 'os4', 'os5', 'tunggakan_pokok', 'tunggakan_bunga', 'tunggakan_pinalti', 
    'personal_number', 'nama_pn', 'kode', 'deskripsi', 'kol', 'rata_os', 'kecamatan', 'kelurahan', 
    'kode_pos', 'kecamatan_usaha', 'kelurahan_usaha', 'kode_pos_usaha'];

    public function getRm($rm){
        return $this->builder()->where('nama_pn', $rm)->get()->getResult();
    }

    public function getAllRm(){
        return $this->builder()->get()->getResult();
    }
    public function insert_batch($data){
        $query = $this->db->table('monthly');
        $query->insertBatch($data);
        }
}