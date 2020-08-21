<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()

	{
		parent::__construct();
		$this->load->model('SiswaModel');

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
			
			redirect('login','refresh');
			

			exit();
		}
		if ($_SESSION['user'] == 'guru') {

			$id_kelasFromWali = $_SESSION['id_kelas'];
			// echo"helo";
			$data['listKelas'] = $this->SiswaModel->getKelasByid_kelas($id_kelasFromWali);
			$data['siswa'] = $this->SiswaModel->getSiswaByid_kelas($id_kelasFromWali);


			$data['listMapel'] = $this->SiswaModel->getMapelByidKelas($id_kelasFromWali);

		} else {
			$data['listKelas'] = $this->SiswaModel->getAllKelas();
			$data['listMapel'] = $this->SiswaModel->getAllMapel();
			$data['siswa'] = $this->SiswaModel->siswa();
		}
		

		// var_dump($_SESSION);die;
		// $data['listKelas'] = $this->SiswaModel->getAllKelas();
		// $data['listMapel'] = $this->SiswaModel->getAllMapel();
		// $data['siswa']= $this->SiswaModel->siswa();
		// var_dump($this->SiswaModel->siswa());die;
		
		$data['content']= 'nilai/data_nilai_kelas';

	
		$this->load->view('templates/index',$data);

	}
	public function ubah_nilai_siswa_proses()
	{

		// var_dump($this->input->post());die;
		$id_nilai = intVal($this->input->post('id_nilai', TRUE));
		// $nisn = $this->input->post('nisn', TRUE);
		$nilai_harian = intVal($this->input->post('nilai_harian', TRUE));
		$nilai_uts = intVal($this->input->post('nilai_uts', TRUE));
		$nilai_uas = intVal($this->input->post('nilai_uas', TRUE));
		$nilai_uas = intVal($this->input->post('nilai_uas', TRUE));
		$nilai_pengetahuan = intVal($this->input->post('nilai_pengetahuan', TRUE));
		$nilai_karakter = intVal($this->input->post('nilai_karakter', TRUE));
		$keterangan = $this->input->post('keterangan', TRUE);

		// var_dump($nilai);die;
		$message = 'Gagal mengedit data nilai!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nilai_harian' => $nilai_harian,
			'nilai_uts' => $nilai_uts,
			'nilai_uas' => $nilai_uas,
			'nilai_pengetahuan' => $nilai_pengetahuan,
			'nilai_karakter' => $nilai_karakter,
			'keterangan' => $keterangan,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isNilaiSiswaAda($id_nilai)) == 1 ? true : false;
		if (!$produk_ada) {
			$status = false;
			// $errorInputs[] = array('#judul','Produk tersebut tidak ada di database!');
			$message .= '<br>Nilai tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nilai_harian)) {
			$status = false;
			$errorInputs[] = array('#nilai_harian', 'Silahkan Isi nilai');
		}
		if (empty($nilai_uts) ) {
			$status = false;
			$errorInputs[] = array('#nilai_uts', 'Silahkan pilih mapel');
		}

		if ($status) {

			if ($this->SiswaModel->edit_nilai_siswa($in, $id_nilai)) {

				$message = "Berhasil Mengubah Nilai Siswa #1";
				}
	
			} else {
				$message = "Gagal Mengubah Nilai Siswa #1";
			}
		


		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusMapelSiswa()
	{

		$id_nilai = $this->input->post('id_nilai', TRUE);
		// var_dump($id_nilai);die;

		$data = $this->SiswaModel->getNilaiSiswaByidMap($id_nilai);
		$status = false;

		$message = 'Gagal menghapus Nilai Siswa!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat  Nilai Siswa yang dimaksud.';
		}else{
			$this->SiswaModel->HapusNilaiSiswa($id_nilai);

			$status = true;
			$message = 'Berhasil menghapus Nilai Siswa: <b>' . $data[0]->nama_mapel . '</b>';

		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));

	}
	public function hapusNilai()
	{

		$id_nilai = $this->input->post('id_nilai', TRUE);
		// var_dump($this->input->post());die;

		$data = $this->SiswaModel->getNilaiSiswaByidMap($id_nilai);
		$status = false;

		$message = 'Gagal menghapus Nilai Siswa!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat  Nilai Siswa yang dimaksud.';
		} else {
			$this->SiswaModel->HapusNilaiSiswa($id_nilai);

			$status = true;
			$message = 'Berhasil menghapus Nilai Siswa: <b>' . $data[0]->nama_mapel . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function tambah_siswa_proses()
	{
		$nisn = $this->input->post('nisn', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$jk = $this->input->post('jk', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);

		$message = 'Gagal menambah data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;


		// var_dump($in);die();
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kelas)) {
			$status = false;
			$errorInputs[] = array('#kelas', 'Silahkan pilih Kelas');
		}
		if (empty($alamat)) {
			$status = false;
			$errorInputs[] = array('#alamat', 'Silahkan isi Alamat');
		}
		$cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
		// var_dump(!$cekFoto);die;
		if (!$cekFoto) {


			$_FILES['f']['name']     = $_FILES['foto']['name'];
			$_FILES['f']['type']     = $_FILES['foto']['type'];
			$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['f']['error']     = $_FILES['foto']['error'];
			$_FILES['f']['size']     = $_FILES['foto']['size'];

			$config['upload_path']          = './upload/images/';
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 3 * 1024; // kByte
			$config['max_width']            = 10 * 1024;
			$config['max_height']           = 10 * 1024;
			$config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
			$this->load->library('image_lib');
			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			$this->image_lib->resize();
			// var_dump(!$this->upload->do_upload('f'));die;
			// Upload file to server

			if (!$this->upload->do_upload('f')) {
				$errorUpload = $this->upload->display_errors() . '<br>';
			} else {
				// Uploaded file data
				$fileName = $this->upload->data()["file_name"];
				$foto = array(
					'foto' => $fileName,
				);
				$in = array(
					'foto' => $fileName,
					'nisn' => $nisn,
					'nama_lengkap' => $nama,
					'tanggal_lahir' => $tanggal_lahir,
					'tempat_lahir' => $tempat_lahir,
					'jenkel' => $jk,
					'alamat' => $alamat,
					'id_kelas' => $kelas,
					'username' => $username,
					'password' => $password,
				);
				$this->SiswaModel->tambah_siswa($in);

				$message = "Berhasil Menambah Siswa #1";
			}
		} else {
			$message = "Gagal menambah Siswa #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));








	}

	public function Kelas()
	{
				if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';

			redirect('login', 'refresh');

			exit();
		}
		
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		// $data['siswa'] = $this->SiswaModel->siswa();
		// var_dump($this->SiswaModel->siswa());die;

		$data['content'] = 'siswa/data_kelas';


		$this->load->view('templates/index', $data);
	}
	public function tambah_kelas_proses()
	{
		$nama = $this->input->post('nama', TRUE);

		$message = 'Gagal menambah data Kelas!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek_kelas = $this->SiswaModel->getKelasByNama($nama);
		// var_dump(count($cek_kelas) > 1);die;
		if(count($cek_kelas) > 1){
			$message = 'Kelas Sudah Ada!';
			// die;
			$status = false;
		}else{
		
				$in = array(
					
					'nama_kelas' => $nama,
					
				);
				$this->SiswaModel->tambah_kelas($in);

				$message = "Berhasil Menambah Kelas #1";
				$status = true;

			}
		
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function getAllKelas()

	{

		if (!$this->isLoggedInAdmin()) {

			echo '403 Forbidden!';

			redirect('login', 'refresh');

			exit();
		}


		$bu = base_url();

		$dt = $this->SiswaModel->data_AllKelas($_POST);

		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;

		$datatable['recordsTotal']    = $dt['totalData'];

		$datatable['recordsFiltered'] = $dt['totalData'];

		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;

		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {
			

			$fields = array($no++);

			$fields[] = $row->id_kelas . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '

       	 <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-id_kelas="'.$row->id_kelas.' " data-nama="'. $row->nama_kelas . '" ></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-id_kelas="'.$row->id_kelas.'" data-nama="'. $row->nama_kelas.'"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function getKelas()
	{
		// $dt = $this->ProdukModel->dt_produk($_POST);
		// var_dump($_POST);die;
		$bu = base_url();
		$dt = $this->SiswaModel->data_AllKelasWali($_POST);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {
		
		
			$fields = array($no++);

			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = $row->nama_mapel . '<br>';
			$fields[] = $row->nama_lengkap . '<br>';
			$fields[] = $row->nilai_harian . '<br>';
			$fields[] = $row->nilai_uts . '<br>';
			$fields[] = $row->nilai_uas . '<br>';
			$fields[] = $row->nilai_pengetahuan . '<br>';
			$fields[] = $row->nilai_karakter . '<br>';
			$fields[] = $row->keterangan . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" 
			
			data-nisn="'.$row->nisn. '" 
			data-id_nilai="' . $row->id_nilai . ' " 
			data-kode_mapel="' . $row->kode_mapel . '" 
			data-nama_mapel="' . $row->nama_mapel . ' " 
			data-nilai_harian="' . intVal($row->nilai_harian) . '" 
			data-nilai_uts="' . $row->nilai_uts . '" 
			data-nilai_uas="' . $row->nilai_uas . '" 
			data-nilai_pengetahuan="' . $row->nilai_pengetahuan . '" 
			data-nilai_karakter="' . $row->nilai_karakter . '" 
			data-keterangan="' . $row->keterangan . '" 
			
			data-nama="' . $row->nama_lengkap . '" ></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-id_nilai="' . $row->id_nilai . '" data-nama="' . $row->nama_lengkap . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}



	public function kelas_detail()

	{
		$urlid = $this->uri->segment(3);

		$id_kelas = $_POST['id_kelas'];
		$getKelasFromSess =  $_SESSION['id_kelas'];

		if (!$this->isLoggedInAdmin()) {
			echo 'Anda Harus Login!';
			redirect('login', 'refresh');
			exit();
		}

		if ($_SESSION['user'] == "guru") {

			if ($getKelasFromSess == $urlid) {

				$data['content'] = 'nilai/data_detail_kelas';

			} else {
				// $dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
				// echo" alert("s")";
				echo '<script type="text/javascript">
				    alert("Kelas Bukan Untuk Anda...");
				</script>';


				redirect('Nilai', 'refresh');
			}
		} else if ($_SESSION['user'] == "admin") {

			$data['content'] = 'nilai/data_detail_kelas';
		
		}
		

		$this->load->view('templates/index', $data);


	}
	public function getKelasDetailSiswa()
	{
		$id_kelas = $_POST['id_kelas'];
		// var_dump($getKelasFromSess);die;


		$bu = base_url();
		$u = $this->uri->segment(3);
		// var_dump($u);die;

		if (!$this->isLoggedInAdmin()) {
			echo 'Anda Harus Login!';
			redirect('login', 'refresh');
			exit();
		}

		// $id_kelas = $this->SiswaModel->getMapelByid($u)[0]->id_kelas;

		if ($_SESSION['user'] == "guru") {

			$getKelasFromSess =  $_SESSION['id_kelas'];

			if($getKelasFromSess == $id_kelas){


				$dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
				
			} else {
				$dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
				// echo" alert("s")";
				// echo '<script type="text/javascript">
                //     alert("Kelas Bukan Untuk Anda...");
				// </script>';


				// redirect('Nilai', 'refresh');
			}


		}else if ($_SESSION['user'] == "admin"){

			$dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
		}
		
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {

			// $wali = "";
			// if ($row->nama_wali == '') {
			// 	$wali = "<B> Belum ada wali kelas di kelas ini </B>";
			// } else {
			// 	$wali = $row->nama_wali;
			// }
			$nama = ' <a href="#" class="tomboldetail"  data-nisn="' . $row->nisn . '"data-nama_siswa="' . $row->nama_lengkap . '">
      ' . $row->nama_lengkap . '
      		</a>';
			$fields = array($no++);

			$fields[] = $row->nisn . '<br>';
			$fields[] = $nama . '<br>';
			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = '

       	 <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-id_kelas="' . $row->id_kelas . ' " data-nama="' . $row->nama_kelas . '" ></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-id_kelas="' . $row->id_kelas . '" data-nama="' . $row->nama_kelas . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function getDetailNilaiSiswa()
	{
		$nisn = $_POST['nisn'];
		// var_dump($id_kelas);die;

		$bu = base_url();
		$dt = $this->SiswaModel->data_AllNilaiSiswa($_POST, $nisn);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {

			// var_dump(intVal($row->nilai));die;
			// $keterangan = "";
			// if (intVal($row->nilai) < intVal($row->kkm)) {
			// 	$keterangan = "<B> Belum Lulus</B>";
			// } else {
			// 	$keterangan = 'Lulus';
			// }

			$fields = array($no++);

			$fields[] = $row->nama_kelas . '<br>';
			$fields[] = $row->nama_mapel . '<br>';
			$fields[] = $row->nilai_harian . '<br>';
			$fields[] = $row->nilai_uts . '<br>';
			$fields[] = $row->nilai_uas . '<br>';
			$fields[] = $row->nilai_pengetahuan . '<br>';
			$fields[] = $row->nilai_karakter . '<br>';
			$fields[] = $row->keterangan . '<br>';
			$fields[] = '

			<button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" 
			data-nisn="' . $row->nisn . '" 
			data-id_nilai="' . $row->id_nilai . ' " 
			data-kode_mapel="' . $row->kode_mapel . '" 
			data-nama_mapel="' . $row->nama_mapel . ' " 
			data-nilai_harian="' . intVal($row->nilai_harian) . '" 
			data-nilai_uts="' . $row->nilai_uts . '" 
			data-nilai_uas="' . $row->nilai_uas . '" 
			data-nilai_pengetahuan="'.$row->nilai_pengetahuan.'" 
			data-nilai_karakter="' . $row->nilai_karakter . '" 
			data-keterangan="' . $row->keterangan . '" 			
			data-nama="' . $row->nama_lengkap . '"
			
			
			></i> Ubah</button>

		<button class="btn btn-round btn-danger hapus" data-id_nilai="' . $row->id_nilai . '" 
		data-nama_mapel="' . $row->nama_mapel . '" 
		
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}


	public function detail_nilai_siswa()

	{
			if (!$this->isLoggedInAdmin()) {
			echo 'Anda Harus Login!';
			redirect('login', 'refresh');
			exit();
		}

		$urlid = $this->uri->segment(3);
		$id_kelas = $this->SiswaModel->getIdKelasByNISN($urlid);
		$id_kelasFromNisn =$id_kelas[0]->id_kelas;
		$data['nama']= $id_kelas[0]->nama_lengkap;
		
		if ($_SESSION['user'] == "guru") {
			
			$getKelasFromSess =  $_SESSION['id_kelas'];
			if ($getKelasFromSess == $id_kelasFromNisn) {

			$data['listMapel'] = $this->SiswaModel->getAllMapelByIdKelas($id_kelas[0]->id_kelas);
			// / var_dump($data);die;
			$data['content'] = 'nilai/data_detail_nilai_siswa';

			} else {
				// $dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
				// echo" alert("s")";
				echo '<script type="text/javascript">
				    alert("Siswa Bukan Untuk Anda...");
				</script>';


				redirect('siswa/Kelas', 'refresh');
			}
		} else if ($_SESSION['user'] == "admin") {
			$data['listMapel'] = $this->SiswaModel->getAllMapelByIdKelas($id_kelas[0]->id_kelas);
			// var_dump($data);die;
			$data['content'] = 'nilai/data_detail_nilai_siswa';
		}else if ($_SESSION['user'] == "siswa") {
			
			$getKelasFromSess =  $_SESSION['id_kelas'];
			if ($getKelasFromSess == $id_kelasFromNisn) {

			$data['listMapel'] = $this->SiswaModel->getAllMapelByIdKelas($id_kelas[0]->id_kelas);
			// / var_dump($data);die;
			$data['content'] = 'nilai/data_detail_nilai_siswa';

			} else {
				// $dt = $this->SiswaModel->data_AllKelasSiswa($_POST, $id_kelas);
				// echo" alert("s")";
				echo '<script type="text/javascript">
				    alert("Nilai Siswa Bukan Untuk Anda...");
				</script>';


				redirect('siswa/Kelas', 'refresh');
			}
		}


		// var_dump($data['nama']);die;


		$this->load->view('templates/index', $data);

		// $this->load->view('admin/transaksi_detail', $obj);

	}




	public function getUserTransaksi()
	{
		if (!$this->isLoggedInAdmin()) {
			echo '403 Forbidden!';

			redirect('login', 'refresh');
			exit();
		}
		$id_user = $this->input->post('id_user');
		$id_transaksi = $this->input->post('id_transaksi');
		// var_dump($id_user);
		// die;
		$dt = $this->AdminModel->user_transaksi($_POST, $id_user, $id_transaksi);
		// var_dump($dt['data']->result());die();

		$datatable['draw']            = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {
			// var_dump(($row));die();
			$status = "";
			$metode_pembayaran = "";
			$confirm = '
        <button class="btn btn-success btn-blocks  my-1 btnLihatTx  text-white" 
          data-id_transaksi="' . $row->id_transaksi . '"
          data-kode_transaksi="' . $row->Kode . '"
          data-resi="' . $row->resi . '"
          data-judul="' . $row->Judul . '"
          data-id_alamat="' . $row->id_alamat . '"
          data-id_tipe_produk ="' . $row->id_tipe_produk . '"
          data-id_produk ="' . $row->id_produk . '"
          data-id_user ="' . $row->id_user . '"
				><i class="fas fa-info-circle"></i> Lihat detail</button><br>
						 ';
			switch ($row->Status) {
				case 0:
					$status = "Belum bayar";
					if (($row->resi != "" && $row->metode_pembayaran != 1) || $row->metode_pembayaran == 2)
						$confirm .= '
            <button class="btn btn-warning btn-blocks  my-1 btnConfirmTx  text-white" 
              data-id_transaksi="' . $row->id_transaksi . '"
          		data-resi="' . $row->resi . '"
              data-kode_transaksi="' . $row->Kode . '"
              data-judul="' . $row->Judul . '"
              data-id_produk="' . $row->id_produk . '"
              data-id_user ="' . $row->id_user . '"
            ><i class="far fa-check-circle"></i> Confirm</button><br>';
					// var_dump($row->resi);die();

					$confirm .= '
						
            <button class="btn btn-danger btn-blocks  my-1 btnCancelTx  text-white" 
              data-id_transaksi="' . $row->id_transaksi . '"
              data-kode_transaksi="' . $row->Kode . '"
              data-judul="' . $row->Judul . '"
              data-id_produk="' . $row->id_produk . '"
              data-id_user ="' . $row->id_user . '"
            ><i class="fas fa-ban"></i> Cancel</button>
            ';
					break;
				case 1:
					$status = "Sudah bayar";
					if ($row->resi != "" || $row->metode_pembayaran == 2)
						$confirm .= '
            <button class="btn btn-warning btn-blocks  my-1 btnConfirmTx  text-white" 
              data-id_transaksi="' . $row->id_transaksi . '"
              data-judul="' . $row->Judul . '"
              data-kode_transaksi="' . $row->Kode . '"
              data-id_produk="' . $row->id_produk . '"
              data-id_user ="' . $row->id_user . '"
            ><i class="far fa-check-circle"></i> Confirm</button><br>
            ';
					$confirm .= '
            <button class="btn btn-danger btn-blocks  my-1 btnCancelTx  text-white" 
              data-id_transaksi="' . $row->id_transaksi . '"
              data-judul="' . $row->Judul . '"
              data-kode_transaksi="' . $row->Kode . '"
              data-id_produk="' . $row->id_produk . '"
              data-id_user ="' . $row->id_user . '"
						><i class="fas fa-ban"></i> Cancel</button>
					
            ';
					break;
				case 2:
					$status = "Transaksi selesai";
					break;
				case 4:
					$status = "Transaksi dibatalkan";
					break;
			}
			// Pemilihan Metode Pembayaran
			switch ($row->metode_pembayaran) {
				case 0:
					$metode_pembayaran = "Belum Memilih Metode";
					break;
				case 1:
					$metode_pembayaran = "Transfer";
					if ($row->Status == 0) {
						$confirm .= '
					    <button class="btn btn-warning btn-blocks  my-1 btnConfirmTransf  text-white" 
              data-id_transaksi="' . $row->id_transaksi . '"
              data-judul="' . $row->Judul . '"
              data-kode_transaksi="' . $row->Kode . '"
              data-id_produk="' . $row->id_produk . '"
              data-id_user ="' . $row->id_user . '"
           		 ><i class="far fa-check-circle"></i> Confirm Bayar</button><br>';
					} elseif ($row->Status == 1) {
						$confirm .= '
						<button class="btn btn-info btn-blocks  my-1 btnInputResi  text-white" 
						data-kode_transaksi="' . $row->Kode . '"
						data-id_user ="' . $row->id_user . '"
						data-resi="' . $row->resi . '"
            data-id_transaksi="' . $row->id_transaksi . '"
            data-id_tipe_produk="' . $row->id_tipe_produk . '"
							
						
					" data-toggle="modal" data-target="#btnInputResi" btnInputResi
						 > <i class="fa fa-keyboard"></i> Input Resi</button><br>';
					}

					break;
				case 2:
					$metode_pembayaran = " Cash & Carry";
					break;
			}

			$date = $row->created_at;
			$CreatedDate = strtotime($date);
			$date2 = date('d-m-Y H:i:s', $CreatedDate);
			$fields = array($no++);
			$fields[] = $row->kode_transaksi . '<br>' . $date2;
			$fields[] = $row->nama;
			$fields[] = $row->{'No Handphone'} . '<br>' . $row->email;
			$fields[] = $row->Judul . '<br>' . $row->grade;
			$fields[] = $row->Qty;
			$fields[] = 'Rp ' . $this->formatuang($row->harga_awal);
			$fields[] = 'Rp ' . $this->formatuang($row->harga_total_detail);
			$fields[] = $status;
			$fields[] = $metode_pembayaran;

			// $fields[] = $row->id_admin;
			$fields[] = $confirm;

			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
	// lintas
























	public function ubah_kelas()
	{

		// var_dump($this->input->post());die;
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$message = 'Gagal mengedit data Kelas!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama_kelas' => $nama,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isKelasAda($kelas)) == 1 ? true : false;
		
		if (!$produk_ada) {
			$status = false;
			$message .= '<br>Kelas tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}

		if ($status) {

			if ($this->SiswaModel->edit_kelas($in, $kelas)) {

				$message = "Berhasil Mengubah Kelas #1";
			}

			
		} else {
			$message = "Gagal Mengubah Siswa #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusKelas()
	{
		// var_dump($this->input->post());die;

		$id_kelas = $this->input->post('id_kelas', TRUE);

		$data = $this->SiswaModel->getKelasByid_kelas($id_kelas);
		$status = false;

		$message = 'Gagal menghapus Kelas!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Kelas yang dimaksud.';
		} else {
			$this->SiswaModel->HapusKelas($id_kelas);

			$status = true;
			$message = 'Berhasil menghapus Kelas: <b>' . $data[0]->nama_kelas . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function Mapel()
	{
				if (!$this->isLoggedInAdmin()) {

			echo 'Anda Harus Login!';

			exit();
		}
		
		$data['listKelas'] = $this->SiswaModel->getAllMapel();
		// $data['siswa'] = $this->SiswaModel->siswa();
		// var_dump($this->SiswaModel->siswa());die;

		$data['content'] = 'siswa/data_mapel';


		$this->load->view('templates/index', $data);
	}
	public function getAllMapel()

	{
		$bu = base_url();
		$dt = $this->SiswaModel->data_AllMapel($_POST);

		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;

		$datatable['recordsTotal']    = $dt['totalData'];

		$datatable['recordsFiltered'] = $dt['totalData'];

		$datatable['data']            = array();

		$start  = isset($_POST['start']) ? $_POST['start'] : 0;

		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {


			$fields = array($no++);

			$fields[] = $row->kode_mapel . '<br>';
			$fields[] = $row->nama_mapel . '<br>';
			$fields[] = $row->kkm . '<br>';
			$fields[] = '

       	 <button class="btn btn-round btn-info btn_edit"  data-toggle="modal" data-target=".bs-example-modal-lg" data-kode_mapel="' . $row->kode_mapel . ' " data-nama="' . $row->nama_mapel . '" data-kkm="' . $row->kkm . '" ></i> Ubah</button>

        <button class="btn btn-round btn-danger hapus" data-kode_mapel="' . $row->kode_mapel . '" data-nama="' . $row->nama_mapel . '"
        >Hapus</button>               

        ';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function ubah_mapel()
	{

		// var_dump($this->input->post());die;
		$nama = $this->input->post('nama', TRUE);
		$kode_mapel = $this->input->post('kode_mapel', TRUE);
		$kkm = $this->input->post('kkm', TRUE);

		$message = 'Gagal mengedit data Mapel!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(

			'nama_mapel' => $nama,
			'kkm' => $kkm,
		);
		// var_dump($in);die();

		// pengecekan input
		$produk_ada = count($this->SiswaModel->isMapelAda($kode_mapel)) == 1 ? true : false;
		// var_dump($produk_ada);die();


		if (!$produk_ada) {
			$status = false;
			$message .= '<br>Kelas tersebut tidak ada di database!<br>Silahkan Muat ulang halaman ini!';
		} else {
		}
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kkm)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi KKM');
		}

		if ($status) {

			if ($this->SiswaModel->edit_mapel($in, $kode_mapel)) {

				$message = "Berhasil Mengubah Mapel #1";
			}
		} else {
			$message = "Gagal Mengubah Mapel #1";
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function tambah_mapel_proses()
	{
		$nama = $this->input->post('nama', TRUE);
		$kkm = $this->input->post('kkm', TRUE);

		$message = 'Gagal menambah data Mapel!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cek_kelas = $this->SiswaModel->getMapelByNama($nama);
		// var_dump(count($cek_kelas) > 1);die;
		if (count($cek_kelas) > 1) {
			$message = 'Mapel Sudah Ada!';
			// die;
			$status = false;
		} else {

			$in = array(

				'nama_mapel' => $nama,
				'kkm' => $kkm,

			);
			$this->SiswaModel->tambah_mapel($in);

			$message = "Berhasil Menambah Mapel #1";
			$status = true;
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusMapel()
	{
		// var_dump($this->input->post());die;

		$kode_mapel = $this->input->post('kode_mapel', TRUE);

		$data = $this->SiswaModel->getMapelByid($kode_mapel);
		// var_dump($data);die;
		$status = false;

		$message = 'Gagal menghapus Mapel!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Mapel yang dimaksud.';
		} else {
			$this->SiswaModel->HapusMapel($kode_mapel);

			$status = true;
			$message = 'Berhasil menghapus Mapel: <b>' . $data[0]->nama_mapel . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function tambah_nilai_siswa_proses()
	{
		// var_dump($_POST);die;
		$nisn = $this->input->post('nisn', TRUE);
		$mapel = $this->input->post('mapel', TRUE);
		$nilai_harian = $this->input->post('nilai_harian', TRUE);
		$nilai_uts = $this->input->post('nilai_uts', TRUE);
		$nilai_uas = $this->input->post('nilai_uas', TRUE);
		$nilai_pengetahuan = $this->input->post('nilai_pengetahuan', TRUE);
		$nilai_karakter = $this->input->post('nilai_karakter', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);

		$message = 'Gagal menambah data Nilai!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		$cekNilai = $this->SiswaModel->cekMapelDiNilai($mapel,$nisn);
		// var_dump(count($cekNilai) > 0);
		// die;

		if (count($cekNilai) > 0) {
			// var_dump("jjjjjjj");
			$message = 'Nilai Sudah Ada!';
			$status = false;
			// $errorInputs[] = array('#mapel', 'Silahkan Isi ');
			// die;
		} 
		if ($mapel=='default') {
			$status = false;
			$errorInputs[] = array('#mapel', 'Silahkan Isi ');
		}		if (empty($nilai_harian)) {
			$status = false;
			$errorInputs[] = array('#nilai_harian', 'Silahkan Isi ');
		}		if (empty($nilai_uts)) {
			$status = false;
			$errorInputs[] = array('#nilai_uts', 'Silahkan Isi ');
		}		if (empty($nilai_uas)) {
			$status = false;
			$errorInputs[] = array('#nilai_uas', 'Silahkan Isi ');
		}		if (empty($nilai_pengetahuan)) {
			$status = false;
			$errorInputs[] = array('#nilai_pengetahuan', 'Silahkan Isi ');
		}		if (empty($nilai_karakter)) {
			$status = false;
			$errorInputs[] = array('#nilai_karakter', 'Silahkan Isi ');
		}		if (empty($keterangan)) {
			$status = false;
			$errorInputs[] = array('#keterangan', 'Silahkan Isi ');
		}else {
			$in = array(
				'kode_mapel' => $mapel,
				'nilai_harian' => $nilai_harian,
				'nisn' => $nisn,
				'nilai_uts' => $nilai_uts,
				'nilai_uas' => $nilai_uas,
				'nilai_pengetahuan' => $nilai_pengetahuan,
				'nilai_karakter' => $nilai_karakter,
				'keterangan' => $keterangan,
			);
	
		}
		if($status){
			$this->SiswaModel->tambah_nilai_siswa($in);

			$message = "Berhasil Menambah Nilai Siswa #1";
			// $status = true;
		}

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function getMapelByKelas()
	{
		$id = $_POST['id'];
		// var_dump($id);die;
		$data = $this->SiswaModel->getMapelByidKelas($id);
		echo json_encode($data);

		# code...
	}
	public function nilaiKelas()
	{

		if (!$this->isLoggedInAdmin()) {
			echo 'Anda Harus Login!';
			redirect('login', 'refresh');
			exit();
		}

		$u = $this->uri->segment(3);				
			// var_dump($u);
		// var_dump($_SESSION);die;
		$u = $this->uri->segment(3);
		$id_kelas = $this->SiswaModel->getMapelByid($u)[0]->id_kelas;

		if($_SESSION['user']=="guru"){
			
			if($_SESSION['id_kelas'] == $id_kelas ){
				$data['mapel'] = $this->SiswaModel->getMapelByid($u);
				$data['kelas'] = $this->SiswaModel->getKelasByid_kelas($id_kelas);
				$data['listKelas'] = $this->SiswaModel->getAllKelas();
				// $data['listSiswa'] = $this->SiswaModel->getAllSiswaByIDKelasOuterJinNilai($id_kelas);
				$data['listSiswa'] = $this->SiswaModel->getAllSiswaByIDKelas($id_kelas);
				$data['listMapel'] = $this->SiswaModel->getAllMapel();
				$data['siswa'] = $this->SiswaModel->siswa();
			} else{

			// echo" alert("s")";
 			 echo'<script type="text/javascript">
                    alert("Kelas Bukan Untuk Anda...");
				</script>';
				
				
				redirect('Nilai','refresh');
				
			}
			
		}else{

		$data['mapel'] = $this->SiswaModel->getMapelByid($u);
		$data['kelas'] = $this->SiswaModel->getKelasByid_kelas($id_kelas);
		$data['listKelas'] = $this->SiswaModel->getAllKelas();
		$data['listSiswa'] = $this->SiswaModel->getAllSiswaByIDKelasOuterJinNilai($id_kelas);
		$data['listMapel'] = $this->SiswaModel->getAllMapel();
		$data['siswa'] = $this->SiswaModel->siswa();
		}

		$data['content'] = 'nilai/data_nilai_kelas_mapel';


		$this->load->view('templates/index', $data);
	}
	public function getSiswaKelas()
	{
		$kelas = $_POST['kelas'];
		// $dt = $this->ProdukModel->dt_produk($_POST);
		// var_dump($_POST);die;
		$bu = base_url();
		$dt = $this->SiswaModel->data_AllSiswaKelas($_POST, $kelas);
		$datatable['draw']      = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();

		$no = $start + 1;

		foreach ($dt['data']->result() as $row) {


			$fields = array($no++);

			$fields[] = $row->nama_lengkap .
			'<br>';
			$fields[] = $row->nisn . '<br>';
			$fields[] = '<img src="'.base_url().'upload/images/' . $row->foto.'" id="image" alt="image"><br>';
			$datatable['data'][] = $fields;
		}



		echo json_encode($datatable);

		exit();
	}
	public function tambah_nilai_proses()
	{
		// var_dump($_POST);die;
		$nisn = $this->input->post('siswa', TRUE);
		$mapel = $this->input->post('mapel', TRUE);
		$nilai_harian = $this->input->post('nilai_harian', TRUE);
		$nilai_uts = $this->input->post('nilai_uts', TRUE);
		$nilai_uas = $this->input->post('nilai_uas', TRUE);
		$nilai_pengetahuan = $this->input->post('nilai_pengetahuan', TRUE);
		$nilai_karakter = $this->input->post('nilai_karakter', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		$cekNilaiSiswa = $this->SiswaModel->CekNilaiSiswa($nisn,$mapel);
		$namaSiswa = $this->SiswaModel->getSiswaByNisn($nisn)[0]->nama_lengkap;

		// var_dump($namaSiswa);die;
		

		$message = 'Gagal menambah data Nilai !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		// var_dump($in);die();
		if (empty($nilai_harian)) {
			$status = false;
			$errorInputs[] = array('#nilai_harian', 'Silahkan Isi');
		}
		if (empty($nilai_uts)) {
			$status = false;
			$errorInputs[] = array('#nilai_uts', 'Silahkan pilih ');
		}
		if (empty($nilai_uas)) {
			$status = false;
			$errorInputs[] = array('#nilai_uas', 'Silahkan isi');
		}		if (empty($nilai_pengetahuan)) {
			$status = false;
			$errorInputs[] = array('#nilai_pengetahuan', 'Silahkan isi');
		}		if (empty($nilai_karakter)) {
			$status = false;
			$errorInputs[] = array('#nilai_karakter', 'Silahkan isi');
		}
		if (empty($keterangan)) {
			$status = false;
			$errorInputs[] = array('#keterangan', 'Silahkan isi');
		}
		if (empty($nilai_harian)) {
			$status = false;
			$errorInputs[] = array('#nilai_harian', 'Silahkan isi');
		}


		$in = array(
			'kode_mapel' => $mapel,
			'nisn' => $nisn,
			'nilai_harian' => $nilai_harian,
			'nilai_uts' => $nilai_uts,
			'nilai_uas' => $nilai_uas,
			'nilai_pengetahuan' => $nilai_pengetahuan,
			'nilai_karakter' => $nilai_karakter,
			'keterangan' => $keterangan,
		);
		if (count($cekNilaiSiswa) > 0
		) {
			$message = 'Siswa:  '. $namaSiswa.' Sudah Di nilai!';
			$errorInputs = array();
			$status = false;
			// die;
		}else if($status){
			$this->SiswaModel->tambah_nama_tabel($in);
			$message = "Berhasil Menambah Nilai Siswa #1";
			// $status: true;
		}
	 else {
			$message = "Gagal menambah Nilai Siswa , silahkan isi semua form";
			// $status: false;
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function downloadTemplateNilai()

	{
		$this->load->helper('download');


		// Use it when necessary

		$sFileName = 'assets/template/template_nilai.xlsx';
		force_download($sFileName, NULL);
	}



}
