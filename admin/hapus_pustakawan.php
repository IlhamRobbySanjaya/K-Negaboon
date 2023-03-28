<?php 
session_start();
if( !isset($_SESSION["login"])){
	header("location: loginadmin.php");
	exit;
}

require 'functions.php';

$ambil = $conn->query("SELECT * FROM pustakawan WHERE nip='$_GET[id]'");
$row = $ambil->fetch_assoc();


$conn->query("DELETE FROM pustakawan WHERE nip= '$_GET[id]'");

echo "<script>alert('pustakawan terhapus');</script>";
echo "<script>location='index.php';</script>";
 ?>
