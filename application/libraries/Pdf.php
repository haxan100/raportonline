<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
	function __construct()
	{
		
		parent::__construct();
		// $this->load->model('KonfigModel');
	}
	    public function Header() {
		// $image_file = base_url().'assets/images/logo.png';
		// var_dump($image_file);die;
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 3000, '', false, false, 0, false, false, false);
		// $pdf->Image('@' . $image_file, 55, 19, '', '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);


        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
		$this->Cell(0, 15, 'SMP 4 TAMAN PEMALANG ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		// $this->Cell(0, 5, 'JAWA TENGAH ', 1, TRUE, 'C', 0, '', -4, false, 'S', 'M');
		
		
		// $this->Cell(0, 16, 'DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA  ', 1, false, 'A', 0, '', 0, false, 'S', 'S');
		// $this->Cell(0, 15, 'SMPN 4 TAMAN PEMALANG ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}
