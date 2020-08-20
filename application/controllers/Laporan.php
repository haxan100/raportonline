<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            
		    $this->load->model('SiswaModel');
		    $this->load->model('GuruModel');
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
              public function GuruAll()
        {            
            $dt = $this->GuruModel->GuruAll();          
            $data['judul']="Guru_All";
            $data['judulData']="Data Guru";
            $data['guru']=$dt->result();
            $this->load->view('cetak/guruAll',$data);
        }             
         public function MapelAll()
        {            
			$dt= $this->SiswaModel->getAllMapelAndKelas();      
            $data['judul']="Mapel_All";
            $data['judulData']="Data Mapel";
            $data['data']=$dt;
            $this->load->view('cetak/MapelAll',$data);
        }
        
       
}
