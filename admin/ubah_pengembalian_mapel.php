<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
date_default_timezone_set('Asia/Jakarta');
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM pengembalian_buku_mapel WHERE id_kembali_mapel = '$id'")[0];
  
  //ketika tombol selesai ditekan
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Konfirmasi pengembalian mapel</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-info text-center mt-3">Konfirmasi Pengembalian Buku Mapel</h2>
    <div class="pull-right">
    <form action="proses_ubah_pengembalian_mapel.php" method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
              <label for="id_kembali_mapel"> Id  : </label>
              <input type="text" class="form-control" value="<?php echo $data['id_kembali_mapel'] ?>"name="id_kembali_mapel" id="id_kembali_mapel" readonly>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="id_pinjam_buku_mapel"> Id  : </label>
              <input type="text" class="form-control" value="<?php echo $data['id_pinjam_buku_mapel'] ?>"name="id_pinjam_buku_mapel" id="id_pinjam_buku_mapel" readonly>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="waktu_pengembalian"> Waktu Pengembalian  : </label>
              <input type="text" class="form-control" value="<?php echo $data['waktu_pengembalian'] ?>"name="waktu_pengembalian" id="waktu_pengembalian" readonly>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="nama_pengembali"> Nama Pengembali : </label>
              <input type="text" class="form-control" value="<?php echo $data['nama_pengembali'] ?>"name="nama_pengembali" id="nama_pengembali" readonly>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="buku_kembali"> Buku Dikembalikan Sebanyak : </label>
              <input type="text" class="form-control"  value="<?php echo $data['banyak_buku_kembali'] ?>"name="buku_kembali" id="buku_kembali" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="buku_kurang"> Kekurangan Buku Sebanyak : </label>
              <input type="text" class="form-control" value="<?php echo $data['buku_kurang'] ?>" name="buku_kurang" id="buku_kurang" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="buku_diganti"> Kekurangan Diganti Sebanyak : </label>
              <input type="text" class="form-control"  name="buku_diganti" id="buku_diganti" autocomplete="off" required>
        </div>
      </div>
      <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">SELESAI</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="pengembalian_mapel_selesai.php" class="btn btn-success">Kembali</a>
      </div>
  
        <br><br>
        
      
    </form>
    </div>
    </div>



                
</body>
</html>