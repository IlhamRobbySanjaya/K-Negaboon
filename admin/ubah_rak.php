<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET['id'];
  $qe = mysqli_query($conn, "SELECT * FROM rak WHERE id_rak = '$id'");
  $data = mysqli_fetch_array($qe);

  if( isset($_POST["edit"])){
    // ambil data dari tiap elemen dalam forms
    $no_rak = $_POST["no_rak"];
    
    $tambah = mysqli_query($conn, "UPDATE rak SET id_rak='$id', no_rak='$no_rak'
 WHERE id_rak = '$id'");

    if($tambah){
      ?>
      <script type="text/javascript">
        alert('Edit Data Berhasil');
        document.location.href="rak.php";
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
    <title>Edit No Rak</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Edit Rak</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="no_rak">No Rak : </label>
                  <input type="text" class="form-control"value ="<?php echo $data['no_rak'] ?>"  name="no_rak" id="no_rak">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="edit">Edit Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>