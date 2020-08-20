<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            
		    $this->load->model('SiswaModel');
        }
    public function index()
        {
            $data['contoh']="contoh";
            $this->load->view('contoh',$data);
        }
            public function SiswaAll()
        {
            
            $dt = $this->SiswaModel->siswa();
            
            $data['judul']="SISWA";
            $data['siswa']=$dt->result();
            $this->load->view('contoh',$data);
        }
        
       
}
