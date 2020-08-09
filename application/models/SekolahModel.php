<?php

defined('BASEPATH') or exit('No direct script access allowed');



class SekolahModel extends CI_Model

{
	public function dataSekolah()

	{
		$this->db->select('*');
		$query = $this->db->get('data_sekolah');

		return $query;
	}

	public function visi()

	{
		$this->db->select('id_visi,ket');		
		// $this->db->from('data_sekolah d');
		 $this->db->join('visi v', 'v.id = d.visi');
		$query= $this->db->get('data_sekolah d');
		// var_dump($this->db->last_query());		die;

		return $query;
	}



}
