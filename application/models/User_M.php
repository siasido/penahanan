<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_M extends CI_Model {

    protected $table = 'users';
    
    public function login($data){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $data['username']);
        $this->db->where('password', sha1($data['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null){
        $this->db->select('*, 
            (CASE
                WHEN role = 1 THEN "Admin"
                WHEN role = 2 THEN "Ketua Pengadilan"
                WHEN role = 2 THEN "Wakil Ketua Pengadilan"
                ELSE "Staff"
            END) as roletext,');
        $this->db->from($this->table);
        if($id != null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function username_check($username, $id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('id !=', $id);
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

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function getPejabatByRole($param){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('role', $param);
        $query = $this->db->get();
        return $query;
    }
}
