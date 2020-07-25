<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');

		$this->load->helper('url');
	}

	public function index()
	{	
		$data['siswa']= $this->SiswaModel->siswa();
		$data['kelas'] = $this->SiswaModel->getAllKelas();
		// var_dump($this->SiswaModel->getAllKelas());die;
		
		$data['content']= 'dashboard';
		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();
		// var_dump($data['konfig']);die;

	
		$this->load->view('templates/index',$data);

	}
}
