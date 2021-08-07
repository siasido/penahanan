<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Rekening_M', 'rekening_model');
		$this->load->library('form_validation');
        isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'rekening',
            'data' => $this->rekening_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('rekening/rekening-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'rekening'
        );
		$this->load->view('template', $data);
        $this->load->view('rekening/rekening-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'rekening',
            'data' => $this->rekening_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('rekening/rekening-form-edit', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namabank', 'Nama Bank', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('namaakun', 'Nama Akun', 'trim|required|max_length[40]');
            $this->form_validation->set_rules('norek', 'Nomor Rekening', 'trim|numeric|required|max_length[20]|callback_norek_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'rekening'
                );
                $this->load->view('template', $data);
                $this->load->view('rekening/rekening-form-add', $data);
			} else {
                $postData = array(
                    'namabank' => $post['namabank'],
                    'namaakun' => $post['namaakun'],
                    'norek' => $post['norek'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );
                $this->rekening_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('rekening');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('rekening');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namabank', 'Nama Bank', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('namaakun', 'Nama Akun', 'trim|required|max_length[40]');
            $this->form_validation->set_rules('norek', 'Nomor Rekening', 'trim|numeric|required|max_length[20]|callback_norek_check');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'rekening'
                );
                $this->load->view('template', $data);
                $this->load->view('rekening/rekening-form-edit', $data);
			} else {
                $postData = array(
                    'namabank' => $post['namabank'],
                    'namaakun' => $post['namaakun'],
                    'norek' => $post['norek'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->rekening_model->update($postData, $post['idrekening']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('rekening');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('rekening');
        }
    }

    public function norek_check(){
		$post = $this->input->post(null, true);
		$query = $this->rekening_model->norek_check($post['norek'], $post['idrekening']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('norek_check', '{field} ini sudah digunakan, silahkan ganti.');
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
        $this->rekening_model->update($data, $post['idrekening']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('rekening');
        }
    }

}
