<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Barang_M', 'barang_model');
        $this->load->model('Unit_M', 'unit_model');
        $this->load->model('Kategori_M', 'kategori_model');
		$this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
        isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'barang',
            'data' => $this->barang_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('barang/barang-list', $data);
    }

    public function details($id){
        $data = array(
            'active_menu' => 'barang',
            'data_barang' => $this->barang_model->get($id)->row()
        );
		$this->load->view('template-customer', $data);
        $this->load->view('ecommerce/product-details', $data);
    }
    
    public function add(){
        $data = array(
            'active_menu' => 'barang',
            'data_unit' => $this->unit_model->get()->result(),
            'data_kategori' => $this->kategori_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('barang/barang-form-add', $data);
    }
    
    public function edit($id){
        $data = array(
            'active_menu' => 'barang',
            'data_unit' => $this->unit_model->get()->result(),
            'data_kategori' => $this->kategori_model->get()->result(),
            'data_barang' => $this->barang_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('barang/barang-form-edit', $data);
	}

    public function submit(){
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

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'barang'
                );
                $this->load->view('template', $data);
                $this->load->view('barang/barang-form-add', $data);
			} else {
                $postData = array(
                    'namaproduk' => $post['namaproduk'],
                    'deskripsi' => $post['deskripsi'],
                    'idkategori' => $post['idkategori'],
                    'idunit' => $post['idunit'],
                    'hargasatuan' => $post['hargasatuan'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => NULL,
                    'is_active' => 1
                );

                if($_FILES['foto']['name'] != null){
					$configurasi['upload_path']          = './uploads/products/';
					$configurasi['allowed_types']        = 'jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'product-'.date('YmdHis');
				
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('foto')){ 
                        $data = array(
                            'active_menu' => 'barang',
                            'error' => $this->upload->display_errors()
                        );
                        $this->load->view('template', $data);
                        $this->load->view('barang/barang-form-add', $data);
					}
					else{ //if upload image success

                        $postData['foto'] = $this->upload->data('file_name');
						
                        $this->barang_model->add($postData);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                            redirect('barang');
                        }
					} 
					
				} else {
				
					$this->barang_model->add($postData);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('barang');
                    }
					
				}
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('barang');
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
                    'active_menu' => 'barang',
                    'data_unit' => $this->unit_model->get()->result(),
                    'data_kategori' => $this->kategori_model->get()->result(),
                    'data_barang' => $this->barang_model->get($post['idproduk'])->row()
                );
                $this->load->view('template', $data);
                $this->load->view('barang/barang-form-edit', $data);
			} else {
                if($_FILES['foto']['name'] != null){

                    //hapus dulu foto lama biar server ga penuh
                    $targetFile = $this->barang_model->get($post['idproduk'])->row()->foto;
					unlink('./uploads/products/'.$targetFile);

					$configurasi['upload_path']          = './uploads/products/';
					$configurasi['allowed_types']        = 'jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'product-'.date('YmdHis');
				
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('foto')){ 
                        $data = array(
                            'active_menu' => 'barang',
                            'error' => $this->upload->display_errors(),
                            'data_unit' => $this->unit_model->get()->result(),
                            'data_kategori' => $this->kategori_model->get()->result(),
                            'data_barang' => $this->barang_model->get($post['idproduk'])->row()
                        );
                        $this->load->view('template', $data);
                        $this->load->view('barang/barang-form-edit', $data);
					}
					else{ //if upload image success

                        $postData['foto'] = $this->upload->data('file_name');
						
                        $this->barang_model->update($postData, $post['idproduk']);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                            redirect('barang');
                        }
					} 
					
				} else {
				
					$this->barang_model->update($postData, $post['idproduk']);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                        redirect('barang');
                    }
					
				}
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('barang');
        }
    }

    public function namaproduk_check(){
		$post = $this->input->post(null, true);
		$query = $this->barang_model->namaproduk_check($post['namaproduk'], $post['idproduk']);

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
        $this->barang_model->update($data, $post['idproduk']);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('barang');
        }
    }

}
