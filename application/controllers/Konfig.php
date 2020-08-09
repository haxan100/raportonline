<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfig extends CI_Controller {
		public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('SekolahModel');
		$this->load->model('WaliModel');
		$this->load->model('KonfigModel');

		$this->load->helper('url');
	}
	public function index()
	{
		$data['content'] = 'konfig/Konfigurasi';
		$data['konfig']
		= $this->SekolahModel->dataSekolah()->result();

		$this->load->view('templates/index', $data);
		
	}
	public function getAllKonfig()
	{
		$bu = base_url();
		$dt = $this->KonfigModel->data_Sekolah($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->nama . '<br>';
			$fields[] = $row->alamat . '<br>';
			$fields[] = $row->no_telp . '<br>';
			$fields[] = $row->kepala_sekolah . '<br>';
			$fields[] = $row->deskripsi . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit_det"  data-toggle="modal" data-target=".bs-example-modal-lg" 
			data-nama="' . $row->nama . '" data-alamat="' . $row->alamat . '" 
			data-no_telp="' . $row->no_telp . '" 
			data-kepala_sekolah="' . $row->kepala_sekolah . '" 
			data-deskripsi="' . $row->deskripsi . '" 
			></i> Ubah</button>            

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}

	








}
