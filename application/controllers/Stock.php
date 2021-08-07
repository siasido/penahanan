<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Stock_M', 'stock_model');
        $this->load->model('Barang_M', 'barang_model');
        $this->load->model('Supplier_M', 'supplier_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
        isLogout();
		
    }

    public function getBarangDropdown(){
		$queryDataBarang = $this->barang_model->get()->result();
		$data_barang[null] = array(
			'namaproduk' => '-Pilih Barang-',
			'namaunit' => null,
            'sisastock' => null,
		);
		foreach ($queryDataBarang as $key => $row) {
			$data_barang[$row->idproduk] = array(
				'namaproduk' => $row->namaproduk,
				'namaunit' => $row->namaunit,
                'sisastock' => $row->sisastock
			);	
		}
		return $data_barang;
	}

	public function index(){
        $data = array(
            'active_menu' => 'stock',
            'data' => $this->stock_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-list', $data);
    }

    public function inStockList(){
        $data = array(
            'active_menu' => 'stock',
            'data' => $this->stock_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-in-list', $data);
    }
    
    public function inStockAdd(){
        $data = array(
            'active_menu' => 'stock',
            'data_barang' => $this->getBarangDropdown(),
            'data_supplier' => $this->supplier_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-in-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'stock',
            'data_unit' => $this->unit_model->get()->result(),
            'data_kategori' => $this->kategori_model->get()->result(),
            'data_barang' => $this->stock_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-form-edit', $data);
	}

    public function submitInStock(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('purchasedate', 'Tanggal Purchase', 'trim|required');
            $this->form_validation->set_rules('qty', 'Qty Purchase', 'trim|numeric|required');
            $this->form_validation->set_rules('idproduk', 'Barang', 'trim|numeric|required');
            $this->form_validation->set_rules('idsupplier', 'Supplier', 'trim|numeric|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.'); 

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'stock',
                    'data_barang' => $this->getBarangDropdown(),
                    'data_supplier' => $this->supplier_model->get()->result()
                );
                $this->load->view('template', $data);
                $this->load->view('stock/stock-in-form-add', $data);
			} else {
                $postData = array(
                    'purchasedate' => $post['purchasedate'],
                    'qty' => $post['qty'],
                    'idproduk' => $post['idproduk'],
                    'idsupplier' => $post['idsupplier'],
                    'notes' => $post['notes'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );

                $updateData = array(
                    'sisastock' =>  $post['sisastock'] + $post['qty'],
                    'updated_at' => date("Y-m-d H:i:S")
                );
				
                $this->stock_model->add('purchasestock',$postData);
                $this->barang_model->update($updateData, $post['idproduk']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('stock/inStockList');
                }
					
				
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('stock');
        }
       
    }

    public function outStockList(){
        $data = array(
            'active_menu' => 'stock',
            'data' => $this->stock_model->getOutStock()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-out-list', $data);
    }
    
    public function outStockAdd(){
        $data = array(
            'active_menu' => 'stock',
            'data_barang' => $this->getBarangDropdown(),
            'data_supplier' => $this->supplier_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('stock/stock-out-form-add', $data);
    }

    public function submitOutStock(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('outstockdate', 'Tanggal OutStock', 'trim|required');
            $this->form_validation->set_rules('qty', 'Qty', 'trim|numeric|required');
            $this->form_validation->set_rules('idproduk', 'Barang', 'trim|numeric|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.'); 

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'stock',
                    'data_barang' => $this->getBarangDropdown()
                );
                $this->load->view('template', $data);
                $this->load->view('stock/stock-out-form-add', $data);
			} else {
                $postData = array(
                    'outstockdate' => $post['outstockdate'],
                    'qty' => $post['qty'],
                    'idproduk' => $post['idproduk'],
                    'notes' => $post['notes'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );

                $updateData = array(
                    'sisastock' =>  $post['sisastock'] - $post['qty'],
                    'updated_at' => date("Y-m-d H:i:S")
                );
				
                $this->stock_model->add('outstock',$postData);
                $this->barang_model->update($updateData, $post['idproduk']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('stock/outStockList');
                }
					
				
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('stock');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namaproduk', 'Nama Barang', 'trim|required|max_length[80]|callback_namaproduk_check');
            $this->form_validation->set_rules('hargasatuan', 'Harga Satuan', 'trim|numeric|required|min_length[3]');
            $this->form_validation->set_rules('idunit', 'Satuan Barang', 'trim|numeric|required');
            $this->form_validation->set_rules('idkategori', 'Kategori Barang', 'trim|numeric|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.'); 

            $postData = array(
                'namaproduk' => $post['namaproduk'],
                'deskripsi' => $post['deskripsi'],
                'idkategori' => $post['idkategori'],
                'idunit' => $post['idunit'],
                'hargasatuan' => $post['hargasatuan'],
                'updated_at' => date("Y-m-d H:i:S"),
                'is_active' => 1
            );

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'stock',
                    'data_unit' => $this->unit_model->get()->result(),
                    'data_kategori' => $this->kategori_model->get()->result(),
                    'data_barang' => $this->stock_model->get($post['idproduk'])->row()
                );
                $this->load->view('template', $data);
                $this->load->view('stock/stock-form-edit', $data);
			} else {
                if($_FILES['foto']['name'] != null){

                    //hapus dulu foto lama biar server ga penuh
                    $targetFile = $this->stock_model->get($post['idproduk'])->row()->foto;
					unlink('./uploads/products/'.$targetFile);

					$configurasi['upload_path']          = './uploads/products/';
					$configurasi['allowed_types']        = 'jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'product-'.date('YmdHis');
				
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('foto')){ 
                        $data = array(
                            'active_menu' => 'stock',
                            'error' => $this->upload->display_errors(),
                            'data_unit' => $this->unit_model->get()->result(),
                            'data_kategori' => $this->kategori_model->get()->result(),
                            'data_barang' => $this->stock_model->get($post['idproduk'])->row()
                        );
                        $this->load->view('template', $data);
                        $this->load->view('stock/stock-form-edit', $data);
					}
					else{ //if upload image success

                        $postData['foto'] = $this->upload->data('file_name');
						
                        $this->stock_model->update($postData, $post['idproduk']);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                            redirect('stock');
                        }
					} 
					
				} else {
				
					$this->stock_model->update($postData, $post['idproduk']);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('stock');
                    }
					
				}
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('stock');
        }
    }

    public function namaproduk_check(){
		$post = $this->input->post(null, true);
		$query = $this->stock_model->namaproduk_check($post['namaproduk'], $post['idproduk']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('namaproduk_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
	}


    public function delete(){
        $post = $this->input->post();

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->stock_model->update($data, $post['idproduk']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('stock');
        }
    }

}
