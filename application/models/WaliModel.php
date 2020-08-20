<?php

defined('BASEPATH') or exit('No direct script access allowed');



class WaliModel extends CI_Model

{
	public function index()

	{
		$this->db->select('w.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = w.id_kelas', 'left');
		$query = $this->db->get('wali_kelas w');
		
		return $query;
	}

	public function data_AllWali($post)

	{
		$columns = array(
			'nama_wali',
			'w.id_kelas',			'nama_kelas',

		);
		// untuk search
		$columnsSearch = array(
			'nama_wali',
			'w.id_kelas',			'nama_kelas',

		);



		// gunakan join disini

		$from = 'wali_kelas w';



		// custom SQL

		$sql = "SELECT* FROM {$from}  left join kelas k on k.id_kelas = w.id_kelas
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
	public function edit_wali($in, $kode_wali)

	{

		$this->db->where('kode_wali', $kode_wali);
		return $this->db->update('wali_kelas', $in);

		// var_dump($this->db->last_query());


		// $query = $this->db->get('siswa s');

		//  $query;
	}
	public function getWaliById($kode_wali)
	{
		$this->db->select('*');
		$this->db->where('id_wali_kelas', $kode_wali);
		$query = $this->db->get('wali_kelas');
		return $query->result();
	}
	public function tambah_Wali($in)
	{

		return $this->db->insert('wali_kelas', $in);
	}
	public function HapusWali($kode_wali)
	{
		$this->db->where('id_wali_kelas', $kode_wali);

		$this->db->delete('wali_kelas');
		$query = $this->db->get('wali_kelas s');

		return $query->result();


		# code...
	}
	public function getAllGuru()

	{
		$this->db->select('*');
		$query = $this->db->get('wali_kelas s');

		return $query->result();
	}
	public function getAllMapelFromKelas($kelas)
	{
		
		$this->db->select('*');
		
		$this->db->where('id_kelas', $kelas);
		$query = $this->db->get('mapel');
		return $query->result() ;
		
		
		
		# code...
	}
	public function getGuruByNik($kode_wali)
	{
		$this->db->select('*');
		$this->db->where('kode_wali', $kode_wali);
		$query = $this->db->get('wali_kelas');
		return $query->result();
	}
	public function data_AllGuru($post)

	{
		$columns = array(
			'nama_guru',
			'w.id_kelas',	
			'nama_kelas',

		);
		// untuk search
		$columnsSearch = array(
			'nama_guru',
			'w.id_kelas',		
			'nama_kelas',

		);
		$from = 'guru w';
		$sql = "SELECT m.*,w.* ,k.nama_kelas FROM {$from}  left join mapel m on m.kode_mapel = w.id_mapel left join kelas k on k.id_kelas = m.id_kelas
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
	public function getGuruMapel($mapel)
	{
		$this->db->select('*');
		$this->db->where('id_mapel', $mapel);
		$query = $this->db->get('guru');
		return $query->result();
	}
	public function tambah_Guru($in)
	{

		return $this->db->insert('guru', $in);
	}
	public function HapusGuru($id_guru)
	{
		$this->db->where('id_guru', $id_guru);

		$this->db->delete('guru');
		$query = $this->db->get('wali_kelas s');

		return $query->result();


		# code...
	}
	public function getGuruById($id_guru)
	{
		$this->db->select('*');
		$this->db->where('id_guru', $id_guru);
		$query = $this->db->get('guru');
		return $query->result();
	}
	public function getAllMapelFromKelasAdnMapel($kelas,$mapel)
	{

		$this->db->select('*');

		$this->db->where('id_kelas', $kelas);
		$this->db->where('kode_mapel', $mapel);
		$query = $this->db->get('mapel');
		return $query->result();



		# code...
	}
	public function edit_guru($in, $id_guru)

	{

		$this->db->where('id_guru', $id_guru);
		return $this->db->update('guru', $in);

	}
	public function UpdateProf($data)
	{

		$arr = [
			'username' => trim($data['username']),
			'password' => trim($data['password']),
		];
		if (!empty($data['id_user'])) {
			$this->db->where('kode_wali', $data['id_user']);
			$this->db->where('id_kelas', $data['id_kelas']);
			$this->db->update('wali_kelas', $arr);
		} else {
			$this->db->insert('wali_kelas', $arr);
			if (!empty($this->db->error()['message'])) {
				return $this->db->error();
			}
		}
	}
	public function UpdateProfAdmin($data)
	{

		$arr = [
			'username' => trim($data['username']),
			'password' => trim($data['password']),
		];
		if (!empty($data['id_user'])) {
			$this->db->where('id_user', $data['id_user']);
			$this->db->update('admin', $arr);
		} else {
			$this->db->insert('admin', $arr);
			if (!empty($this->db->error()['message'])) {
				return $this->db->error();
			}
		}
	}
		public function listAllGuru()

	{
		$this->db->select('*');
		$query = $this->db->get('guru s');

		return $query->result();
	}
		public function getGuruByRealNik($nik)
	{
		$this->db->select('*');
		$this->db->where('nik', $nik);
		$query = $this->db->get('guru');
		return $query->result();
	}
		public function getWaliByNikAndKelas($kode_wali,$id_kelas)
	{
		$this->db->select('*');
		$this->db->where('kode_wali', $kode_wali);
		$this->db->where('id_kelas', $id_kelas);
		$query = $this->db->get('wali_kelas');
		return $query->result();
	}
	public function getWaliByNikAndPass($kode_wali,$pass)
	{
		$this->db->select('*');
		$this->db->where('kode_wali', $kode_wali);
		// $this->db->where('id_kelas', $id_kelas);
		$this->db->where('password', $pass);
		$query = $this->db->get('wali_kelas');
		return $query->result();
	}


}
