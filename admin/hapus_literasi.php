<?php 
session_start();
if( !isset($_SESSION["login"])){
	header("location: loginadmin.php");
	exit;
}

require 'functions.php';

$ambil = $conn->query("SELECT * FROM buku_literasi_umum WHERE kode_buku_literasi='$_GET[id]'");
$row = $ambil->fetch_assoc();
$fotoproduk = $row['gambar_sampul'];
if (file_exists("img/literasi/$fotoproduk"))
{
	unlink("img/literasi/$fotoproduk");
}

if ($conn->query("DELETE FROM buku_literasi_umum WHERE kode_buku_literasi= '$_GET[id]'")){

echo "<script>alert('Buku Literasi Umum Terhapus');</script>";
echo "<script>location='literasi.php';</script>";

}else{
	echo "<script>alert('Gagal Menghapus, Karena Buku Masih Dipinjam');</script>";
echo "<script>location='literasi.php';</script>";

}
 ?>