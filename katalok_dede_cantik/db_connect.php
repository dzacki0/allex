<?php
$host = 'localhost'; // atau 127.0.0.1
$user = 'root'; // Sesuaikan dengan user database kamu
$password = ''; // Sesuaikan dengan password database kamu
$database = 'katalogapp'; // Nama database yang kamu gunakan

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
