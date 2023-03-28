<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM buku_literasi_umum WHERE Kode_buku_literasi = '$id'")[0];
  
  if( isset($_POST["submit"]) ) {

  if( ubahliterasi($_POST) > 0 ) {
    echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'literasi.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'literasi.php';
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
    <title>Ubah Buku Literasi Umum</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Ubah Buku Literasi Umum</h2>
    
    <form action="" method="post" enctype="multipart/form-data">
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="kode_buku_literasi">Kode Buku Literasi : </label>
                  <input type="hidden" class="form-control"  name="kode_buku_literasi" value ="<?php echo $data['kode_buku_literasi']; ?>" id="kode_buku_literasi">
                  <input type="hidden" class="form-control"  name="gambarLama" value ="<?php echo $data['gambar_sampul']; ?>" id="kode_buku_literasi">
            </div>
                <div class="form-group col-md-6">
                  <label for="kategori">Kategori : </label> <a href="kategori.php" class="btn btn-warning" title="tambah_kategori" >Tambah Kategori</a>
                  <select class="form-control" name="id_kategori" id="id_kategori" required >
                  <option name="id_kategori" id="id_kategori" value="<?php echo $data['id_kategori'] ?>"><?php echo $data['id_kategori'] ?></option>
                    <?php
                    $sql_kategori = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_query($conn));
                    while ($data_kategori = mysqli_fetch_array($sql_kategori)){
                      echo '<option value="'.$data_kategori['id_kategori'].'">' .$data_kategori['nama_kategori']. '</option>'; 
                    }
                    ?>
                    </select>
                </div>
           </div>

            <div class="form-group text-center">
                  <label for="judul_buku_literasi">Judul Buku Literasi : </label>
                  <input type="text"  class="form-control" value ="<?php echo $data['judul_buku_literasi'] ?>" name="judul_buku_literasi" id="judul_buku_literasi">
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="penerbit">Penerbit : </label> <a href="penerbit.php" class="btn btn-warning" title="tambah_penerbit">Tambah Penerbit</a>
                  <select class="form-control" name="id_penerbit" id="id_penerbit" required >
                  <option value="<?php echo $data['id_penerbit'] ?>"><?php echo $data['id_penerbit'] ?></option>
                    <?php
                    $sql_penerbit = mysqli_query($conn, "SELECT * FROM penerbit") or die (mysqli_query($conn));
                    while ($data_penerbit = mysqli_fetch_array($sql_penerbit)){
                      echo '<option value="'.$data_penerbit['id_penerbit'].'">' .$data_penerbit['nama_penerbit']. '</option>'; 
                    }
                    ?>
                </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="tahun_terbit">Tahun Terbit : </label>  
                  <input type="text" class="form-control" value ="<?php echo $data['tahun_terbit'] ?>" name="tahun_terbit" id="tahun_terbit">
                </div>
                <div class="form-group col-md-4">
                  <label for="stok">Stok : </label>  
                  <input type="text" class="form-control" value ="<?php echo $data['stok'] ?>" name="stok" id="stok">
                </div>

                <div class="form-group col-md-4">
                  <label for="no_rak">No Rak : </label> <a href="rak.php" class="btn btn-warning" title="tambah_rak">Tambah Rak</a>
                  <select class="form-control" name="id_rak" id="id_rak" required > 
                  <option value="<?php echo $data['id_penerbit'] ?>"><?php echo $data['id_penerbit'] ?></option>
                    <?php
                    $sql_rak = mysqli_query($conn, "SELECT * FROM rak") or die (mysqli_query($conn));
                    while ($data_rak = mysqli_fetch_array($sql_rak)){
                      echo '<option value="'.$data_rak['id_rak'].'">'. $data_rak['no_rak']. '</option>'; 
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="form-group text-center">
              <label for="deskripsi_buku">Deskripsi Buku : </label>
              <textarea type="text"  value ="<?php echo $data['deskripsi_buku'] ?>" name="deskripsi_buku" id="deskripsi_buku" class="form-control" rows="5" > <?php echo $data['deskripsi_buku'] ?></textarea>
            </div>

            <div class="form-group">
              <label for="gambar_sampul">Gambar Sampul : <?php echo $data['gambar_sampul'] ?></label><br>
              <img src="img/literasi/<?= $data['gambar_sampul'] ?>" width="60">
              <input type="file" name="gambar_sampul" class="form-control-file" id="gambar_sampul">
              <small>(Upload File Dengan Ukuran Maksiman 1 MB)</small>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Ubah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="literasi.php" class="btn btn-success">Kembali</a>
            </div>
        <br><br>
    </form>
    </div>
    
</body>
</html>