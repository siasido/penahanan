<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_M', 'user_model');
        // isLogin();
    }

    public function index()
    {
        isLogin();
        $data = array(
            'title' => 'Login Page'
        );
        $this->load->view('auth/login-page', $data);
    }

    public function login(){
        $post = $this->input->post(null, true);
        if (isset($post['login'])){
            $result = $this->user_model->login($post);
            if ($result->num_rows() == 1){
                $data = $result->row();
                // var_dump($data);

                $session_data = array(
                    "id" => $data->id,
                    "username"=> $data->username,
                    "nama"=> $data->nama,
                    "image"=> $data->image,
                    "role"=> $data->role
                );

                $this->session->set_userdata($session_data);

                $this->session->set_flashdata('notif_success', 'Berhasil Login');
                redirect('dashboard/index');
            } else {
                $this->session->set_flashdata('notif_failed', 'Gagal Login');
                redirect('auth/index');
            }
        }
    }
    

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('notif_success', 'Anda Telah Logout');
        redirect('auth');
    }

}
