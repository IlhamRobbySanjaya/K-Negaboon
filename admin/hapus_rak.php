<?php 
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';
$conn->query("DELETE FROM rak WHERE id_rak= '$_GET[id]'");
echo "<script>alert('No Rak Terhapus');</script>";
echo "<script>location='rak.php';</script>";
 ?>
}