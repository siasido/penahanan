<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_M extends CI_Model {

    protected $table = 'kategori';
    
    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('idkategori', $id);
        }
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function namakategori_check($namakategori, $id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('namakategori', $namakategori);
        $this->db->where('is_active', 1);
        if($id !=null){
            $this->db->where('idkategori !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idkategori', $id);
        $this->db->update($this->table, $data);
    }

}
