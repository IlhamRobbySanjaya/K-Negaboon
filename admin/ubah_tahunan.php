<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}
  include 'functions.php';
  $id = $_GET["id"];
  $data = query("SELECT * FROM buku_tahunan_siswa WHERE id_judul_buku_tahunan = '$id'")[0];

  if( isset($_POST["submit"]) ) {

  if( ubahtahunan($_POST) > 0 ) {
    echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'tahunan.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'tahunan.php';
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
    <title>Tambah Buku Tahunan</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-warning text-center mt-3">Ubah Buku Tahunan</h2>
    <div class="pull-right">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="id_judul_buku_tahunan">Id Judul Buku Tahunan : </label>
                  <input type="hidden" class="form-control"  name="id_judul_buku_tahunan" value ="<?php echo $data['id_judul_buku_tahunan']; ?>" id="id_judul_buku_tahunan">
                  <input type="hidden" class="form-control"  name="gambarLama" value ="<?php echo $data['gambar_sampul']; ?>" id="id_judul_buku_tahunan">
                </div>
                <div class="form-group col-md-4">
                  <label for="untuk_kelas">Untuk Kelas : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['untuk_kelas'] ?>" placeholder="Masukkan Kelas..." name="untuk_kelas" id="untuk_kelas">
                </div>

                <div class="form-group col-md-4">
                  <label for="id_penerbit">Penerbit : </label> <a href="penerbit.php" class="btn btn-warning" title="tambah_penerbit">Tambah Penerbit</a>
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
            </div>
            <div class="form-group text-center">
                  <label for="judul_buku_tahunan">Judul Buku Tahunan : </label>
                  <input type="text" class="form-control" value ="<?php echo $data['judul_buku_tahunan'] ?>" placeholder="Masukkan Judul Buku..." name="judul_buku_tahunan" id="judul_buku_tahunan">
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="tahun_terbit">Tahun Terbit : </label>
              <input type="text" class="form-control" value ="<?php echo $data['tahun_terbit'] ?>" placeholder="Masukkan Kode Buku..." name="tahun_terbit" id="tahun_terbit">
            </div>
            <div class="form-group col-md-6">
              <label for="stok">Stok : </label>
              <input type="text" class="form-control" value ="<?php echo $data['stok'] ?>" placeholder="Masukkan Stok Buku..." name="stok" id="stok">
            </div>
            </div>
            <div class="form-group">
              <label for="gambar_sampul">Gambar Sampul : <?php echo $data['gambar_sampul'] ?></label><br>
              <img src="img/literasi/<?= $data['gambar_sampul'] ?>" width="60">
              <input type="file" name="gambar_sampul" class="form-control-file" id="gambar_sampul">
              <small>(Upload File Dengan Ukuran Maksiman 1 MB)</small>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">UBAH!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
              <a href="tahunan.php" class="btn btn-success">KEMBALI</a>
            </div>

        </form>
        </div>
        </div>

</body>
</html>