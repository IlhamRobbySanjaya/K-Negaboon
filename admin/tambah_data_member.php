<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
date_default_timezone_set('Asia/Jakarta');
require 'functions.php';
if( isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    $nis = $_POST["nis"];
    $nama_siswa = $_POST["nama_siswa"];
    //query insert data
    $tambah = mysqli_query($conn, "INSERT INTO member_perpus VALUES ('$nis', '$nama_siswa', '', '', '','','tidak aktif')");
    if($tambah){
    echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'data_member.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('gagal menambahkan data');
            document.location.href = 'tambah_data_member.php';
        </script>
    ";
  }
}

echo Date('l, Y-m-d');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css/autocomplete.css">
    <title>Tambah Data Member</title>
   
</head>
<body>
    <div class="container">
    <h2 class="alert alert-info text-center mt-3">Tambah Data Member Siswa</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="nis"> NIS Siswa : </label>
              <input type="text" class="form-control" placeholder = "Masukkan NIS Siswa" name="nis" id="nis" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="nama_siswa"> Nama Siswa : </label>
              <input type="text" class="form-control" placeholder="Masukkan Nama Siswa" name="nama_siswa" id="nama_siswa" required>
        </div>
      </div>
        <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="data_member.php" class="btn btn-success">Kembali</a>
      </div>
    <br><br>  
    </form>
    </div>
    </div>       
</body>
</html>                
</body>
</html>