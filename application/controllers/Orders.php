<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Barang_M', 'barang_model');
        $this->load->model('Rekening_M', 'rekening_model');
        $this->load->model('Order_M', 'order_model');
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

    public function prosescheckout(){
        $post = $this->input->post(null, true);
        // echo json_encode($post);
        // exit();

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namapenerima', 'Nama Penerima', 'trim|required|max_length[40]');
            $this->form_validation->set_rules('nohppenerima', 'No.HP Penerima', 'trim|numeric|required|min_length[11]|max_length[15]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
            $this->form_validation->set_rules('kurir', 'Kurir', 'trim|max_length[20]|required');
            $this->form_validation->set_rules('idrekening', 'Rekening', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.'); 

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'stock',
                    'data_rekening' => $this->getRekeningDropdown()
                );
                $this->load->view('template-customer', $data);
                $this->load->view('ecommerce/product-checkout', $data);
			} else {
                $postData = array(
                    'userid' => $this->session->userdata('userid'),
                    'no_order' => $post['no_order'],
                    'total' => $post['total'],
                    'idrekening' => $post['idrekening'],
                    'notes' => $post['notes'],
                    'namapenerima' => $post['namapenerima'],
                    'nohppenerima' => $post['nohppenerima'],
                    'alamat' => $post['alamat'],
                    'kurir' => $post['kurir'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1,
                    'statusbayar' => 0,
                    'statusorder' => 0
                );
				
                $this->order_model->saveTransaction($postData);

                //add to sales detail
                foreach ($this->cart->contents() as $items) {
                    $data = array(
                        'idproduk'   => $items['id'],
                        'qty'   => $items['qty'],
                        'no_order' => $post['no_order'],
                        'created_at' => date("Y-m-d H:i:S"),
                        'updated_at' => NULL,
                        'is_active' => 1
                    );
                
                    $this->order_model->saveDetailTransaction($data);
                }

                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    $this->cart->destroy();
                    redirect('orders/myorderlist');
                }
					
				
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('orders/checkout');
        } 
    }

    public function myorderlist(){
        $data = array(
            'data_orderlist' => $this->order_model->getByUserId($this->session->userdata('userid'))->result(),
            'data_processedOrderlist' => $this->order_model->getByUserIdAndStatusOrder($this->session->userdata('userid'), 1)->result()
        );
        $this->load->view('template-customer', $data);
        $this->load->view('ecommerce/myorderlist', $data);
    }

    public function allorder(){
        $data = array(
            'active_menu' => 'order',
            'data_orderlist' => $this->order_model->getAllOrder()->result(),
            'data_processedOrderlist' => $this->order_model->getOrderByStatusOrder(null, 1)->result()
            
        );
        // print_r($this->db->last_query());
        //     exit();
        $this->load->view('template', $data);
        $this->load->view('ecommerce/all-order', $data);
    }

    public function formbayar($id){
        $data = array(
            'data_order' => $this->order_model->getByOrderid($id)->row()
        );
        $this->load->view('template-customer', $data);
        $this->load->view('ecommerce/form-bayar', $data);
    }

    public function prosesbayar(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){

            $targetFile = $this->order_model->getByOrderid($post['idsales'])->row()->buktipembayaran;
            if($targetFile){
                unlink('./uploads/bukti-bayar/'.$targetFile);
            }
            
            if($_FILES['buktipembayaran']['name'] != null){
                $configurasi['upload_path']          = './uploads/bukti-bayar/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'resibayar-'.date('YmdHis').random_string('alnum',8);
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('buktipembayaran')){ 
                    $this->session->set_flashdata('notif_failed', 'Gagal upload bukti bayar.');
                    $data = array(
                        'data_order' => $this->order_model->getByOrderid($post['idsales'])->row()
                    );
                    $this->load->view('template-customer', $data);
                    $this->load->view('ecommerce/form-bayar', $data);
                }
                else{ //if upload image success
                    $postData = array(
                        'buktipembayaran' => $this->upload->data('file_name'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'statusbayar' => 1
                    );
        
                    $this->order_model->update($postData, $post['idsales']);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('orders/myorderlist');
                    }
                } 
                
            } else {
            
                $this->session->set_flashdata('notif_failed', 'Anda Belum Mengunggah Bukti Bayar');
                $data = array(
                    'data_order' => $this->order_model->getByOrderid($post['idsales'])->row()
                );
                $this->load->view('template-customer', $data);
                $this->load->view('ecommerce/form-bayar', $data);
                
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('orders/myorderlist');
        }
    }

    public function confirmpayment(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $postData = array(
                'updated_at' => date('Y-m-d H:i:s'),
                'statusbayar' => $post['statusbayar'],
                'catatanpembayaran' => $post['catatanpembayaran']
            );

            $this->order_model->update($postData, $post['idsales']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('notif_success', 'Berhasil Update Status Pembayaran');
                redirect('orders/allorder');
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Update Status Pembayaran. Tekan Tombol Submit!');
            redirect('orders/allorder');
        }
    }

    public function prosesorder($id){
        $postData = array(
            'updated_at' => date('Y-m-d H:i:s'),
            'statusorder' => 1
        );
        $this->order_model->update($postData, $id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Berhasil Update Status Pesanan');
            redirect('orders/allorder');
        }
    }

    
}
