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
$buah = $_GET["query"];

// Query ke database.
$query  = $conn->query("SELECT * FROM member_perpus WHERE nama_siswa LIKE '%$buah%' AND status = 'aktif' ORDER BY nis DESC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['nama_siswa'],
            'buah' => $data['nama_siswa'],
            'nis'  => $data['nis']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => 'tidak ada data',
        'buah'  => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}
