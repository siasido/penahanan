<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Barang_M', 'barang_model');
        $this->load->model('Rekening_M', 'rekening_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		
    }

    public function getRekeningDropdown(){
		$queryDataRekening = $this->rekening_model->get()->result();
		$data_rekening[null] = array(
			'rekening' => '-Pilih Rekening-',
		);
		foreach ($queryDataRekening as $key => $row) {
			$data_rekening[$row->idrekening] = array(
				'rekening' => $row->namabank.' - ' .$row->norek.' (a.n. '.$row->namaakun.')'
			);	
		}
		return $data_rekening;
	}

	public function checkout(){
        $data = array(
            'data_rekening' => $this->getRekeningDropdown()
        );
		$this->load->view('template-customer', $data);
        $this->load->view('ecommerce/product-checkout', $data);
    }



    
}
