<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Kategori_M', 'kategori_model');
		$this->load->library('form_validation');
        isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'kategori',
            'data' => $this->kategori_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('kategori/kategori-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'kategori'
        );
		$this->load->view('template', $data);
        $this->load->view('kategori/kategori-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'kategori',
            'data' => $this->kategori_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('kategori/kategori-form-edit', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namakategori', 'Nama Kategori', 'trim|required|max_length[50]|callback_namakategori_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'kategori'
                );
                $this->load->view('template', $data);
                $this->load->view('kategori/kategori-form-add', $data);
			} else {
                $postData = array(
                    'namakategori' => $post['namakategori'],
                    'deskripsi' => $post['deskripsi'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );
                $this->kategori_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('kategori');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('kategori');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namakategori', 'Nama kategori', 'trim|required|max_length[50]|callback_namakategori_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');
            $this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'kategori'
                );
                $this->load->view('template', $data);
                $this->load->view('kategori/kategori-form-edit', $data);
			} else {
                $postData = array(
                    'namakategori' => $post['namakategori'],
                    'deskripsi' => $post['deskripsi'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->kategori_model->update($postData, $post['idkategori']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('kategori');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('kategori');
        }
    }

    public function namakategori_check(){
		$post = $this->input->post(null, true);
		$query = $this->kategori_model->namakategori_check($post['namakategori'], $post['idkategori']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('namakategori_check', '{field} ini sudah digunakan, silahkan ganti.');
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
        $this->kategori_model->update($data, $post['idkategori']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('kategori');
        }
    }

}
