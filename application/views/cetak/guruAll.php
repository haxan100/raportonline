<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
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

$pdf->Cell(190,7,'DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA',0,1,'C');
$pdf->Cell(190,7,'JAWA TENGAH',0,1,'C');

$pdf->Ln();
            $i=0;
            $html='<h3>'.$judulData.'<h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center" style="border:1px solid #000;">No</th>
                            <th width="15%" align="center" style="border:1px solid #000;">Nama Guru</th>
                            <th width="15%" align="center" style="border:1px solid #000;">NIK</th>

                            <th width="15%" align="center" style="border:1px solid #000;">Tempat Lahir</th>

                            <th width="15%" align="center" style="border:1px solid #000;">Tanggal Lahir</th>
                            <th width="25%" align="center" style="border:1px solid #000;">Alamat</th>

                            <th width="10%" align="center" style="border:1px solid #000;">Kelas</th>
                        </tr>';
            foreach ($guru as $row) 
                {
                    // var_dump($row);die;
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center" style="border:1px solid #000;">'.$i.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nama_guru.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nik.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->tempat_lahir.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->tanggal_lahir.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->alamat.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nama_kelas.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');









$pdf->endPage();

// $pdf->Write(7, 'Some sample text');
$pdf->Output($judul, 'I');




?>