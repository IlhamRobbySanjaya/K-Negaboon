<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit; 
}
require 'functions.php';
if( isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    $kode_judul = $_POST["kode_buku"];
    $kode_buku = $_POST["kode_buku_tahunan"];
    $nis_peminjam = $_POST["nis"];
    $tgl_pinjam = Date('Y-m-d');
    $tgl_kembali =Date('Y-m-d', time()+31536000);
    
    //cek stok buku
    $stok_buku = cek_stok($conn, $kode_judul);

    if ($stok_buku < 1) {
    echo "
        <script>
            alert('stok buku habis, proses peminjaman gagal');
            document.location.href = 'tambah_pinjam_tahunan.php';
        </script>
    ";
    exit();
    }
   
    //query insert data
    $tambah = mysqli_query($conn, "INSERT INTO peminjaman_buku_tahunan VALUES (NULL, '$kode_judul', '$kode_buku', '$nis_peminjam', '$tgl_pinjam', '$tgl_kembali', 'masa pinjam')");
    if($tambah == true){

    kurangi_stok($conn, $kode_judul);
    echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href = 'peminjaman_tahunan.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('gagal menambahkan data');
            document.location.href = 'peminjaman_tahunan.php';
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
    <title>Tambah Peminjaman Tahunan</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-warning text-center mt-3">Tambah Data Peminjaman Buku Tahunan Siswa</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nama_siswa"> Nama Siswa : </label> 
          <input type="text" class="form-control" id="buah" name="nama_siswa" placeholder="Masukkan Nama" value="" autocomplete="off" required>
        </div>
        <div class="form-group col-md-6">
          <label for="nis"> NIS Siswa : </label> 
          <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS Otomatis Terisi" value="" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="judul_buku"> Judul Buku Tahunan : </label> 
          <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku Tahunan" value="" require>
        </div>
        <div class="form-group col-md-6">
            <label for="kode_buku"> ID Judul Buku Tahunan : </label> 
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="ID judul Otomatis Terisi" value="" readonly>
        </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
                <label for="kode_buku_tahunan"> Kode Buku Tahunan : </label>
                <input type="text" class="form-control" placeholder="kode buku tahunan" name="kode_buku_tahunan" id="kode_buku_tahunan">
          </div>
        </div>
      </div> 
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="tanggal_peminjaman"> Tanggal Peminjaman : </label>
              <input type="text" class="form-control" placeholder = "<?php  echo Date('Y-m-d');?>" name="tanggal_peminjaman" id="tanggal_peminjaman" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
              <label for="tanggal_hrs_kembali"> Tanggal Harus Kembali : </label>
              <input type="text" class="form-control" placeholder="<?php echo Date('Y-m-d', time()+31536000); ?>" name="tanggal_hrs_kembali" id="tanggal_hrs_kembali" readonly>
        </div>
      </div>
      <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="peminjaman_literasi.php" class="btn btn-success">Kembali</a>
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
        $( "#buah" ).autocomplete({
            serviceUrl: "source_member_aktif.php",   // Kode php untuk prosesing data.
            dataType: "JSON",           // Tipe data JSON.
            onSelect: function (suggestion) {
                $( "#nis" ).val("" + suggestion.nis);
            }
        });
    })
</script>
<script type="text/javascript">
      $(document).ready(function() {

          // Selector input yang akan menampilkan autocomplete.
          $( "#judul_buku" ).autocomplete({
              serviceUrl: "source_judul_tahunan.php",   // Kode php untuk prosesing data.
              dataType: "JSON",           // Tipe data JSON.
              onSelect: function (suggestion) {
                  $( "#kode_buku" ).val("" + suggestion.kode_buku);
              }
          });
      })
    </script>




                
</body>
</html>