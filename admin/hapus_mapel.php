<?php 
session_start();
if( !isset($_SESSION["login"])){
	header("location: loginadmin.php");
	exit;
}
require 'functions.php';

$ambil = $conn->query("SELECT * FROM buku_mapel_kelas WHERE id_judul_buku_mapel='$_GET[id]'");
$row = $ambil->fetch_assoc();
$fotoproduk = $row['gambar_sampul'];
if (file_exists("img/mapel/$fotoproduk"))
{
	unlink("img/mapel/$fotoproduk");
}

$conn->query("DELETE FROM buku_mapel_kelas WHERE id_judul_buku_mapel= '$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='mapel.php';</script>";
 ?>
}