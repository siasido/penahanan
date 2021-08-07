<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Barang_M', 'barang_model');
		isLogout();
	}

	public function index(){
		$data = array(
			'data' => $this->barang_model->get()->result()
		);
		$this->load->view('template-customer', $data);
		$this->load->view('ecommerce/products', $data);
	}

	public function dashboardAdmin(){
		$data = array(
			'active_menu' => 'dashboard',
			'totalBarang' => $this->getTotalActiveData('products'),
			'totalSupplier' => $this->getTotalActiveData('suppliers'),
			'totalKategori' => $this->getTotalActiveData('kategori'),
			'totalOrder' => $this->getTotalActiveData('salesheader'),
		);
		$this->load->view('template', $data);
		$this->load->view('dashboard/dashboard-admin', $data);
	}

	public function getTotalActiveData($tablename){
		$this->db->like('is_active', '1');
		$this->db->from($tablename);
		return $this->db->count_all_results();
	}


}
