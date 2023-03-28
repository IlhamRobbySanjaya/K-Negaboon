<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}

require 'functions.php';
$data_pengembalian_literasi = query ("SELECT member_perpus.nama_siswa, buku_literasi_umum.judul_buku_literasi, peminjaman_buku_literasi.tanggal_peminjaman, 
                                      pengembalian_buku_literasi.tanggal_pengembalian, pengembalian_buku_literasi.terlambat, pengembalian_buku_literasi.denda 
                                      FROM peminjaman_buku_literasi 
                                      LEFT JOIN member_perpus ON member_perpus.nis = peminjaman_buku_literasi.nis 
                                      LEFT JOIN buku_literasi_umum ON buku_literasi_umum.kode_buku_literasi = peminjaman_buku_literasi.kode_buku_literasi 
                                      LEFT JOIN pengembalian_buku_literasi ON pengembalian_buku_literasi.id_pinjam_buku_literasi = peminjaman_buku_literasi.id_pinjam_buku_literasi 
                                      WHERE peminjaman_buku_literasi.notifikasi = 'kembali' "); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Data Pengembalian Literasi Selesai</title>
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
    <?php include 'tag_header.php';  ?>
      <div class="container">
        <div class="row nomargin">
          <div class="span4">
            <div class="logo">
              <h1><a href="index.html"><i class="icon-tint"></i> K-Negabon Library</a></h1>
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
                    <li class="dropdown">
                      <a href="#">Peminjaman<i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                      <li><a href="peminjaman_literasi.php">Buku Literasi Umum</a></li>
                        <li><a href="peminjaman_mapel.php">Buku Mapel Kelas</a></li>
                        <li><a href="peminjaman_tahunan.php">Buku Tahunan Siswa</a></li>
                      </ul>
                    </li>
                    <li class="dropdown active">
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
              <h2>Data Pengembalian Buku Literasi Umum</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="index.html">Beranda</a> <a class="icon-angle-right"></a></li>
              <li><a href="#">Pengembalian</a> <a class="icon-angle-right"></a></li>
              <li><a href="pengembalian_literasi.php">Buku Literasi Umum></a></li>
              <li class="active">Data Pengembalian Buku Literasi</li>
            </ul>
          </div>
        </div>
      </div>
      <form action="laporan_pengembalian_literasi.php" method="post">
      <ul width="50"><input required type="radio" name="cek" value="1" style="cursor: pointer;"> Semua Data</ul>
      <ul width="50"><input required type="radio" name="cek" value="2" style="cursor: pointer;">Tanggal
      <input type="date" name="tgl_awal" value="<?= date("Y/m/d") ?>" style="height: 20px;"> Sampai <span class="right"><input type="date" value="<?= date("Y/m/d") ?>" name="tgl_akhir" style="height: 20px;"></span>
      </ul>
      <ul class="text-left"><input type="submit" name="tampilkan" class="btn btn-primary" value="Tampilkan"></ul>
    </form>
     
    </section>
    <br>       

      <br>
      <div class="container-fluid">
      <div class="content">
      <div class="box">
        <div class="offside-3 col-lg-7">
          <form action="" method="post">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover " id="tabel">
                <thead>
                  <tr bgcolor='yellow' align='center'>
                      <th>NO</th>
                      <th>Nama Peminjam</th>
                      <th>Judul Buku Yang Dipinjam</th>
                      <th>Tanggal peminjaman</th>
                      <th>Tanggal Kembali</th>
                      <th>Terlambat</th>
                      <th>Denda</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1; 
                        foreach( $data_pengembalian_literasi as $row) :
                    ?>
                  <tr>
                      <td><?=$i; ?></td>
                      <td><?php echo $row["nama_siswa"];?></td>
                      <td><?php echo $row["judul_buku_literasi"];?></td>
                      <td><?php echo $row["tanggal_peminjaman"];?></td>
                      <td><?php echo $row["tanggal_pengembalian"];?></td>
                      <td><?php echo $row["terlambat"];?></td>
                      <td><?php echo $row["denda"];?></td>
                  </tr>
                      <?php 
                      $i++; 
                      endforeach; 
                      ?>
                </tbody>
              </table>
            </div>
          </form>
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