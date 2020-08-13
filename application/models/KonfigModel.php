<?php

defined('BASEPATH') or exit('No direct script access allowed');



class KonfigModel extends CI_Model

{
    public function index()

    {
        $this->db->select('w.*,k.nama_kelas');

        $this->db->join('kelas k', 'k.id_kelas = w.id_kelas', 'left');
        $query = $this->db->get('wali_kelas w');

        return $query;
	}
	public function data_Sekolah($post)

	{
		$columns = array(
			'nama',
			'alamat',
			'no_telp',

		);
		// untuk search
		$columnsSearch = array(
			'nama',
			'alamat',
			'no_telp',

		);
		$from = 'data_sekolah';
		$sql = "SELECT * FROM {$from} 
		";

		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		$whereTemp = "";
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
	public function edit_konfig($in)

	{

		$this->db->where('id',1);
		return $this->db->update('data_sekolah', $in);
	}
	public function visi_Sekolah($post)

	{
		$columns = array(
			'ket',

		);
		// untuk search
		$columnsSearch = array(
			'ket',

		);
		$from = 'visi';
		$sql = "SELECT * FROM {$from} 
		";

		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		$whereTemp = "";
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
	public function tambah_Visi($in)
	{

		return $this->db->insert('visi', $in);
	}
	public function edit_visi($in,$id)

	{

		$this->db->where('id_visi', $id);
		return $this->db->update('visi', $in);
	}
	public function getVisiById($kode_wali)
	{
		$this->db->select('*');
		$this->db->where('id_visi', $kode_wali);
		$query = $this->db->get('visi');
		return $query->result();
	}
	public function HapusVisi($id_visi)
	{
		$this->db->where('id_visi', $id_visi);

		$this->db->delete('visi');
		$query = $this->db->get('visi');

		return $query->result();


		# code...
	}
	public function misi_Sekolah($post)

	{
		$columns = array(
			'ket',

		);
		// untuk search
		$columnsSearch = array(
			'ket',

		);
		$from = 'misi';
		$sql = "SELECT * FROM {$from} 
		";

		$where = "";

		// if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {

		$whereTemp = "";
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
	public function edit_misi($in, $id)

	{

		$this->db->where('id_misi', $id);
		return $this->db->update('misi', $in);
	}
	public function tambah_Misi($in)
	{

		return $this->db->insert('misi', $in);
	}
	public function getMisiById($kode_wali)
	{
		$this->db->select('*');
		$this->db->where('id_misi', $kode_wali);
		$query = $this->db->get('misi');
		return $query->result();
	}
	public function HapusMisi($id_visi)
	{
		$this->db->where('id_misi', $id_visi);

		$this->db->delete('misi');
		$query = $this->db->get('misi');

		return $query->result();


		# code...
	}

}
