<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_M extends CI_Model {

    public function saveTransaction($data){
        $this->db->insert('salesheader', $data);
    }

    public function saveDetailTransaction($data){
        $this->db->insert('salesdetail', $data);
    }

    public function getByUserId($id){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.userid', $id);
        }
        $this->db->where('a.statusorder', 0);
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getByUserIdAndStatusOrder($id = null, $statusorder = null){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.userid', $id);
        }
        if($statusorder != null){
            $this->db->where('a.statusorder', $statusorder);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getByOrderid($id = null){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.idsales', $id);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getAllOrder($id = null){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.idsales', $id);
        }
        $this->db->where('a.statusorder', 0);
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getOrderByStatusOrder($id = null, $statusorder = null){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.idsales', $id);
        }
        if($statusorder != null){
            $this->db->where('a.statusorder', $statusorder);
        }
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }

    public function getUnpaidAndRejectedOrder($id = null){
        $this->db->select('a.*, b.namalengkap, c.namaakun, c.namabank, c.norek');
        $this->db->from('salesheader a');
        $this->db->join('users b', 'a.userid = b.userid');
        $this->db->join('rekening c', 'a.idrekening = c.idrekening');
        if($id != null){
            $this->db->where('a.idsales', $id);
        }
        $this->db->where('a.statusbayar', 0);
        $this->db->or_where('a.statusbayar', 2);
        $this->db->where('a.is_active', 1);
        $query = $this->db->get();
        return $query;
    }


    public function update($data, $id){
        
        $this->db->where('idsales', $id);
        $this->db->update('salesheader', $data);
    }

}