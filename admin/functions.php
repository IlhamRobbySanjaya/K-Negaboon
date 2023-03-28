<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
date_default_timezone_set('Asia/Jakarta');

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;   
}


// untuk literasi
function cariliterasi($keywordliterasi){
    $query = "SELECT * FROM buku_literasi_umum
            WHERE
            judul_buku_literasi LIKE '%$keywordliterasi%' 
            ";
    return query($query);
}


//halaman register.php
function registrasiliterasi($dataliterasi) {
    global $conn;

    $nip = ($dataliterasi["nip"]);
    $nama_pustakawan = ($dataliterasi["nama_pustakawan"]);
    $username = strtolower(stripslashes($dataliterasi["username"]));
    $password = mysqli_real_escape_string($conn, $dataliterasi["password"]);
    $password2 = mysqli_real_escape_string($conn, $dataliterasi["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM pustakawan WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar!')
              </script>";
        return false;
    }
    // cek konfirmasi password
    if( $password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }
    
    //enskripsi passowrd
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data pustakawan ke database
    mysqli_query($conn, "INSERT INTO pustakawan VALUES ('$nip', '$nama_pustakawan', '$username', '$password')");

    return mysqli_affected_rows($conn);

}

function tambahliterasi($dataliterasi) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $kode_buku_literasi = htmlspecialchars($dataliterasi["kode_buku_literasi"]);
    $judul_buku_literasi = htmlspecialchars($dataliterasi["judul_buku_literasi"]);
    $id_penerbit = htmlspecialchars($dataliterasi["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($dataliterasi["tahun_terbit"]);
    $stok = htmlspecialchars($dataliterasi["stok"]);
    $id_rak = htmlspecialchars($dataliterasi["id_rak"]);
    $id_kategori = htmlspecialchars($dataliterasi["id_kategori"]);
 
    // upload gambar
    $gambar_sampul = uploadliterasi();
    if( !$gambar_sampul ) {
        return false;
    }

    $deskripsi_buku = htmlspecialchars($dataliterasi["deskripsi_buku"]);

    $query = "INSERT INTO buku_literasi_umum 
              VALUES
              ('$kode_buku_literasi', '$judul_buku_literasi', '$id_penerbit', '$tahun_terbit', '$id_rak', '$id_kategori', '$stok', '$gambar_sampul', '$deskripsi_buku')
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadliterasi() {

    $namaFile = $_FILES['gambar_sampul']['name'];
    $ukuranFile = $_FILES['gambar_sampul']['size'];
    $error = $_FILES['gambar_sampul']['error'];
    $tmpName = $_FILES['gambar_sampul']['tmp_name'];

    // cek jika tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // cek hanya gambar yang boleh di upload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // jika lolos maka gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/literasi/' . $namaFileBaru);

    return $namaFileBaru;

}

function cek_stok_mapel($conn,$kode_judul)
{
    $q = "SELECT stok FROM buku_mapel_kelas WHERE id_judul_buku_mapel = '$kode_judul'";
    $hasil = mysqli_query($conn, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $stok = $hasil['stok'];

    return $stok;
}

function kurangi_stok_mapel($conn, $kode_judul)
{
    $banyak_buku = $_POST["banyak_buku"];
    $q = "UPDATE buku_mapel_kelas SET stok = stok - $banyak_buku WHERE id_judul_buku_mapel = '$kode_judul'";
    mysqli_query($conn, $q);
}

function tambah_stok_mapel($conn, $id_judul_buku_mapel)
{
    $banyak_buku_kembali = $_POST["buku_kembali"];
    $q = "UPDATE buku_mapel_kelas SET stok = stok + $banyak_buku_kembali WHERE id_judul_buku_mapel = '$id_judul_buku_mapel'";
    mysqli_query($conn, $q);
}

// function tambah_stok_mapel_kurang($conn, $id_judul_buku_mapel)
// {
//     $buku_diganti = $_POST["buku_diganti"];
//     $q = "UPDATE buku_mapel_kelas SET stok = stok + $buku_diganti WHERE id_judul_buku_mapel = '$id_judul_buku_mapel'";
//     mysqli_query($conn, $q);
// }

function hapus_stok_mapel($conn, $id_judul_buku_mapel)
{
    $ambil = $conn->query("SELECT * FROM peminjaman_buku_mapel WHERE id_pinjam_buku_mapel='$_GET[id]'");
    $row = $ambil->fetch_assoc();
    $banyak_buku = $row["banyak_buku"];
    $q = "UPDATE buku_mapel_kelas SET stok = stok + $banyak_buku WHERE id_judul_buku_mapel = '$id_judul_buku_mapel'";
    mysqli_query($conn, $q);
}


function cek_stok_literasi($conn,$kode_buku_literasi)
{
    $q = "SELECT stok FROM buku_literasi_umum WHERE kode_buku_literasi = '$kode_buku_literasi'";
    $hasil = mysqli_query($conn, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $stok = $hasil['stok'];

    return $stok;
}

function kurangi_stok_literasi($conn, $kode_buku_literasi)
{
    $q = "UPDATE buku_literasi_umum SET stok = stok - 1 WHERE kode_buku_literasi = '$kode_buku_literasi'";
    mysqli_query($conn, $q);
}

function tambah_stok_literasi($conn, $kode_buku_literasi)
{
    $q = "UPDATE buku_literasi_umum SET stok = stok + 1 WHERE kode_buku_literasi = '$kode_buku_literasi'";
    mysqli_query($conn, $q);
}


function cek_stok($conn,$id_judul_buku_tahunan )
{
    $q = "SELECT stok FROM buku_tahunan_siswa WHERE id_judul_buku_tahunan = '$id_judul_buku_tahunan'";
    $hasil = mysqli_query($conn, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $stok = $hasil['stok'];

    return $stok;
}

function kurangi_stok($conn, $id_judul_buku_tahunan)
{
    $q = "UPDATE buku_tahunan_siswa SET stok = stok - 1 WHERE id_judul_buku_tahunan = '$id_judul_buku_tahunan'";
    mysqli_query($conn, $q);
}

function tambah_stok($conn, $id_judul_buku_tahunan)
{
    $q = "UPDATE buku_tahunan_siswa SET stok = stok + 1 WHERE id_judul_buku_tahunan = '$id_judul_buku_tahunan'";
    mysqli_query($conn, $q);
}


function hitung_denda($tgl_kembali, $tanggal_hrs_kembali)
{
    if (strtotime( $tgl_kembali ) > strtotime($tanggal_hrs_kembali)) {
        $kembali = new DateTime($tgl_kembali); 
        $jatuh_tempo   = new DateTime($tanggal_hrs_kembali); 

        $selisih = $kembali->diff($jatuh_tempo);
        $selisih = $selisih->format('%d');

        $denda = 2000 * $selisih;
    } else {
        $denda = 0;
    }

    return $denda;
}
function ubahliterasi($data) {
    global $conn;
    
    $kode_buku_literasi = htmlspecialchars($data["kode_buku_literasi"]);
    $judul_buku_literasi = htmlspecialchars($data["judul_buku_literasi"]);
    $id_penerbit = htmlspecialchars($data["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $stok = htmlspecialchars($data["stok"]);
    $id_rak = htmlspecialchars($data["id_rak"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar_sampul']['error'] === 4 ) {
        $gambar_sampul = $gambarLama;
    } else {
        $gambar_sampul = uploadliterasi();
    }

    $query = "UPDATE buku_literasi_umum SET
                judul_buku_literasi = '$judul_buku_literasi',
                id_penerbit = '$id_penerbit',
                tahun_terbit = '$tahun_terbit',
                id_rak = '$id_rak',
                id_kategori = '$id_kategori',
                stok ='$stok',
                gambar_sampul = '$gambar_sampul',
                deskripsi_buku = '$deskripsi_buku'
              WHERE kode_buku_literasi = '$kode_buku_literasi'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function terlambatliterasi($tgl_dateline, $tgl_kembali ){

$tgl_dateline_pecah = explode("-", $tgl_dateline);
$tgl_dateline_pecah = $tgl_dateline_pecah[2]."-".$tgl_dateline_pecah[1]."-".$tgl_dateline_pecah[0];

$tgl_kembali_pecah = explode("-", $tgl_kembali);
$tgl_kembali_pecah = $tgl_kembali_pecah[2]."-".$tgl_kembali_pecah[1]."-".$tgl_kembali_pecah[0];

$selisih = strtotime($tgl_kembali_pecah)-strtotime($tgl_dateline_pecah);

$selisih = $selisih/86400;

if ($selisih>=1) {
    $hasil_tgl = floor($selisih);
} else {
    $hasil_tgl = 0;
}
return $hasil_tgl;
}


function tambahmapel($datamapel) {
	global $conn;

    $id_judul_buku_mapel = htmlspecialchars($datamapel["id_judul_buku_mapel"]);
    $judul_buku_mapel = htmlspecialchars($datamapel["judul_buku_mapel"]);
    $id_penerbit = htmlspecialchars($datamapel["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($datamapel["tahun_terbit"]);
    $untuk_kelas = htmlspecialchars($datamapel["untuk_kelas"]);

    // upload gambar
    $gambar_sampul = uploadmapel();
    if( !$gambar_sampul ) {
    	return false;
    }

    $stok = htmlspecialchars($datamapel["stok"]);

    $query = "INSERT INTO buku_mapel_kelas 
              VALUES
              ('$id_judul_buku_mapel', '$judul_buku_mapel', '$id_penerbit', '$tahun_terbit', '$untuk_kelas', '$gambar_sampul', '$stok')
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadmapel() {

	$namaFile = $_FILES['gambar_sampul']['name'];
	$ukuranFile = $_FILES['gambar_sampul']['size'];
	$error = $_FILES['gambar_sampul']['error'];
	$tmpName = $_FILES['gambar_sampul']['tmp_name'];
	// cek jika tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // cek hanya gambar yang boleh di upload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // jika lolos maka gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/mapel/' . $namaFileBaru);

    return $namaFileBaru;

}

function ubahmapel($data) {
    global $conn;

    $id_judul_buku_mapel = htmlspecialchars($data["id_judul_buku_mapel"]);
    $judul_buku_mapel = htmlspecialchars($data["judul_buku_mapel"]);
    $id_penerbit = htmlspecialchars($data["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $untuk_kelas = htmlspecialchars($data["untuk_kelas"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $stok = htmlspecialchars($data["stok"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar_sampul']['error'] === 4 ) {
        $gambar_sampul = $gambarLama;
    } else {
        $gambar_sampul = uploadmapel();
    }

    $query = "UPDATE buku_mapel_kelas SET
                judul_buku_mapel = '$judul_buku_mapel',
                id_penerbit = '$id_penerbit',
                tahun_terbit = '$tahun_terbit',
                untuk_kelas = '$untuk_kelas',
                gambar_sampul = '$gambar_sampul',
                stok = '$stok'
              WHERE id_judul_buku_mapel = '$id_judul_buku_mapel'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// tambah data tahunan
function tambahtahunan($datatahunan) {
	global $conn;

    $id_judul_buku_tahunan = htmlspecialchars($datatahunan["id_judul_buku_tahunan"]);
    $judul_buku_tahunan = htmlspecialchars($datatahunan["judul_buku_tahunan"]);
    $id_penerbit = htmlspecialchars($datatahunan["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($datatahunan["tahun_terbit"]);
    $untuk_kelas = htmlspecialchars($datatahunan["untuk_kelas"]);

    // upload gambar
    $gambar_sampul = uploadtahunan();
    if( !$gambar_sampul ) {
        return false;
    }
    
    $stok = htmlspecialchars($datatahunan["stok"]);

    $query = "INSERT INTO buku_tahunan_siswa
              VALUES 
              ('$id_judul_buku_tahunan', '$judul_buku_tahunan', '$id_penerbit', '$tahun_terbit', '$untuk_kelas', '$gambar_sampul', '$stok')
              ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadtahunan() {

	$namaFile = $_FILES['gambar_sampul']['name'];
	$ukuranFile = $_FILES['gambar_sampul']['size'];
	$error = $_FILES['gambar_sampul']['error'];
	$tmpName = $_FILES['gambar_sampul']['tmp_name'];
    
	// cek jika tidak ada gambar yang di upload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // cek hanya gambar yang boleh di upload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // jika lolos maka gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/tahunan/' . $namaFileBaru);

    return $namaFileBaru;

}

function ubahtahunan($data) {
    global $conn;
    
    $id_judul_buku_tahunan = htmlspecialchars($data["id_judul_buku_tahunan"]);
    $judul_buku_tahunan = htmlspecialchars($data["judul_buku_tahunan"]);
    $id_penerbit = htmlspecialchars($data["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $untuk_kelas = htmlspecialchars($data["untuk_kelas"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $stok = htmlspecialchars($data["stok"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar_sampul']['error'] === 4 ) {
        $gambar_sampul = $gambarLama;
    } else {
        $gambar_sampul = uploadtahunan();
    }

    $query = "UPDATE buku_tahunan_siswa SET
                judul_buku_tahunan = '$judul_buku_tahunan',
                id_penerbit = '$id_penerbit',
                tahun_terbit = '$tahun_terbit',
                untuk_kelas = '$untuk_kelas',
                gambar_sampul = '$gambar_sampul',
                stok = '$stok'
              WHERE id_judul_buku_tahunan = '$id_judul_buku_tahunan'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function terlambattahunan($tgl_dateline, $tgl_kembali ){

$tgl_dateline_pecah = explode("-", $tgl_dateline);
$tgl_dateline_pecah = $tgl_dateline_pecah[2]."-".$tgl_dateline_pecah[1]."-".$tgl_dateline_pecah[0];

$tgl_kembali_pecah = explode("-", $tgl_kembali);
$tgl_kembali_pecah = $tgl_kembali_pecah[2]."-".$tgl_kembali_pecah[1]."-".$tgl_kembali_pecah[0];

$selisih = strtotime($tgl_kembali_pecah)-strtotime($tgl_dateline_pecah);

$selisih = $selisih/86400;

if ($selisih>=1) {   
    $hasil_tgl = floor($selisih);
} else {
    $hasil_tgl = 0;
}
return $hasil_tgl;
} 

function tambahtamu($datatamu) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $nama_tamu = htmlspecialchars($datatamu["nama_tamu"]);
    $delegasi = htmlspecialchars($datatamu["delegasi"]);
    $kepentingan = htmlspecialchars($datatamu["kepentingan"]);
    $Tanggal_Kedatangan = Date('Y-m-d');

    $query = "INSERT INTO tamu 
              VALUES
              (null, '$nama_tamu', '$delegasi', '$kepentingan', '$Tanggal_Kedatangan')
              ";
   
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahsiswa($datasiswa) {     
    global $conn;

    // ambil data dari tiap elemen dalam form    
    $tanggal_absensi =  Date('Y-m-d');
    $nama_siswa = htmlspecialchars($datasiswa["nama_siswa"]);
    $kode_kelas = htmlspecialchars($datasiswa["kode_kelas"]);
    $keperluan = htmlspecialchars($datasiswa["keperluan"]);

    $query = "INSERT INTO pengunjung_siswa 
              VALUES
              (null, '$tanggal_absensi', '$nama_siswa', '$kode_kelas', '$keperluan')
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahkelas($data){
    global $conn;
    $kode_kelas = htmlspecialchars($data["kode_kelas"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $wali_kelas = htmlspecialchars($data["wali_kelas"]);

    $query = "INSERT INTO kelas (kode_kelas, jurusan, wali_kelas) VALUES ('$kode_kelas', '$jurusan', '$wali_kelas') ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapuskelas($id){
    global $conn;
    mysqli_query ($conn, "DELETE FROM kelas WHERE kode_kelas = '$id'");

    return mysqli_affected_rows($conn);
}

function ubahkelas($data){
    global $conn;
    $kode_kelas = htmlspecialchars($data["kode_kelas"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $wali_kelas = htmlspecialchars($data["wali_kelas"]);

    $query = "UPDATE  kelas SET
                    kode_kelas = '$kode_kelas',
                    jurusan = '$jurusan',
                    wali_kelas ='$wali_kelas'
                WHERE kode_kelas = '$_GET[id]'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>