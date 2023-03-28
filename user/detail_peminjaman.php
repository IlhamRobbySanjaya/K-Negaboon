<?php 
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
require 'functions.php';
// $data = query("SELECT * FROM buku_literasi_umum WHERE kode_buku_literasi = '$id'")[0];

session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}

require '../admin/functions.php';
$peminjaman_mapel = mysqli_query($conn,"SELECT a.id_pinjam_buku_mapel, a.nama_peminjam, a.waktu_peminjaman, a.banyak_buku, a.notifikasi, b.judul_buku_mapel as id_judul_buku_mapel, c.jurusan as kode_kelas
                          FROM peminjaman_buku_mapel a LEFT JOIN buku_mapel_kelas b on b.id_judul_buku_mapel = a.id_judul_buku_mapel LEFT JOIN kelas c on c.kode_kelas = a.kode_kelas  WHERE a.notifikasi='masa pinjam' ORDER BY a.id_pinjam_buku_mapel DESC"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Peminjaman Buku Mapel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Your page description here" />
  <meta name="author" content="" />

  <!-- css -->
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet" />
  <link href="css/prettyPhoto.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="js/dataTables/dataTables.bootstrap.css" rel="stylesheet">
  <!-- Theme skin -->
  <link id="t-colors" href="color/default.css" rel="stylesheet" />

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
  <link rel="shortcut icon" href="ico/favicon.png" />

  <!-- =======================================================
    Theme Name: Remember
    Theme URL: https://bootstrapmade.com/remember-free-multipurpose-bootstrap-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>

  <div id="wrapper">
    <!-- start header -->
    <header>
    <?php require'head.php'; ?>
      <div class="container">
        <div class="row nomargin">
          <div class="span4">
            <div class="logo">
              <h1><a href="index.php"><i class="icon-tint"></i> K-Negabon Library</a></h1>
            </div>
          </div>
          <div class="span8">
            <div class="navbar navbar-static-top">
              <div class="navigation">
                <nav>
                  <ul class="nav topnav">
                    <li><a href="index.php">Beranda</a></li>
                    <li class="dropdown">
                      <a href="#">Koleksi Buku<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="literasi.php">Buku Literasi Umum</a></li>
                        <li><a href="mapel.php">Buku Mapel Kelas</a></li>
                        <li><a href="tahunan.php">Buku Tahunan Siswa</a></li>
                      </ul>
                    </li>
                    <li class="dropdown active">
                      <a href="#">Peminjaman<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                      <li><a href="peminjaman_literasi.php">Buku Literasi Umum</a></li>
                        <li><a href="peminjaman_mapel.php">Buku Mapel Kelas</a></li>
                        <li><a href="peminjaman_tahunan.php">Buku Tahunan Siswa</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">Pengembalian<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="pengembalian_literasi.php">Buku Literasi Umum</a></li>
                        <li><a href="pengembalian_mapel.php">Buku Mapel Kelas</a></li>
                        <li><a href="pengembalian_tahunan.php">Buku Tahunan Siswa</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">Pengunjung<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="siswa.php">Siswa</a></li>
                        <li><a href="tamupen.php">Tamu</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">Data<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="data_member.php">Member Siswa</a></li>
                        <li><a href="data_kelas.php">Kelas</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end header -->

    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Peminjaman Buku Mapel Kelas</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.html">Beranda</a> <i class="icon-angle-right"></i></li>
              <li><a href="#">Peminjaman</a> <i class="icon-angle-right"></i></li>
              <li class="active">Buku Mapel Kelas</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <br>
     <div class="container-fluid">
    <a href="tambah_pinjam_mapel.php" class="btn btn-info icon-plus">Tambah Data Peminjaman Mapel</a>
    <br><br>

      <div class="content">
        <div class="box">
          <div class="offside-3 col-lg-7">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tabel">
                </div>
                  <thead>
                  <tr bgcolor="yellow" align="center">
                        <th>no</th>
                        <th>ID Pinjam Mapel</th>
                        <th>Judul Buku Mapel</th>
                        <th>Kelas</th>
                        <th>Nama Peminjam</th>
                        <th>Waktu Pinjam</th>
                        <th>Sebanyak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; ?> 
                  <?php
                  foreach( $peminjaman_mapel as $row) :
                  ?>
                  <tr>
                  <td><?=$i; ?></td>
                        <td><?php echo $row["id_pinjam_buku_mapel"]; ?></td>
                        <td><?php echo $row["id_judul_buku_mapel"];?></td>
                        <td><?php echo $row["kode_kelas"];?></td>
                        <td><?php echo $row["nama_peminjam"];?></td>
                        <td><?php echo $row["waktu_peminjaman"];?></td>
                        <td><?php echo $row["banyak_buku"];?></td>
                        <td><?php echo $row["notifikasi"];?></td>
                        <td>
                            <a href="hapus_peminjaman_mapel.php?id=<?= $row["id_pinjam_buku_mapel"]; ?>
                            " onclick="return confirm('Yakin Ingin Menghapus Data Ini?');" class="btn btn-default" ><i class="icon-trash" title="hapus data"></i>hapus</a>
                          </td>
                  </tr>
                  <?php $i++; ?>
                  <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    
    <footer>
    <?php include 'footer_admin.php';  ?>
    </footer>
  </div>
  <a href="#" class="scrollup"><i class="icon-angle-up icon-rounded icon-bglight icon-2x"></i></a>

  <!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/toucheffects.js"></script>
  <script src="js/google-code-prettify/prettify.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/portfolio/jquery.quicksand.js"></script>
  <script src="js/portfolio/setting.js"></script>
  <script src="js/animate.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="js/custom.js"></script>
  <script src="js/dataTables/dataTables.bootstrap.js"></script>
  <script src="js/dataTables/jquery.dataTables.js"></script>
  <script type="text/javascript">
        $(document).ready(function () {
            $('#tabel').DataTable();
        });
    </script>

</body>

</html>
