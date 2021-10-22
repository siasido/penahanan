<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// isLogout();
	}

	public function index(){
		$data = array(
			'active_menu' => 'Dashboard',
			'page_title' => 'Dashboard',
		);

		$this->load->view('template', $data);
		$this->load->view('dashboard/dashboard', $data);
	}



}
