<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_M', 'user_model');
        
    }

    public function index()
    {
        $this->load->view('auth/login-page');
    }

    public function login(){
        $post = $this->input->post(null, true);
        if (isset($post['login'])){
            $result = $this->user_model->login($post);
            if ($result->num_rows() == 1){
                $data = $result->row();
                // var_dump($data);

                $session_data = array(
                    "userid" => $data->userid,
                    "username"=> $data->username,
                    "namalengkap"=> $data->namalengkap,
                    "foto"=> $data->foto,
                    "role"=> $data->role,
                    "nohp"=> $data->nohp
                );

                $this->session->set_userdata($session_data);

                if ($data->role == 1){
                    redirect('dashboard/dashboardAdmin');
                } else {
                    redirect('dashboard');
                }
            } else {
                echo "<script>
                    alert('Maaf username dan password anda salah');
                    window.location = '".site_url('auth')."';
                </script>";
            }
        }
    }
    

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }

}
