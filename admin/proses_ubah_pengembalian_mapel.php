<?php
require 'functions.php';

if( isset($_POST["submit"])){
    $id_kembali_mapel= $_POST["id_kembali_mapel"];
$q = "SELECT pengembalian_buku_mapel.id_kembali_mapel, peminjaman_buku_mapel.id_pinjam_buku_mapel, buku_mapel_kelas.id_judul_buku_mapel,buku_mapel_kelas.untuk_kelas,
            kelas.jurusan, peminjaman_buku_mapel.nama_peminjam, pengembalian_buku_mapel.nama_pengembali, 
            peminjaman_buku_mapel.waktu_peminjaman, pengembalian_buku_mapel.waktu_pengembalian, 
            peminjaman_buku_mapel.banyak_buku, pengembalian_buku_mapel.banyak_buku_kembali, 
            pengembalian_buku_mapel.buku_kurang, peminjaman_buku_mapel.notifikasi

            FROM peminjaman_buku_mapel 
            LEFT JOIN buku_mapel_kelas ON buku_mapel_kelas.id_judul_buku_mapel = peminjaman_buku_mapel.id_judul_buku_mapel 
            LEFT JOIN kelas ON kelas.kode_kelas = peminjaman_buku_mapel.kode_kelas 
            LEFT JOIN pengembalian_buku_mapel ON pengembalian_buku_mapel.id_pinjam_buku_mapel = peminjaman_buku_mapel.id_pinjam_buku_mapel 
            WHERE peminjaman_buku_mapel.notifikasi = 'kembali' AND pengembalian_buku_mapel.id_kembali_mapel = '$id_kembali_mapel'";
$hasil = mysqli_query($conn, $q);
$hasil2 = mysqli_fetch_assoc($hasil);
$id_judul_buku_mapel = $hasil2["id_judul_buku_mapel"];
$buku_diganti = $_POST["buku_diganti"];
var_dump($id_judul_buku_mapel);
$stok = mysqli_query($conn,"UPDATE buku_mapel_kelas SET stok = stok + $buku_diganti WHERE id_judul_buku_mapel = '$id_judul_buku_mapel'");

// tambah_stok_mapel_kurang($conn, $id_judul_buku_mapel);

//post ke tabel pengembalian buku mapel

$id_pinjam_mapel = $_POST["id_pinjam_buku_mapel"];
$nama_pengembali = $_POST["nama_pengembali"];
$waktu_kembali = $_POST['waktu_pengembalian']; 
$banyak_buku_kembali= $_POST['buku_kembali'] + $_POST['buku_diganti'];
$buku_kurang=$_POST['buku_kurang']- $_POST['buku_diganti'];
//var_dump($banyak_buku_kembali);

$tambah2 = mysqli_query($conn, "UPDATE pengembalian_buku_mapel SET  banyak_buku_kembali='$banyak_buku_kembali', buku_kurang='$buku_kurang'
                        WHERE id_kembali_mapel='$id_kembali_mapel'");
 if($tambah2  == true ){
  echo "
      <script>
          alert('Proses Pengembalian Buku Berhasil');
      </script>
  ";
} else {
  echo "
      <script>
          alert('Proses Pengembalian Buku Gagal');
        
      </script>
  ";
}
}
?>







