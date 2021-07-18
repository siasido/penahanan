<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Supplier_M', 'supplier_model');
		$this->load->library('form_validation');
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'supplier',
            'data' => $this->supplier_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('supplier/supplier-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'supplier'
        );
		$this->load->view('template', $data);
        $this->load->view('supplier/supplier-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'supplier',
            'data' => $this->supplier_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('supplier/supplier-form-edit', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namasupplier', 'Nama Supplier', 'trim|required|max_length[50]|callback_suppliername_check');
            $this->form_validation->set_rules('nohp', 'No.Handphone', 'trim|numeric|required|min_length[11]|max_length[15]|callback_nohp_check');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'supplier'
                );
                $this->load->view('template', $data);
                $this->load->view('supplier/supplier-form-add', $data);
			} else {
                $postData = array(
                    'namasupplier' => $post['namasupplier'],
                    'nohp' => $post['nohp'],
                    'alamat' => $post['alamat'],
                    'deskripsi' => $post['deskripsi'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );
                $this->supplier_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('supplier');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('supplier');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namasupplier', 'Nama Supplier', 'trim|required|max_length[50]|callback_suppliername_check');
            $this->form_validation->set_rules('nohp', 'No.Handphone', 'trim|numeric|required|min_length[11]|max_length[15]|callback_nohp_check');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'supplier'
                );
                $this->load->view('template', $data);
                $this->load->view('supplier/supplier-form-edit', $data);
			} else {
                $postData = array(
                    'namasupplier' => $post['namasupplier'],
                    'nohp' => $post['nohp'],
                    'alamat' => $post['alamat'],
                    'deskripsi' => $post['deskripsi'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->supplier_model->update($postData, $post['idsupplier']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('supplier');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('supplier');
        }
    }

    public function suppliername_check(){
		$post = $this->input->post(null, true);
		$query = $this->supplier_model->suppliername_check($post['namasupplier'], $post['idsupplier']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('suppliername_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function nohp_check(){
		$post = $this->input->post(null, true);
		$query = $this->supplier_model->nohp_check($post['nohp'], $post['idsupplier']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('nohp_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function delete(){
        $post = $this->input->post();

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->supplier_model->update($data, $post['idsupplier']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('supplier');
        }
    }

}
