<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Unit_M', 'unit_model');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
        $data = array(
            'active_menu' => 'unit',
            'data' => $this->unit_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('units/unit-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'unit'
        );
		$this->load->view('template', $data);
        $this->load->view('units/unit-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'unit',
            'data' => $this->unit_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('units/unit-form-edit', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namaunit', 'Nama Satuan', 'trim|required|max_length[50]|callback_namaunit_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'unit'
                );
                $this->load->view('template', $data);
                $this->load->view('units/unit-form-add', $data);
			} else {
                $postData = array(
                    'namaunit' => $post['namaunit'],
                    'deskripsi' => $post['deskripsi'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );
                $this->unit_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('unit');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('unit');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namaunit', 'Nama unit', 'trim|required|max_length[50]|callback_namaunit_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'unit'
                );
                $this->load->view('template', $data);
                $this->load->view('units/unit-form-edit', $data);
			} else {
                $postData = array(
                    'namaunit' => $post['namaunit'],
                    'deskripsi' => $post['deskripsi'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->unit_model->update($postData, $post['idunit']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('unit');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('unit');
        }
    }

    public function namaunit_check(){
		$post = $this->input->post(null, true);
		$query = $this->unit_model->namaunit_check($post['namaunit'], $post['idunit']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('namaunit_check', '{field} ini sudah digunakan, silahkan ganti.');
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
        $this->unit_model->update($data, $post['idunit']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('unit');
        }
    }

}
