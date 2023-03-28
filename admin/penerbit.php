<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}

require 'functions.php';


$penerbit = query ("SELECT * FROM penerbit"); 
?>

<div class="container-fluid">
    <br><br>

    <form action="" method="post">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
			<th>no</th>
            <th>Nama Penerbit</th>
            <th>Aksi</th>
           
        </tr>
		<?php $i = 1; ?> 
        <?php
            foreach( $penerbit as $row) :
        ?>
        <tr>
		    <td><?=$i; ?></td>
            <td><?php echo $row["nama_penerbit"]; ?></td>
            <td>
            <a href="ubah_penerbit.php?id=<?php echo $row ['id_penerbit']; ?>" class="btn btn-warning" title="ubah data" >ubah</a>
            <a href="hapus_penerbit.php?id=<?= $row['id_penerbit']; ?>
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
    $nama_penerbit = $_POST["nama_penerbit"];
   

    //query insert data
    mysqli_query($conn, "INSERT INTO penerbit VALUES ('', '$nama_penerbit')");

    

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
    <title>Halaman Penerbit</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Tambah Penerbit</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama_penerbit">Nama Penerbit : </label>
                  <input type="text" class="form-control" placeholder="Masukkan Nama Penerbit..." name="nama_penerbit" id="nama_penerbit">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>