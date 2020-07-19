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
		$this->load->library('form_validation');
		$username = $this->input->post('username', true);

		$password = $this->input->post('password', true);

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);

		$cek = $this->AdminModel->cek_login("admin", $where)->num_rows();
		if ($cek > 0) {

			$data_session = array(
				'nama' => $username,
				'status' => "login"
			);
			$this->session->set_userdata($data_session);
			// redirect(base_url("siswa"));

			// $this->load->view("siswa/data_siswa");  
			
			// redirect('siswa');
			

		} else {
			echo "Username dan password salah !";
		}
			$data = $this->AdminModel->login($username);
			$status = false;
			$message = 'Username tidak ditemukan!';
			// var_dump($data->num_rows());die;
		if ($data->num_rows() == 1) {

        $r = $data->row();

        // echo "sama"; die;
          $session = array(
            'admin_session' => true, // Buat session authenticated dengan value true

            'id_user' => $r->id_user, // Buat session authenticated

            'nama' => $r->nama, // Buat session authenticated

          );
		  $this->session->set_userdata($session);
		   $status = true;
          $message = 'Selamat datang <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
        $status = true;
        $message = 'Selamat datang <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
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

}
