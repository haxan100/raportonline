<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');
		$this->load->model('GuruModel');
		
		$this->load->model('AdminModel');
		$this->load->model('SekolahModel');

		$this->load->helper('url');
    }
  	public function getJumlah()
	{
        $jmlGuru = $this->GuruModel->GuruAll()->result();
		$GuruC= count($jmlGuru);
		$data = array(
			'guru' =>15 ,
			'mapel' =>15 ,
			'siswa' =>105 ,
		 );
        $status=  true ;
        // var_dump();die;
		echo json_encode(array(
			'status' => $status,
			'data' => $data,
		));
	}
	  	public function getVisiMisi()
	{
        $jmlGuru = $this->GuruModel->GuruAll()->result();
        $jmlSiswa = $this->SiswaModel->SiswaAll()->result();
        $jmlMapel = $this->SiswaModel->MapelAll()->result();
		$GuruC= count($jmlGuru);
		$SiswaC= count($jmlSiswa);
		$MapelC= count($jmlMapel);
		// var_dump($MapelC);die;
		$getVisi = $this->SekolahModel->visi()->result();
		$getMisi = $this->SekolahModel->misi()->result();

		$dataGuru = array(
			"0" => array( 
				"id" => 1, 
				"nama" => 'Siswa', 
				"jumlah" => $SiswaC, 
			), 
			"1" => array( 				
					"id" => 1, 
					"nama" => 'Guru', 
					"jumlah" => $GuruC, 
			), 
			"2" => array( 
				"id" => 1, 
				"nama" => 'Mapel', 
				"jumlah" => $MapelC, 
			), 

		 );

		 $dataMapel = array(
			'id' =>2 ,
			'jumlah' =>209 ,
			'nama' =>'mapel' ,
		 );
		 $dat = array(
			 '1' =>$dataMapel ,
			 '2' =>$dataGuru ,
			 );
		 

		 $data = array(
			 'jml' =>$dataGuru ,
			 'visi' =>$getVisi ,
			 'misi' =>$getMisi ,
		 );

        $status=  true ;
        // var_dump();die;
		echo json_encode(array(
			'status' => $status,
			'data' => $data,
		));
	}
		public function login_proses()

	{
		// var_dump($_POST);die;
		$this->load->library('form_validation');
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$where = array(
			'nisn' => $username,
			'password' => $password
		);
		// $cek = $this->AdminModel->cek_login("admin", $where)->num_rows(); // cek admin
		// $cekWali = $this->AdminModel->cek_login("wali_kelas", $where)->num_rows(); // cek walikelas
		$cekSiswa = $this->AdminModel->cek_login("siswa", $where)->num_rows(); // cek walikelas

		 if($cekSiswa>0){
			// echo "guru";
			$r = $this->AdminModel->cek_login("siswa", $where)->row();
			// var_dump($r);die;
			$data_session = array(
				'nama' => $r->nama_lengkap,
				'status' => "login",
				'user' => "siswa",
				'admin_session' => true, // Buat session authenticated dengan value true
				'id_user' => $r->nisn, // Buat session authenticated
				'nisn' => $r->nisn, // Buat session authenticated
				'id_kelas' => $r->id_kelas,
				'foto' => $r->foto,
			);
			$this->session->set_userdata($data_session);
			$status = true;
			$message = 'Selamat datang Siswa sedang mengalihkan..';
		}

		 else {
			$status = false;
			$message = 'Username Dan Password  Salah!';
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,

		));
	}
		public function getDetailNilaiSiswa()
	{
		$nisn = $_POST['nisn'];
		
		$status =true;
		$dt = $this->SiswaModel->getNilaiSiswaForAPI($nisn);
		
		// var_dump(json_encode($dt));die;
		echo json_encode(array(
			'status' => $status,
			'data' => $dt,

		));
		die;
		// $datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		// $datatable['recordsTotal']    = $dt['totalData'];
		// $datatable['recordsFiltered'] = $dt['totalData'];
		// $datatable['data']            = array();
		// $start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// // var_dump($dt['data']->result());die();

		// $no = $start + 1;

		// foreach ($dt['data']->result() as $row) {

		// 	// var_dump(intVal($row->nilai));die;
		// 	// $keterangan = "";
		// 	// if (intVal($row->nilai) < intVal($row->kkm)) {
		// 	// 	$keterangan = "<B> Belum Lulus</B>";
		// 	// } else {
		// 	// 	$keterangan = 'Lulus';
		// 	// }

		// 	$fields = array($no++);

		// 	$fields[] = $row->nama_kelas . '<br>';
		// 	$fields[] = $row->nama_mapel . '<br>';
		// 	$fields[] = $row->nilai_harian . '<br>';
		// 	$fields[] = $row->nilai_uts . '<br>';
		// 	$fields[] = $row->nilai_uas . '<br>';
		// 	$fields[] = $row->nilai_pengetahuan . '<br>';
		// 	$fields[] = $row->nilai_karakter . '<br>';
		// 	$fields[] = $row->keterangan . '<br>';
		// 	$fields[] = '

		// 	<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" 
		// 	data-nisn="' . $row->nisn . '" 
		// 	data-id_nilai="' . $row->id_nilai . ' " 
		// 	data-kode_mapel="' . $row->kode_mapel . '" 
		// 	data-nama_mapel="' . $row->nama_mapel . ' " 
		// 	data-nilai_harian="' . intVal($row->nilai_harian) . '" 
		// 	data-nilai_uts="' . $row->nilai_uts . '" 
		// 	data-nilai_uas="' . $row->nilai_uas . '" 
		// 	data-nilai_pengetahuan="'.$row->nilai_pengetahuan.'" 
		// 	data-nilai_karakter="' . $row->nilai_karakter . '" 
		// 	data-keterangan="' . $row->keterangan . '" 			
		// 	data-nama="' . $row->nama_lengkap . '"
			
			
		// 	></i> Ubah</button>

		// <button class="btn btn-round btn-danger hapus" data-id_nilai="' . $row->id_nilai . '" 
		// data-nama_mapel="' . $row->nama_mapel . '" 
		
        // >Hapus</button>               

        // ';
		// 	$datatable['data'][] = $fields;
		// }



		echo json_encode($datatable);

		exit();
	}
	public function getSess()
	{
		var_dump($_SESSION);
		# code...
	}
		public function getDetailDataSiswa()
	{
		$nisn = $_POST['nisn'];
		
		$status =true;
		$dt = $this->SiswaModel->getDetailSiswaSatu($nisn);
		
		// var_dump(json_encode($dt));die;
		echo json_encode(array(
			'status' => $status,
			'data' => $dt,

		));
			die;
	}
		public function getAllGuru()
	{
		
		
		$status =true;
		$dt = $this->GuruModel->GuruAllForStudent()->result();
		echo json_encode(array(
			'status' => $status,
			'data' => $dt,

		));
			die;
	}
		public function getAllSiswa()
	{	
		
		$status =true;
		$dt = $this->SiswaModel->getAllSiswaForStuden()->result();
		echo json_encode(array(
			'status' => $status,
			'data' => $dt,

		));
			die;
	}
		public function getAllMapel()
	{	
		
		$status =true;
		$dt = $this->SiswaModel->getAllMapelForStudent()->result();
		echo json_encode(array(
			'status' => $status,
			'data' => $dt,

		));
			die;
	}


	
    



}