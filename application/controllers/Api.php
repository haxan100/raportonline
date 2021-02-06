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
		$GuruC= count($jmlGuru);
		$getVisi = $this->SekolahModel->visi()->result();
		$getMisi = $this->SekolahModel->misi()->result();

		$dataJML = array(
			'guru' =>15 ,
			'mapel' =>15 ,
			'siswa' =>105 ,
		 );
		 $data = array(
			 'jml' =>$dataJML ,
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
			'username' => $username,
			'password' => $password
		);
		$cek = $this->AdminModel->cek_login("admin", $where)->num_rows(); // cek admin
		$cekWali = $this->AdminModel->cek_login("wali_kelas", $where)->num_rows(); // cek walikelas
		$cekSiswa = $this->AdminModel->cek_login("siswa", $where)->num_rows(); // cek walikelas
		// var_dump($cekSiswa);die;

		if($cek>0){
			// echo "admin";/
			$r = $this->AdminModel->cek_login("admin", $where)->row();   
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'user' => "admin",
				'admin_session' => true, // Buat session authenticated dengan value true
				'id_user' => $r->id_user, // Buat session authenticated
				'nama' => $r->nama,

			);
			$this->session->set_userdata($data_session);
			$status = true;
			$message = 'Selamat datang sedang mengalihkan..';
		}else if($cekWali>0){
			// echo "guru";
			$r = $this->AdminModel->cek_login("wali_kelas", $where)->row();
			
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'user' => "guru",
				'admin_session' => true, // Buat session authenticated dengan value true
				'id_user' => $r->kode_wali, // Buat session authenticated
				'nama' => $r->nama_wali,
				'id_kelas' => $r->id_kelas,

			);
			$this->session->set_userdata($data_session);
			$status = true;
			$message = 'Selamat datang Wali Kelas <span class="font-weight-bold"> ' . $r->nama_wali . '</span>, sedang mengalihkan..';
		}else if($cekSiswa>0){
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
		$dt = $this->SiswaModel->getDetailSiswa($nisn);
		
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

	
    



}