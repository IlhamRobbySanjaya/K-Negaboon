<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
date_default_timezone_set('Asia/Jakarta');
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM peminjaman_buku_mapel WHERE id_pinjam_buku_mapel = '$id'")[0];
  
  //ketika tombol selesai ditekan
  if( isset($_POST["submit"])){
    $tambah = mysqli_query($conn,  "UPDATE peminjaman_buku_mapel SET
    notifikasi = 'kembali' WHERE id_pinjam_buku_mapel = '$id'");

    $q = "SELECT buku_mapel_kelas.id_judul_buku_mapel FROM buku_mapel_kelas JOIN peminjaman_buku_mapel ON buku_mapel_kelas.id_judul_buku_mapel = peminjaman_buku_mapel.id_judul_buku_mapel WHERE peminjaman_buku_mapel.id_pinjam_buku_mapel = '$id'";
    $hasil = mysqli_query($conn, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $id_judul_buku_mapel = $hasil['id_judul_buku_mapel'];
    $banyak_buku_kembali = $_POST["buku_kembali"];

    tambah_stok_mapel($conn, $id_judul_buku_mapel);

    //post ke tabel pengembalian buku mapel
    $id_pinjam_mapel = $_POST["id_pinjam_mapel"];
    $nama_pengembali = $_POST["nama_pengembali"];
    $waktu_kembali = date('H:i, d F Y'); 
    $buku_kurang = $_POST["buku_kurang"];

    $tambah2 = mysqli_query($conn, "INSERT INTO pengembalian_buku_mapel VALUES (NULL, '$id_pinjam_mapel', '$nama_pengembali', '$waktu_kembali','$banyak_buku_kembali', '$buku_kurang')");
     if($tambah2  == true ){
      echo "
          <script>
              alert('Proses Pengembalian Buku Berhasil');
              document.location.href = 'pengembalian_mapel.php';
          </script>
      ";
    } else {
      echo "
          <script>
              alert('Proses Pengembalian Buku Gagal');
              document.location.href = 'proses_pengembalian_mapel.php';
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
    <title>Konfirmasi pengembalian mapel</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-info text-center mt-3">Konfirmasi Pengembalian Buku Mapel</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-4">
                  <label for="id_pinjam_mapel">ID Pinjam Buku Mapel : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['id_pinjam_buku_mapel'] ?>" name="id_pinjam_mapel" id="id_pinjam_mapel" readonly>
        </div>
        <div class="form-group col-md-4">
                  <label for="id_judul_mapel">ID Judul Buku Mapel : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['id_judul_buku_mapel'] ?>" name="id_judul_mapel" id="id_judul_mapel" readonly>
        </div>
        <div class="form-group col-md-4">
              <label for="kode_kelas"> Kode Kelas : </label>
              <input type="text" class="form-control" value ="<?php echo $data['kode_kelas'] ?>" name="kode_kelas" id="kode_kelas" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="waktu_peminjaman"> Waktu Peminjaman : </label>
              <input type="text" class="form-control"  value ="<?php echo $data['waktu_peminjaman'] ?>"name="waktu_peminjaman" id="waktu_peminjaman" readonly>
        </div>
        <div class="form-group col-md-6">
              <label for="waktu_pengembalian"> Waktu Pengembalian : </label>
              <input type="text" class="form-control" value ="<?php echo date('H:i, d F Y'); ?>" name="waktu_pengembalian" id="waktu_pengembalian" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="nama_peminjam"> Nama Peminjam : </label>
              <input type="text" class="form-control" value ="<?php echo $data['nama_peminjam'] ?>" name="nama_peminjam" id="nama_peminjam" readonly>
        </div>
        <div class="form-group col-md-6">
              <label for="nama_pengembali"> Nama Pengembali : </label>
              <input type="text" class="form-control" name="nama_pengembali" id="nama_pengembali" autocomplete="off"required>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="buku_dipinjam"> Buku Dipinjam Sebanyak : </label>
              <input type="text" class="form-control" value="<?php echo $data['banyak_buku'] ?>" name="buku_dipinjam" id="buku_dipinjam" readonly>
        </div>
        <div class="form-group col-md-6">
              <label for="buku_kembali"> Buku Dikembalikan Sebanyak : </label>
              <input type="text" class="form-control"  name="buku_kembali" id="buku_kembali" autocomplete="off" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="buku_kurang"> Kekurangan Buku Sebanyak : </label>
              <input type="text" class="form-control"  name="buku_kurang" id="buku_kurang" autocomplete="off"required>
        </div>
      </div>
      <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">SELESAI</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="pengembalian_mapel.php" class="btn btn-success">Kembali</a>
      </div>
  
        <br><br>
        
      
    </form>
    </div>
    </div>



                
</body>
</html>