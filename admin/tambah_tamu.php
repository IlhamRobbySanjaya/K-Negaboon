<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}  
require 'functions.php';

//cek tombol submit ditekan atau tidak
if( isset($_POST["submit"]) ) {
  
    // cek keberhasilan tambah data
    if( tambahtamu($_POST) > 0 ) {
      echo "
            <script>
              alert('data berhasil ditambahkan!');
              document.location.href = 'tamupen.php';
            </script>
      ";
    } else {
      echo "
            <script>
              alert('data gagal ditambahkan!');
              document.location.href = 'tamupen.php';
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
    <title>Tambah Data Tamu</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-danger text-center mt-3">Tambah Data Tamu</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
     
            <div class="form-group text">
                  <label for="nama_tamu">Nama Tamu : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Nama Tamu" name="nama_tamu" id="nama_tamu">
            </div>
            </div>
    
            <div class="form-group text">
                  <label for="nama_tamu">Delegasi : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Delegasi" name="delegasi" id="delegasi">
            </div>

            <div class="form-group text">
              <label for="deskripsi_buku">Kepentingan : </label>
              <textarea type="text" name="kepentingan" id="kepentingan" class="form-control"  placeholder="Masukkan Kepentingan" rows="5"></textarea>
            </div> 
               
             <div class="form-group text">
              <label for="Tanggal_Kedatangan">Tanggal_Kedatangan : </label>
              <input type="text" class="form-control" placeholder = "<?php  echo Date('Y-m-d');?>" name="Tanggal_Kedatangan" readonly>
             </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="tamupen.php" class="btn btn-success">Kembali</a>
            </div>
          </div>
        <br><br>
        
      
    </form>
    </div>
    </div>


                
</body>
</html>