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



}
