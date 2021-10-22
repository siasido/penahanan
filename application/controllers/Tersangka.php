<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tersangka extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Tersangka_M', 'tersangka_model');
		$this->load->library('form_validation');
        $this->load->library('encryption');
        // isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'tersangka',
            'page_title' => 'Tersangka',
            'data' => $this->tersangka_model->get()->result(),
        );
		$this->load->view('template', $data);
        $this->load->view('tersangka/tersangka-list', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'tersangka',
            'page_title' => 'Tersangka',
        );
		$this->load->view('template', $data);
        $this->load->view('tersangka/tersangka-form-add', $data);
    }
    
    public function edit($id){
        $id = decode_url($id);

        $data = array(
            'active_menu' => 'tersangka',
            'page_title' => 'Tersangka',
            'data' => $this->tersangka_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('tersangka/tersangka-form-edit', $data);
	}

    public function detail($id){
        $id = decode_url($id);

        $data = array(
            'active_menu' => 'tersangka',
            'page_title' => 'Tersangka',
            'data' => $this->tersangka_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('tersangka/tersangka-form-detail', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);

        // echo json_encode($post);
        // exit();

        if (isset($post['submit'])){
            $this->form_validation->set_rules('nama', 'Nama Tersangka', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('tempatlahir', 'Tempat Lahir', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('kebangsaan', 'Kebangsaan', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('agama', 'Agama', 'trim|required|numeric');
            $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'tersangka',
                    'page_title' => 'Tersangka',
                );
                $this->load->view('template', $data);
                $this->load->view('tersangka/tersangka-form-add', $data);
			} else {
                $postData = array(
                    'nama' => $post['nama'],
                    'tempatlahir' => $post['tempatlahir'],
                    'tgllahir' => $post['tgllahir'],
                    'jeniskelamin' => $post['jeniskelamin'],
                    'suku' => $post['suku'],
                    'kebangsaan' => $post['kebangsaan'],
                    'pekerjaan' => $post['pekerjaan'],
                    'alamat' => $post['alamat'],
                    'agama' => $post['agama'],
                    'pendidikan' => $post['pendidikan'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->tersangka_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('tersangka');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('tersangka');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('nama', 'Nama Tersangka', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('tempatlahir', 'Tempat Lahir', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('kebangsaan', 'Kebangsaan', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('agama', 'Agama', 'trim|required|numeric');
            $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'tersangka',
                    'page_title' => 'Tersangka',
                    'data' => $this->tersangka_model->get($post['id'])->row()
                );
                $this->load->view('template', $data);
                $this->load->view('tersangka/tersangka-form-edit', $data);
			} else {
                $postData = array(
                    'nama' => $post['nama'],
                    'tempatlahir' => $post['tempatlahir'],
                    'tgllahir' => $post['tgllahir'],
                    'jeniskelamin' => $post['jeniskelamin'],
                    'suku' => $post['suku'],
                    'kebangsaan' => $post['kebangsaan'],
                    'pekerjaan' => $post['pekerjaan'],
                    'alamat' => $post['alamat'],
                    'agama' => $post['agama'],
                    'pendidikan' => $post['pendidikan'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->tersangka_model->update($postData, $post['id']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('tersangka');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('tersangka');
        }
    }

    public function delete($id){
        $id = decode_url($id);

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->tersangka_model->update($data, $id);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('tersangka');
        }
    }

}
