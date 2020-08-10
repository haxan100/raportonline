<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfig extends CI_Controller {
		public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');
		$this->load->model('WaliModel');
		$this->load->model('KonfigModel');

		$this->load->helper('url');
	}
	public function index()
	{
		$data['content'] = 'konfig/Konfigurasi';
		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();

		$this->load->view('templates/index', $data);
		
	}
	public function getAllKonfig()
	{
		$bu = base_url();
		$dt = $this->KonfigModel->data_Sekolah($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->nama . '<br>';
			$fields[] = $row->alamat . '<br>';
			$fields[] = $row->no_telp . '<br>';
			$fields[] = $row->kepala_sekolah . '<br>';
			$fields[] = $row->deskripsi . '<br>';
			$fields[] =  '<img class="img-fluid" id="foto_wrapper" src="' . $bu . '/assets/images/' . $row->logo . ' "/> ';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit_det"  data-toggle="modal" data-target=".bs-example-modal-lg" 
			data-nama="' . $row->nama . '" data-alamat="' . $row->alamat . '" 
			data-no_telp="' . $row->no_telp . '" 
			data-kepala_sekolah="' . $row->kepala_sekolah . '" 
			data-deskripsi="' . $row->deskripsi . '" 
			></i> Ubah</button>            

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_konfig_proses()
	{

		// var_dump($this->input->post());die;
		// var_dump($_FILES);die;

		$newID = "logo";

		$_FILES['f']['name']     = $_FILES['foto']['name'];
		$_FILES['f']['type']     = $_FILES['foto']['type'];
		$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
		$_FILES['f']['error']     = $_FILES['foto']['error'];
		$_FILES['f']['size']     = $_FILES['foto']['size'];

		$config['upload_path']          = './assets/images/';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['overwrite']        = TRUE;
		$config['remove_space'] = TRUE;
		$config['max_size']             = 3 * 1024; // kByte
		$config['max_width']            = 10 * 1024;
		$config['max_height']           = 10 * 1024;
		$config['file_name'] = $newID .".png";
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		$this->upload->initialize($config);

		// $this->upload->do_upload('foto');

		// var_dump($this->upload->do_upload('f')); 

		// die;



		// var_dump($config['file_name']);die;

		$nameFoto = $config['file_name'];
		// foto akhir

		$nameFoto = str_replace(' ', '_', $nameFoto);

		if ($this->upload->do_upload('f')) {

			// Gagal

			$error = false;

			// echo "gagal";
			// die;

		} else {

			//  berhasil

			// echo "berhasil";

			$error = false;

			$fileName = $this->upload->data()["file_name"];



			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			// die;
		}


		$nama_sekolah = $this->input->post('nama_sekolah', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$no_telp = $this->input->post('no_telp', TRUE);
		$kepala_sekolah = $this->input->post('kepala_sekolah', TRUE);
		$deskripsi = $this->input->post('Deskripsi', TRUE);
		$message = 'Gagal mengedit data Deskripsi Sekolah!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama' => $nama_sekolah,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'kepala_sekolah' => $kepala_sekolah,
			'deskripsi' => $deskripsi,
		);

		if (empty($nama_sekolah)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama Sekolah');
		}
		if (empty($alamat)) {
			$status = false;
			$errorInputs[] = array('#alamat', 'Silahkan Isi Alamat');
		}
		if (empty($no_telp)) {
			$status = false;
			$errorInputs[] = array('#no_telp', 'Silahkan Isi No Telp');
		}
		if (empty($deskripsi)) {
			$status = false;
			$errorInputs[] = array('#deskripsi', 'Silahkan Isi Deskripsi');
		}

		if ($status) {

			if ($this->KonfigModel->edit_konfig($in)) {

				$message = "Berhasil Mengubah Data Sekolah #1";
			}
		} else {
			$message = "Gagal Mengubah Data sekolah #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}

	








}
