<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';

$ambil = $conn->query("SELECT * FROM peminjaman_buku_tahunan WHERE id_pinjam_buku_tahunan='$_GET[id]'");
$row = $ambil->fetch_assoc();
$id_judul_buku_tahunan = $row['id_judul_buku_tahunan'];
$berhasil = tambah_stok($conn, $id_judul_buku_tahunan);
$hapus= mysqli_query($conn, "DELETE FROM peminjaman_buku_tahunan WHERE id_pinjam_buku_tahunan= '$_GET[id]'");

if($hapus){
echo "<script>alert('Peminjaman Buku Tahunan Terhapus');</script>";
echo "<script>location='peminjaman_tahunan.php';</script>";


}else{
	echo "<script>alert('Gagal Menghapus');</script>";
echo "<script>location='peminjaman_tahunan.php';</script>";

}
 ?>
