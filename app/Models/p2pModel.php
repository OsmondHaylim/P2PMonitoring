<?php
namespace App\Models;
use CodeIgniter\Model;

class p2pModel extends Model{
    protected $table = 'update_p2p';
    protected $primaryKey = 'id';

    protected $allowedFields = ['no_rek', 'tanggal_update', 'keterangan'];
}