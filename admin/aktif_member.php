<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM tamu WHERE id_tamu = '$id'")[0];

  if( isset($_POST["submit"])){
    $nama = $_POST["nama_tamu"];
    $delegasi = $_POST["delegasi"];
    $kepentingan = $_POST["kepentingan"];
    //query insert data
    $tambah = mysqli_query($conn, "UPDATE tamu SET nama='$nama_tamu', delegasi='$delegasi',kepentingan='$kepentingan'");
    var_dump($tambah);
    if($tambah){
        ?>
        <script type="text/javascript">
          alert('member berhasil disetujui!');
          document.location.href="data_tamu.php";
        </script>
        <?php
      }else {
        echo "gagal mengedit data!!!";
      }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="../vendor/register_member/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/register_member/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../vendor/register_member/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/register_member/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form action = "" method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="NAMA" name="nama" id="nama"
                            value ="<?php echo $data['nama_tamu']; ?>">
                        </div>
                    <form method="POST">
                        <div class="input-group">
                             <input class="input--style-1" type="text" placeholder="DELEGASI" name="nama" id="delegasi"
                             value ="<?php echo $data['delegasi']; ?>">
                        </div>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="KEPENTINGAN" name="kepentingan" id="kepentingan"
                            value ="<?php echo $data['kepentingan']; ?>">
                        </div>
                        </div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="submit">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/register_member/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../vendor/register_member/select2/select2.min.js"></script>
    <script src="../vendor/register_member/datepicker/moment.min.js"></script>
    <script src="../vendor/register_member/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../js/register_member/global.js"></script>

</body>

</html>

       
