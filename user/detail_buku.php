<?php 
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
require 'functions.php';
$id = $_GET["id"];
// $data = query("SELECT * FROM buku_literasi_umum WHERE kode_buku_literasi = '$id'")[0];
$buku_literasi_umum = query ("SELECT a.kode_buku_literasi, a.judul_buku_literasi, a.tahun_terbit, a.gambar_sampul, a.deskripsi_buku, b.nama_kategori as id_kategori, c.nama_penerbit as id_penerbit, d.no_rak as id_rak 
FROM buku_literasi_umum a LEFT JOIN kategori b on b.id_kategori = a.id_kategori LEFT JOIN penerbit c on c.id_penerbit = a.id_penerbit LEFT JOIN rak d on d.id_rak = a.id_rak WHERE kode_buku_literasi = '$id'"); 


// $buku_literasi_umum = query("SELECT * FROM buku_literasi_umum WHERE kode_buku_literasi = '$id'");
 //$buku_literasi_umum = query ("SELECT a.kode_buku_literasi, a.judul_buku_literasi, a.tahun_terbit, a.gambar_sampul, a.deskripsi_buku, b.nama_kategori as id_kategori, c.nama_penerbit as id_penerbit, d.no_rak as id_rak FROM buku_literasi_umum a LEFT JOIN kategori b on b.id_kategori = a.id_kategori LEFT JOIN penerbit c on c.id_penerbit = a.id_penerbit LEFT JOIN rak d on d.id_rak = a.id_rak ORDER BY a.kode_buku_literasi ASC "); 

?>


<?php require'head.php'; ?>
 
<body>
  <div class="click-closed"></div>
  <!--/ Form Search Star /-->
  <div class="box-collapse">
    <div class="title-box-d">  
      <h3 class="title-d">Cari Peminjaman Siswa</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    <a class="btn btn-b" href="cari_literasi.php">Cari Literasi</a>
    <a class="btn btn-b" href="cari_tahunan.php">Cari Tahunan</a>
         
           
           
          </div>
        </div>
      </form>
    </div>
  </div>
 
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
            <a class="nav-link" href="buku.php">Buku Mapel</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bantuan.php">Bantuan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/loginadmin.php">Login</a>
          </li>
        </ul>
      </div>
      <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block  " data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="search" aria-hidden="true">Cek Peminjaman</span>
      </button>
    </div>
  </nav>
  <!--/ Nav End /-->

  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <?php foreach ( $buku_literasi_umum as $row) : ?>
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single"><?= $row['judul_buku_literasi']; ?></h1>
            <span class="color-text-a">Kode Buku = <?= $row['kode_buku_literasi'] ?> </span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Beranda</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                <?= $row['judul_buku_literasi']; ?>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Property Single Star /-->
  <style>
    .item-b img {
      height : 430px;
    }
  </style>
  <section class="property-single nav-arrow-b">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <center><div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
            <div class="item-b col-md-4">
              <img src="../admin/img/literasi/<?php echo $row["gambar_sampul"]; ?>" alt="">
            </div>
          </div></center>
          <div class="row">
            <div class="item-b col-md-6">
              <div class="property-price d-flex justify-content-center foo">
                <div class="card-header-c d-flex">
                  <div class="card-box-ico">
                    <span class="fa fa-book"></span>
                  </div>
                  <div class="card-title-c align-self-center">
                    <h5 class="title-c"><?= $row['kode_buku_literasi'] ?></h5>
                  </div>
                </div>
              </div>
              <div class="property-summary">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d section-t4">
                      <h3 class="title-d">Keterangan</h3>
                    </div>
                  </div>
                </div>
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong>Penerbit : </strong>
                      <span><?= $row['id_penerbit'] ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Tahun Terbit : </strong>
                      <span><?= $row['tahun_terbit'] ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Kategori : </strong>
                      <span><?= $row['id_kategori'] ?></span>
                    <li class="d-flex justify-content-between">
                      <strong>Rak : </strong>
                      <span><?= $row['id_rak'] ?></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-7 col-lg-6 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Deskripsi Buku</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                  <?= $row['deskripsi_buku']; ?>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach ; ?>
        </div>
      </div>
    </div>
  </section>
  <!--/ Property Single End /-->

  <?php require'foot.php'; ?>
