<?php
session_start();
if( isset($_SESSION["login"])){
	header("Location: index.php");
	exit;
}
require 'functions.php';

	if( isset($_POST["login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM pustakawan WHERE username = '$username'");

	// cek username
	if(mysqli_num_rows($result) === 1 ){
	
	// cek password
	$row = mysqli_fetch_assoc($result);
	if(password_verify($password, $row["password"]) ) {
		//set session
		$_SESSION["login"] = true;
		header("location: index.php");
		exit;
	}
 
	}
	$error = true;

	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/login/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/login/util.css">
	<link rel="stylesheet" type="text/css" href="css/login/main.css">
<!--===============================================================================================-->
</head>
<body>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="img/login/img-01.png" alt="IMG">
				</div>
				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Pustakawan Login
					</span>
					<?php if( isset($error)): ?>
					<p style="color:red; font-style: italic;">username / password salah</p>
					<?php endif; ?>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="username"  autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit " name="login">
							Login
						</button>
					</div>
					<div class="text-center p-t-12">
						<a class="txt2" href="../user/index.php">
							<h6>Beranda</h6>
						</a>
					</div>
					
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/login/main.js"></script>

</body>
</html>