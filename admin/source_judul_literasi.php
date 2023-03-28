<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
$host     = "localhost";// Server database
$username = "root";     // Username database
$password = "";     // Password database
$database = "perpustakaan";     // Nama database

// Koneksi ke database.
$conn = new mysqli($host, $username, $password, $database);

// Deklarasi variable keyword buah.
$judul_buku = $_GET["query"];

// Query ke database.
$query  = $conn->query("SELECT * FROM buku_literasi_umum WHERE judul_buku_literasi LIKE '%$judul_buku%' ORDER BY kode_buku_literasi DESC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['judul_buku_literasi'],
            'judul_buku'  => $data['judul_buku_literasi'],
            'kode_buku'  => $data['kode_buku_literasi']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => 'tidak ada data',
        'judul_buku'  => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}