<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_M extends CI_Model {

    protected $table = 'products';
    
    public function get($id = null){
        $this->db->select('a.*, b.namakategori, c.namaunit');
        $this->db->from('products a');
        $this->db->join('kategori b', 'a.idkategori = b.idkategori');
        $this->db->join('units c', 'a.idunit = c.idunit');
        if($id != null){
            $this->db->where('a.idproduk', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getByKategori($id = null){
        $this->db->select('a.*, b.namakategori, c.namaunit');
        $this->db->from('products a');
        $this->db->join('kategori b', 'a.idkategori = b.idkategori');
        $this->db->join('units c', 'a.idunit = c.idunit');
        if($id != null){
            $this->db->where('a.idkategori', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function namaproduk_check($namaproduk, $id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('namaproduk', $namaproduk);
        $this->db->where('is_active', 1);
        if ($id != null){
            $this->db->where('idproduk !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function nohp_check($nohp, $id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nohp', $nohp);
        $this->db->where('is_active', 1);
        if ($id != null){
            $this->db->where('idproduk !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idproduk', $id);
        $this->db->update($this->table, $data);
    }

}
