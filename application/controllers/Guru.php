<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('WaliModel');
		$this->load->model('AdminModel');
		$this->load->model('GuruModel');

		$this->load->helper('url');
	}

	public function index()
	{
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listWali'] = $this->WaliModel->index();
		
		
		$data['content']= 'login';
		$obj['ci'] = $this;
	
		$this->load->view('login_guru',$obj);
		
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
			// 'password' => md5($password)
		);
		
		$cek = $this->GuruModel->cek_login("guru", $where)->num_rows();
		$data = $this->GuruModel->cek_login("guru", $where)->row();
		// var_dump();die;
		if ($cek > 0) {

			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'user' => "guru",
				'id_user' => $data->id_guru, // Buat session authenticated
				'id_guru' => $data->id_guru, // Buat session authenticated
				'id_kelas' => $data->id_kelas, // Buat session authenticated
				'id_mapel' => $data->id_mapel, // Buat session authenticated

			);
			$this->session->set_userdata($data_session);
		} else {
			$status = false;
			$message = 'Username Dan Password  Salah!';
		}
			$data = $this->GuruModel->login($username);
			$status = false;
			$message = 'Username tidak ditemukan!';
			// var_dump($data->num_rows());die;
		if ($data->num_rows() == 1) {

        $r = $data->row();   
          $session = array(
            'admin_session' => true, // Buat session authenticated dengan value true
            'id_guru' => $r->id_guru, // Buat session authenticated
            'nama_guru' => $r->nama_guru, // Buat session authenticated
          );
		  $this->session->set_userdata($session);
		   $status = true;
          $message = 'Selamat datang <span class="font-weight-bold">' . $r->nama_guru . '</span>, sedang mengalihkan..';
      } else {
        $message = 'Username & password tidak cocok!';
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
		public function formProfil($user_id = 0)
	{
		// var_dump($_POST);die;
		if ($_POST) {
			$id_user = $_POST['id_user'];
			$result = $this->GuruModel->UpdateProf($_POST);
			if (isset($result['code'])) {
				$this->session->set_flashdata('flash_data', $result['message']);
			} else {
				$this->session->set_flashdata('flash_data', "User data already saved.");
			}
			redirect('dashboard');
		}
	}


}
