<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');
		$this->load->model('GuruModel');
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
		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listGuru'] = $this->WaliModel->listAllGuru();
		
		
		$data['content']= 'wali/data_wali';

	
		$this->load->view('templates/index',$data);

	}
	public function getAllWali()
	{
		$bu = base_url();
		$dt = $this->WaliModel->data_AllWali($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->kode_wali . '<br>';
			$fields[] = $row->nama_wali . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-id_wali_kelas="' . $row->id_wali_kelas. '" data-kode_wali="' . $row->kode_wali . '" 
			data-id_kelas="' . $row->id_kelas . '" 
			data-username="' . $row->username . '" 
			data-password="' . $row->password . '" 
			></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-id_wali_kelas="' . $row->id_wali_kelas . '" data-nama="' . $row->nama_wali . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_wali_proses()
	{

		// var_dump($this->input->post());die;
		// $nama = $this->input->post('nama', TRUE);
		$nik = $this->input->post('nik', TRUE);
		
		$nama =  $this->WaliModel->getGuruByRealNik($nik)[0]->nama_guru;

		$kelas = $this->input->post('kelas', TRUE);
		$kode_wali = $this->input->post('kode_wali', TRUE);
		$username = $this->input->post('usernames', TRUE);
		$password = $this->input->post('passwords', TRUE);
		$message = 'Gagal mengedit data Wali!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'id_kelas' => $kelas,
			'nama_wali' => $nama,
			'username' => $username,
			'password' => $password,
		);
		
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kelas)) {
			$status = false;
			$errorInputs[] = array('#kelas', 'Silahkan Isi Kelas');
		}
		if (empty($username)) {
			$status = false;
			$errorInputs[] = array('#username', 'Silahkan Isi Username');
		}
		if (empty($password)) {
			$status = false;
			$errorInputs[] = array('#password', 'Silahkan Isi Password');
		}

		if ($status) {

			if ($this->WaliModel->edit_wali($in, $nik)) {

				$message = "Berhasil Mengubah Wali Kelas #1";
			}
		} else {
			$message = "Gagal Mengubah Wali Kelas #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function tambah_wali_proses()
	{
		// $nama = $this->input->post('nama', TRUE);
		// var_dump(empty($password));die;
		// var_dump($this->input->post());die;
		$nik = $this->input->post('nik', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$username = $this->input->post('usernames', TRUE);
		$password = $this->input->post('passwords', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek = $this->WaliModel->getWaliByNikAndKelas($nik,$kelas);
		$cekPass = $this->WaliModel->getWaliByNikAndPass($nik,$password);
		// var_dump($cek);die;
		$nama =  $this->WaliModel->getGuruByRealNik($nik)[0]->nama_guru;
		// var_dump(count($cek)>=1);die;
		if (count($cek) >= 1) {
			$message = 'Wali Kelas Sudah Ada!';
			$status = false;
		}else if (count($cekPass) >= 1) {
			$message = 'Guru Sudah Pernah Daftar Wali kelas dengan password yang sama , mohon di bedakan!';
			$status = false;
		}else 
		if($nik==0){
			$message = 'Guru harus di pilih!';
			$status = false;
		}else if($kelas=='default'){
			$message = 'Kelas harus di pilih!';
			$status = false;
		}else if(empty($password)){
			$message = 'Password harus di isi!';
			$status = false;
		}else	if(empty($username)){
			$message = 'Username harus di isi!';
			$status = false;
		}else {

			$in = array(

				'id_kelas' => $kelas,
				'kode_wali' => $nik,
				'nama_wali' => $nama,
				'password' => $password,
				'username' => $username,

			);
			$this->WaliModel->tambah_Wali($in);

			$message = "Berhasil Menambah Wali Kelas #1";
			$status = true;
		}
	

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusWali()
	{
		// var_dump($this->input->post());die;

		$kode_wali = $this->input->post('id_wali_kelas', TRUE);

		$data = $this->WaliModel->getWaliById($kode_wali);
		$status = false;

		$message = 'Gagal menghapus Wali Kelas!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Wali Kelas yang dimaksud.';
		} else {
			$this->WaliModel->HapusWali($kode_wali);

			$status = true;
			$message = 'Berhasil menghapus Wali Kelas: <b>' . $data[0]->nama_wali . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function Guru()
	{
		if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';
			 redirect('login'); 

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
		$data['listWali'] = $this->WaliModel->index();


		$data['content'] = 'guru/data_guru';


		$this->load->view('templates/index', $data);
	}
	public function getMapelFromKelas()
	{
		$all = $this->WaliModel->getAllMapelFromKelas($_POST['kelas']);

		$lists = "<option value=''>Pilih</option>";

		foreach ($all as $data) {
			$lists .= "<option value='" . $data->kode_mapel . "'>" . $data->nama_mapel . "</option>"; // Tambahkan tag option ke variabel $lists
		}

		$callback = array('list_kota' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
		echo json_encode($callback);
		// var_dump($all);die;
		# code...
	}
	public function tambah_guru_proses()
	{
		// var_dump($_POST);die;
		$nik = $this->input->post('nik', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$mapel = $this->input->post('mapel', TRUE);
		// $username = $this->input->post('usernames', TRUE);
		// $password = $this->input->post('passwords', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);
		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		// $pass = md5($password);
		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek = $this->WaliModel->getGuruMapel($mapel);

		// $cekUNameGuru = $this->GuruModel->GetGuruByUsername($username);
		// if($cekUNameGuru!=null){
		// 	$status = false;
		// 	$message = "Username Sudah Pernah Terpakai!";
		// }			
		if (count($cek) > 0) {
			$message = 'Mapel di Kelas Sudah Ada Yang Mengisi!';
			$status = false;
		}if (empty($nik)) {
			$message = 'NIK Harap Di Isi';
			$status = false;
		} 	if (empty($nama)) {
			$message = 'Nama Harap Di Isi';
			$status = false;
		} 	if (empty($mapel)) {
			$message = 'Mapel Harap Di Isi';
			$status = false;
		} 
			// if (empty($username)) {
		// 	$message = 'UserName Harap Di Isi';
		// 	$status = false;
		// } 	if (empty($password)) {
		// 	$message = 'Password Harap Di Isi';
		// 	$status = false;
		// } 
			if (empty($alamat)) {
			$message = 'Alamat Harap Di Isi';
			$status = false;
		} 	if (empty($tanggal_lahir)) {
			$message = 'Tanggal Lahir Harap Di Isi';
			$status = false;
		} 	
		
		if($status){

			$in = array(
				// 'id_kelas' => $kelas,
				'nik' => $nik,
				'nama_guru' => $nama,
				'tempat_lahir' => $nama,
				'tanggal_lahir' => $nama,
				'alamat' => $nama,
				'id_mapel' => $mapel,
				'id_kelas' => $kelas,
				// 'password' => $password,
				'tempat_lahir' => $tempat_lahir,
				'tanggal_lahir' => $tanggal_lahir,
				'alamat' => $alamat,
				// 'username' => $username,

			);
			$this->WaliModel->tambah_Guru($in);
			$message = "Berhasil Menambah Guru Mapel #1";
			$status = true;
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function getAllGuru()
	{
		$bu = base_url();
		$dt = $this->WaliModel->data_AllGuru($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->nik . '<br>';
			$fields[] = $row->nama_guru . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = $row->nama_mapel . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-kode_wali="' . $row->nik . '" 
			data-id_guru="' . $row->id_guru . '" data-nama="' . $row->nama_guru . '" 
			data-id_kelas="' . $row->id_kelas . '" 
			data-id_mapel="' . $row->id_mapel . '" 
			data-username="' . $row->username . '" 
			data-password="' . $row->password . '" 
			data-tempat_lahir="' . $row->tempat_lahir . '" 
			data-tanggal_lahir="' . $row->tanggal_lahir . '" 
			data-alamat="' . $row->alamat . '" 
			></i> Ubah</button>

		<button class="btn btn-round btn-danger hapus" data-kode_wali="' . $row->nik . '" 	
			data-id_guru="' . $row->id_guru . '" 
			data-nama="' . $row->nama_guru . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function hapusGuru()
	{
		// var_dump($this->input->post());die;

		$id_guru = $this->input->post('id_guru', TRUE);
		$data = $this->WaliModel->getGuruById($id_guru);
		$status = false;

		$message = 'Gagal menghapus Wali Kelas!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Wali Kelas yang dimaksud.';
		} else {
			$this->WaliModel->HapusGuru($id_guru);

			$status = true;
			$message = 'Berhasil menghapus Guru Kelas: <b>' . $data[0]->nama_guru . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function getMapelFromKelasAndMapel()
	{
		// var_dump($_POST);die;
		$all = $this->WaliModel->getAllMapelFromKelasAdnMapel($_POST['kelas'], $_POST['mapel']);

		// $lists = "<option value=''>Pilih</option>";

		foreach ($all as $data) {
			$lists = "<option value='" . $data->kode_mapel . "'>" . $data->nama_mapel . "</option>"; // Tambahkan tag option ke variabel $lists
		}

		$callback = array('list_kota' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
		echo json_encode($callback);
		// var_dump($all);die;
		# code...
	}
	public function ubah_guru_proses()
	{

		// var_dump($this->input->post());die;

		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$mapel = $this->input->post('mapel', TRUE);
		$id_guru = $this->input->post('id_guru', TRUE);
		$nik = $this->input->post('nik', TRUE);
		$username = $this->input->post('usernames', TRUE);
		$password = $this->input->post('passwords', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);
		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$message = 'Gagal mengedit data Guru!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nik' => $nik,
			'nama_guru' => $nama,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'alamat' => $alamat,
			'id_kelas' => $kelas,
			'id_mapel' => $mapel,
			// 'username' => $username,
			// 'password' => $password,
		);

		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kelas)) {
			$status = false;
			$errorInputs[] = array('#kelas', 'Silahkan Isi Kelas');
		}
		// if (empty($username)) {
		// 	$status = false;
		// 	$errorInputs[] = array('#username', 'Silahkan Isi Username');
		// }
		// if (empty($password)) {
		// 	$status = false;
		// 	$errorInputs[] = array('#password', 'Silahkan Isi Password');
		// }

		if ($status) {

			if ($this->WaliModel->edit_guru($in, $id_guru)) {

				$message = "Berhasil Mengubah Guru Kelas #1";
			}
		} else {
			$message = "Gagal Mengubah Guru Kelas #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function formProfil($user_id = 0)
	{
		// var_dump($_POST);die;
		if ($_POST) {
			$id_user = $_POST['id_user'];
			$result = $this->WaliModel->UpdateProf($_POST);
			if (isset($result['code'])) {
				$this->session->set_flashdata('flash_data', $result['message']);
			} else {
				$this->session->set_flashdata('flash_data', "User data already saved.");
			}
			redirect('dashboard');
		}
	}


	}








