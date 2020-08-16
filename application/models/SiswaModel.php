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
			'm.nama_mapel',
			// 'p.created_at',

			// 'p.stok',

			// 'p.view_count',

			// 'p.harga_awal',

			// // 'p.harga_awal',

			// // 'p.created_at',

		);
		// untuk search
		$columnsSearch = array(
			'm.nama_mapel',


			// 'p.judul',

			// 'p.harga_awal',

			// 'p.view_count',

			// 'p.status',

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
			'nama_mapel',

		);
		// untuk search
		$columnsSearch = array(
			// 's.nama_kelas',
			// 'w.nama_wali',
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
		// var_dump($sql);die;
		return array(

			'totalData' => $totaldata,

			'data' => $data,

		);
	}
	public function data_AllKelasSiswa($post, $id_kelas)

	{
		$columns = array(
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
			'k.nama_kelas',
			// 's.nama_lengkap',
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
			'nama_mapel',

		);
		// untuk search
		$columnsSearch = array(
			'nama_mapel',
			// 's.nama_lengkap',
		);



		// gunakan join disini

		$from = 'nilai n';
		// custom 
		// SQL SELECT  * FROM `nilai` 
// join siswa s on s.nisn=nilai.nisn
// join mapel m on m.kode_mapel=nilai.kode_mapel
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
		$query = $this->db->get('siswa s');
		$this->db->where('id_kelas', $kelas);

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









}
