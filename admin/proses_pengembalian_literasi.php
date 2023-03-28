<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM peminjaman_buku_literasi WHERE id_pinjam_buku_literasi = '$id'")[0];

  //ketika tombol selesai ditekan
  if( isset($_POST["submit"])){
    $tambah = mysqli_query($conn,  "UPDATE peminjaman_buku_literasi SET
    notifikasi = 'kembali' WHERE id_pinjam_buku_literasi = '$id'");

    //post ke tabel pengembalian buku literasi
    $id_pinjam_literasi = $_POST["id_pinjam_literasi"];
    $tanggal_pengembalian = $_POST["tanggal_kembali"];
    $terlambat = $_POST["terlambat"];
    $denda = $_POST["denda"];

    $tambah2 = mysqli_query($conn, "INSERT INTO pengembalian_buku_literasi VALUES (NULL, '$id_pinjam_literasi', '$tanggal_pengembalian', '$terlambat','$denda')");
     if($tambah2 == true ){
      echo "
          <script>
              alert('Proses Pengembalian Buku Berhasil');
              document.location.href = 'pengembalian_literasi.php';
          </script>
      ";
    } else {
      echo "
          <script>
              alert('Proses Pengembalian Buku Berhasil');
              document.location.href = 'pengembalian_literasi.php';
          </script>
      ";
    }
  }

  $denda = 1000;
  $tgl_dateline = $data['tanggal_hrs_kembali'];
  $tgl_kembali = date('Y-m-d');
  $lambat = terlambatliterasi($tgl_dateline, $tgl_kembali);
  $denda1 = $lambat*$denda;

              if ($lambat>0) {
                echo "
                
                        <font color='red'>Pengembalian Anda terlambat sebanyak $lambat hari</font>

                      ";
              } else {
                echo "Pengembalian anda tepat waktu";
              }
              ?></td>
            <td><?php 
            if ($lambat>0) {
               
                // echo "
                
                //         <font color='red'>(Rp $denda1)</font>

                //       ";
              } else {
                //  
              }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Konfirmasi Pengembalian Literasi</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-info text-center mt-3">Konfirmasi Pengembalian Buku Literasi</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-4">
                  <label for="id_pinjam_literasi">ID Pinjam Buku Literasi : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['id_pinjam_buku_literasi'] ?>" name="id_pinjam_literasi" id="id_pinjam_literasi">
        </div>
      </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
                  <label for="kode_buku_literasi">Kode Buku Literasi : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['kode_buku_literasi'] ?>" name="kode_buku_literasi" id="kode_buku_literasi">
        </div>
        <div class="form-group col-md-6">
              <label for="nis"> Nis Peminjam : </label>
              <input type="text" class="form-control" value ="<?php echo $data['nis'] ?>" name="nis" id="nis">
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="tanggal_peminjaman"> Tanggal Peminjaman : </label>
              <input type="text" class="form-control"  value ="<?php echo $data['tanggal_peminjaman'] ?>"name="tanggal_peminjaman" id="tanggal_peminjaman" readonly>
        </div>
        <div class="form-group col-md-6">
              <label for="tanggal_hrs_kembali"> Tanggal Jatuh Tempo : </label>
              <input type="text" class="form-control" value ="<?php echo $data['tanggal_hrs_kembali'] ?>" name="tanggal_hrs_kembali" id="tanggal_hrs_kembali" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="tanggal_kembali"> Tanggal Pengembalian : </label>
              <input type="text" class="form-control" value="<?php echo $tgl_kembali ?>" name="tanggal_kembali" id="tanggal_kembali" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="terlambat"> Terlambat : </label>
              <input type="text" class="form-control"  value="<?php echo $lambat ?>" name="terlambat" id="terlambat" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="denda"> Denda : </label>
              <input type="text" class="form-control" value="<?php echo $denda1 ?>" name="denda" id="denda" >
        </div>
      </div>
      <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">SELESAI</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="pengembalian_literasi.php" class="btn btn-success">Kembali</a>
      </div>
  
        <br><br>
        
      
    </form>
    </div>
    </div>



                
</body>
</html>