<?php

defined('BASEPATH') or exit('No direct script access allowed');



class SiswaModel extends CI_Model

{
	public function siswa()

	{
		$this->db->select('s.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$query = $this->db->get('siswa s');
		
		return $query;
	}
	public function getAllKelas()

	{
		$this->db->select('*');
		$query = $this->db->get('kelas s');

		return $query->result();
	}
	public function isSiswaAda($nisn)

	{
		$this->db->select('*');
		
		$this->db->where('nisn', $nisn);
		
		$query = $this->db->get('siswa s');

		return $query->result();
	}
	public function edit_siswa($in,$nisn)

	{
		
		$this->db->where('nisn', $nisn);
		return $this->db->update('siswa', $in);

        // var_dump($this->db->last_query());


		// $query = $this->db->get('siswa s');

		//  $query;
	}
	public function getFotoOld($nisn)

	{
		$this->db->select('foto');


		$this->db->where('nisn', $nisn);
		$query = $this->db->get('siswa s');
		return $query->result()[0]->foto;
		

		//  $query;
	}
	public function getSiswaByNisn($nisn)
	{

		$this->db->select('*');


		$this->db->where('nisn', $nisn);
		$query = $this->db->get('siswa s');
		return $query->result();
		# code...
	}
	public function HapusSiswa($nisn)
	{
		$this->db->where('nisn', $nisn);
		
		$this->db->delete('siswa');
		$query = $this->db->get('siswa s');

		return $query->result();

		
		# code...
	}
	public function tambah_siswa($in)
	{
		
		return $this->db->insert('siswa', $in);
		
	}
	public function getKelasByNama($nama)
	{

		$this->db->select('*');


		$this->db->where('nama_kelas', $nama);
		$query = $this->db->get('kelas');
		return $query->result();
		# code...
	}
	public function tambah_kelas($in)
	{

		return $this->db->insert('kelas', $in);
	}

	public function data_AllKelas($post)

	{
		$columns = array(
			'id_kelas',
			'nama_kelas',
			// 'p.created_at',

			// 'p.stok',

			// 'p.view_count',

			// 'p.harga_awal',

			// // 'p.harga_awal',

			// // 'p.created_at',

		);
		// untuk search
		$columnsSearch = array(
			'nama_kelas',


			// 'p.judul',

			// 'p.harga_awal',

			// 'p.view_count',

			// 'p.status',

		);



		// gunakan join disini

		$from = 'kelas k';



		// custom SQL

		$sql = "SELECT* FROM {$from} 
		";



		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";
		
		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;	
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllSiswa($post)

	{
		$columns = array(
			'nisn',
			'nama_lengkap',
			'tanggal_lahir',
			'tempat_lahir',
			'jenkel',
			'alamat',
			'nama_kelas',

		);
		// untuk search
		$columnsSearch = array(
			'nama_lengkap',


			// 'p.judul',

			// 'p.harga_awal',

			// 'p.view_count',

			// 'p.status',

		);



		// gunakan join disini

		$from = 'siswa s';



		// custom SQL

		$sql = "SELECT* FROM {$from}  left join kelas k on k.id_kelas = s.id_kelas
		";



		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function isKelasAda($kelas)

	{
		$this->db->select('*');

		$this->db->where('id_kelas', $kelas);

		$query = $this->db->get('kelas');

		return $query->result();
	}
	public function edit_kelas($in, $kelas)

	{

		$this->db->where('id_kelas', $kelas);
		return $this->db->update('kelas', $in);

		// var_dump($this->db->last_query());


		// $query = $this->db->get('siswa s');

		//  $query;
	}
	public function getKelasByid_kelas($id_kelas)
	{

		$this->db->select('*');


		$this->db->where('id_kelas', $id_kelas);
		$query = $this->db->get('kelas');
		return $query->result();
		# code...
	}
	public function HapusKelas($id_kelas)
	{
		$this->db->where('id_kelas', $id_kelas);

		$this->db->delete('kelas');
		$query = $this->db->get('kelas s');

		return $query->result();


		# code...
	}
	public function getAllMapel()

	{
		$this->db->select('*');
		$query = $this->db->get('mapel ');

		return $query->result();
	}
	public function data_AllMapel($post)

	{
			$columns = array(
			'm.kode_mapel',
			'm.nama_mapel',	
			'm.kkm',
			'k.nama_kelas',

		);
		// untuk search
		$columnsSearch = array(
			'm.nama_mapel',	
			'm.kode_mapel',
			'm.kkm',
			'k.nama_kelas',

		);



		// gunakan join disini

		$from = 'mapel m';



		// custom SQL

		$sql = "SELECT * FROM {$from}  join kelas k on k.id_kelas = m.id_kelas
		";



		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function isMapelAda($kelas)

	{
		$this->db->select('*');

		$this->db->where('kode_mapel', $kelas);

		$query = $this->db->get('mapel');

		return $query->result();
	}
	public function edit_mapel($in, $id_mapel)

	{

		$this->db->where('kode_mapel', $id_mapel);
		return $this->db->update('mapel', $in);
	}
	public function getMapelByNama($nama,$kelas)
	{
		$this->db->select('*');
		$this->db->where('nama_mapel', $nama);
		$this->db->where('id_kelas', $kelas);
		$query = $this->db->get('mapel');
		return $query->result();
		# code...
	}
	public function tambah_mapel($in)
	{

		return $this->db->insert('mapel', $in);
	}
	public function getMapelByid($kode_mapel)
	{
		$this->db->select('*');
		$this->db->where('kode_mapel', $kode_mapel);
		$query = $this->db->get('mapel');
		return $query->result();
		# code...
	}
	public function HapusMapel($kode_mapel)
	{
		$this->db->where('kode_mapel', $kode_mapel);

		$this->db->delete('mapel');
		$query = $this->db->get('mapel s');

		return $query->result();


		# code...
	}
	public function data_AllKelasWali($post)

	{
		// var_dump($post);die;
		$columns = array(
			'k.nama_kelas',
			'nama_mapel',
			'n.nilai_harian',
			'n.nilai_uts',
			'n.nilai_uas',
			'n.nilai_pengetahuan',
			'n.nilai_karakter',
			'n.keterangan'

		);
		// untuk search
		$columnsSearch = array(
			'k.nama_kelas',
			'nama_mapel',
			'n.nilai_harian',
			'n.nilai_uts',
			'n.nilai_uas',
			'n.nilai_pengetahuan',
			'n.nilai_karakter',
			'n.keterangan'
		);
		// gunakan join disini
		$from = 'kelas k';
				// custom SQL
		$sql = "SELECT k.*, m.nama_mapel, n.*,s.* FROM `nilai` n
					join mapel m on m.kode_mapel=n.kode_mapel
					join siswa s on s.nisn=n.nisn 
					join kelas k on k.id_kelas=s.id_kelas 
		";
		// var_dump($sql);
		$where = "";
		if (isset($post['kelas']) && $post['kelas'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (s.id_kelas='" . $post['kelas'] . "')";
		}
		if (isset($post['mapel']) && $post['mapel'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (n.kode_mapel='" . $post['mapel'] . "')";
		}

		// if (isset($post['kelas']) && $post['kelas'] != 'Pilih Kelas') {
		// 	if ($where != "") $where .= "AND";
		// 	$where .= " (s.id_kelas='" . $post['kelas'] . "')";
		// }
		// if (isset($post['mapel']) && $post['mapel'] != 'Pilih Mapel') {
		// 	if ($where != "") $where .= "AND";
		// 	$where .= " (n.kode_mapel='" . $post['mapel'] . "')";
		// }
		$whereTemp = "";
		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis
			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';
		//SORT Kolom
		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;
		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		// var_dump($sql);die;
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllKelasSiswa($post, $id_kelas)

	{
		$columns = array(
			'nisn',
			'nama_lengkap',
			'nama_kelas',


		);
		// untuk search
		$columnsSearch = array(
			'k.nisn',
			'nama_lengkap',
			'nama_kelas',

		);



		// gunakan join disini

		$from = 'kelas k';
		// custom SQL
		$sql = "SELECT s.*,k.*, k.id_kelas as kid_kelas FROM {$from}  join siswa s on k.id_kelas=s.id_kelas where k.id_kelas='$id_kelas'
		";
		// var_dump($sql);
		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' and (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllNilaiSiswa($post, $nisn)

	{
		$columns = array(
			'k.nama_kelas',
			'nama_mapel',
			'n.nilai_harian',
			'n.nilai_uts',
			'n.nilai_uas',
			'n.nilai_pengetahuan',
			'n.nilai_karakter',
			'n.keterangan'

		);
		// untuk search
		$columnsSearch = array(
			'k.nama_kelas',
			'nama_mapel',
			'n.nilai_harian',
			'n.nilai_uts',
			'n.nilai_uas',
			'n.nilai_pengetahuan',
			'n.nilai_karakter',
			'n.keterangan'
		);

		// gunakan join disini

		$from = 'nilai n';
		$sql = "SELECT k.*, m.nama_mapel, n.*,s.* FROM `nilai` n
					join mapel m on m.kode_mapel=n.kode_mapel
					join siswa s on s.nisn=n.nisn 
					join kelas k on k.id_kelas=s.id_kelas 
		 where n.nisn='$nisn'
		";
		// var_dump($sql);
		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' and (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function cekMapelDiNilai($mapel,$nisn)
	{
		$this->db->select('*');
		$this->db->where('kode_mapel', $mapel);
		$this->db->where('nisn', $nisn);
		$query = $this->db->get('nilai');
        // var_dump($this->db->last_query());

		return $query->result();
		# code...
	}
	public function tambah_nilai_siswa($in)
	{

		return $this->db->insert('nilai', $in);
	}
	public function isNilaiSiswaAda($id_nilai)

	{
		$this->db->select('*');

		$this->db->where('id_nilai', $id_nilai);

		$query = $this->db->get('nilai s');

		return $query->result();
	}
	public function edit_nilai_siswa($in, $id_nilai)

	{

		$this->db->where('id_nilai', $id_nilai);
		return $this->db->update('nilai', $in);

		// var_dump($this->db->last_query());


		// $query = $this->db->get('siswa s');

		//  $query;
	}
	public function getNilaiSiswaByidMap($id_nilai)
	{

		$this->db->select('*');

		// $this->db->from('nilai s');
		$this->db->join('mapel m', 'm.kode_mapel = s.kode_mapel', 'left');
		
		
		$this->db->where('id_nilai', $id_nilai);
		$query = $this->db->get('nilai s');
		return $query->result();
		# code...
	}
	public function HapusNilaiSiswa($id_nilai)
	{
		$this->db->where('id_nilai', $id_nilai);

		$this->db->delete('nilai');
		$query = $this->db->get('nilai s');

		return $query->result();


		# code...
	}
	function cek_login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}
	public function login($username)
	{
		$this->db->select('nisn,nama_lengkap,password');
		$this->db->where('username', $username);
		// $this->db->where('password', $password);
		return $this->db->get('siswa');
	}
	public function getMapelByidKelas($id_kelas)
	{
		$this->db->select('*');
		$this->db->where('id_kelas', $id_kelas);
		$query = $this->db->get('mapel');
		return $query->result();
		# code...
	}
	public function data_AllSiswaKelas($post,$idkelas)

	{
		// var_dump($post);die;
		$columns = array(
			'nama_lengkap',

		);
		// untuk search
		$columnsSearch = array(
			'nama_lengkap'
			// 's.nama_kelas',
			// 'w.nama_wali',
		);
		// gunakan join disini
		$from = 'siswa s';
		// custom SQL
		$sql = "SELECT* FROM $from inner join mapel m on m.id_kelas=s.id_kelas ";
		// var_dump($sql);
		$where = "";
		if (isset($post['kelas']) && $post['kelas'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (s.id_kelas='" . $post['kelas'] . "')";
		}
		if (isset($post['mapel']) && $post['mapel'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (m.kode_mapel='" . $post['mapel'] . "')";
		}
		// if (isset($post['mapel']) && $post['mapel'] != 'default') {
		// 	if ($where != "") $where .= "AND";
		// 	$where .= " (n.kode_mapel='" . $post['mapel'] . "')";
		// }
		// if (isset($post['status']) && $post['status'] != 'default') {
		// 	if ($where != "") $where .= "AND";
		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }
		$whereTemp = "";
		// if (isset($post['date']) && $post['date'] != '') {
		//     $date = explode(' / ', $post['date']);
		//     if (count($date) == 1) {
		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";
		//     } else {
		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";
		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";
		//     }
		// }
		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis
			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';
		//SORT Kolom
		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;
		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function getAllSiswaByIDKelas($kelas)

	{
		$this->db->select('*');
		$this->db->where('id_kelas', $kelas);
		$query = $this->db->get('siswa s');

		return $query->result();
	}
	public function tambah_nama_tabel($in)
	{

		return $this->db->insert('nilai', $in);
	}
	public function CekNilaiSiswa($nisn, $mapel)
	{
		$this->db->select('*');
		$this->db->where('kode_mapel', $mapel);
		$this->db->where('nisn', $nisn);
		$query = $this->db->get('nilai');
		// var_dump($this->db->last_query());

		return $query->result();
		# code...
	}
	public function getAllSiswaByIDKelasOuterJinNilai($kelas)

	{
		$this->db->select('siswa.*');
		$this->db->from('siswa');
		
		$this->db->join('nilai', 'nilai.nisn = siswa.nisn', 'LEFT OUTER');
		$this->db->where('nilai.nisn is null');
		$this->db->where('siswa.id_kelas', $kelas);
		// $this->db->where('nilai.kode_mapel', 9);
		$query = $this->db->get();
		// var_dump($this->db->last_query());
		// die;
		

		return $query->result();
	}
	public function getIdKelasByNISN($nisn)
	{

		$this->db->select('*');
		
		$this->db->from('siswa');
		


		$this->db->where('nisn', $nisn);
		$query = $this->db->get();
		return $query->result();
		# code...
	}
	public function getAllMapelByIdKelas($id_kelas)

	{
		$this->db->select('*');
		$this->db->where('id_kelas', $id_kelas);
		
		$query = $this->db->get('mapel ');

		return $query->result();
	}
	public function getSiswaByid_kelas($id_kelas)
	{

		$this->db->select('*');


		$this->db->where('id_kelas', $id_kelas);
		$query = $this->db->get('siswa');
		return $query->result();
		# code...
	}
	public function data_AllSiswaByKelas($post,$id_kelas)

	{
		$columns = array(
			'nama_lengkap',
			// 'p.created_at',

			// 'p.stok',

			// 'p.view_count',

			// 'p.harga_awal',

			// // 'p.harga_awal',

			// // 'p.created_at',

		);
		// untuk search
		$columnsSearch = array(
			'nama_lengkap',


			// 'p.judul',

			// 'p.harga_awal',

			// 'p.view_count',

			// 'p.status',

		);



		// gunakan join disini

		$from = 'siswa s';



		// custom SQL

		$sql = "SELECT* FROM {$from}  left join kelas k on k.id_kelas = s.id_kelas

		";

// var_dump($_POST);die;

		$where = "";

		if (isset($post['id_kelas']) && $post['id_kelas'] != 'default') {

			if ($where != "") $where .= "AND";

			$where .= " (s.id_kelas='" . $post['id_kelas'] . "')";
		}

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllKelasByKelas($post,$id_kelas)

	{
		$columns = array(
			'id_kelas',
			'nama_kelas',
			// 'p.created_at',

			// 'p.stok',

			// 'p.view_count',

			// 'p.harga_awal',

			// // 'p.harga_awal',

			// // 'p.created_at',

		);
		// untuk search
		$columnsSearch = array(
			'nama_kelas',


			// 'p.judul',

			// 'p.harga_awal',

			// 'p.view_count',

			// 'p.status',

		);



		// gunakan join disini

		$from = 'kelas k';



		// custom SQL

		$sql = "SELECT* FROM {$from} where id_kelas=$id_kelas
		";



		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllMapellByIdKelas($post, $getKelasFromSess)

	{
		$columns = array(
			'm.kode_mapel',
			'm.nama_mapel',	
			'm.kkm',
			'k.nama_kelas',

		);
		// untuk search
		$columnsSearch = array(
			'm.nama_mapel',	
			'm.kode_mapel',
			'm.kkm',
			'k.nama_kelas',

		);



		// gunakan join disini

		$from = 'mapel m';



		// custom SQL

		$sql = "SELECT * FROM {$from}  join kelas k on k.id_kelas = m.id_kelas where m.id_kelas=$getKelasFromSess
		";



		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		// }

		// if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		// }

		// if (isset($post['status']) && $post['status'] != 'default') {

		// 	if ($where != "") $where .= "AND";

		// 	$where .= " (p.status='" . $post['status'] . "')";
		// }



		$whereTemp = "";

		// if (isset($post['date']) && $post['date'] != '') {

		//     $date = explode(' / ', $post['date']);

		//     if (count($date) == 1) {

		//         $whereTemp .= "(created_at LIKE '%" . $post['date'] . "%')";

		//     } else {

		//         // $whereTemp .= "(created_at BETWEEN '".$date[0]."' AND '".$date[1]."')";

		//         $whereTemp .= "(date_format(created_at, \"%Y-%m-%d\") >='$date[0]' AND date_format(created_at, \"%Y-%m-%d\") <= '$date[1]')";

		//     }

		// }



		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";

		else if ($whereTemp != '') $where .= $whereTemp;



		// search

		if (isset($post['search']['value']) && $post['search']['value'] != '') {

			$search = $post['search']['value'];

			// create parameter pencarian kesemua kolom yang tertulis

			// di $columns

			$whereTemp = "";

			for ($i = 0; $i < count($columnsSearch); $i++) {

				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';



				// agar tidak menambahkan 'OR' diakhir Looping

				if ($i < count($columnsSearch) - 1) {

					$whereTemp .= ' OR ';
				}
			}

			if ($where != '') $where .= " AND (" . $whereTemp . ")";

			else $where .= $whereTemp;
		}

		if ($where != '') $sql .= ' WHERE (' . $where . ')';







		//SORT Kolom

		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;

		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
		public function getAllMapelAndKelas()

	{
		$this->db->select('*');
		$this->db->from('mapel m');
		$this->db->join('kelas k', 'k.id_kelas = m.id_kelas');
		// db_
		$query = $this->db->get();

		return $query->result();
	}
		public function getNilaiSiswaByNISN($nisn)
	{

		$this->db->select('*');
		$this->db->from('nilai n');
		$this->db->join('mapel m', 'm.kode_mapel = n.kode_mapel');	
		
		$this->db->where('n.nisn', $nisn);
		$query = $this->db->get();
		return $query->result();
		# code...
	}
		public function UpdateProfSiswa($data)
	{

		$arr = [
			'username' => trim($data['username']),
			'password' => trim($data['password']),
		];
		if (!empty($data['id_user'])) {
			$this->db->where('nisn', $data['id_user']);
			$this->db->update('siswa', $arr);
		} else {
			$this->db->insert('siswa', $arr);
			if (!empty($this->db->error()['message'])) {
				return $this->db->error();
			}
		}
	}
			
	
	public function getUserBy($idTabel,$namaId)
	{
		$this->db->select('*');
		$this->db->from('siswa');		
		$this->db->where($idTabel, $namaId);
		$query = $this->db->get();
        // var_dump($this->db->last_query());die;
		return $query->result();
		# code...
	}
		public function getUserByUsername($username)
	{
		$this->db->select('*');
		$this->db->from('siswa');		
		$this->db->where('username', $username);
		$query = $this->db->get();
        // var_dump($this->db->last_query());die;
		return $query->result();
		# code...
	}
		public function getNilaiSiswaForAPI($nisn)
	{
		$this->db->select('*');
		$this->db->where('nisn', $nisn);
		$this->db->join('mapel m', 'm.kode_mapel = nilai.kode_mapel', 'left');
		
		$query = $this->db->get('nilai');
        // var_dump($this->db->last_query());

		return $query->result();
		# code...
	}
		public function getDetailSiswa($nisn)

	{
		$this->db->select('s.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db->where('nisn', $nisn);
		
		$query = $this->db->get('siswa s');
		// echo $this->db->last_query();die;
		return $query->result();
	}
		public function getAllSiswaForStuden()

	{
		$this->db->select('s.nisn,s.alamat,s.foto,s.nama_lengkap,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$query = $this->db->get('siswa s');
		
		return $query;
	}
		public function getAllMapelForStudent()

	{
		$this->db->select('*');
		
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$query = $this->db->get('mapel s');
		
		return $query;
	}
		public function SiswaAll()
	{
		$this->db->select('*');
		$query = $this->db->get('siswa ');
		
		return $query;
	}
		public function MapelAll()
	{
		$this->db->select('*');
		$query = $this->db->get('mapel');
		
		return $query;
	}
		public function getDetailSiswaSatu($nisn)

	{
		$this->db->select('s.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db->where('nisn', $nisn);
		
		$query = $this->db->get('siswa s');
		// echo $this->db->last_query();die;
		return $query->row();
	}
		public function data_allMateri($post)
	{
		// var_dump($post);die;
		$columns = array(
		'kelas',
		'mapel',
		'materi',
		'status',

		);
		// untuk search
		$columnsSearch = array(
		'kelas',
		'mapel',
		'materi',
		'status',
		);

		$sql = "SELECT mat.*,
									map.kode_mapel,map.nama_mapel,
									k.nama_kelas
					 FROM `materi` mat
					join mapel map on map.kode_mapel=mat.id_mapel					
					join kelas k on k.id_kelas=mat.id_kelas 
		";
		// var_dump($sql);
		$where = "";
		if (isset($post['kelas']) && $post['kelas'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (mat.id_kelas='" . $post['kelas'] . "')";
		}
		if (isset($post['mapel']) && $post['mapel'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (mat.id_mapel='" . $post['mapel'] . "')";
		}
		$whereTemp = "";
		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis
			// di $columns
			$whereTemp = "";
			for ($i = 0; $i < count($columnsSearch); $i++) {
				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';
				// agar tidak menambahkan 'OR' diakhir Looping
				if ($i < count($columnsSearch) - 1) {
					$whereTemp .= ' OR ';
				}
			}
			if ($where != '') $where .= " AND (" . $whereTemp . ")";
			else $where .= $whereTemp;
		}
		if ($where != '') $sql .= ' WHERE (' . $where . ')';
		//SORT Kolom
		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;
		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		// $sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		// var_dump($sql);die;
		return array(
			'totalData' => $totaldata,
			'data' => $data,
		);
	}
	public function tambah_materi($in)
	{	
		return $this->db->insert('materi', $in);		
	}
		public function getMateriById($id_nilai)
	{
		$this->db->select('*');	
		$this->db->where('id_materi', $id_nilai);
		$query = $this->db->get('materi s');
		return $query->row();
		# code...
	}
	public function HapusMateri($id_materi)
	{
		$this->db->where('id_materi', $id_materi);
		$this->db->delete('materi');
		$query = $this->db->get('materi s');
		return $query->result();


		# code...
	}
		public function edit_materi($in, $id_nilai)
	{
		$this->db->where('id_materi', $id_nilai);
		return $this->db->update('materi', $in);
	}
			public function data_Materi_for_siswa($post)
	{
		// var_dump($post);die;
		$columns = array(
		'kelas',
		'mapel',
		'materi',
		'status',

		);
		// untuk search
		$columnsSearch = array(
		'kelas',
		'mapel',
		'materi',
		'status',
		);
		$id_kelas = $post['id_kelas'];
		// var_dump($post['id_kelas']);die;

		$sql = "SELECT mat.*,
									map.kode_mapel,map.nama_mapel,
									k.nama_kelas
					 FROM `materi` mat
					join mapel map on map.kode_mapel=mat.id_mapel					
					join kelas k on k.id_kelas=mat.id_kelas 
					where mat.id_kelas = $id_kelas and mat.status=1
		";
		// var_dump($sql);
		$where = "";
		// if (isset($post['kelas']) && $post['kelas'] != 'default') {
		// 	if ($where != "") $where .= "AND";
		// 	$where .= " (mat.id_kelas='" . $post['kelas'] . "')";
		// }
		if (isset($post['mapel']) && $post['mapel'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (mat.id_mapel='" . $post['mapel'] . "')";
		}
		$whereTemp = "";
		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis
			// di $columns
			$whereTemp = "";
			for ($i = 0; $i < count($columnsSearch); $i++) {
				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';
				// agar tidak menambahkan 'OR' diakhir Looping
				if ($i < count($columnsSearch) - 1) {
					$whereTemp .= ' OR ';
				}
			}
			if ($where != '') $where .= " AND (" . $whereTemp . ")";
			else $where .= $whereTemp;
		}
		if ($where != '') $sql .= ' and (' . $where . ')';
		//SORT Kolom
		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;
		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		// $sql .= " ORDER BY {$sortColumn} {$sortDir}";

		$count = $this->db->query($sql);
		$totaldata = $count->num_rows();
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		$data  = $this->db->query($sql);
		// var_dump($sql);die;
		return array(
			'totalData' => $totaldata,
			'data' => $data,
		);
	}
		public function getMateriKelasMapelById($id_nilai)
	{
		$this->db->select('*');	
		$this->db->where('id_materi', $id_nilai);
		$this->db->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db->join('mapel m', 'm.kode_mapel = s.id_mapel', 'left');
		$query = $this->db->get('materi s');
		return $query->row();
		# code...
	}







}
