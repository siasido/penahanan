<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Barang_M', 'barang_model');;
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		
    }

	public function cart(){
        $data = array(
            // 'data' => $this->barang_model->get()->result()
        );
		$this->load->view('template-customer', $data);
        $this->load->view('ecommerce/product-cart', $data);
    }

    
}
