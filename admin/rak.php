<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}

require 'functions.php';


$rak = query ("SELECT * FROM rak"); 
?>

<div class="container-fluid">
    <br><br>

    <form action="" method="post">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
			<th>NO</th>
            <th>NO RAK</th>
            <th>AKSI</th>
           
        </tr>
		<?php $i = 1; ?> 
        <?php
            foreach( $rak as $row) :
        ?>
        <tr>
		    <td><?=$i; ?></td>
            <td><?php echo $row["no_rak"]; ?></td>
            <td>
            <a href="ubah_rak.php?id=<?php echo $row ['id_rak']; ?>" class="btn btn-warning" title="ubah data" >ubah</a>
            <a href="hapus_rak.php?id=<?= $row['id_rak']; ?>
              " onclick="return confirm('yakin');"  class="btn btn-danger" title="hapus data">hapus</a>
            </td>
        </tr>
			<?php $i++; ?>
			<?php endforeach; ?>
    </table>
    </form>
  </div>

  <?php

//cek tombol submit ditekan atau tidak
if( isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    $no_rak = $_POST["no_rak"];
   

    //query insert data
    mysqli_query($conn, "INSERT INTO rak VALUES ('', '$no_rak')");

    

    // cek keberhasilan tambah data
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "berhasil";
    } else {
        echo "gagal!";
        echo "<br>";
        echo mysqli_error($conn);
    }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Halaman Rak Buku</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Tambah Rak Buku</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="no_rak">No Rak : </label>
                  <input type="text" class="form-control" placeholder="Masukkan No Rak..." name="no_rak" id="no_rak">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>