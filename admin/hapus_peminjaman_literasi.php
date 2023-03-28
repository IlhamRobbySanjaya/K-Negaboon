<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';

if($conn->query("DELETE FROM peminjaman_buku_literasi WHERE id_pinjam_buku_literasi = '$_GET[id]'")){echo "<script>alert('Peminjaman Buku Literasi Terhapus');</script>";
echo "<script>location='peminjaman_literasi.php';</script>";
}
else{
	echo "<script>alert('Gagal Menghapus');</script>";
echo "<script>location='peminjaman_literasi.php';</script>";

}
 ?>
