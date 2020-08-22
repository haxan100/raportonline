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

			redirect('login', 'refresh');

			exit();
		}
		if($_SESSION['user']=="siswa" or $_SESSION['user']=="guru"  ){
			             
            echo '<script type="text/javascript">
                        alert("Hanya Admin Yang Dapat Memasuki Menu Ini...");
                    </script>';
			// echo 'Siswa Tidak Dapat Memasuki Menu Ini!';
			redirect('dashboard', 'refresh');
			exit();

		}
		$data['content'] = 'konfig/konfigurasi';
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
			$fields[] =  '<img class="img-fluid" id="foto_wrapper" src="' . $bu . '/assets/images/' . $row->logo . ' "/> ';
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
	public function ubah_konfig_proses()
	{

		// var_dump($this->input->post());die;
		// var_dump($_FILES);die;

		$newID = "logo";

		$_FILES['f']['name']     = $_FILES['foto']['name'];
		$_FILES['f']['type']     = $_FILES['foto']['type'];
		$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
		$_FILES['f']['error']     = $_FILES['foto']['error'];
		$_FILES['f']['size']     = $_FILES['foto']['size'];

		$config['upload_path']          = './assets/images/';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['overwrite']        = TRUE;
		$config['remove_space'] = TRUE;
		$config['max_size']             = 3 * 1024; // kByte
		$config['max_width']            = 10 * 1024;
		$config['max_height']           = 10 * 1024;
		$config['file_name'] = $newID .".png";
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		$this->upload->initialize($config);

		// $this->upload->do_upload('foto');

		// var_dump($this->upload->do_upload('f')); 

		// die;



		// var_dump($config['file_name']);die;

		$nameFoto = $config['file_name'];
		// foto akhir

		$nameFoto = str_replace(' ', '_', $nameFoto);

		if ($this->upload->do_upload('f')) {

			// Gagal

			$error = false;

			// echo "gagal";
			// die;

		} else {

			//  berhasil

			// echo "berhasil";

			$error = false;

			$fileName = $this->upload->data()["file_name"];



			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			// die;
		}


		$nama_sekolah = $this->input->post('nama_sekolah', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$no_telp = $this->input->post('no_telp', TRUE);
		$kepala_sekolah = $this->input->post('kepala_sekolah', TRUE);
		$deskripsi = $this->input->post('Deskripsi', TRUE);
		$message = 'Gagal mengedit data Deskripsi Sekolah!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama' => $nama_sekolah,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'kepala_sekolah' => $kepala_sekolah,
			'deskripsi' => $deskripsi,
		);

		if (empty($nama_sekolah)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama Sekolah');
		}
		if (empty($alamat)) {
			$status = false;
			$errorInputs[] = array('#alamat', 'Silahkan Isi Alamat');
		}
		if (empty($no_telp)) {
			$status = false;
			$errorInputs[] = array('#no_telp', 'Silahkan Isi No Telp');
		}
		if (empty($deskripsi)) {
			$status = false;
			$errorInputs[] = array('#deskripsi', 'Silahkan Isi Deskripsi');
		}

		if ($status) {

			if ($this->KonfigModel->edit_konfig($in)) {

				$message = "Berhasil Mengubah Data Sekolah #1";
			}
		} else {
			$message = "Gagal Mengubah Data sekolah #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function getAllVisi()
	{
		$bu = base_url();
		$dt = $this->KonfigModel->visi_Sekolah($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->ket . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit_visi"  data-toggle="modal" data-target=".modal_visi" 
			data-ket="' . $row->ket . '" data-id_visi="' . $row->id_visi . '" 
			></i> Ubah</button>    

			<button class="btn btn-round btn-danger btn_hapus_visi"  
			data-ket="' . $row->ket . '" data-id_visi="' . $row->id_visi . '" 
			></i> Hapus</button>           

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function tambah_visi_proses()
	{

		// var_dump($_POST);die;
		$visi = $this->input->post('visi', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

			$in = array(

				'ket' => $visi,
			'id' => 1,
			);
			$this->KonfigModel->tambah_Visi($in);

			$message = "Berhasil Menambah Visi Sekolah ";
			$status = true;
		

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}

	public function ubah_konfig_visi_proses()
	{

		// var_dump($this->input->post());die;
		// var_dump($_FILES);die;
		$visi = $this->input->post('visi', TRUE);
		$id_visi = $this->input->post('id_visi', TRUE);
		$status = true;
		$errorInputs[] = array('#visi', 'Berhasil Mengubah Visi Sekolah');

			$in = array(
			'ket' => $visi,
		);

		if (empty($visi)) {
			$status = false;
			$errorInputs[] = array('#visi', 'Silahkan Isi Nama Sekolah');
		}
		if ($status) {

			if ($this->KonfigModel->edit_visi($in,$id_visi)) {

				$message = "Berhasil Mengubah Visi Sekolah";
			}
		} else {
			$message = "Gagal Mengubah Visi sekolah #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusVisi()
	{
		// var_dump($this->input->post());die;

		$id_visi = $this->input->post('id_visi', TRUE);

		$data = $this->KonfigModel->getVisiById($id_visi);
		$status = false;

		$message = 'Gagal menghapus Visi!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Visi yang dimaksud.';
		} else {
			$this->KonfigModel->HapusVisi($id_visi);

			$status = true;
			$message = 'Berhasil menghapus Visi: <b>' . $data[0]->ket . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function getAllMisi()
	{
		$bu = base_url();
		$dt = $this->KonfigModel->misi_Sekolah($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->ket . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit_misi"  data-toggle="modal" data-target=".modal_misi" 
			data-ket="' . $row->ket . '" data-id_misi="' . $row->id_misi . '" 
			></i> Ubah</button>    

			<button class="btn btn-round btn-danger btn_hapus_misi"  
			data-ket="' . $row->ket . '" data-id_misi="' . $row->id_misi . '" 
			></i> Hapus</button>           

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_konfig_misi_proses()
	{

		// var_dump($this->input->post());die;
		// var_dump($_FILES);die;
		$misi = $this->input->post('misi', TRUE);
		$id_misi = $this->input->post('id_misi', TRUE);
		$status = true;
		$errorInputs[] = array('#misi', 'Berhasil Mengubah misi Sekolah');

		$in = array(
			'ket' => $misi,
		);

		if (empty($misi)) {
			$status = false;
			$errorInputs[] = array('#misi', 'Silahkan Isi Misi Sekolah');
		}
		if ($status) {

			if ($this->KonfigModel->edit_misi($in, $id_misi)) {

				$message = "Berhasil Mengubah Misi Sekolah";
			}
		} else {
			$message = "Gagal Mengubah Misi sekolah #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function tambah_misi_proses()
	{

		// var_dump($_POST);die;
		$misi = $this->input->post('misi', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'ket' => $misi,
			'id' => 1,
		);
		$this->KonfigModel->tambah_Misi($in);

		$message = "Berhasil Menambah Misi Sekolah ";
		$status = true;


		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusMisi()
	{
		// var_dump($this->input->post());die;

		$id_misi = $this->input->post('id_misi', TRUE);

		$data = $this->KonfigModel->getMisiById($id_misi);
		$status = false;

		$message = 'Gagal menghapus Misi!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Misi yang dimaksud.';
		} else {
			$this->KonfigModel->HapusMisi($id_misi);

			$status = true;
			$message = 'Berhasil menghapus misi: <b>' . $data[0]->ket . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}

	








}
