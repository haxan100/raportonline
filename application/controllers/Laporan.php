<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            
		    $this->load->model('SiswaModel');
		$this->load->model('KonfigModel');
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
        public function CetakNilaiByNISN($post)
        {           
            // var_dump($_SESSION);die;
            if ($_SESSION['user'] == "siswa") {
                
                $nisn =  $_SESSION['id_user'];
                if ($nisn == $post){
                    $urlid = $this->uri->segment(3);
                    // $nisn = $urlid;
                    // var_dump($urlid);
                    $dt = $this->SiswaModel->getNilaiSiswaByNISN($nisn); 
                    $siswa = $this->SiswaModel->getSiswaByNisn($nisn)[0]->nama_lengkap; 
                    $id_kelas = $this->SiswaModel->getSiswaByNisn($nisn)[0]->id_kelas; 

                    $kelas = $this->SiswaModel->getKelasByid_kelas($id_kelas)[0]->nama_kelas; 
                    # pendekatan prosedural
                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $hari = strftime("%A %d %B %Y");
                    // die;
                    $kp = $this->KonfigModel->GetSekolah()->result()[0];

                    $data['kepala_sekolah']=$kp->kepala_sekolah;
                    $data['hari']=$hari;
                    $data['nisn']=$nisn;
                    $data['kelas']=$kelas;
                    $data['siswa']=$siswa;
                    $data['judul']="Data Nilai $siswa";
                    $data['judulData']="Data Nilai Siswa  $siswa";
                    $data['data']=$dt;
                    $this->load->view('cetak/cetak_nilai_siswa',$data);
                } else {
                    // var_dump("sss");die;
                    
                    echo '<script type="text/javascript">
                        alert("Nilai Siswa Bukan Untuk Anda...");
                    </script>';


                    redirect('siswa/Kelas', 'refresh');
                }
            }	else{
                 $urlid = $this->uri->segment(3);
                    $nisn = $urlid;
                    // var_dump($urlid);
                    $dt = $this->SiswaModel->getNilaiSiswaByNISN($nisn); 
                    $siswa = $this->SiswaModel->getSiswaByNisn($nisn)[0]->nama_lengkap; 
                    $id_kelas = $this->SiswaModel->getSiswaByNisn($nisn)[0]->id_kelas; 

                    $kelas = $this->SiswaModel->getKelasByid_kelas($id_kelas)[0]->nama_kelas; 
                    # pendekatan prosedural
                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $hari = strftime("%A %d %B %Y");
                    // die;
                    $kp = $this->KonfigModel->GetSekolah()->result()[0];

                    $data['kepala_sekolah']=$kp->kepala_sekolah;
                    $data['hari']=$hari;
                    $data['nisn']=$nisn;
                    $data['kelas']=$kelas;
                    $data['siswa']=$siswa;
                    $data['judul']="Data Nilai $siswa";
                    $data['judulData']="Data Nilai Siswa  $siswa";
                    $data['data']=$dt;
                    $this->load->view('cetak/cetak_nilai_siswa',$data);

            }
        }
            public function Materi($id)
        {            
            $data['data'] = $this->SiswaModel->getMateriKelasMapelById($id);
            $dt = $this->SiswaModel->siswa();          
            $data['judul']="SISWA";
            $data['siswa']=$dt->result();
            $this->load->view('Materi/cetak',$data);
        }
        
       
}
