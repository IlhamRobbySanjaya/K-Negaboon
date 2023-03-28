<?php 

require 'functions.php';
$id = $_GET["id"];

$data_kelas = query("SELECT * FROM kelas WHERE kode_kelas = '$id'")[0];

if (isset($_POST['edit'])) {
    if (ubahkelas($_POST) > 0) {
        echo "
                <script> 
                    alert ('data kelas berhasil diubah');
                    document.location.href = 'data_kelas.php';
                </script>

            ";
    } else {
        echo "
                <script> 
                    alert ('data kelas gagal diubah');
                </script>

            ";
    }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Edit Data Kelas</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-info text-center mt-3">Edit Data Kelas</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="kode_kelas">Kode_kelas : </label>
              <input type="text" class="form-control" value="<?= $data_kelas["kode_kelas"]; ?>" name="kode_kelas" id="kode_kelas" required>
            </div>
        </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="jurusan">Jurusan : </label> 
              <input type="text" class="form-control" value="<?= $data_kelas["jurusan"]; ?>" name ="jurusan" id="jurusan" required>
            </div>   
            </div>
            <div class="form-row">
        <div class="form-group col-md-6">
              <label for="wali_kelas">Wali Kelas : </label>
              <input type="text" class="form-control" value="<?= $data_kelas["wali_kelas"]; ?>" name="wali_kelas" id="wali_kelas" required>
        </div>
      </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="edit">Edit Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="data_kelas.php" class="btn btn-success">Kembali</a>
            </div>
          </div>
        <br><br>
        
      
    </form>
    </div>
    </div>


                
</body>
</html>