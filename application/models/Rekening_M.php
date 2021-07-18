<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_M extends CI_Model {

    protected $table = 'rekening';
    
    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('idrekening', $id);
        }
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function norek_check($norek, $id = null){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('norek', $norek);
        $this->db->where('is_active', 1);
        if ($id != null){
            $this->db->where('idrekening !=', $id);
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
            $this->db->where('idrekening !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idrekening', $id);
        $this->db->update($this->table, $data);
    }

}
