<?php defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

require_once BASEPATH.'core/CodeIgniter.php';

use PhpOffice\PhpWord\PhpWord;

class Penetapan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Penetapan_M', 'penetapan_model');
        $this->load->model('Instansi_M', 'instansi_model');
        $this->load->model('Tersangka_M', 'tersangka_model');
        $this->load->model('User_M', 'user_model');
		$this->load->library('form_validation');
        $this->load->library('encryption');
        // isLogout();
		
    }

	public function index(){
        isLogout();
        $data = array(
            'active_menu' => 'penetapan',
            'page_title' => 'penetapan',
            'data' => $this->penetapan_model->get()->result(),
        );
		$this->load->view('template', $data);
        $this->load->view('penetapan/penetapan-list', $data);
    }

    public function getInstansiDropdown(){
		$queryDataInstansi = $this->instansi_model->get()->result();
		$data_instansi[null] = array(
			'namainstansi' => '-Pilih Instansi-',
		);
		foreach ($queryDataInstansi as $key => $row) {
			$data_instansi[$row->id] = array(
				'namainstansi' => $row->nama
			);	
		}
		return $data_instansi;
	}

    public function getTersangkaDropdown(){
		$queryDataTersangka = $this->tersangka_model->get()->result();
		$data_tersangka[null] = array(
			'namatersangka' => '-Pilih Tersangka-',
		);
		foreach ($queryDataTersangka as $key => $row) {
			$data_tersangka[$row->id] = array(
				'namatersangka' => $row->nama
			);	
		}
		return $data_tersangka;
	}

    
    public function add(){
        isLogout();
        $data = array(
            'active_menu' => 'penetapan',
            'page_title' => 'penetapan',
            'data_instansi' => $this->getInstansiDropdown(),
            'data_tersangka' => $this->getTersangkaDropdown(),
        );
		$this->load->view('template', $data);
        $this->load->view('penetapan/penetapan-form-add', $data);
    }
    
    public function edit($id){
        isLogout();
        $id = decode_url($id);

        $data = array(
            'active_menu' => 'penetapan',
            'page_title' => 'penetapan',
            'row' => $this->penetapan_model->get($id)->row(),
            'data_instansi' => $this->getInstansiDropdown(),
            'data_tersangka' => $this->getTersangkaDropdown(),
        );
		$this->load->view('template', $data);
        $this->load->view('penetapan/penetapan-form-edit', $data);
	}

    public function detail($id){
        isLogout();
        $id = decode_url($id);
        
        // echo json_encode($this->penetapan_model->get($id)->row());
        // exit();

        $data = array(
            'active_menu' => 'penetapan',
            'page_title' => 'penetapan',
            'data' => $this->penetapan_model->get($id)->row(),
        );
		$this->load->view('template', $data);
        $this->load->view('penetapan/penetapan-form-detail', $data);
	}

    public function submit(){
        $post = $this->input->post(null, true);


        if (isset($post['submit'])){
            $this->form_validation->set_rules('tglpermohonan', 'Tanggal Permohonan', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('idinstansi', 'Instansi Pemohon', 'trim|required|numeric');
            $this->form_validation->set_rules('nomorpermohonan', 'No. Permohonan', 'trim|required');
            $this->form_validation->set_rules('idtersangka', 'Tersangka', 'trim|required|numeric');
            $this->form_validation->set_rules('jenisperkara', 'Jenis Perkara', 'trim|required');
            $this->form_validation->set_rules('pasalperkara', 'Pasal Perkara', 'trim|required');
            $this->form_validation->set_rules('instansipenahanterakhir', 'Instansi Penahan Terakhir', 'trim|required|numeric');
            $this->form_validation->set_rules('tglpenahananhabis', 'Tanggal Penahanan Berakhir', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('pasalrujukan', 'Pasal Rujukan', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'penetapan',
                    'page_title' => 'penetapan',
                    'data_instansi' => $this->getInstansiDropdown(),
                    'data_tersangka' => $this->getTersangkaDropdown(),
                );
                $this->load->view('template', $data);
                $this->load->view('penetapan/penetapan-form-add', $data);
			} else {
                $currentYear = date('Y');
                $queryCounter = $this->penetapan_model->getNomorPenetapanTerakhir($currentYear)->row()->nomorterakhir;
                $noPenetapan =  ($queryCounter ?? 0) + 1;

                $noPenetapanBaru = $noPenetapan.'/Pen.Pid/2021/PN Kpg';

                $postData = array(
                    'counter' => $noPenetapan,
                    'nomorpenetapan' => $noPenetapanBaru,
                    'tglpermohonan' => $post['tglpermohonan'],
                    'idinstansi' => $post['idinstansi'],
                    'nomorpermohonan' => $post['nomorpermohonan'],
                    'idtersangka' => $post['idtersangka'],
                    'jenisperkara' => $post['jenisperkara'],
                    'pasalperkara' => $post['pasalperkara'],
                    'instansipenahanterakhir' => $post['instansipenahanterakhir'],
                    'tglpenahananhabis' => $post['tglpenahananhabis'],
                    'pasalrujukan' => $post['pasalrujukan'],
                    'perpanjangan' => $post['perpanjangan'],
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->penetapan_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('penetapan');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('penetapan');
        }
       
    }

    public function update(){
        $post = $this->input->post(null, true);

        $id = decode_url($post['id']);

        if (isset($post['submit'])){
            $this->form_validation->set_rules('tglpermohonan', 'Tanggal Permohonan', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('idinstansi', 'Instansi Pemohon', 'trim|required|numeric');
            $this->form_validation->set_rules('nomorpermohonan', 'No. Permohonan', 'trim|required');
            $this->form_validation->set_rules('idtersangka', 'Tersangka', 'trim|required|numeric');
            $this->form_validation->set_rules('jenisperkara', 'Jenis Perkara', 'trim|required');
            $this->form_validation->set_rules('pasalperkara', 'Pasal Perkara', 'trim|required');
            $this->form_validation->set_rules('instansipenahanterakhir', 'Instansi Penahan Terakhir', 'trim|required|numeric');
            $this->form_validation->set_rules('tglpenahananhabis', 'Tanggal Penahanan Berakhir', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('pasalrujukan', 'Pasal Rujukan', 'trim|required|numeric');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'penetapan',
                    'page_title' => 'penetapan',
                    'row' => $this->penetapan_model->get($id)->row(),
                    'data_instansi' => $this->getInstansiDropdown(),
                    'data_tersangka' => $this->getTersangkaDropdown(),
                );
                $this->load->view('template', $data);
                $this->load->view('penetapan/penetapan-form-edit', $data);
			} else {
                $postData = array(
                    'tglpermohonan' => $post['tglpermohonan'],
                    'idinstansi' => $post['idinstansi'],
                    'nomorpermohonan' => $post['nomorpermohonan'],
                    'idtersangka' => $post['idtersangka'],
                    'jenisperkara' => $post['jenisperkara'],
                    'pasalperkara' => $post['pasalperkara'],
                    'instansipenahanterakhir' => $post['instansipenahanterakhir'],
                    'tglpenahananhabis' => $post['tglpenahananhabis'],
                    'pasalrujukan' => $post['pasalrujukan'],
                    'perpanjangan' => $post['perpanjangan'],
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );
                $this->penetapan_model->update($postData, $id);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('penetapan');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('penetapan');
        }
    }

    public function delete($id){
        $id = decode_url($id);

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->penetapan_model->update($data, $id);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('penetapan');
        }
    }

    public function cetak(){
        $post = $this->input->post(null, true);
        // var_dump($post);
        $pejabatName = $this->user_model->getPejabatByRole($post['roleuser'])->row()->nama;
        $pejabatRole = '';
        if ($post['roleuser'] == 2){
            $pejabatRole = 'Ketua';
        } else if ($post['roleuser'] == 3){
            $pejabatRole = 'Wakil Ketua';
        };

        $dataPenetapan = $this->penetapan_model->get($post['id'])->row();
        $dataTersangka = $this->tersangka_model->get($dataPenetapan->idtersangka)->row();

        $tglMulaiPerpanjangan = date('Y-m-d', strtotime($dataPenetapan->tglpenahananhabis. ' + 1 days'));
        $tglAkhirPerpanjangan = date('Y-m-d', strtotime($dataPenetapan->tglpenahananhabis. ' + 30 days'));
        // var_dump($dataPenetapan->nomorpenetapan);
        // exit();

        $fileName = strtr(
            $dataPenetapan->nomorpenetapan,
            array(
                '/' => '-',
                '.' => '-'
            )
        );
        try {

            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            
            $phpWord->setDefaultFontName('Bookman Old Style');
            $phpWord->setDefaultFontSize(12);

            $section = $phpWord->addSection(
                array('paperSize' => 'Folio')
            );
            $sectionStyle = $section->getStyle();

            // 3.5 cm left margin
            $sectionStyle->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(3));
            // 2 cm margin
            $sectionStyle->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
            $sectionStyle->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));
            $sectionStyle->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2));

            $section->addText(
                'P E N E T A P A N',
                array('color' => '000000', 'bold' => true),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'center'
                )
            );


            $section->addtext(
                'Nomor: '.$dataPenetapan->nomorpenetapan,
                array('bold' => true),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'center'
                )
            );

            $section->addText();

            $section->addText(
                'DEMI KEADILAN BERDASARKAN KETUHANAN YANG MAHA ESA',
                array('bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'center'
                )
            );

            $section->addText(htmlspecialchars("\t".$pejabatRole.' Pengadilan Negeri Kupang Kelas 1A'), null, 
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Telah membaca surat dari '. $dataPenetapan->namainstansi. ' Nomor '.$dataPenetapan->nomorpermohonan .' tanggal '.date_indo_text($dataPenetapan->tglpermohonan).' perihal perpanjangan waktu penahanan guna kepentingan pemeriksaan yang belum selesai terhadap Tersangka:'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $table = $section->addTable();
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Nama');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->nama);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Tempat, Tgl Lahir');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->tempatlahir.', '.date_indo_text($dataTersangka->tgllahir));
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Umur');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->umur.' tahun');
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Jenis Kelamin');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->jeniskelamintext);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Suku, Kebangsaan');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->suku.', '.$dataTersangka->kebangsaan);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Pendidikan');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->pendidikantext);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Pekerjaan');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->pekerjaan);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Agama');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->agamatext);
            $table->addRow();
            $table->addCell(1000);
            $table->addCell(2500)->addText('Alamat');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->alamat);
            // $table->addCell(1000);

            $section->addText(htmlspecialchars("\t" .'Membaca permintaan perpanjangan penahanan terdakwa tersebut.'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );
            
            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa Tersangka disangka melakukan tindak pidana “'.$dataPenetapan->jenisperkara.'”, sebagaimana dimaksud dalam '.$dataPenetapan->pasalperkara.'.'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa waktu penahanan Tersangka tersebut berdasarkan perintah penahanan yang dikeluarkan '.$dataPenetapan->instansipenahanterakhirtext.', akan berakhir pada tanggal '.date_indo_text($dataPenetapan->tglpenahananhabis)).'.',
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa dari surat/laporan perkara tersebut terdapat cukup alasan untuk mengabulkan permohonan tersebut.'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Mengingat '.$dataPenetapan->pasalrujukantext.'.'),
              null,
              array(
                'space' => array('before' => 0, 'after' => 60), 
                'align' => 'both'
              )
            );

            $section->addText();

            $section->addText(htmlspecialchars('M E N E T A P K A N'),
                array('color' => '000000', 'bold' => true),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'center'
                )
            );

            $section->addText(htmlspecialchars("\t".'Mengabulkan permintaan dari '.$dataPenetapan->namainstansi.' untuk memperpanjang waktu penahanan Tersangka '. $dataPenetapan->namatersangka .' selama 30 (tiga puluh) hari terhitung sejak tanggal '.date_indo_text($tglMulaiPerpanjangan).' sampai dengan tanggal '.date_indo_text($tglAkhirPerpanjangan).'.'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t".'Memerintahkan agar kepada Tersangka dan keluarganya selekas mungkin diberikan sehelai turunan penetapan ini.'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText();
            
            $section->addText(htmlspecialchars("\t\t\t\t\t".'Ditetapkan di Kupang'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText(htmlspecialchars("\t\t\t\t\t".'Pada tanggal, '.date_indo_text(date('Y-m-d'))),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText(htmlspecialchars("\t\t\t\t\t".$pejabatRole.' Pengadilan Negeri Kupang Kelas 1A'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText();
            $section->addText();

            $section->addText(htmlspecialchars("\t\t\t\t\t".$pejabatName),
                array('color' => '000000', 'bold' => true),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header('Content-Type: application/msword');
        	header('Content-Disposition: attachment;filename="Penetapan-'. $fileName.'.docx"'); 
		    header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
