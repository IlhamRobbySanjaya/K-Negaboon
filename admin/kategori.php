<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: loginadmin.php");
    exit;
}

require 'functions.php';


$kategori = query ("SELECT * FROM kategori"); 
?>

<div class="container-fluid">
    <br><br>

    <form action="" method="post">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
			<th>no</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
           
        </tr>
		<?php $i = 1; ?> 
        <?php
            foreach( $kategori as $row) :
        ?>
        <tr>
			<td><?=$i; ?></td>
            <td><?php echo $row["nama_kategori"]; ?></td>
            <td>
            <a href="ubah_kategori.php?id=<?php echo $row ['id_kategori']; ?>" class="btn btn-warning" title="ubah data" >ubah</a>
            <a href="hapus_kategori.php?id=<?= $row['id_kategori']; ?>
              " onclick="return confirm('yakin');"  class="btn btn-danger" title="hapus data">hapus</a>
            </td>
           
        </tr>
			<?php $i++; ?>
			<?php endforeach; ?>
    </table>
    </form>
  </div>

  <?php
$conn = mysqli_connect ("localhost" , "root","", "perpustakaan");
//cek tombol submit ditekan atau tidak
if( isset($_POST["submit"])){
    // ambil data dari tiap elemen dalam form
    $nama_kategori = $_POST["nama_kategori"];
   

    //query insert data
    mysqli_query($conn, "INSERT INTO kategori VALUES ('', '$nama_kategori')");

    

    // cek keberhasilan tambah data
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "berhasil";
    } else {
        echo "gagal!";
        echo "<br>";
        echo mysqli_error($conn);
    }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <title>Halaman Kategori</title>
</head>
<body>
    <div class="container">
    <h2 class="alert alert-success text-center mt-3">Tambah kategori</h1>
    
    <form action="" method="post">
    
           <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nama_kategori">Kode Buku Literasi : </label>
                  <input type="text" class="form-control" placeholder="Masukkan kategori..." name="nama_kategori" id="nama_kategori">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Tambah Data!</button>
              <button type="reset" class="btn btn-danger">RESET</button>
            </div>
        <br><br>
    </div>
                
</body>
</html>