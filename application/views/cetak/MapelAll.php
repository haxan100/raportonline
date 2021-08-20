<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle($judul);
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);	
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 002', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));


$pdf->setFooterData(array(0,64,0), array(0,64,128));

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 20);

$pdf->Cell(190,1,$sekolah->nama, 0,1,'C', 0, '', 0, false, 'M', 'M');
// $pdf->Cell(0, 15, 'SMP 4 TAMAN PEMALANG ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
// $pdf->SetFont('helvetica', 'S', 10);

$pdf->SetFontSize(15);
$pdf->Cell(190,10, $sekolah->alamat ,0,1,'C');
$pdf->SetFontSize(10);
 $pdf->setFont('freesans','');


$html=
"<hr class='solid'>";
$pdf->Ln();
            $i=0;
            $html.='<h3>'.$judulData.'<h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="">
                        <tr bgcolor="#ffffff">
                            <th  align="center" style="border:1px solid #000;">No</th>
                            <th  align="center" style="border:1px solid #000;">Nama Mapel</th>

                            <th  align="center" style="border:1px solid #000;">Kode Mapel</th>

                            <th  align="center" style="border:1px solid #000;">Nama Kelas</th>
                        </tr>';
            foreach ($data as $row) 
                {
                    // var_dump($row);die;
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center" style="border:1px solid #000;">'.$i.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nama_mapel.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->kode_mapel.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nama_kelas.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');









$pdf->endPage();

// $pdf->Write(7, 'Some sample text');
$pdf->Output($judul, 'I');




?>