<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;   
}



function cari($keyword){
    $query = "SELECT * FROM buku_literasi_umum
            WHERE
            judul_buku_literasi LIKE '%$keyword%' 
            ";
    return query($query);
}

//halaman register.php
function registrasi($data) {
    global $conn;

    $nip = ($data["nip"]);
    $nama_pustakawan = ($data["nama_pustakawan"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

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

function tambah($data) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $kode_buku_literasi = htmlspecialchars($data["kode_buku_literasi"]);
    $judul_buku_literasi = htmlspecialchars($data["judul_buku_literasi"]);
    $id_penerbit = htmlspecialchars($data["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $id_rak = htmlspecialchars($data["id_rak"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
 
    // upload gambar
    $gambar_sampul = upload();
    if( !$gambar_sampul ) {
        return false;
    }

    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);

    $query = "INSERT INTO buku_literasi_umum 
              VALUES
              ('$kode_buku_literasi', '$judul_buku_literasi', '$id_penerbit', '$tahun_terbit', '$id_rak', '$id_kategori', '$gambar_sampul', '$deskripsi_buku')
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {

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


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buku_tahunan_siswa WHERE id_judul_buku_tahunan = $id ");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    
    $kode_buku_literasi = htmlspecialchars($data["kode_buku_literasi"]);
    $judul_buku_literasi = htmlspecialchars($data["judul_buku_literasi"]);
    $id_penerbit = htmlspecialchars($data["id_penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $id_rak = htmlspecialchars($data["id_rak"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar_sampul']['error'] === 4 ) {
        $gambar_sampul = $gambarLama;
    } else {
        $gambar_sampul = upload();
    }

    $query = "UPDATE buku_literasi_umum SET
                kode_buku_literasi = '$kode_buku_literasi',
                judul_buku_literasi = '$judul_buku_literasi',
                id_penerbit = '$id_penerbit',
                tahun_terbit = '$tahun_terbit',
                id_rak = '$id_rak'
                id_kategori = '$id_kategori',
                gambar_sampul = '$gambar_sampul',
                deskripsi_buku = '$deskripsi_buku'
              WHERE id = '$id'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function terlambat($tgl_dateline, $tgl_kembali ){

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



?>