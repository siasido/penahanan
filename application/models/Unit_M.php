<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_M extends CI_Model {

    protected $table = 'units';
    
    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('idunit', $id);
        }
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function namaunit_check($namaunit, $id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('namaunit', $namaunit);
        $this->db->where('is_active', 1);
        if($id !=null){
            $this->db->where('idunit !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idunit', $id);
        $this->db->update($this->table, $data);
    }

}
