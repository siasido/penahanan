<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct(){
		parent::__construct();	
        isLogout();
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
            } else {
                $this->session->set_flashdata('notif_failed', 'Gagal menambah barang ke keranjang.');
                redirect('dashboard');
            }
        } else {
            $this->cart->destroy();
            redirect('auth');
        }
    }

    public function show(){
        if(empty($this->cart->contents())){
            redirect('dashboard');
        } 
        $data_cart = array(
            'contents' => $this->cart->contents(),
            'totalitems' => $this->cart->total_items(),
            'totalamount' => $this->cart->total()
        );
        
        $this->load->view('template-customer', $data_cart);
        $this->load->view('ecommerce/product-cart', $data_cart);
        
    }

    public function remove($rowId){
        $status = $this->cart->remove($rowId);
        if ($status){
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus barang dari keranjang.');
            redirect('cart/show');
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal menghapus barang dari keranjang.');
            redirect('cart/show');
        }
    }

    public function updateCart(){
        $index = 1;

        try {
            foreach ($this->cart->contents() as $items) {
                $data = array(
                    'rowid' => $items['rowid'],
                    'qty'   => $this->input->post($index.'[qty]')
                );
            
                $this->cart->update($data);
                $index++;
            }
            $this->session->set_flashdata('notif_success', 'Berhasil update keranjang.');
            redirect('cart/show');
        } catch (Exception $e) {
            $this->session->set_flashdata('notif_failed', 'Gagal update keranjang.');
            redirect('cart/show');
        }
    }

}