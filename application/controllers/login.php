<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');
		$this->load->model('AdminModel');

		$this->load->helper('url');
	}

	public function index()
	{
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listWali'] = $this->WaliModel->index();
		
		
		$data['content']= 'login';
		$obj['ci'] = $this;
	
		$this->load->view('login',$obj);
		
		// this->load->view('View File', $data, FALSE);
		

	}
	function cekLogin()

	{

		if (!$this->isLoggedInAdmin()) {

			$this->session->set_flashdata(

				'notifikasi',

				array(

					'alert' => 'alert-danger',

					'message' => 'Silahkan Login terlebih dahulu.',

				)

			);

			redirect('admin/login');
		}
	}
	public function isLoggedInAdmin()
	{
		if ($this->session->userdata('admin_session'))
		return true; // sudah login
		else
			return false; // belum login
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
			$message = 'Selamat datang <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
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
	public function logout()

	{

		$this->session->sess_destroy();

		redirect('login');
	}

}
