<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_M extends CI_Model {

    protected $table = 'company';
    
    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('idcompany', $id);
        }
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idcompany', $id);
        $this->db->update($this->table, $data);
    }

}
