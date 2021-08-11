<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('User_M', 'user_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		
    }

	public function register(){
        $this->load->view('users/register');
    }

    public function prosesregistrasi(){
        $post = $this->input->post(null, true);

        // print_r($post);
        // exit();

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('matches', '{field} tidak sesuai dengan kata sandi, silahkan ganti.'); 
        
        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|min_length[11]|max_length[15]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

        $data = array(
            'namalengkap' => $post['namalengkap'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'email' => $post['email'],
            'alamat' => $post['alamat'],
            'nohp' => $post['nohp'],
            'role' => 2
        );

        if ($this->form_validation->run() == FALSE){
            $this->load->view('users/register');
        } else {
            

            if($_FILES['foto']['name'] != null){ // check wheiter foto is exist					
                // configurasi upload
                $configurasi['upload_path']          = './uploads/users/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'user-'.date('YmdHis');
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('foto')){ //if upload failed
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('users/register',$error);
                }
                else{ //if upload image success

                    $data['foto'] = $this->upload->data('file_name'); //get image name
                } 
                
            } 

            $this->user_model->add($data);
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location = '".site_url('auth')."';
                </script>";
            }
        }
    }

    public function myprofile(){
        $data = array(
            'active_menu' => null,
            'data_pengguna' => $this->user_model->get($this->session->userdata('userid'))->row()
        );

        if($this->session->userdata('role') != 1){
            $this->load->view('template-customer', $data);
        } else {
            $this->load->view('template', $data);
        }
        $this->load->view('users/myprofile', $data);
    }   

    public function updatemyprofile(){
        $post = $this->input->post(null, true);

        // print_r($post);
        // exit();
        

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('matches', '{field} tidak sesuai dengan kata sandi, silahkan ganti.'); 
        $this->form_validation->set_message('valid_email', '{field} tidak valid'); 
        
        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[20]|callback_username_check');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|min_length[11]|max_length[15]');

        if($post['password']){
            $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
            $data['password'] = sha1($post['password']);
        }

        if($post['passconf']){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
        }

        $data = array(
            'namalengkap' => $post['namalengkap'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'nohp' => $post['nohp'],
            'email' => $post['email'],
            'alamat' => $post['alamat'],
            'role' => 2
        );

        if ($this->form_validation->run() == FALSE){
            $this->load->view('users/register');
        } else {
            

            if($_FILES['foto']['name'] != null){ // check wheiter foto is exist					
                // configurasi upload
                $configurasi['upload_path']          = './uploads/users/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'user-'.date('YmdHis');
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('foto')){ //if upload failed
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('users/register',$error);
                }
                else{ //if upload image success

                    $data['foto'] = $this->upload->data('file_name'); //get image name
                } 
            } 

            $this->user_model->add($data);
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location = '".site_url('auth')."';
                </script>";
            }
        }
    }

    public function username_check(){
		$post = $this->input->post(null, true);
		$query = $this->user_model->username_check($post['username'], $post['userid']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('username_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
	}


}
