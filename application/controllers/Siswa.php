<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');

		$this->load->helper('url');
	}

	public function isLoggedInAdmin()
	{
		if ($this->session->userdata('admin_session'))
		return true; // sudah login
		else
			return false; // belum login
	}

	public function index()
	{

		if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';

			redirect('login', 'refresh');

			exit();
		}
			if($_SESSION['user']=="siswa"){
			             
            echo '<script type="text/javascript">
                        alert("Siswa Tidak Dapat Memasuki Menu Ini...");
                    </script>';
			echo 'Siswa Tidak Dapat Memasuki Menu Ini!';
			redirect('dashboard', 'refresh');
			exit();

		}

		// var_dump($_SESSION);die;



		if($_SESSION['user']=='guru'){
			$id_kelasFromWali = $_SESSION['id_kelas'];
			// echo"helo";
			$data['listKelas'] = $this->SiswaModel->getKelasByid_kelas($id_kelasFromWali);
			$data['siswa'] = $this->SiswaModel->getSiswaByid_kelas($id_kelasFromWali);


		}else{
			$data['listKelas'] = $this->SiswaModel->getAllKelas();
			$data['siswa'] = $this->SiswaModel->siswa();
		}


		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();
		// var_dump($_SESSION);die;
	
		// var_dump($this->SiswaModel->siswa());die;
		
		$data['content']= 'siswa/data_siswa';

	
		$this->load->view('templates/index',$data);

	}
	public function ubah_siswa_proses()
	{

		// var_dump($this->input->post());die;
		$nisn = $this->input->post('nisn', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		// $id_tipe_bid = $this->input->post('tipeBid', TRUE);
		$jk = $this->input->post('jk', TRUE);
		$username = $this->input->post('usernames', TRUE);
		$password = $this->input->post('passwords', TRUE);

		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);

		$message = 'Gagal mengedit data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama_lengkap' => $nama,
			'tanggal_lahir' => $tanggal_lahir,
			'tempat_lahir' => $tempat_lahir,
			'jenkel' => $jk,
			'alamat' => $alamat,
			'id_kelas' => $kelas,
			'username' => $username,
			'password' => $password,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isSiswaAda($nisn)) == 1 ? true : false;
		$getNamaFotoOld= $this->SiswaModel->getFotoOld($nisn);
		// var_dump($getNamaFotoOld);die();

		$maxFoto = 5;
		$id_foto_hapus_array = array();
		if (!$produk_ada) {
			$status = false;
			// $errorInputs[] = array('#judul','Produk tersebut tidak ada di database!');
			$message .= '<br>Produk tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kelas) ) {
			$status = false;
			$errorInputs[] = array('#kelas', 'Silahkan pilih Kelas');
		}
		if (empty($alamat)) {
			$status = false;
			$errorInputs[] = array('#alamat', 'Silahkan isi Alamat');
		}
		// var_dump($_FILES['foto']['name']);die();tunggu

		if ($status) {

			if ($this->SiswaModel->edit_siswa($in, $nisn)) {

				$message = "Berhasil Mengubah Siswa #1";
				$cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
				// var_dump(!$cekFoto);die;
				if (!$cekFoto) {
					

					$_FILES['f']['name']     = $_FILES['foto']['name'];
					$_FILES['f']['type']     = $_FILES['foto']['type'];
					$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
					$_FILES['f']['error']     = $_FILES['foto']['error'];
					$_FILES['f']['size']     = $_FILES['foto']['size'];

					$config['upload_path']          = './upload/images/';
					$config['allowed_types']        = 'jpg|jpeg|png|gif';
					$config['max_size']             = 3 * 1024; // kByte
					$config['max_width']            = 10 * 1024;
					$config['max_height']           = 10 * 1024;
					$config['file_name'] = $nisn . "-" . date	("Y-m-d-H-i-s") . ".jpg";
					$this->load->library('image_lib');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);


					$this->image_lib->resize();
					// var_dump(!$this->upload->do_upload('f'));die;
					// Upload file to server

					if (!$this->upload->do_upload('f')) {
						$errorUpload = $this->upload->display_errors() . '<br>';
					} else {
						// Uploaded file data
						$fileName = $this->upload->data()["file_name"];
						$foto = array(
							'foto' => $fileName,
						);
						$this->SiswaModel->edit_siswa($foto, $nisn);
						unlink("./upload/images/$getNamaFotoOld");

						$message = "Berhasil Mengubah Siswa #1";
						
					}


					$inFoto = array(

						'foto' => $nameFoto = str_replace(' ', '_', $config['file_name']),
					);
					// $this->ProdukModel->update_spek_hp($inFoto, $nis );
				}


				}
	
			} else {
				$message = "Gagal Mengubah Siswa #1";
			}
		


		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusSiswa()
	{

		$nisn = $this->input->post('nisn', TRUE);

		$data = $this->SiswaModel->getSiswaByNisn($nisn);
		$status = false;

		$message = 'Gagal menghapus Siswa!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Siswa yang dimaksud.';
		}else{
			$this->SiswaModel->HapusSiswa($nisn);

			$status = true;
			$message = 'Berhasil menghapus Siswa: <b>' . $data[0]->nama_lengkap . '</b>';

		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));

	}
	public function tambah_siswa_proses()
	{
		$nisn = $this->input->post('nisn', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$jk = $this->input->post('jk', TRUE);
		$username = $this->input->post('usernames', TRUE);
		$password = $this->input->post('passwords', TRUE);
		// vra_dump()
		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);

		$message = 'Gagal menambah data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cekNISN= $this->SiswaModel->getUserBy('nisn',$nisn);
		$cekPWnU= $this->SiswaModel->getUserByUsername($username);

		if($cekNISN!=null){
			$status = false;
			$message = "NISN Sudah Pernah Terdaftar!";
			// die("sss");
		}	if($cekPWnU!=null){
			$status = false;
			$message = "Username Sudah Pernah Terdaftar!";
		}		
		if (empty($nama)) {
			$status = false;
			$message = "Nama Harus Di Isi!";
		}
		if (empty($kelas) or $kelas=='default') {
			$status = false;
			$message = "Kelas Harus Di Isi!";
		}
		if (empty($alamat)) {
			$status = false;
			$message = "Alamat Harus Di Isi!";
		}
		if (empty($password)) {
			$status = false;
			$message = "Password Harus Di Isi!";
		}
		if (empty($username)) {
			$status = false;
			$message = "Username Harus Di Isi!";
		}

		$cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
		// var_dump($cekFoto);die;
		if (!$cekFoto) {

			$_FILES['f']['name']     = $_FILES['foto']['name'];
			$_FILES['f']['type']     = $_FILES['foto']['type'];
			$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['f']['error']     = $_FILES['foto']['error'];
			$_FILES['f']['size']     = $_FILES['foto']['size'];
			$config['upload_path']          = './upload/images/';
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 3 * 1024; 
			$config['max_width']            = 10 * 1024;
			$config['max_height']           = 10 * 1024;
			$config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
			$this->load->library('image_lib');
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->image_lib->resize();

			if (!$this->upload->do_upload('f')) {
				$errorUpload = $this->upload->display_errors() . '<br>';
				$status = false;
				$errorInputs[] = array('#foto', $errorUpload);
			} else {
				// var_dump($status);die;
				if($status){
					// Uploaded file data
					$fileName = $this->upload->data()["file_name"];
					$foto = array(
						'foto' => $fileName,
					);
					$in = array(
						'foto' => $fileName,
						'nisn' => $nisn,
						'nama_lengkap' => $nama,
						'tanggal_lahir' => $tanggal_lahir,
						'tempat_lahir' => $tempat_lahir,
						'jenkel' => $jk,
						'alamat' => $alamat,
						'id_kelas' => $kelas,
						'username' => $username,
						'password' => $password,
					);
				$this->SiswaModel->tambah_siswa($in);

				$message = "Berhasil Menambah Siswa #1";
				}
			}
		} else {
			$message = "Harap Upload Foto!";
			$status = false;
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));








	}

	public function Kelas()
	{
		if (!$this->isLoggedInAdmin()) {
			echo 'Anda Harus Login!';
			exit();
		}
		if($_SESSION['user']=="siswa"){
			             
            echo '<script type="text/javascript">
                        alert("Siswa Tidak Dapat Memasuki Menu Ini...");
                    </script>';
			echo 'Siswa Tidak Dapat Memasuki Menu Ini!';
			redirect('dashboard', 'refresh');
			exit();

		}
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['content'] = 'siswa/data_kelas';
		$this->load->view('templates/index', $data);

	}
	public function tambah_kelas_proses()
	{
		$nama = $this->input->post('nama', TRUE);

		$message = 'Gagal menambah data Kelas!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek_kelas = $this->SiswaModel->getKelasByNama($nama);
		// var_dump(count($cek_kelas) > 1);die;
		if(count($cek_kelas) > 1){
			$message = 'Kelas Sudah Ada!';
			// die;
			$status = false;
		}else{
		
				$in = array(
					
					'nama_kelas' => $nama,
					
				);
				$this->SiswaModel->tambah_kelas($in);

				$message = "Berhasil Menambah Kelas #1";
				$status = true;

			}
		
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function getAllKelas()
	{

		if (!$this->isLoggedInAdmin()) {

			echo '403 Forbidden!';

			exit();
		}
		// var_dump($_SESSION);die;
		if($_SESSION['user']=='guru'){
			$id_kelasFromWali= $_SESSION['id_kelas'];
			$dt = $this->SiswaModel->data_AllKelasByKelas($_POST,$id_kelasFromWali);
		}else{

			$dt = $this->SiswaModel->data_AllKelas($_POST);
		}

		$bu = base_url();
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;

		$datatable['recordsTotal']    = $dt['totalData'];

		$datatable['recordsFiltered'] = $dt['totalData'];

		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;

		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {
			

			$fields = array($no++);

			$fields[] = $row->id_kelas . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '

       	 <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-id_kelas="'.$row->id_kelas.' " data-nama="'. $row->nama_kelas . '" ></i> Ubah</button>
		
        <button class="btn btn-round btn-danger hapus" data-id_kelas="'.$row->id_kelas.'" data-nama="'. $row->nama_kelas. '"
		>Hapus</button>            

    

        ';
		// 	$fields[] = '

       	//  <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-id_kelas="'.$row->id_kelas.' " data-nama="'. $row->nama_kelas . '" ></i> Ubah</button>
			
		//   <button class="btn btn-round btn-primary btn_lihat fa fa-users " data-id_kelas="' . $row->id_kelas . '" data-nama="' . $row->nama_kelas . '"
		// > Lihat Siswa</button>   
		
        // <button class="btn btn-round btn-danger hapus" data-id_kelas="'.$row->id_kelas.'" data-nama="'. $row->nama_kelas. '"
		// >Hapus</button>            

    

        // ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function getAllSiswa()
	{
		// var_dump($_SESSION);die;

		if ($_SESSION['user'] == 'guru') {
			$id_kelasFromWali = $_SESSION['id_kelas'];
			$dt = $this->SiswaModel->data_AllSiswaByKelas($_POST,$id_kelasFromWali);
			// var_dump($id_kelasFromWali);die;
	
		} else {

			$dt = $this->SiswaModel->data_AllSiswa($_POST);
	
		}

		$bu = base_url();


		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;

		$datatable['recordsTotal']    = $dt['totalData'];

		$datatable['recordsFiltered'] = $dt['totalData'];

		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;

		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {


			$fields = array($no++);

			$fields[] = $row->nisn . '<br>';
			$fields[] = $row->nama_lengkap . '<br>';
			$fields[] = $row->tanggal_lahir . '<br>';
			$fields[] = $row->tempat_lahir . '<br>';
			$fields[] = $row->jenkel . '<br>';
			$fields[] = $row->alamat . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '<img src="upload/images/'.$row->foto . '" id="image" alt="image"><br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" 
			data-nisn="'.$row->nisn.'" 
			data-nama="' . $row->nama_lengkap . '" 
			data-tanggal_lahir="' . $row->tanggal_lahir . '" 
			data-jen="' . $row->jenkel . '" 
			data-kelas="' . $row->nama_kelas . '" 
			data-id_kelas="' . $row->id_kelas . '" 
			data-foto="' . $row->foto . '" 
			data-alamat="' . $row->alamat . '" 
			data-username="' . $row->username . '" 
			data-password="' . $row->password . '" 
			data-tempat_lahir="' . $row->tempat_lahir . '" 
			
			
			
			
			></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-nisn="' . $row->nisn . '" data-nama="' . $row->nama_lengkap . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_kelas()
	{
		// var_dump($this->input->post());die;
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$message = 'Gagal mengedit data Kelas!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama_kelas' => $nama,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isKelasAda($kelas)) == 1 ? true : false;
		
		if (!$produk_ada) {
			$status = false;
			$message .= '<br>Kelas tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}

		if ($status) {

			if ($this->SiswaModel->edit_kelas($in, $kelas)) {

				$message = "Berhasil Mengubah Kelas #1";
			}

			
		} else {
			$message = "Gagal Mengubah Siswa #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusKelas()
	{
		// var_dump($this->input->post());die;

		$id_kelas = $this->input->post('id_kelas', TRUE);

		$data = $this->SiswaModel->getKelasByid_kelas($id_kelas);
		$status = false;

		$message = 'Gagal menghapus Kelas!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Kelas yang dimaksud.';
		} else {
			$this->SiswaModel->HapusKelas($id_kelas);

			$status = true;
			$message = 'Berhasil menghapus Kelas: <b>' . $data[0]->nama_kelas . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function Mapel()
	{
		if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';

			exit();
		}
			if($_SESSION['user']=="siswa"){
			             
            echo '<script type="text/javascript">
                        alert("Siswa Tidak Dapat Memasuki Menu Ini...");
                    </script>';
			echo 'Siswa Tidak Dapat Memasuki Menu Ini!';
			redirect('dashboard', 'refresh');
			exit();

		}

		if ($_SESSION['user'] == "guru") {
			$getKelasFromSess =  $_SESSION['id_kelas'];

			$data['listKelas'] = $this->SiswaModel->getKelasByid_kelas($getKelasFromSess);
		}else{

			$data['listMapel'] = $this->SiswaModel->getAllMapel();
			$data['listKelas'] = $this->SiswaModel->getAllKelas();
		}

		
		// var_dump($data['listKelas']);die;
		$data['content'] = 'siswa/data_mapel';


		$this->load->view('templates/index', $data);
	}
	public function getAllMapel()

	{

		if ($_SESSION['user'] == "guru") {
			$getKelasFromSess =  $_SESSION['id_kelas'];
			$dt = $this->SiswaModel->data_AllMapellByIdKelas($_POST, $getKelasFromSess);


		}else{

			$dt = $this->SiswaModel->data_AllMapel($_POST);
		}

		$bu = base_url();

		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;

		$datatable['recordsTotal']    = $dt['totalData'];

		$datatable['recordsFiltered'] = $dt['totalData'];

		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;

		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {


			$fields = array($no++);

			$fields[] = $row->kode_mapel . '<br>';
			$fields[] = $row->nama_mapel . '<br>';
			$fields[] = $row->kkm . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '

       	 <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-kode_mapel="' . $row->kode_mapel . ' " data-nama="' . $row->nama_mapel . '" data-kkm="' . $row->kkm . '" data-id_kelas="' . $row->id_kelas . '" ></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-kode_mapel="' . $row->kode_mapel . '" data-nama="' . $row->nama_mapel . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_mapel()
	{

		// var_dump($this->input->post());die;
		$nama = $this->input->post('nama', TRUE);
		$kode_mapel = $this->input->post('kode_mapel', TRUE);
		$kkm = $this->input->post('kkm', TRUE);
		$id_kelas = $this->input->post('kelas', TRUE);

		$message = 'Gagal mengedit data Mapel!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama_mapel' => $nama,
			'kkm' => $kkm,
			'id_kelas' => $id_kelas,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isMapelAda($kode_mapel)) == 1 ? true : false;
		// var_dump($produk_ada);die();


		if (!$produk_ada) {
			$status = false;
			$message .= '<br>Kelas tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kkm)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi KKM');
		}

		if ($status) {

			if ($this->SiswaModel->edit_mapel($in, $kode_mapel)) {

				$message = "Berhasil Mengubah Mapel #1";
			}
		} else {
			$message = "Gagal Mengubah Mapel #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function tambah_mapel_proses()
		{
		$nama = $this->input->post('nama', TRUE);
		$kkm = $this->input->post('kkm', TRUE);
		$kelas = $this->input->post('kelas', TRUE);

		$message = 'Gagal menambah data Mapel!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek_kelas = $this->SiswaModel->getMapelByNama($nama,$kelas);
		// var_dump(count($cek_kelas));die;
		if (count($cek_kelas) >= 1) {
			$message = 'Mapel Sudah Ada!';
			// die;
			$status = false;
		} else {

			$in = array(

				'nama_mapel' => $nama,
				'kkm' => $kkm,
				'id_kelas' => $kelas,

			);
			$this->SiswaModel->tambah_mapel($in);

			$message = "Berhasil Menambah Mapel #1";
			$status = true;
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusMapel()
	{
		// var_dump($this->input->post());die;

		$kode_mapel = $this->input->post('kode_mapel', TRUE);

		$data = $this->SiswaModel->getMapelByid($kode_mapel);
		// var_dump($data);die;
		$status = false;

		$message = 'Gagal menghapus Mapel!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Mapel yang dimaksud.';
		} else {
			$this->SiswaModel->HapusMapel($kode_mapel);

			$status = true;
			$message = 'Berhasil menghapus Mapel: <b>' . $data[0]->nama_mapel . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function downloadTemplateHarga()

	{$this->load->helper('download');


		// Use it when necessary

		$sFileName = 'assets/template/kelas.xlsx'; 
		force_download($sFileName, NULL);
	}
	public function tambah_materi_proses()
	{
	   // var_dump($this->input->post());die;
		$kelas = $this->input->post('kelas', TRUE);
		$mapel = $this->input->post('mapelInput', TRUE);
		$materi = $this->input->post('materi', TRUE);
		$link = $this->input->post('link', TRUE);
		$statusInput = $this->input->post('status', TRUE);
		$message = 'Gagal menambah data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		if (empty($materi)) {
			$status = false;
			$message = "Nama Harus Di Isi!";
		}
		if (empty($kelas) or $kelas=='default') {
			$status = false;
			$message = "Kelas Harus Di Isi!";
		}
		if (empty($mapel)) {
			$status = false;
			$message = "Alamat Harus Di Isi!";
		}
		if (empty($link)) {
			$status = false;
			$message = "Password Harus Di Isi!";
		}
		var_dump($status);die;
		if($status){			
			$now = date	("Y-m-d H-i-s");	
				$in = array(
					'id_mapel' => $mapel,
					'id_kelas' => $kelas,
					'materi' => $materi,
					'link' => $link,
					'status' => $statusInput,
					'created_at' => $now,
				);
			$this->SiswaModel->tambah_materi($in);
			$message = "Berhasil Menambah Materi #1";
		}else{
			$message = "Gagal Menambah Materi!";
			$status = false;			
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));

	}

		public function ubah_materi()
	{
        //var_dump($this->input->post());die;
		$id_materi = $this->input->post('id_materi', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$mapel = $this->input->post('mapelInput', TRUE);
		$materi = $this->input->post('materi', TRUE);
		$link = $this->input->post('link', TRUE);
		$statusInput = $this->input->post('status', TRUE);

		$message = 'Gagal mengedit Materi!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'id_mapel' => $mapel,
			'id_kelas' => $kelas,
			'materi' => $materi,
			'link' => $link,
			'status' => $statusInput,
		);	
		// var_dump($in);die;
		if (empty($id_materi)) {
			$status = false;
		}
		if (empty($kelas)) {
			$status = false;
		}
		if (empty($mapel)) {
			$status = false;
		}
		if (empty($materi)) {
			$status = false;
		}
		if (empty($link)) {
			$status = false;
		}
		// var_dump($status);die;
		if ($status) {
				if ($this->SiswaModel->edit_materi($in, $id_materi)) {
					$message = "Berhasil Mengubah Materi #1";
				}else{
					$message = "Gagal #1";
				}	
			} else {
				$message = "Gagal Mengubah Materi. Harap DiIsi Semua  Field #1";
			}


		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}






}
