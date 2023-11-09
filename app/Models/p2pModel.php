<?php
namespace App\Models;
use CodeIgniter\Model;

class p2pModel extends Model{
    protected $table = 'uko';
    protected $table2 = 'kc';
    protected $primaryKey = 'KD_UKO';
    protected $primaryKey = 'KD_UKO';

    public function getUko($id = false){
        if($id === false){
            return $this->findAll();
        }else {
            return $this->getWhere(['KD_UKO' => $id]);
        }
    }

    public function getAllUko(){
        return $this->builder()->get()->getResult();
    }
}