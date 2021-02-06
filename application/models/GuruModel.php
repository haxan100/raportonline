<?php

defined('BASEPATH') or exit('No direct script access allowed');



class GuruModel extends CI_Model

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
		$this->db->select('*');
		$this->db->where('username', $username);
		// $this->db->where('password', $password);
		return $this->db->get('guru');
	}
		public function GuruAll()

	{
		$this->db->select('w.*,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = w.id_kelas', 'left');
		$query = $this->db->get('guru w');
		
		return $query;
	}
		public function UpdateProf($data)
	{

		$arr = [
			'username' => trim($data['username']),
			'password' => trim($data['password']),
		];
		if (!empty($data['id_user'])) {
			$this->db->where('id_guru', $data['id_user']);
			$this->db->where('id_kelas', $data['id_kelas']);
			$this->db->update('guru', $arr);
		} else {
			$this->db->insert('guru', $arr);
			if (!empty($this->db->error()['message'])) {
				return $this->db->error();
			}
		}
	}
		public function GetGuruByUsername($username)
	{
		$this->db->select('*');
		$this->db->where('username', $username);
		return $this->db->get('guru')->result();
	}
		public function GuruAllForStudent()

	{
		$this->db->select('g.id_guru,g.foto,g.nik,g.nama_guru,m.nama_mapel,g.alamat,k.nama_kelas');
		
		$this->db->join('kelas k', 'k.id_kelas = g.id_kelas', 'left');
		$this->db->join('mapel m', 'm.kode_mapel = g.id_mapel', 'left');
		$query = $this->db->get('guru g');
		
		return $query;
	}


}
