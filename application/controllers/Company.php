<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Company_M', 'company_model');
		$this->load->library('form_validation');
        isLogout();
		
    }

	public function index(){
        $data = array(
            'active_menu' => 'company',
            'data' => $this->company_model->get()->result()
        );
		$this->load->view('template', $data);
        $this->load->view('company/company-list', $data);
    }
    
    
    public function edit($id){
        $data = array(
            'active_menu' => 'company',
            'data' => $this->company_model->get($id)->row()
        );
		$this->load->view('template', $data);
        $this->load->view('company/company-form-edit', $data);
	}

    public function update(){
        $post = $this->input->post(null, true);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('namacompany', 'Nama Company', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('nohp', 'No. Handphone', 'trim|required|numeric|min_length[11]|max_length[15]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'company'
                );
                $this->load->view('template', $data);
                $this->load->view('company/company-form-edit', $data);
			} else {
                $postData = array(
                    'namacompany' => $post['namacompany'],
                    'nohp' => $post['nohp'],
                    'alamat' => $post['alamat'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->company_model->update($postData, $post['idcompany']);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('company');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('company');
        }
    }



}
