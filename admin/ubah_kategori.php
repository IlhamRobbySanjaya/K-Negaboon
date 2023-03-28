<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET['id'];
  $qe = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = '$id'");
  $data = mysqli_fetch_array($qe);

  if( isset($_POST["edit"])){
    // ambil data dari tiap elemen dalam forms
    $nama_kategori = $_POST["nama_kategori"];
    
    $tambah = mysqli_query($conn, "UPDATE kategori SET id_kategori='$id', nama_kategori='$nama_kategori'
 WHERE id_kategori = '$id'");

    if($tambah){
      ?>
      <script type="text/javascript">
        alert('Edit Data Berhasil');
        document.location.href="kategori.php";
      </script>
      <?php
    }else {
      echo "gagal mengedit data!!!";
    }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Edit Nama Kategori</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Edit Kategori</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama_kategori">Nama Kategori : </label>
                  <input type="text" class="form-control"value ="<?php echo $data['nama_kategori'] ?>"  name="nama_kategori" id="nama_kategori">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="edit">Edit Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>