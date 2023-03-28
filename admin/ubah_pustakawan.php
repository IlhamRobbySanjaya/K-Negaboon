<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET['id'];
  $qe = mysqli_query($conn, "SELECT * FROM pustakawan WHERE nip = '$id'");
  $data = mysqli_fetch_array($qe);

  if( isset($_POST["edit"])){
    // ambil data dari tiap elemen dalam forms
    $nip = $_POST["nip"];
    $nama_pustakawan = $_POST["nama_pustakawan"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    
    $tambah = mysqli_query($conn, "UPDATE pustakawan SET nip='$nip', nama_pustakawan='$nama_pustakawan',username='$username',password='$password'
 WHERE nip = '$id'");

    if($tambah){
      ?>
      <script type="text/javascript">
        alert('Edit Data Berhasil');
        document.location.href="index.php";
      </script>
      <?php
    }else {
      echo "gagal mengedit data!!!";
    }

    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form-v7 by Colorlib</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/register/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/register/line-awesome/css/line-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/register/style.css"/>
</head>
<body class="form-v7">
	<div class="page-content">
		<div class="form-v7-content">
			<div class="form-left">
				<img src="img/register/form-v7.jpg" alt="form">
				<p class="text-1">Sign Up</p>
				<p class="text-2">Privaci policy & Term of service</p>
			</div>
			<form class="form-detail" action="" method="post" id="myform">
				<div class="form-row">
					<label for="nip">NIP</label>
					<input type="text" value ="<?php echo $data['nip'] ?>"name="nip" id="nip" class="input-text">
				</div>
				<div class="form-row">
					<label for="nama_pustakawan">NAMA PUSTAKAWAN</label>
					<input type="text" value ="<?php echo $data['nama_pustakawan'] ?>"name="nama_pustakawan" id="nama_pustakawan" class="input-text">
				</div>
				<div class="form-row">
					<label for="username">USERNAME</label>
					<input type="text" value ="<?php echo $data['username'] ?>"name="username" id="username" class="input-text">
				</div>
				<div class="form-row">
					<label for="password">PASSWORD</label>
					<input type="password" value ="<?php echo $data['password'] ?>"name="password" id="password" class="input-text" required>
				</div>
				<!-- <div class="form-row">
					<label for="password2">CONFIRM PASSWORD</label>
					<input type="password" name="password2" id="password2" class="input-text" required>
				</div> -->
				<div class="form-row-last">
					<button type="submit" name="edit" class="btn btn-success" >EDIT</button>
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<!-- <script>
		// just for the demos, avoids form submit
		jQuery.validator.setDefaults({
		  	debug: true,
		  	success:  function(label){
        		label.attr('id', 'valid');
   		 	},
		});
		$( "#myform" ).validate({
		  	rules: {
			    your_email: {
			      	required: true,
			      	email: true
			    },
			    password: "required",
		    	comfirm_password: {
		      		equalTo: "#password"
		    	}
		  	},
		  	messages: {
		  		username: {
		  			required: "Please enter an username"
		  		},
		  		your_email: {
		  			required: "Please provide an email"
		  		},
		  		password: {
	  				required: "Please provide a password"
		  		},
		  		comfirm_password: {
		  			required: "Please provide a password",
		      		equalTo: "Wrong Password"
		    	}
		  	}
		});
	</script> -->
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>