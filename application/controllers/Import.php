<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require 'vendor/autoload.php';
require APPPATH . '/third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');
		// $this->load->model('BidModel');
		// $this->load->model('ProdukModel');
		// $this->load->model('UserModel');
		// $this->load->library('image_lib');
	}



	public function import_spek_hp()
	{
		// Load plugin PHPExcel nya
		// include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$berhasil = 0;
		$excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');

		// var_dump(($_FILES['fileURL']['name']));die;

		if (!empty($_FILES['fileURL']['name'])) {
			// get file extension
			$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
			$berhasil = 0;

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
			// var_dump($spreadsheet);die;
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			// array Count
			$arrayCount = count($allDataInSheet);
			$hasilRow = $arrayCount - 1;
			$ugagal = "";
			$duplicateuser = '';
			$duplicateCount = 0;
			// var_dump($arrayCount);die;
			$numrow = 1; // untuk mengecek duplikat 

			foreach ($allDataInSheet as $row) {

				// var_dump($row);die;
				if ($numrow > 1) {
					// var_dump($row);die;
					$cek = $this->db->query("SELECT * FROM `spek_handphone` where merk= '" . $row['A'] . "' AND model= '" . $row['B'] . "'  AND ram= '" . $row['E'] . "' AND storage= '" . $row['F'] . "' ");

					// 	var_dump($this->db->last_query());
					// die;

					$hasil = count($cek->result());

					// var_dump($hasil);
					// die;

					if ($hasil >= 1) {
						$duplicateCount++;
						$duplicateuser .= $row['A']."/".$row['B'] . "/" . $row['E'] . "/" . $row['F'] .  ",	 ";
					}
				}
				$numrow++;
			}
			if ($duplicateCount >= 1) {
				$numrow = 1;
				$this->session->set_flashdata('flash_data', "Error.: <br> $duplicateCount Spesifikasi HP terdapat duplikat! <br> $duplicateuser");
			} else {
				$numrow = 1;
				foreach ($allDataInSheet as $row) {
					if ($numrow > 1) {					
						$data = array(
							'merk' => $row['A'], 
							'model' => $row['B'],
							// 'screen_size' => $row['C'] ,
							// 'screen_resolution' => $row['D'],
							'back_camera' => $row['C'],
							'front_camera' => $row['D'],
							// 'os' => $row['G'],
							'ram' => $row['E'],
							'storage' => $row['F'],
							// 'color' => $row['J']	  	  	  	  
						);
						// var_dump($data);
						// die;	
						$this->ProdukModel->tambah_spek_hp($data);

						$this->session->set_flashdata('flash_data', "$hasilRow  Spesifikasi Handphone berhasil di import.");


						$sukses =true;

						
						


						//   var_dump($data);die;
						$this->load->view('admin/master_spek_hp', $data);


					}
					$numrow++;
				}
			}
			if($sukses){
				$id_admin = $this->session->userdata('id_admin');

						$aksi = 'Import Spek Hp';
						$id_kategori = 31;
						$this->AdminModel->log($id_admin, $id_kategori, $aksi);
			}

		}

		redirect("admin/master_spek_hp"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
	public function import_harga()
	{
		$berhasil = 0;
		$excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');
		$message = 'Gagal menambah data Kelas!<br>Silahkan lengkapi data yang diperlukan.';
		// var_dump($id_master_harga_awal);die;
		if (!empty($_FILES['fileURL']['name'])) {
			// get file extension
			$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
			$berhasil = 0;

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
			// var_dump($spreadsheet);die;
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			// array Count
			$arrayCount = count($allDataInSheet);
			$hasilRow = $arrayCount - 1;
			$ugagal = "";
			$duplicateuser = '';
			$duplicateCount = 0;
			// var_dump($arrayCount);die;
			$numrow = 1; // untuk mengecek duplikat 

			foreach ($allDataInSheet as $row) {

				// var_dump($row);die;
				if ($numrow > 1) {
					// var_dump($row);die;
					$cek = $this->db->query("SELECT * FROM `kelas` where 
					
					nama_kelas= '" . $row['B'] . "'  ");
					$hasil = count($cek->result());
					// var_dump($cek->result());
					// die;
					if ($hasil >= 1) {
						$duplicateCount++;
						$duplicateuser .= $row['B'] ;
					}
				}
				$numrow++;
			}
			if ($duplicateCount >= 1) {
				$numrow = 1;
				$message = 'Gagal menambah data Kelas!<br>Duplikat.';
				$status = false;
				$this->session->set_flashdata('flash_error', "Error.: <br> $duplicateCount Kelas terdapat duplikat! <br> $duplicateuser");
				$this->session->set_flashdata('flash_oke', "$hasilRow Kelas berhasil di import.");

			

			} else {
				$numrow = 1;
				foreach ($allDataInSheet as $row) {
					if ($numrow > 1) {

						$data['ci'] = $this;	
						$data = array(
							
							'nama_kelas' => $row['B'],
						);
						// var_dump($data);
						// die;	
						$this->SiswaModel->tambah_kelas($data);
						$message = 'Berhasil menambah data Kelas!';
						$this->session->set_flashdata('flash_oke', "$hasilRow Kelas berhasil di import.");

						$status = true;
						//   var_dump($data);die;
						// $this->load->view('siswa/kelas', $data);
					}
					$numrow++;
				}
				
			}
			redirect("siswa/kelas"); 
			

		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			// 'errorInputs' => $errorInputs
		));
		// var_dump("hhhh");die;
		$data['ci'] = $this;	
		redirect("siswa/kelas"); 
		
	}

}
