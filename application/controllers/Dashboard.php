<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');
		$this->load->model('WaliModel');
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
		ob_start();
		if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';

			redirect('login', 'refresh');

			exit();
		}


		// var_dump($_SESSION);die;
		$data['siswa'] = $this->SiswaModel->siswa();
		$data['kelas'] = $this->SiswaModel->getAllKelas();
		$data['guru'] = $this->WaliModel->getAllGuru();
		$data['mapel'] = $this->SiswaModel->getAllMapel();
		// var_dump($this->SiswaModel->getAllKelas());die;

		$data['content'] = 'dashboard';
		$data['konfig']
			= $this->SekolahModel->dataSekolah()->result();

		$data['visi'] =    $this->SekolahModel->visi()->result();
		$data['misi'] =    $this->SekolahModel->misi()->result();

		// var_dump($data['visi']);die;


		$this->load->view('templates/index', $data);
	}
}
