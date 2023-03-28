<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
require 'functions.php';

//cek tombol submit ditekan atau tidak
if( isset($_POST['submit']) ) {
  
    // cek keberhasilan tambah data
    if( tambahkelas($_POST) > 0 ) {
      echo "
            <script>
              alert('data berhasil ditambahkan!');
              document.location.href = 'data_kelas.php';
            </script>
      ";
    } else {
      echo "
            <script>
              alert('data gagal ditambahkan!');
              document.location.href = 'data_kelas.php';
            </script>
      ";
    }

}
?>
   
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
     <!-- desain autocomplete css -->
     <link rel="stylesheet" href="../user/css/autocomplet_registrasi.css">
    <title>Tambah Data Kelas</title>
</head>    
<body>
    <div class="container">
    <h2 class="alert alert-danger text-center mt-3">Tambah Data Kelas</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
              <div class="form-group col-md-6">
                <label for="kelas"> Nama Kelas : </label> 
                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Nama Kelas" value="" required>
        </div>
              <div class="form-group col-md-6">
                 <label for="kode_kelas"> Kode Kelas : </label> 
                 <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Kode Kelas Otomatis Terisi" value="" readonly>
        </div>
        </div>
        <div class="form-group text-center">
              <label for="deskripsi_buku">Wali Kelas : </label>
              <textarea type="text" class="form-control" placeholder ="masukkan nama wali kelas"name="wali_kelas" id="wali_kelas" rows="5"></textarea>
            </div>
      
    

            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="data_kelas.php" class="btn btn-success">Kembali</a>
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