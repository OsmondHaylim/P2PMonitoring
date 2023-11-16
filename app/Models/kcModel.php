<?php
namespace App\Models;
use CodeIgniter\Model;

class kcModel extends Model{
    protected $table = 'kc';
    protected $primaryKey = 'KC_ID';

    public function getKc($fk){
        // if($id === false){
        //     return $this->findAll();
        // }else {
            return $this->builder()->where('KD_UKO', $fk)->get()->getResult();
        // }
    }

    public function getAllKc(){
        return $this->builder()->get()->getResult();
    }
}