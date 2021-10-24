<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyitaan_M extends CI_Model {

    protected $table = 'penyitaan';
    
    public function get($id = null){
        $this->db->select('a.*, b.nama as namatersangka, c.nama as namainstansi,
                (CASE
                    WHEN jenispenyitaan = 1 THEN "Penetapan Izin Sita"
                    ELSE "Penetapan Persetujuan Sita"
                END) as jenispenyitaantext');
        $this->db->from('penyitaan a');
        $this->db->join('tersangka b', 'a.idtersangka = b.id', 'left');
        $this->db->join('instansi c', 'a.idinstansi = c.id', 'left');
        if($id != null){
            $this->db->where('a.id', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getNomorPenetapanTerakhir($param){
        $this->db->select('max(counter) as nomorterakhir');
        $this->db->from('penyitaan');
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
