<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET['id'];
  $qe = mysqli_query($conn, "SELECT * FROM penerbit WHERE id_penerbit = '$id'");
  $data = mysqli_fetch_array($qe);

  if( isset($_POST["edit"])){
    // ambil data dari tiap elemen dalam forms
    $nama_penerbit = $_POST["nama_penerbit"];
    
    $tambah = mysqli_query($conn, "UPDATE penerbit SET id_penerbit='$id', nama_penerbit='$nama_penerbit'
 WHERE id_penerbit = '$id'");

    if($tambah){
      ?>
      <script type="text/javascript">
        alert('Edit Data Berhasil');
        document.location.href="penerbit.php";
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
    <title>Edit Nama Penerbit</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Edit Penerbit</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama_penerbit">Nama Penerbit : </label>
                  <input type="text" class="form-control"value ="<?php echo $data['nama_penerbit'] ?>"  name="nama_penerbit" id="nama_penerbit">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="edit">Edit Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>