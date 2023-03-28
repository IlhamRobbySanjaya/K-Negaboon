<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';

$ambil = $conn->query("SELECT * FROM peminjaman_buku_mapel WHERE id_pinjam_buku_mapel='$_GET[id]'");
$row = $ambil->fetch_assoc();
$id_judul_buku_mapel = $row['id_judul_buku_mapel'];
$berhasil = hapus_stok_mapel($conn, $id_judul_buku_mapel);
$hapus= mysqli_query($conn, "DELETE FROM peminjaman_buku_mapel WHERE id_pinjam_buku_mapel= '$_GET[id]'");

if( $hapus){

echo "<script>alert('Peminjaman Buku Mapel Terhapus');</script>";
echo "<script>location='peminjaman_mapel.php';</script>";


}else{
	echo "<script>alert('Gagal Menghapus');</script>";
echo "<script>location='peminjaman_mapel.php';</script>";

}
 ?>
