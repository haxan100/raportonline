<?php

defined('BASEPATH') or exit('No direct script access allowed');



class AdminModel extends CI_Model

{
	public function index()

	{
		$this->db->select('w.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = w.id_kelas', 'left');
		$query = $this->db->get('wali_kelas w');
		
		return $query;
	}

	function cek_login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}
	public function login($username)
	{
		$this->db->select('id_user,nama,password');
		$this->db->where('username', $username);
		// $this->db->where('password', $password);
		return $this->db->get('admin');
	}

}
