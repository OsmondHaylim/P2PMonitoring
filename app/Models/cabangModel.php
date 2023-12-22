<?php
namespace App\Models;
use CodeIgniter\Model;

class cabangModel extends Model{
    protected $table = 'cabang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'kd_cabang', 'cabang', 'kd_uker', 'uker'];

}