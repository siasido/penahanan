<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('User_M', 'user_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('encryption');
    }

	public function index(){
		isLogout();
        $data = array(
            'active_menu' => 'Users',
            'page_title' => 'User Pengguna',
            'data' => $this->user_model->get()->result(),
        );
		$this->load->view('template', $data);
        $this->load->view('users/user-list', $data);
    }
    
    public function add(){
		isLogout();
        $data = array(
            'active_menu' => 'Users',
            'page_title' => 'User Pengguna',
        );
		$this->load->view('template', $data);
        $this->load->view('users/user-form-add', $data);
    }
    
    public function edit($id){
		isLogout();
        $id = decode_url($id);

        $data = array(
            'active_menu' => 'users',
            'page_title' => 'User Pengguna',
            'row' => $this->user_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('users/user-form-edit', $data);
	}

    public function submit(){
		isLogout();
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'users',
                    'page_title' => 'User Pengguna',
                );
                $this->load->view('template', $data);
                $this->load->view('users/user-form-add', $data);
			} else {

                $postData = array(
                    'nama' => strtoupper($post['nama']),
                    'username' => $post['username'],
                    'password' => sha1($post['password']),
                    'role' => $post['role'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );

                if($_FILES['image']['name'] != null){
					$configurasi['upload_path']          = './uploads/users/';
					$configurasi['allowed_types']        = 'jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'user-'.date('YmdHis');
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('image')){ 
                        $data = array(
                            'active_menu' => 'Users',
                            'page_title' => 'User Pengguna',
                            'error' => $this->upload->display_errors()
                        );
                        $this->load->view('template', $data);
                        $this->load->view('users/user-form-add', $data);
					}
					else{ //if upload image successs
                        $postData['image'] = $this->upload->data('file_name');
						
                        $this->user_model->add($postData);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                            redirect('users');
                        }
					} 
					
				} else {
				
					$this->user_model->add($postData);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('users');
                    }
					
				}
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('users');
        }
       
    }

    public function update(){
		isLogout();
        $post = $this->input->post(null, true);
        $id = decode_url($this->input->post('id'));

        if (isset($post['submit'])){
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[20]');
            // $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            $postData = array(
                'nama' => strtoupper($post['nama']),
                'username' => $post['username'],
                'role' => $post['role'],
                'created_at' => date("Y-m-d H:i:S"),
                'updated_at' => date("Y-m-d H:i:S"),
                'is_active' => 1
            );

            if (isset($post['password'])){
                $postData['password'] = sha1($post['password']);
            }

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'users',
                    'page_title' => 'User Pengguna',
                );
                $this->load->view('template', $data);
                $this->load->view('users/user-form-add', $data);
			} else {
                if($_FILES['image']['name'] != null){
					$configurasi['upload_path']          = './uploads/users/';
					$configurasi['allowed_types']        = 'jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'user-'.date('YmdHis');
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('image')){ 
                        $data = array(
                            'active_menu' => 'Users',
                            'page_title' => 'User Pengguna',
                            'error' => $this->upload->display_errors()
                        );
                        $this->load->view('template', $data);
                        $this->load->view('users/user-form-add', $data);
					}
					else{ //if upload image successs
                        $postData['image'] = $this->upload->data('file_name');
						
                        $this->user_model->update($postData, $id);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                            redirect('users');
                        }
					} 
					
				} else {
				
					$this->user_model->update($postData, $id);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('users');
                    }
					
				}
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('users');
        }
    }

    public function delete($id){
		isLogout();
        $id = decode_url($id);

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->user_model->update($data, $id);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('users');
        }
    }

}
