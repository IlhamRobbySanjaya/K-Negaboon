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
$kelas = $_GET["query"];

// Query ke database.
$query  = $conn->query("SELECT * FROM kelas WHERE jurusan LIKE '%$kelas%' ");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['jurusan'],
            'kelas'  => $data['jurusan'],
            'kode_kelas'  => $data['kode_kelas']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => 'tidak ada data',
        'kelas'  => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}