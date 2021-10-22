<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('User_M', 'user_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		
    }

	public function get(){
        
    }


}
