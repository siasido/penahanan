<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct(){
		parent::__construct();	
    }

    public function submit(){
        if($this->session->userdata('userid')){
            $post = $this->input->post(null, true);
            $data = array(
                'id'      => $post['idproduk'],
                'qty'     => 1,
                'price'   => $post['hargasatuan'],
                'name'    => $post['namaproduk'],
                'options' => array('foto' => $post['foto'])
            );
            
            $status = $this->cart->insert($data);
            if ($status){
                $this->session->set_flashdata('notif_success', 'Berhasil menambah barang ke keranjang.');
                redirect('dashboard');
            }
        } else {
            $this->cart->destroy();
            redirect('auth');
        }
    }

    public function show(){
        $data_cart = array(
            'contents' => $this->cart->contents(),
            'totalitems' => $this->cart->total_items(),
            'totalamount' => $this->cart->total()
        );
        
        $this->load->view('template-customer', $data_cart);
        $this->load->view('ecommerce/product-cart', $data_cart);
    }

}