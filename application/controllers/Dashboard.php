<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');

		$this->load->helper('url');
	}

	public function index()
	{	
		$data['siswa']= $this->SiswaModel->siswa();
		// var_dump($this->SiswaModel->siswa());die;
		
		$data['content']= 'dashboard';

	
		$this->load->view('templates/index',$data);

	}
}
