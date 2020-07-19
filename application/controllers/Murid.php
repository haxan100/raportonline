<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Murid extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');

		$this->load->helper('url');
	}

	public function index()
	{
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listWali'] = $this->WaliModel->index();


		$data['content'] = 'login';
		$obj['ci'] = $this;

		$this->load->view('login_murid', $obj);
	}
	public function login_proses()

	{
		$this->load->library('form_validation');
		$username = $this->input->post('username', true);

		$password = $this->input->post('password', true);

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);

		$cek = $this->SiswaModel->cek_login("siswa", $where)->num_rows();
		// var_dump($cek);die;
		if ($cek > 0) {

			$data_session = array(
				'nama' => $username,
				'status' => "login"
			);
			$this->session->set_userdata($data_session);
			
		} else {
			// echo "Username dan password salah !";
			$message = 'Username dan password salah';

		}
		$data = $this->SiswaModel->login($username);
		$status = false;
		$message = 'Username tidak ditemukan!';
		// var_dump($data->num_rows());die;
		if ($data->num_rows() == 1) {

			$r = $data->row();

			// echo "sama"; die;
			$session = array(
				'nisn' => $r->nisn, // Buat session authenticated

				'nama' => $r->nama_lengkap, // Buat session authenticated

			);
			$this->session->set_userdata($session);
			$status = true;
			$message = 'Selamat datang ' . $r->nama_lengkap . ', sedang mengalihkan..';
		} else {
			$message = 'Username & password tidak cocok!';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,

		));
	}
	public function data()
	{
		// if (!$this->isLoggedInAdmin()) {

		// 	echo 'Anda Harus Login!';

		// 	exit();
		// }
		// var_dump($_SESSION);die;
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['siswa'] = $this->SiswaModel->siswa();
		// var_dump($this->SiswaModel->siswa());die;

		$data['content'] = 'nilai/data_nilai_untuk_murid';


		$this->load->view('templates/index', $data);
	}

}
