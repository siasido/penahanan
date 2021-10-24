<?php defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

require_once BASEPATH.'core/CodeIgniter.php';

use PhpOffice\PhpWord\PhpWord;

class Penyitaan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Penyitaan_M', 'penyitaan_model');
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
            'active_menu' => 'penyitaan',
            'page_title' => 'penyitaan',
            'data' => $this->penyitaan_model->get()->result(),
        );
		$this->load->view('template', $data);
        $this->load->view('penyitaan/penyitaan-list', $data);
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
            'active_menu' => 'penyitaan',
            'page_title' => 'penyitaan',
            'data_instansi' => $this->getInstansiDropdown(),
            'data_tersangka' => $this->getTersangkaDropdown(),
        );
		$this->load->view('template', $data);
        $this->load->view('penyitaan/penyitaan-form-add', $data);
    }
    
    public function edit($id){
        isLogout();
        $id = decode_url($id);

        $data = array(
            'active_menu' => 'penyitaan',
            'page_title' => 'penyitaan',
            'row' => $this->penyitaan_model->get($id)->row(),
            'data_instansi' => $this->getInstansiDropdown(),
            'data_tersangka' => $this->getTersangkaDropdown(),
        );
		$this->load->view('template', $data);
        $this->load->view('penyitaan/penyitaan-form-edit', $data);
	}

    public function detail($id){
        isLogout();
        $id = decode_url($id);
        
        $data = array(
            'active_menu' => 'penyitaan',
            'page_title' => 'penyitaan',
            'data' => $this->penyitaan_model->get($id)->row(),
        );
		$this->load->view('template', $data);
        $this->load->view('penyitaan/penyitaan-form-detail', $data);
	}

    public function generateQRcode( $dataQR){
        try {
            
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            $image_name='qr-'.date('YmdHis').'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = $dataQR; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            return $image_name;

        } catch (Exception $e) {
            echo $e->getMessage();

            return false;
        }
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
            $this->form_validation->set_rules('nomorlaporansita', 'Nomor Laporan Sita', 'trim|required');
            $this->form_validation->set_rules('tgllaporansita', 'Tanggal Laporan Sita', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('tglbasita', 'Tanggal BA Sita', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('deskripsipenyitaan', 'Barang yang disita', 'trim|required');
            $this->form_validation->set_rules('disitadari', 'Barang disita dari siapa', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){

                echo "tidak lolos validasi";
                echo validation_errors(); 
                exit();

				$data = array(
                    'active_menu' => 'penyitaan',
                    'page_title' => 'penyitaan',
                    'data_instansi' => $this->getInstansiDropdown(),
                    'data_tersangka' => $this->getTersangkaDropdown(),
                );
                $this->load->view('template', $data);
                $this->load->view('penyitaan/penyitaan-form-add', $data);
			} else {
                $currentYear = date('Y');
                $queryCounter = $this->penyitaan_model->getNomorPenetapanTerakhir($currentYear)->row()->nomorterakhir;
                $nopenetapan =  ($queryCounter ?? 0) + 1;

                $nopenetapanBaru = $nopenetapan.'/Pen.Pid/2021/PN Kpg';

                $jenispenyitaantext = $post['jenispenyitaan'] == 1 ? 'Penetapan Izin Penyitaan' : 'Penetapan Persetujuan Penyitaan';
                $dataTersangka = $this->tersangka_model->get($post['idtersangka'])->row();

                $dataQR = 'Satuan Kerja: Pengadilan Negeri Kupang'."\r\n".
                            'Nomor Register: '.$nopenetapanBaru."\r\n". 
                            'Tanggal Register: '.date_indo_text(date("Y-m-d"))."\r\n".
                            'Jenis Penyitaan: '.$jenispenyitaantext."\r\n".
                            'Nomor Surat Permohonan Penyidik: '.$post['nomorpermohonan']."\r\n". 
                            'Nama Tersangka: '.$dataTersangka->nama;

                $qrcode = $this->generateQRcode($dataQR);

                $postData = array(
                    'jenispenyitaan' => $post['jenispenyitaan'],
                    'counter' => $nopenetapan,
                    'nomorpenetapan' => $nopenetapanBaru,
                    'tglpermohonan' => $post['tglpermohonan'],
                    'idinstansi' => $post['idinstansi'],
                    'nomorpermohonan' => $post['nomorpermohonan'],
                    'idtersangka' => $post['idtersangka'],
                    'jenisperkara' => $post['jenisperkara'],
                    'pasalperkara' => $post['pasalperkara'],
                    'nomorlaporansita' => $post['nomorlaporansita'],
                    'tgllaporansita' => $post['tgllaporansita'],
                    'tglbasita' => $post['tglbasita'],
                    'deskripsipenyitaan' => $post['deskripsipenyitaan'],
                    'disitadari' => $post['disitadari'],
                    'qrcode' => $qrcode,
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );

                $this->penyitaan_model->add($postData);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('penyitaan');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('penyitaan');
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
            $this->form_validation->set_rules('nomorlaporansita', 'Nomor Laporan Sita', 'trim|required');
            $this->form_validation->set_rules('tgllaporansita', 'Tanggal Laporan Sita', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('tgllbasita', 'Tanggal BA Sita', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('deskripsipenyitaan', 'Barang yang disita', 'trim|required');
            $this->form_validation->set_rules('disitadari', 'Barang disita dari siapa', 'trim|required');
            $this->form_validation->set_rules('jenispenyitaan', 'Jenis Penyitaan', 'trim|required');

            $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
            $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
            $this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
            $this->form_validation->set_message('numeric', '{field} harus berisi numerik.');

            if ($this->form_validation->run() == FALSE){
				$data = array(
                    'active_menu' => 'penyitaan',
                    'page_title' => 'penyitaan',
                    'row' => $this->penyitaan_model->get($id)->row(),
                    'data_instansi' => $this->getInstansiDropdown(),
                    'data_tersangka' => $this->getTersangkaDropdown(),
                );
                $this->load->view('template', $data);
                $this->load->view('penyitaan/penyitaan-form-edit', $data);
			} else {

                $dataTersangka = $this->tersangka_model->get($post['idtersangka'])->row();
                $dataPenyitaanLama = $this->penyitaan_model->get($id)->row();
                $jenispenyitaantext = $post['jenispenyitaan'] == 1 ? 'Penetapan Izin Penyitaan' : 'Penetapan Persetujuan Penyitaan';

                $dataQR = 'Satuan Kerja: Pengadilan Negeri Kupang'."\r\n".
                            'Nomor Register: '.$dataPenyitaanLama->nopenetapan."\r\n". 
                            'Tanggal Register: '.date_indo_text(date("Y-m-d"))."\r\n".
                            'Jenis Penyitaan: '.$jenispenyitaantext."\r\n".
                            'Nomor Surat Permohonan Penyidik: '.$post['nomorpermohonan']."\r\n". 
                            'Nama Tersangka: '.$dataTersangka->nama;

                $qrcode = $this->generateQRcode($dataQR);

                $postData = array(
                    'jenispenyitaan' => $post['jenispenyitaan'],
                    'tglpermohonan' => $post['tglpermohonan'],
                    'idinstansi' => $post['idinstansi'],
                    'nomorpermohonan' => $post['nomorpermohonan'],
                    'idtersangka' => $post['idtersangka'],
                    'jenisperkara' => $post['jenisperkara'],
                    'pasalperkara' => $post['pasalperkara'],
                    'nomorlaporansita' => $post['nomorlaporansita'],
                    'tgllaporansita' => $post['tgllaporansita'],
                    'tglbasita' => $post['tglbasita'],
                    'deskripsipenyitaan' => $post['deskripsipenyitaan'],
                    'disitadari' => $post['disitadari'],
                    'qrcode' => $qrcode,
                    'created_at' => date("Y-m-d H:i:S"),
                    'updated_at' => date("Y-m-d H:i:S"),
                    'is_active' => 1
                );

                $this->penyitaan_model->update($postData, $id);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                    redirect('penyitaan');
                }
            }
        } else {
            $this->session->set_flashdata('notif_failed', 'Gagal Menyimpan Data. Tekan Tombol Submit!');
            redirect('penyitaan');
        }
    }

    public function delete($id){
        $id = decode_url($id);

        $data = array(
            'is_active' => 0,
            'updated_at' => date("Y-m-d H:i:S")
        );
        $this->penyitaan_model->update($data, $id);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
            redirect('penyitaan');
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

        $datapejabat = array(
            'namapejabat' => $pejabatName,
            'rolepejabat' => $pejabatRole
        );

        $datapenyitaan = $this->penyitaan_model->get($post['id'])->row();
        $dataTersangka = $this->tersangka_model->get($datapenyitaan->idtersangka)->row();

        if ($datapenyitaan->jenispenyitaan == 2 ){
            $this->generatePersetujuanSitaDocument($datapenyitaan, $dataTersangka, $datapejabat);
        } else {
            $this->generateIzinSitaDocument($datapenyitaan, $dataTersangka, $datapejabat);
        }
    }


    public function generatePersetujuanSitaDocument($datapenyitaan, $dataTersangka, $datapejabat){

        $fileName = strtr(
            $datapenyitaan->nomorpenetapan,
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
                'Nomor: '.$datapenyitaan->nomorpenetapan,
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

            $section->addText(htmlspecialchars("\t".$datapejabat['rolepejabat'].' Pengadilan Negeri Kupang Kelas 1A'), null, 
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Membaca surat dari '. $datapenyitaan->namainstansi. ' Nomor '.$datapenyitaan->nomorpermohonan .' tanggal '.date_indo_text($datapenyitaan->tglpermohonan).' mengenai telah dilakukannya penyitaan dengan alasan dalam keadaan yang sangat perlu dan mendesak atas benda-benda yang mempunyai hubungan langsung dengan tindak pidana "'.$datapenyitaan->jenisperkara.'" sebagaimana dimaksud dalam '.$datapenyitaan->pasalperkara.' yang diperlukan untuk kepentingan penyidikan dalam perkara Tersangka: '),
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

            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa berdasarkan laporan dari Penyidik '.$datapenyitaan->namainstansi.' Nomor '.$datapenyitaan->nomorlaporansita.' tanggal '.date_indo_text($datapenyitaan->tgllaporansita).' telah dilakukan penyitaan dengan alasan keadaan yang sangat perlu dan mendesak.'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa setelah mempelajari uraian singkat kejadian perkara dan Berita Acara Penyitaan maka penyitaan tersebut cukup alasan untuk disetujui.'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Memperhatikan Pasal 38 ayat (2) Undang-Undang Nomor 8 tahun 1981 tentang Hukum Acara Pidana.'),
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

            $section->addText(htmlspecialchars("\t".'Memberi persetujuan penyitaan berupa:'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t".$datapenyitaan->deskripsipenyitaan),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars('Yang telah disita dari '.$datapenyitaan->disitadari.' dilakukan oleh Penyidik '.$datapenyitaan->namainstansi.' sesuai Berita Acara Penyitaan tanggal '.date_indo_text($datapenyitaan->tglbasita).'.'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText();
            
            $table = $section->addTable();
           

            $cellRowSpan = array('vMerge' => 'restart');
            $cellRowContinue = array('vMerge' => 'continue');
            $cellColSpan = array('gridSpan' => 2);

            $table->addRow();
            $table->addCell(2000, $cellRowSpan)->addImage( base_url().'assets/images/'.$datapenyitaan->qrcode,
                    array(
                        'width'         => 100,
                        'height'        => 100,
                        'marginTop'     => -1,
                        'marginLeft'    => -1,
                        'wrappingStyle' => 'behind'
                    )
            );
            $table->addCell(1500, $cellRowSpan);
            $table->addCell(7000)->addText("Ditetapkan di	Kupang;");

            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(7000)->addText("Pada tanggal, ".date_indo_text(date('Y-m-d')));

            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(7000)->addText($datapejabat['rolepejabat'].' Pengadilan Negeri Kupang Kelas 1A');

            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(7000);

            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(7000);

            $table->addRow();
            $table->addCell(null, $cellRowContinue);
            $table->addCell(null, $cellRowContinue);
            $table->addCell(7000)->addText($datapejabat['namapejabat'], array('color' => '000000', 'bold' => true));


            

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header('Content-Type: application/msword');
        	header('Content-Disposition: attachment;filename="penyitaan-'. $fileName.'.docx"'); 
		    header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }


    public function generateIzinSitaDocument($datapenyitaan, $dataTersangka, $datapejabat){

        $fileName = strtr(
            $datapenyitaan->nomorpenetapan,
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
                'Nomor: '.$datapenyitaan->nomorpenetapan,
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

            $section->addText(htmlspecialchars("\t".$datapejabat['rolepejabat'].' Pengadilan Negeri Kupang Kelas 1A'), null, 
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Membaca surat dari '. $datapenyitaan->namainstansi. ' Nomor '.$datapenyitaan->nomorpermohonan .' tanggal '.date_indo_text($datapenyitaan->tglpermohonan).' mengenai telah dilakukannya penyitaan dengan alasan dalam keadaan yang sangat perlu dan mendesak atas benda-benda yang mempunyai hubungan langsung dengan tindak pidana "'.$datapenyitaan->jenisperkara.'" sebagaimana dimaksud dalam '.$datapenyitaan->pasalperkara.' yang diperlukan untuk kepentingan penyidikan dalam perkara Tersangka: '),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $table = $section->addTable();
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Nama');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->nama);
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Tempat, Tgl Lahir');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->tempatlahir.', '.date_indo_text($dataTersangka->tgllahir));
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Umur');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->umur.' tahun');
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Jenis Kelamin');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->jeniskelamintext);
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Suku, Kebangsaan');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->suku.', '.$dataTersangka->kebangsaan);
            $table->addRow();
            $table->addCell(1500);
            $table->addCell(2500)->addText('Pendidikan');
            $table->addCell(250)->addText(':');
            $table->addCell(7000)->addText($dataTersangka->pendidikantext);
            $table->addRow();
            $table->addCell(1500);
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

            
            $section->addText(htmlspecialchars("\t" .'Menimbang, bahwa berdasarkan uraian singkat kejadian perkara dan surat perintah penyitaan dari Penyidik '.$datapenyitaan->namainstansi.' Nomor '.$datapenyitaan->nomorlaporansita.' tanggal '.date_indo_text($datapenyitaan->tgllaporansita).' maka cukup beralasan untuk memberikan izin penyitaan.'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t" .'Memperhatikan Pasal 38 ayat (2) Undang-Undang Nomor 8 tahun 1981 tentang Hukum Acara Pidana.'),
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

            $section->addText(htmlspecialchars("\t".'Memberi persetujuan penyitaan berupa:'),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t".$datapenyitaan->deskripsipenyitaan),
                null,
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'both'
                )
            );

            $section->addText(htmlspecialchars("\t".'Memerintahkan kepada penyidik untuk melampirkan penetapan ini dalam berkas perkara yang bersangkutan.'),
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

            $section->addText(htmlspecialchars("\t\t\t\t\t".$datapejabat['rolepejabat'].' Pengadilan Negeri Kupang Kelas 1A'),
                array('color' => '000000', 'bold' => false),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addText();
            $section->addText();

            $section->addText(htmlspecialchars("\t\t\t\t\t".$datapejabat['namapejabat']),
                array('color' => '000000', 'bold' => true),
                array(
                    'space' => array('before' => 0, 'after' => 60), 
                    'align' => 'left'
                )
            );

            $section->addImage(
                base_url().'assets/images/'.$datapenyitaan->qrcode,
                array(
                    'width'         => 100,
                    'height'        => 100,
                    'marginTop'     => -1,
                    'marginLeft'    => -1,
                    'wrappingStyle' => 'behind'
                )
            );

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header('Content-Type: application/msword');
        	header('Content-Disposition: attachment;filename="izin-penyitaan-'. $fileName.'.docx"'); 
		    header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

}
