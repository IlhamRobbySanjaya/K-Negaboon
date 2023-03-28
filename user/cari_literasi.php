<?php

require 'functions.php';

?>
 
<!DOCTYPE html>
<html lang="en">
<head> 

<section class="contact">
    <title> Peminjaman </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</section>

  <meta charset="utf-8">
  <title>K-Negabon Library</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/logosmk3.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: EstateAgency
    Theme URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>
 
<body>
<div class="click-closed"></div>
  <!--/ Form Search Star /-->
 
  <!--/ Form Search End /-->

  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand text-brand" href="index.html"><span class="color-b">K-NEGABON </span>LIBRARY</a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center"  id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registrasi.php">Daftar Member</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="buku.php">Buku</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bantuan.php">Bantuan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/loginadmin.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Nav End /-->
                      
  <section class="contact">
              <style>
                body {
                  background: url(img/horizon.jpg) no-repeat center fixed;
                  -webkit-backgroun-size: cover;
                  -moz-background-size: cover;
                  -o-background: cover;
                  background-size: cover;
                }
                .aa {
                  width: 700px;
                  height: 400px;
                  background-color: rgba(0,0,0,0.3);
                  margin: 0 auto;
                  margin-top: 90px;
                  padding-top: 5px;
                  padding-left: 100px;
                  border-radius: 30px;
                  -webkit-border-radius: 60px;
                  -o-border-radius: 40px;
                  -moz-border-radius: 40px;
                  color: darkred;
                }
              </style>
  </section>
   
  <section class="contact">
   <div class="aa">
     <br> <br> <br> <br> <br>
     <h2>Cek Peminjaman</h2><br>
     <form action ="data_cari_literasi.php" method="post">
        <input type="text" name="nis"placeholder="Nomor Induk Siswa" autocomplete="off" required><br><br>
        <button <a href ="cari_literasi.php" type="submit" name = "cari_literasi" class="btn btn-b" ></a>cari literasi</button>
    </form>   
  </section>
   

   <!-- JavaScript Libraries -->
   <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

  </body>
</html>



