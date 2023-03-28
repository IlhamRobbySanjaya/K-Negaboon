<?php
date_default_timezone_set('Asia/Jakarta');
include 'functions.php';
require('assets/pdf/fpdf.php');

if (isset($_POST['tampilkan'])) {
	$cek = $_POST['cek'];
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

	if ($cek == 1) {
		$query1= "SELECT peminjaman_buku_literasi.id_pinjam_buku_literasi, member_perpus.nama_siswa, buku_literasi_umum.judul_buku_literasi, peminjaman_buku_literasi.tanggal_peminjaman, 
        pengembalian_buku_literasi.tanggal_pengembalian, pengembalian_buku_literasi.terlambat, pengembalian_buku_literasi.denda 
        FROM peminjaman_buku_literasi 
        LEFT JOIN member_perpus ON member_perpus.nis = peminjaman_buku_literasi.nis 
        LEFT JOIN buku_literasi_umum ON buku_literasi_umum.kode_buku_literasi = peminjaman_buku_literasi.kode_buku_literasi 
        LEFT JOIN pengembalian_buku_literasi ON pengembalian_buku_literasi.id_pinjam_buku_literasi = peminjaman_buku_literasi.id_pinjam_buku_literasi 
        WHERE peminjaman_buku_literasi.notifikasi = 'kembali' ";

		$total = "SELECT sum(denda) as total_denda FROM pengembalian_buku_literasi";
	}
	if($cek==2){
        $query1= "SELECT peminjaman_buku_literasi.id_pinjam_buku_literasi, member_perpus.nama_siswa, buku_literasi_umum.judul_buku_literasi, peminjaman_buku_literasi.tanggal_peminjaman, 
        pengembalian_buku_literasi.tanggal_pengembalian, pengembalian_buku_literasi.terlambat, pengembalian_buku_literasi.denda 
        FROM peminjaman_buku_literasi 
        LEFT JOIN member_perpus ON member_perpus.nis = peminjaman_buku_literasi.nis 
        LEFT JOIN buku_literasi_umum ON buku_literasi_umum.kode_buku_literasi = peminjaman_buku_literasi.kode_buku_literasi 
        LEFT JOIN pengembalian_buku_literasi ON pengembalian_buku_literasi.id_pinjam_buku_literasi = peminjaman_buku_literasi.id_pinjam_buku_literasi 
        WHERE peminjaman_buku_literasi.tanggal_peminjaman>='$tgl_awal' AND pengembalian_buku_literasi.tanggal_pengembalian <='$tgl_akhir' ";

		$total = "SELECT sum(denda) as total_denda FROM pengembalian_buku_literasi  INNER JOIN peminjaman_buku_literasi 
        ON peminjaman_buku_literasi.id_pinjam_buku_literasi = pengembalian_buku_literasi.id_pinjam_buku_literasi 
        WHERE peminjaman_buku_literasi.tanggal_peminjaman>='$tgl_awal' AND pengembalian_buku_literasi.tanggal_pengembalian <='$tgl_akhir' 
        ORDER BY peminjaman_buku_literasi.tanggal_peminjaman asc";
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
$pdf->Cell(25.5,0.7,"Laporan Data Pengembalian Buku Literasi",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama_siswa', 1, 0, 'C');
$pdf->Cell(9, 0.8, 'Judul Buku Yang Dipinjam', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal Pinjam', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal Kembali', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Terlambat', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Denda', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($conn, $query1);
$totale = mysqli_query($conn, $total);
$hasil = mysqli_fetch_array($totale);
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['nama_siswa'] , 1, 0, 'C');
	$pdf->Cell(9, 0.8, $lihat['judul_buku_literasi'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['tanggal_peminjaman'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['tanggal_pengembalian'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['terlambat'], 1, 0,'R');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($lihat['denda']).",-", 1, 1, 'R');

	$no++;
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(22, 0.8, "TOTAL", 1, 0,'R');
$pdf->Cell(3, 0.8, "Rp. ".number_format($hasil['total_denda']).",-",1, 1,'R');

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

