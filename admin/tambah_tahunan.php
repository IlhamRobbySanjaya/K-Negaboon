<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';
//cek tombol submit ditekan atau tidak
if( isset($_POST["submit"])){

    // cek keberhasilan tambah data
    if( tambahtahunan($_POST) > 0 ) {
      echo "
            <script>
              alert('data berhasil ditambahkan!');
              document.location.href = 'tahunan.php';
            </script>
      ";
    } else {
      echo "
            <script>
              alert('data gagal ditambahkan!');
              document.location.href = 'tahunan.php';
            </script>
      ";
    }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Tambah Buku Tahunan</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-warning text-center mt-3">Tambah Buku Tahunan</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="id_judul_buku_tahunan">Id Judul Buku Tahunan : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Id Judul..." name="id_judul_buku_tahunan" id="id_judul_buku_tahunan" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="untuk_kelas">Untuk Kelas : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Kelas..." name="untuk_kelas" id="untuk_kelas">
                </div>

                <div class="form-group col-md-4">
                  <label for="id_penerbit">Penerbit : </label> <a href="penerbit.php" class="btn btn-warning" title="tambah_penerbit">Tambah Penerbit</a>
                  <select class="form-control" name="id_penerbit" id="id_penerbit" required >
                  <option value="">- Pilih Nama Penerbit -</option>
                    <?php
                    $sql_penerbit = mysqli_query($conn, "SELECT * FROM penerbit") or die (mysqli_query($conn));
                    while ($data_penerbit = mysqli_fetch_array($sql_penerbit)){
                      echo '<option value="'.$data_penerbit['id_penerbit'].'">' .$data_penerbit['nama_penerbit']. '</option>'; 
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group text-center">
                  <label for="judul_buku_tahunan">Judul Buku Tahunan : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Judul Buku..." name="judul_buku_tahunan" id="judul_buku_tahunan">
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="tahun_terbit">Tahun Terbit : </label>
              <input type="text" class="form-control" placeholder="Masukkan Kode Buku..." name="tahun_terbit" id="tahun_terbit">
            </div>
            <div class="form-group col-md-6">
              <label for="stok">Stok : </label>
              <input type="text" class="form-control" placeholder="Masukkan Stok Buku..." name="stok" id="stok">
            </div>
            </div>
            <div class="form-group">
              <label>Gambar Sampul : </label>
              <input type="file" class="form-control-file" name="gambar_sampul" id="gambar_sampul">
              <small>(Upload File Dengan Ukuran Maksiman 1 MB)</small>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="tahunan.php" class="btn btn-success">Kembali</a>
            </div>

        </form>
        </div>
        </div>

</body>
</html>