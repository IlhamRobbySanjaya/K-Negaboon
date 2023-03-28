<?php
$conn = mysqli_connect ("localhost" , "root","", "perpustakaan");
//cek tombol submit ditekan atau tidak
require '../admin/functions.php';
if( isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    $nis = $_POST["nis"];
    $nama = $_POST["nama"];
    $jurusan = $_POST["jurusan"];
    $no_telp = $_POST["no_telp"];
    $alamat = $_POST["alamat"];
    $status = "tidak aktif";

    //query insert data
    $tambah = mysqli_query($conn, "UPDATE member_perpus 
                                  SET nis='$nis', nama_siswa='$nama', jurusan='$jurusan', no_telp = '$no_telp', alamat = '$alamat', status ='tidak aktif'
                                  WHERE nis = '$nis'");
    if($tambah){
      echo "
          <script>
              alert('Berhasil Melakukan Registrasi, Selajutnya Tunggu persetujuan Admin');
              document.location.href = 'registrasi.php';
          </script>
      ";
    } else {
      echo "
          <script>
              alert('Gagal Melakukan Registrasi');
              document.location.href = 'registrasi.php';
          </script>
      ";
    }
    }
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Member</title>

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

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="cssregis/style.css">
    <!-- desain autocomplete css -->
    <link rel="stylesheet" href="css/autocomplet_registrasi.css">
</head>
<body>
  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html"><span class="color-b">K-NEGABON </span>Library</a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Beranda</a>
          </li>
          <li class="nav-item active">
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

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Daftar Member</h2>
                        <form action ="" method="post" class="register-form">
                            <div class="form-group">
                              <label for="nama"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama"id="buah" placeholder="Nama" required/>
                            </div>
                            <div class="form-group">
                                <label for="nis"><i class="zmdi zmdi-key"></i></label>
                                <input type="text" name="nis" id="nis" placeholder="NIS Terisi Otomatis" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="jurusan"><i class="zmdi zmdi-edit"></i></label>
                                <input type="text" name="jurusan" id="jurusan" placeholder="Nama Kelas" required/>
                            </div>
                            <div class="form-group">
                                <label for="no_telpn"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="no_telp" id="no_telp" placeholder="No Telpon"  autocomplete="off" required/>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Alamat"  autocomplete="off" required/>
                            </div>
                            <div class="form-group">
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Cek Nama Anda Jika Ada, Nama Anda Belum Terdaftar Silahkan Registrasi Data Dengan Tepat<a href="#" class="term-service"></a></label>
                            </div>
                            <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="submit">SIMPAN</button>
                        </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!--/ footer Star /-->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">School Address </h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
              Jl. Santawi No.96 A, Tamansari Indah, Kec. Bondowoso
              Kabupaten Bondowoso, Jawa Timur 68216 Indonesia.
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> (123)454-441</li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> anitadwisalasari@gmail.com</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Developer Identity</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> +62 853-3075-0875</li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> teamprogresslibrarybondowoso@gmail.com</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Developer</h3>
            </div>
            <div class="w-body-a">
              <ul class="list-unstyled">
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Yudi Irianto</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Irfan giovani</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Ilham Robby Sanjaya</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Azizah Wina Sriwinarsih</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Muhammad Ansori</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">Home</a>
              </li>
            </ul>
          </nav>
          <div class="socials-a">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-dribbble" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">EstateAgency</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
            -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ Footer End /-->

  <!-- Memanggil jQuery.js -->
  <script src="../admin/js/autocomplete/jquery-3.2.1.min.js"></script>

<!-- Memanggil Autocomplete.js -->
<script src="../admin/js/autocomplete/jquery.autocomplete.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        // Selector input yang akan menampilkan autocomplete.
        $( "#buah" ).autocomplete({
            serviceUrl: "source_member_pasif.php",   // Kode php untuk prosesing data.
            dataType: "JSON",           // Tipe data JSON.
            onSelect: function (suggestion) {
                $( "#nis" ).val("" + suggestion.nis);
            }
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {

        // Selector input yang akan menampilkan autocomplete.
        $( "#jurusan" ).autocomplete({
            serviceUrl: "source_jurusan.php",   // Kode php untuk prosesing data.
            dataType: "JSON",           // Tipe data JSON.
            onSelect: function (suggestion) {
                $( "#jurusan" ).val("" + suggestion.jurusan);
            }
        });
    })
</script>

        
    <!-- JS -->
    <script src="jsregis/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

