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
		$this->db->where('kode_wali', $kode_wali);
		$query = $this->db->get('wali_kelas');
		return $query->result();
	}
	public function tambah_Wali($in)
	{

		return $this->db->insert('wali_kelas', $in);
	}
	public function HapusWali($kode_wali)
	{
		$this->db->where('kode_wali', $kode_wali);

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

}
