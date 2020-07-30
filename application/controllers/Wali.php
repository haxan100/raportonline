<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');

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
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listWali'] = $this->WaliModel->index();
		
		
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

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-kode_wali="' . $row->kode_wali. '" data-nama="' . $row->nama_wali . '" 
			data-id_kelas="' . $row->id_kelas . '" 
			data-username="' . $row->username . '" 
			data-password="' . $row->password . '" 
			></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-kode_wali="' . $row->kode_wali . '" data-nama="' . $row->nama_wali . '"
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
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$kode_wali = $this->input->post('kode_wali', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
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

			if ($this->WaliModel->edit_wali($in, $kode_wali)) {

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
		$kode_wali = $this->input->post('kode_wali', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek = $this->WaliModel->getWaliById($kode_wali);
		if (count($cek) > 1) {
			$message = 'Wali Kelas Sudah Ada!';
			// die;
			$status = false;
		} else {

			$in = array(

				'id_kelas' => $kelas,
				'kode_wali' => $kode_wali,
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

		$kode_wali = $this->input->post('kode_wali', TRUE);

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








}
