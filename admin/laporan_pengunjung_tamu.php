<?php
date_default_timezone_set('Asia/Jakarta');
include 'functions.php';
require('assets/pdf/fpdf.php');

if (isset($_POST['tampilkan'])) {
	$cek = $_POST['cek'];
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	if ($cek == 1) {
		$query1= "SELECT * FROM tamu";
	}
	if($cek==2){
        $query1= "SELECT * FROM tamu
        WHERE tamu.tanggal_kedatangan>='$tgl_awal' AND tamu.tanggal_kedatangan<='$tgl_akhir' ";

	}
}


$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('logo/stm.jpg',1.3,0.48,2.7,2.7);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'SMKN 3 Bondowoso',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0897-0088-757',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. SANTAWI NO. 96A, Tamansari, Kec. Bondowoso, Kab. Bondowoso Prov. Jawa Timur',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.smkn3bondowoso.sch.id ',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Pengunjung Siswa",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Tamu', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Delegasi', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal kedatangan', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Keperluan', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($conn, $query1);
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama_tamu'] , 1, 0, 'C');
    $pdf->Cell(8, 0.8, $lihat['delegasi'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['tanggal_kedatangan'], 1, 0,'C');
	$pdf->Cell(8, 0.8, $lihat['kepentingan'],1, 1, 'C');

	$no++;
}


# footer
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5,"Bondowoso".date('d/M/Y')."",0,'L');
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5, '',0,'C');
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5, '',0,'C');
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5, '',0,'L');
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5, '_________________________',0,'L');
$pdf->SetX(19.5);
$pdf->MultiCell(19,0.5, 'N0 : ',0,'L');
$pdf->Output("laporan_transaksi_pembelian.pdf","I");

?>

