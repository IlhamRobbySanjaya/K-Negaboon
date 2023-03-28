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
    $kode_judul = $_POST["kode_buku"];
    $kode_kelas = $_POST["kode_kelas"];
    $nama_peminjam = $_POST["nama_peminjam"];
    $waktu_peminjaman = date('H:i, d F Y');
    $banyak_buku = $_POST["banyak_buku"];
    
    //cek stok buku
    $stok_buku = cek_stok_mapel($conn,$kode_judul);

    if ($stok_buku < $banyak_buku) {
    echo "
        <script>
            alert('stok buku tidak mencukupi, proses peminjaman gagal');
            document.location.href = 'tambah_pinjam_mapel.php';
        </script>
    ";
    exit();
    }
   
    //query insert data
    $tambah = mysqli_query($conn, "INSERT INTO peminjaman_buku_mapel VALUES (NULL, '$kode_judul', '$kode_kelas', '$nama_peminjam', '$waktu_peminjaman', '$banyak_buku', 'masa pinjam')");
    if($tambah == true){

    kurangi_stok_mapel($conn, $kode_judul);
    echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'peminjaman_mapel.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('gagal menambahkan data');
            document.location.href = 'peminjaman_mapel.php';
        </script>
    ";
  }
}
    

echo Date('l, d-F-Y');

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css/autocomplete.css">
    <title>Tambah Peminjaman Mapel Kelas</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-danger text-center mt-3">Tambah Data Peminjaman Buku Mapel Kelas</h2>
      <div class="pull-right">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kelas"> Nama Kelas : </label> 
                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Nama Kelas" value="" require>
              </div>
              <div class="form-group col-md-6">
                <label for="kode_kelas"> Kode Kelas : </label> 
                <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Kode Kelas Otomatis Terisi" value="" readonly>
              </div>
          </div> 
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="judul_buku"> Judul Buku Mapel : </label> 
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku Mapel" value="" require>
              </div>
              <div class="form-group col-md-6">
                <label for="kode_buku"> ID Judul Buku Mapel : </label> 
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="ID Judul Otomatis Terisi" value="" readonly>
              </div>
            </div>    
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama_peminjam">Nama Peminjam : </label> 
              <input type="text" class="form-control" placeholder="Masukkan Nama Peminjam" name="nama_peminjam" id="nama_peminjam" autocomplete="off" required>
            </div>   
            <div class="form-group col-md-6">
            <label for="waktu_peminjaman"> Waktu Peminjaman : </label>
              <input type="text" class="form-control" placeholder = "<?php echo date('H:i, d F Y');?>"name="waktu_peminjaman" id="waktu_peminjaman" readonly>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="banyak_buku"> Banyak Buku Dipinjam : </label>
              <input type="text" class="form-control" placeholder="Banyak Buku Dipinjam" name="banyak_buku" id="banyak_buku" autocomplete = "off" required>
            </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="peminjaman_mapel.php" class="btn btn-success">Kembali</a>
            </div>
          </div>
        <br><br>
        
      
    </form>
    </div>
    </div>

     <!-- Memanggil jQuery.js -->
     <script src="js/autocomplete/jquery-3.2.1.min.js"></script>

<!-- Memanggil Autocomplete.js -->
<script src="js/autocomplete/jquery.autocomplete.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {

          // Selector input yang akan menampilkan autocomplete.
          $( "#judul_buku" ).autocomplete({
              serviceUrl: "source_judul_mapel.php",   // Kode php untuk prosesing data.
              dataType: "JSON",           // Tipe data JSON.
              onSelect: function (suggestion) {
                  $( "#kode_buku" ).val("" + suggestion.kode_buku);
              }
          });
      })
    </script>
    <script type="text/javascript">
      $(document).ready(function() {

          // Selector input yang akan menampilkan autocomplete.
          $( "#kelas" ).autocomplete({
              serviceUrl: "source_kelas.php",   // Kode php untuk prosesing data.
              dataType: "JSON",           // Tipe data JSON.
              onSelect: function (suggestion) {
                  $( "#kode_kelas" ).val("" + suggestion.kode_kelas);
              }
          });
      })
    </script>
                
</body>
</html>