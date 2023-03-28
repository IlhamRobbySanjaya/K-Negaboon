
<?php

require 'functions.php';

if( isset($_POST['cari_literasi'])){
$nis = $_POST["nis"];

   
$peminjaman_literasi = query ("SELECT a.nis,a.id_pinjam_buku_literasi, a.tanggal_peminjaman, a.tanggal_hrs_kembali,
                                        a.notifikasi, b.judul_buku_literasi as kode_buku_literasi, 
                                        c.nama_siswa as nama
                                      FROM peminjaman_buku_literasi a 
                                      LEFT JOIN buku_literasi_umum b on b.kode_buku_literasi = a.kode_buku_literasi
                                      LEFT JOIN member_perpus c on c.nis = a.nis 
                                      WHERE a.notifikasi='masa pinjam'
                                      AND a.nis = '$nis'
                                      ORDER BY a.id_pinjam_buku_literasi DESC"); 
  //mysqli_query ("SELECT * FROM peminjaman_buku_literasi WHERE nis = '$nis' ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
<body>

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
  </nav>
  <!--/ Nav End /-->

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

<section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="inner-heading">
                    <br>
                    <h2>Pinjam Literasi</h2>
                    </div>
                    </div>
                </div>
            </div>
        </section>  

    <br>
     <div class="container-fluid">
    <br><br>
    <form action="" method="post">
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabel">
    
    <thead>
        <tr>
            <th>no</th>
            <th>Judul Buku Literasi</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Harus Kembali</th>
            <th>Status</th>
        </tr>
        </thead>
 
        <tbody>  
                        <?php $i = 1; ?> 
                        <?php
                            foreach($peminjaman_literasi as $row) :
                        ?>
                        <tr>
                            <td><?=$i; ?></td>
                            <td><?php echo $row["kode_buku_literasi"];?></td>
                            <td><?php echo $row["tanggal_peminjaman"];?></td>
                            <td><?php echo $row["tanggal_hrs_kembali"];?></td>
                            <td><?php echo $row["notifikasi"];?></td>
                        </tr>
                      <?php $i++; ?> 
                      <?php endforeach; ?>
                      </tbody>
        </table>
        <?php echo"nama :  ".$row["nama"];
              echo "<br/>";
              echo "nis:  ".$row["nis"];   
        ?></td>                     
    </div>
    </form>
  </div>
    
</body>
</html>