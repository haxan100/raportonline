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

$pdf->Cell(190,7,'DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA',0,1,'C');
$pdf->Cell(190,7,'JAWA TENGAH',0,1,'C');

$html=
"
<table cellspacing='1' cellpadding='1' border='1'>
    <tr>
        <td rowspan='3'>Nama Siwa : $siswa </td>
        <td>Kelas : $kelas</td>
        <td>NISN/ NIS : $nisn</td>
    </tr>

</table>

";

$html.=
"
<br>
<hr class='solid' style='
    margin-bottom: 61px;
'> 
<br>";

$pdf->Ln();
            $i=0;
            $html.=
            '
                    <table cellspacing="1" bgcolor="#666666" cellpadding="">
                        <tr bgcolor="#ffffff">
                            <th  align="center" style="border:1px solid #000;">No</th>
                            <th  align="center" style="border:1px solid #000;">Nama Mapel</th>
                            <th  align="center" style="border:1px solid #000;">Nilai Harian</th>
                            <th  align="center" style="border:1px solid #000;">Nilai UTS</th>
                            <th  align="center" style="border:1px solid #000;">Nilai UAS</th>
                            <th  align="center" style="border:1px solid #000;">Nilai Pengetahuan</th>
                            <th  align="center" style="border:1px solid #000;">Nilai Karakter</th>
                            <th  align="center" style="border:1px solid #000;">Predikat</th>
                        </tr>';
            foreach ($data as $row) 
                {
                    // var_dump($row->nama_mapel);die;
                    $huruf="";
                    $total = $row->nilai_harian + $row->nilai_uts +$row->nilai_uas+$row->nilai_pengetahuan+$row->nilai_karakter;
                    $sum_tot = $total /5 ;
                    if($sum_tot >=80 ){
                        $index="A+";
                    }else  if($sum_tot <80 and $sum_tot  >=75   ){
                        $index="A-";
                    } else if($sum_tot >=71 and $sum_tot <=74 ){
                        $index="B+";
                    }else  if($sum_tot >=67 and $sum_tot <= 70 ){
                        $index="B-";
                    }else   if($sum_tot >=62 and $sum_tot <= 59){
                        $index="C+";
                    } else  if($sum_tot >=55 and $sum_tot <=58 ){
                        $index="C-";
                    }else   if($sum_tot >=45 and $sum_tot <=54 ){
                        $index="D";
                    }else {
                        $index ="E";
                    }


                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center" style="border:1px solid #000;">'.$i.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nama_mapel.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nilai_harian.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nilai_uts.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nilai_uas.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nilai_pengetahuan.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$row->nilai_karakter.'</td>
                            <td align="center"  style="border:1px solid #000;">'.$index.'</td>
                        </tr>';
                }
            $html.='</table>';



            // $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            







            $pdf->SetX(15);
            $pdf->Cell(0,6,'Wali Murid',0,0,'L',0);
            $pdf->SetX(15);
            $pdf->Cell(0,55,'(......................)',0,0,'L',0);

            $pdf->SetX(135);
            $pdf->Cell(0,6,'Jakarta, '.$hari.'',0,0,'L',0);
            $pdf->SetX(130);
            $pdf->Cell(0,20,'Kepala Sekolah',0,0,'C',0);
            $pdf->SetX(130);
            $pdf->Cell(0,55,'( '.$kepala_sekolah.' )',0,0,'C',0);


            $pdf->endPage();
            // $pdf->SetY($y_axis+10);

// $pdf->Write(7, 'Some sample text');
$pdf->Output($judul, 'I');




?>