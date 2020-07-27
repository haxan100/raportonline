<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');
		$this->load->model('WaliModel');

		$this->load->helper('url');
	}

	public function index()
	{	
		$data['siswa']= $this->SiswaModel->siswa();
		$data['kelas'] = $this->SiswaModel->getAllKelas();
		$data['guru'] = $this->WaliModel->getAllGuru();
		$data['mapel'] = $this->SiswaModel->getAllMapel();
		// var_dump($this->SiswaModel->getAllKelas());die;
		
		$data['content']= 'dashboard';
		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();
		// var_dump($data['konfig']);die;

	
		$this->load->view('templates/index',$data);

	}
}
