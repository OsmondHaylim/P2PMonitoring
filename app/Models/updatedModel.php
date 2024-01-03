<?php
namespace App\Models;
use CodeIgniter\Model;

class updatedModel extends Model{
    protected $table = 'daily';
    protected $table1 = 'daily';
    protected $table2 = 'cabang'; 
    protected $table3 = 'monthly';
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

    public function getLatestDate(){
        $result = $this->orderBy('periode', 'DESC')->first();
        if (is_array($result)) {
            $result = (object) $result;
        }
        return $result;
    }

    public function home(){
        $query = "SELECT t1.id
                FROM daily t1
                LEFT JOIN monthly t3 ON t1.no_rek = t3.no_rek 
                WHERE t1.tanggal_bayar <= t3.tanggal_bayar";

        $commonValues = $this->db->query($query)->getResult();
        $ids = [];
        
        foreach($commonValues as $row){
            $ids[] = $row->id;
        }
        
        $idb = [];
        $idc = [];
        $idt = [];
        
        $builder = $this->db->table('daily table1');
        $builder->select('table2.kd_cabang as kd_uko, table2.cabang as cabang, COUNT(*) as jlhptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osptp');
        $builder->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder->whereIn('table1.kol', [1, 2]);
        $builder->whereNotIn('table1.id', $ids);
        $builder->groupBy('table2.cabang');
        $builder->orderBy('kd_uko');

        $a = $builder->get()->getResult();

        $builder2 = $this->db->table('daily table1');
        $builder2->select('table2.kd_cabang as kd_uko, table2.cabang as cabang, COUNT(*) as jlhnonptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osnonptp');
        $builder2->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder2->whereIn('table1.kol', [3, 4, 5]);
        $builder2->groupBy('table2.cabang');
        $builder->orderBy('kd_uko');

        $b = $builder2->get()->getResult();

        $builder3 = $this->db->table('daily table1');
        $builder3->select('table2.kd_cabang as kd_uko, table2.cabang as cabang, COUNT(*) as jlhnonptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osnonptp');
        $builder3->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder3->whereIn('table1.kol', [1, 2]);
        $builder3->whereIn('table1.id', $ids);
        $builder3->groupBy('table2.cabang');
        $builder->orderBy('kd_uko');

        $c = $builder3->get()->getResult();

        $joinedResult = [];
        foreach ($a as $sumRow) {
            $idt[] = $sumRow->kd_uko;
            $joinedRow = (object)[
                'kd_uko' => $sumRow->kd_uko,
                'cabang' => $sumRow->cabang,
                'jlhptp' => $sumRow->jlhptp,
                'jlhnonptp' => 0,
                'persenptp' => 0,
                'persennonptp' => 0,
                'osptp' => $sumRow->osptp,
                'osnonptp' => 0,
            ];
            foreach ($c as $lastRow) {
                if ($sumRow->cabang == $lastRow->cabang) {
                    $idc[] = $lastRow->kd_uko;
                    $joinedRow->jlhnonptp += $lastRow->jlhnonptp;
                    $joinedRow->osnonptp += $lastRow->osnonptp;
                };
            }
            foreach ($b as $count1Row) {
                if ($count1Row->cabang == $sumRow->cabang) {
                    $idb[] = $count1Row->kd_uko;
                    $joinedRow->jlhnonptp += $count1Row->jlhnonptp;
                    $joinedRow->osnonptp += $count1Row->osnonptp;
                    break;
                }
            }
            
            $joinedRow->persenptp = $joinedRow->jlhptp*100/($joinedRow->jlhptp + $joinedRow->jlhnonptp);
            $joinedRow->persennonptp = $joinedRow->jlhnonptp*100/($joinedRow->jlhptp + $joinedRow->jlhnonptp);
            $joinedResult[] = $joinedRow;
        }
        $idd = [];
        foreach ($c as $sumRow) {
            $matched = false;
            foreach ($idc as $d) {
                if ($d == $sumRow->kd_uko) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $idt[] = $sumRow->kd_uko;
                $joinedRow = (object)[
                    'kd_uko' => $sumRow->kd_uko,
                    'cabang' => $sumRow->cabang,
                    'jlhptp' => 0,
                    'jlhnonptp' => $sumRow->jlhnonptp, 
                    'persenptp' => 0.00,
                    'persennonptp' => 100.00,
                    'osptp' => 0,
                    'osnonptp' => $sumRow->osnonptp,
                ];
                foreach ($b as $count1Row) {
                    if ($count1Row->cabang == $sumRow->cabang) {
                        $idd[] = $count1Row->kd_uko;
                        $joinedRow->jlhnonptp += $count1Row->jlhnonptp;
                        $joinedRow->osnonptp += $count1Row->osnonptp;
                        break;
                    }
                }
                $joinedResult[] = $joinedRow;
            }
        }
        foreach ($b as $sumRow) {
            $matched = false;
            foreach ($idb as $d) {
                if ($d == $sumRow->kd_uko) {
                    $matched = true;
                    break;
                }
            }
            foreach ($idd as $e) {
                if ($e == $sumRow->kd_uko) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $idt[] = $sumRow->kd_uko;
                $joinedRow = (object)[
                    'kd_uko' => $sumRow->kd_uko,
                    'cabang' => $sumRow->cabang,
                    'jlhptp' => 0,
                    'jlhnonptp' => $sumRow->jlhnonptp, 
                    'persenptp' => 0.00,
                    'persennonptp' => 100.00,
                    'osptp' => 0,
                    'osnonptp' => $sumRow->osnonptp,
                ];
                $joinedResult[] = $joinedRow;
            }
        }
        $builder4 = $this->db->table('cabang');
        $builder4->select('kd_cabang, cabang');
        $builder4->groupBy('cabang');
        $f = $builder4->get()->getResult();

        foreach($f as $sumRow){
            $matched = false;
            foreach($idt as $g){
                if ($sumRow->kd_cabang == $g){
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $joinedRow = (object)[
                    'kd_uko' => $sumRow->kd_cabang,
                    'cabang' => $sumRow->cabang,
                    'jlhptp' => 0,
                    'jlhnonptp' => 0, 
                    'persenptp' => 0.00,
                    'persennonptp' => 100.00,
                    'osptp' => 0,
                    'osnonptp' => 0,
                ];
                $joinedResult[] = $joinedRow;
            }
        }
        
        return $joinedResult;
    }

    public function home3(){
        $query = "SELECT
            c.kd_cabang AS kd_uko,
            c.cabang AS cabang,
            COUNT(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE) THEN d.id END) AS jlhptp,
            COUNT(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) <> CURRENT_DATE)) THEN d.id END) AS jlhnonptp,
            SUM(CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS osptp,
            SUM(CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) <> CURRENT_DATE)) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS osnonptp,
            COUNT(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE) THEN d.id END) / COUNT(DISTINCT d.id) * 100 AS persenptp,
            COUNT(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) <> CURRENT_DATE)) THEN d.id END) / COUNT(DISTINCT d.id) * 100 AS persennonptp
        FROM
            cabang c
            LEFT JOIN daily d ON c.kd_uker = d.cabang
            LEFT JOIN monthly m ON d.no_rek = m.no_rek
            LEFT JOIN update_p2p u ON d.no_rek = u.no_rek
        GROUP BY
            c.kd_cabang, c.cabang
        ORDER BY
            kd_uko asc;
        ";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    public function kc3($fk){
        $query = "SELECT
            d.personal_number AS pn,
            d.nama_pn AS nama_pn,
            COUNT(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) > DATE_SUB(CURDATE(), INTERVAL 1 DAY)) THEN d.id END) AS jlhptp,
            COUNT(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) < DATE_SUB(CURDATE(), INTERVAL 1 DAY))) THEN d.id END) AS jlhnonptp,
            SUM(CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) > DATE_SUB(CURDATE(), INTERVAL 1 DAY)) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS osptp,
            SUM(CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) < DATE_SUB(CURDATE(), INTERVAL 1 DAY))) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS osnonptp,
            COUNT(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) > DATE_SUB(CURDATE(), INTERVAL 1 DAY)) THEN d.id END) / COUNT(DISTINCT d.id) * 100 AS persenptp,
            COUNT(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) < DATE_SUB(CURDATE(), INTERVAL 1 DAY))) THEN d.id END) / COUNT(DISTINCT d.id) * 100 AS persennonptp
        FROM
            daily d 
            LEFT JOIN cabang c ON d.cabang = c.kd_uker
            LEFT JOIN monthly m ON d.id = m.id
            LEFT JOIN update_p2p u ON d.no_rek = u.no_rek
            
        WHERE
            c.cabang = '$fk'
        GROUP BY
            d.nama_pn
        ORDER BY
            d.personal_number asc;
        ";
        $result = $this->db->query($query)->getResult();
        return $result;
    }
    
    public function kc($fk){
        $query = "SELECT t1.id
                FROM daily t1
                LEFT JOIN monthly t3 ON t1.no_rek = t3.no_rek 
                WHERE t1.tanggal_bayar <= t3.tanggal_bayar";

        $commonValues = $this->db->query($query)->getResult();
        $ids = [];
        $idb = [];
        $idc = [];
        foreach($commonValues as $row){
            $ids[] = $row->id;
        }

        $builder = $this->db->table('daily table1');
        $builder->select('table1.personal_number as pn, table1.nama_pn as nama_pn, COUNT(*) as jlhptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osptp');
        $builder->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder->whereIn('table1.kol', [1, 2]);
        $builder->where('table2.cabang', $fk);
        $builder->whereNotIn('table1.id', $ids);
        $builder->groupBy('table1.nama_pn');

        $a = $builder->get()->getResult();

        $builder2 = $this->db->table('daily table1');
        $builder2->select('table1.personal_number as pn, table1.nama_pn as nama_pn, COUNT(*) as jlhnonptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osnonptp');
        $builder2->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder2->whereIn('table1.kol', [3, 4, 5]);
        $builder2->where('table2.cabang', $fk);
        $builder2->groupBy('table1.nama_pn');

        $b = $builder2->get()->getResult();

        $builder3 = $this->db->table('daily table1');
        $builder3->select('table1.personal_number as pn, table1.nama_pn as nama_pn, COUNT(*) as jlhnonptp, SUM(table1.os1 + table1.os2 + table1.os3 + table1.os4 + table1.os5) as osnonptp');
        $builder3->join('cabang table2', 'table1.cabang = table2.kd_uker', 'left');
        $builder3->whereIn('table1.kol', [1, 2]);
        $builder3->where('table2.cabang', $fk);
        $builder3->whereIn('table1.id', $ids);
        $builder3->groupBy('table1.nama_pn');

        $c = $builder3->get()->getResult();

        $joinedResult = [];
        foreach ($a as $sumRow) {
            $joinedRow = (object)[
                'pn' => $sumRow->pn,
                'nama_pn' => $sumRow->nama_pn,
                'jlhptp' => $sumRow->jlhptp,
                'jlhnonptp' => 0,
                'persenptp' => 0,
                'persennonptp' => 0,
                'osptp' => $sumRow->osptp,
                'osnonptp' => 0,
            ];

            foreach ($b as $count1Row) {
                if ($count1Row->nama_pn == $sumRow->nama_pn) {
                    $idb[] = $count1Row->pn;
                    $joinedRow->jlhnonptp += $count1Row->jlhnonptp;
                    $joinedRow->osnonptp += $count1Row->osnonptp;
                    break;
                }
            }
            foreach ($c as $lastRow) {
                if ($sumRow->nama_pn == $lastRow->nama_pn) {
                    $idc[] = $lastRow->pn;
                    $joinedRow->jlhnonptp += $lastRow->jlhnonptp;
                    $joinedRow->osnonptp += $lastRow->osnonptp;
                };
            }
            $joinedRow->persenptp = $joinedRow->jlhptp*100/($joinedRow->jlhptp + $joinedRow->jlhnonptp);
            $joinedRow->persennonptp = $joinedRow->jlhnonptp*100/($joinedRow->jlhptp + $joinedRow->jlhnonptp);
            $joinedResult[] = $joinedRow;
        }
        $idd = [];
        foreach ($b as $sumRow) {
            $matched = false;
            foreach ($idb as $d) {
                if ($d == $sumRow->pn) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $joinedRow = (object)[
                    'pn' => $sumRow->pn,
                    'nama_pn' => $sumRow->nama_pn,
                    'jlhptp' => 0,
                    'jlhnonptp' => $sumRow->jlhnonptp, 
                    'persenptp' => 0.00,
                    'persennonptp' => 100.00,
                    'osptp' => 0,
                    'osnonptp' => $sumRow->osnonptp,
                ];
                foreach ($c as $count1Row) {
                    if ($count1Row->cabang == $sumRow->cabang) {
                        $idd[] = $count1Row->kd_uko;
                        $joinedRow->jlhnonptp += $count1Row->jlhnonptp;
                        $joinedRow->osnonptp += $count1Row->osnonptp;
                        break;
                    }
                }
                $joinedResult[] = $joinedRow;
            }
        }
        foreach ($c as $sumRow) {
            $matched = false;
            foreach ($idc as $d) {
                if ($d == $sumRow->pn) {
                    $matched = true;
                    break;
                }
            }
            foreach ($idd as $d) {
                if ($d == $sumRow->pn) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $joinedRow = (object)[
                    'pn' => $sumRow->pn,
                    'nama_pn' => $sumRow->nama_pn,
                    'jlhptp' => 0,
                    'jlhnonptp' => $sumRow->jlhnonptp, 
                    'persenptp' => 0.00,
                    'persennonptp' => 100.00,
                    'osptp' => 0,
                    'osnonptp' => $sumRow->osnonptp,
                ];
                $joinedResult[] = $joinedRow;
            }
        }
        return $joinedResult;
    }

    public function rm3($rm){
        $query = "SELECT d.tanggal_bayar, d.no_rek, d.debitur, d.pinjaman, d.flag, d.kol, d.os1, d.os2, d.os3, d.os4, d.os5
        FROM
            daily d 
            LEFT JOIN monthly m ON d.no_rek = m.no_rek
            LEFT JOIN update_p2p u ON d.no_rek = u.no_rek
        WHERE
            d.nama_pn = '$rm' AND ((d.kol IN (1, 2) AND d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR DATE(u.tanggal_update) < DATE_SUB(CURDATE(), INTERVAL 1 DAY)))
        ";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    public function rm($rm){
        $builder3 = $this->db->table('daily t1');
        $builder3->select('t1.no_rek');
        $builder3->where("t1.tanggal_bayar <= t2.tanggal_bayar");
        $builder3->join('monthly t2', 't1.no_rek = t2.no_rek', 'left');
        $commonValues = $builder3->get()->getResult();
        // $query = "SELECT t1.no_rek
        //         FROM daily t1
        //         LEFT JOIN monthly t3 ON t1.no_rek = t3.no_rek 
        //         WHERE t1.tanggal_bayar <= t3.tanggal_bayar";

        // $commonValues = $this->db->query($query)->getResult();
        // $ids = [];
        foreach($commonValues as $row){
            $ids[] = $row->no_rek;
        }

        // $builder2 = $this->db->table('update_p2p');
        // $builder2->select('no_rek, tanggal_update');
        // $b = $builder2->get()->getResult();
        

        $builder = $this->db->table('daily');
        $builder->whereIn('kol', [1, 2]);
        $builder->where('nama_pn', $rm);
        $builder->whereIn('no_rek', $ids);

        $a = $builder->get()->getResult();
        return $a;
    }

    public function rmData($rm){
        $query = "SELECT
            c.cabang as cabang,
            SUM(d.pinjaman) as total_pinjaman,
            COUNT(*) as count_pinjaman,
            SUM(d.os1 + d.os2 + d.os3 + d.os4 + d.os5) as total_os, 
            SUM(d.os1) as total_os1, 
            COUNT(DISTINCT CASE WHEN d.os1 <> 0 THEN d.os1 ELSE 0 END) as count_os1, 
            SUM(d.os2) as total_os2, 
            COUNT(DISTINCT CASE WHEN d.os2 <> 0 THEN d.os2 ELSE 0 END) as count_os2, 
            SUM(d.os3 + d.os4 + d.os5) as total_os3, 
            COUNT(DISTINCT CASE WHEN (d.os3 + d.os4 + d.os5) <> 0 THEN (d.os3 + d.os4 + d.os5) ELSE 0 END) as count_os3,
            COUNT(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE) THEN d.id END) AS count_done,
            COUNT(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) <> CURRENT_DATE)) THEN d.id END) AS count_not_done,
            SUM(DISTINCT CASE WHEN (d.kol IN (1, 2) AND d.tanggal_bayar > m.tanggal_bayar) OR (u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS os_done,
            SUM(DISTINCT CASE WHEN (d.kol NOT IN (1, 2) OR d.tanggal_bayar <= m.tanggal_bayar) AND (u.id IS NULL OR (u.id IS NOT NULL AND DATE(u.tanggal_update) <> CURRENT_DATE)) THEN d.os1 + d.os2 + d.os3 + d.os4 + d.os5 ELSE 0 END) AS os_not_done,
            COUNT(DISTINCT CASE WHEN u.id IS NOT NULL AND DATE(u.tanggal_update) = CURRENT_DATE THEN u.id END) AS count_marked,
            COUNT(DISTINCT CASE WHEN u.id IS NOT NULL AND DATE(u.tanggal_update) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN u.id END) AS count_yesterday,
            COUNT(DISTINCT CASE WHEN u.id IS NOT NULL AND DATE(u.tanggal_update) < DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN u.id END) AS count_wrong
        FROM
            daily d 
            LEFT JOIN cabang c ON d.cabang = c.kd_uker
            LEFT JOIN monthly m ON d.id = m.id
            LEFT JOIN update_p2p u ON d.no_rek = u.no_rek
        WHERE
            d.nama_pn = '$rm'
        GROUP BY
            d.nama_pn
        ";
        $result = $this->db->query($query)->getRowArray();
        return $result;
    }

    

}