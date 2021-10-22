<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Penetapan_M extends CI_Model {

    protected $table = 'penetapan';
    
    public function get($id = null){
        $this->db->select('a.*, b.nama as namatersangka, c.nama as namainstansi, d.nama as instansipenahanterakhir,
                    (CASE
                    WHEN pasalrujukan = 1 THEN "Pasal 25 Ayat (2) KUHAP"
                    WHEN pasalrujukan = 2 THEN "Pasal 29 Ayat (1,2,3) KUHAP"
                    ELSE "Pasal 29 Ayat (1,2,3) KUHAP"
                END) as pasalrujukantext,
        ');
        $this->db->from('penetapan a');
        $this->db->join('tersangka b', 'a.idtersangka = b.id', 'left');
        $this->db->join('instansi c', 'a.idinstansi = c.id', 'left');
        $this->db->join('instansi d', 'a.instansipenahanterakhir = d.id', 'left');
        if($id != null){
            $this->db->where('a.id', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getNomorPenetapanTerakhir($param){
        $this->db->select('max(counter) as nomorterakhir');
        $this->db->from('penetapan');
        $this->db->where('YEAR(created_at)', $param);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

}
