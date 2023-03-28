<?php 
session_start();
if( !isset($_SESSION["login"])){
	header("location: loginadmin.php");
	exit;
}
require 'functions.php';

$ambil = $conn->query("SELECT * FROM buku_tahunan_siswa WHERE id_judul_buku_tahunan='$_GET[id]'");
$row = $ambil->fetch_assoc();
$fotoproduk = $row['gambar_sampul'];
if (file_exists("img/tahunan/$fotoproduk"))
{
	unlink("img/tahunan/$fotoproduk");
}

$conn->query("DELETE FROM buku_tahunan_siswa WHERE id_judul_buku_tahunan= '$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='tahunan.php';</script>";
 ?>
}

