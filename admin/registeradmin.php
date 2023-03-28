<?php

session_start();
 if( !isset($_SESSION["login"])){
     header("location: loginadmin.php");
     exit;
 }
 require 'functions.php';
$pustakawan = query("SELECT * FROM pustakawan");

if( isset($_POST["register"]) ){
    if(registrasiliterasi($_POST) > 0 ) {
            echo "<script>
                    alert('user baru berhasil ditambahkan');
                  </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Register Admin</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/register/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/register/line-awesome/css/line-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet" href="css/css/bootstrap.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/register/style.css"/>
</head>

<body class="form-v7">
	<div class="page-content">
		<div class="form-v7-content">
			<div class="form-left">
				<img src="img/cipi.jpg" alt="form">
				<p class="text-1"></p>
				<p class="text-2">Privaci policy & Term of service</p>
			</div>
			<form class="form-detail" action="" method="post" id="myform">
				<div class="form-row">
					<label for="nip">NIP</label>
					<input type="text" name="nip" id="nip" class="input-text" autocomplete="off" required>
				</div>
				<div class="form-row">
					<label for="nama_pustakawan">NAMA PUSTAKAWAN</label>
					<input type="text" name="nama_pustakawan" id="nama_pustakawan" class="input-text" autocomplete="off" required>
				</div>
				<div class="form-row">
					<label for="username">USERNAME</label>
					<input type="text" name="username" id="username" class="input-text" autocomplete="off" required>
				</div>
				<!-- <div class="form-row">
					<label for="your_email">E-MAIL</label>
					<input type="text" name="your_email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div> -->
				<div class="form-row">
					<label for="password">PASSWORD</label>
					<input type="password" name="password" id="password" class="input-text" autocomplete="off" required>
				</div>
				<div class="form-row">
					<label for="password2">CONFIRM PASSWORD</label>
					<input type="password" name="password2" id="password2" class="input-text" autocomplete="off" required>
				</div>
				<div class="form-row-last">
					<button type="submit" name="register" class="btn btn-primary" >REGISTER</button>
					<a href="index.php" class="btn btn-warning">Kembali</a>
				</div>
			</form>
		</div>
	</div>
	<table class="table table-striped table-bordered table-hover ">

        <tr>
            <th>NO</th>
		    <th>NIP</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
		<?php $i = 1; ?> 
        <?php
            foreach( $pustakawan as $row) :
        ?>
        <tr>
			      <td><?=$i; ?></td>
            <td><?php echo $row["nip"]; ?></td>
            <td><?php echo $row["nama_pustakawan"];?></td>
            <td><?php echo $row["username"];?></td>
            <td>
              <a href="ubah_pustakawan.php?id=<?php echo $row ['nip']; ?>" class="btn btn-warning" title="ubah data" >ubah</a>

              <a href="hapus_pustakawan.php?id=<?= $row["nip"]; ?>
              " onclick="return confirm('Yakin Ingin Menghapus Data Ini?');"  class="btn btn-danger" title="hapus data">hapus</a>
            </td>
        </tr>
			<?php $i++; ?>
			<?php endforeach; ?>
    </table>

	
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	
</body>
</html>