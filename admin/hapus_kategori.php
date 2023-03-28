<?php 
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';
$conn->query("DELETE FROM kategori WHERE id_kategori= '$_GET[id]'");
echo "<script>alert('Nama Kategori Terhapus');</script>";
echo "<script>location='kategori.php';</script>";
 ?>
}