<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Instansi_M', 'instansi_model');
		$this->load->library('form_validation');
        $this->load->library('encryption');
        // isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'instansi',
            'page_title' => 'Instansi',
            'data' => $this->instansi_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('instansi/instansi-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'instansi',
            'page_title' => 'Instansi',
        );
		$this->load->view('template', $data);
        $this->load->view('instansi/instansi-form-add', $data);
    }
    
    public function edit($id){
        $id = $this->encryption->decrypt($id);

        $data = array(
            'active_menu' => 'instansi',
            'page_title' => 'Instansi',
            'data' => $this->instansi_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('instansi/instansi-form-edit', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('tipe', 'Tipe Instansi', 'trim|numeric|required');
            $this->form_validation->set_rules('nama', 'Nama Instansi', 'trim|required|max_length[150]');
            $this->form_validation->set_rules('singkatan', 'Singkatan Instansi', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('alamat', 'Alamat instansi', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'instansi'
                );
                $this->load->view('template', $data);
                $this->load->view('instansi/instansi-form-add', $data);
			} else {
                $postData = array(
                    'tipe' => $post['tipe'],
                    'nama' => $post['nama'],
                    'singkatan' => $post['singkatan'],
                    'alamat' => $post['alamat'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->instansi_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('instansi');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('instansi');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('tipe', 'Tipe Instansi', 'trim|numeric|required');
            $this->form_validation->set_rules('nama', 'Nama Instansi', 'trim|required|max_length[150]');
            $this->form_validation->set_rules('singkatan', 'Singkatan Instansi', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('alamat', 'Alamat instansi', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'instansi',
                    'page_title' => 'Instansi',
                    'data' => $this->instansi_model->get($post['id'])->row()
                );
                $this->load->view('template', $data);
                $this->load->view('instansi/instansi-form-edit', $data);
			} else {
                $postData = array(
                    'tipe' => $post['tipe'],
                    'nama' => $post['nama'],
                    'singkatan' => $post['singkatan'],
                    'alamat' => $post['alamat'],
                    // 'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->instansi_model->update($postData, $post['id']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('instansi');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('instansi');
        }
    }

    public function delete($id){
        $id = decode_url($id);
        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->instansi_model->update($data, $id);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('instansi');
        }
    }

}
