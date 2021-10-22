<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tersangka_M extends CI_Model {

    protected $table = 'tersangka';
    
    public function get($id = null){
        $this->db->select('*, 
            (CASE
                WHEN pendidikan = 1 THEN "SD"
                WHEN pendidikan = 2 THEN "SLTP"
                WHEN pendidikan = 3 THEN "SLTA"
                WHEN pendidikan = 4 THEN "Diploma I (D1)"
                WHEN pendidikan = 5 THEN "Diploma III (D3)"
                WHEN pendidikan = 6 THEN "Diploma IV (D4)"
                WHEN pendidikan = 7 THEN "Sarjana (S1)"
                WHEN pendidikan = 8 THEN "Magister (S2)"
                WHEN pendidikan = 9 THEN "Doktoral (S3)"
                ELSE "Lain-Lain"
            END) as pendidikantext,
            (CASE
                WHEN jeniskelamin = 1 THEN "Laki-Laki"
                WHEN jeniskelamin = 2 THEN "Perempuan"
            END) as jeniskelamintext,
            (CASE
                WHEN agama = 1 THEN "Budha"
                WHEN agama = 2 THEN "Hindu"
                WHEN agama = 3 THEN "Islam"
                WHEN agama = 4 THEN "Katolik"
                WHEN agama = 5 THEN "Konghucu"
                WHEN agama = 6 THEN "Kristen Protestan"
                ELSE "Lain-Lain"
            END) as agamatext,  
            TIMESTAMPDIFF(YEAR, tgllahir, CURDATE()) AS umur');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('id', $id);
        }
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
