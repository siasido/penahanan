<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_M extends CI_Model {

    protected $table = 'purchasestock';
    
    public function get($id = null){
        $this->db->select('a.*, b.namaproduk, c.namasupplier, d.namaunit');
        $this->db->from('purchasestock a');
        $this->db->join('products b', 'a.idproduk = b.idproduk');
        $this->db->join('suppliers c', 'a.idsupplier = c.idsupplier');
        $this->db->join('units d', 'b.idunit = d.idunit');
        if($id != null){
            $this->db->where('a.idproduk', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getOutStock($id = null){
        $this->db->select('a.*, b.namaproduk, c.namaunit');
        $this->db->from('outstock a');
        $this->db->join('products b', 'a.idproduk = b.idproduk');
        $this->db->join('units c', 'b.idunit = c.idunit');
        if($id != null){
            $this->db->where('a.idproduk', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function add($tablename ,$data){
        $this->db->insert($tablename, $data);
        
    }


    public function update($data, $id){
        
        $this->db->where('idproduk', $id);
        $this->db->update($this->table, $data);
    }

}
