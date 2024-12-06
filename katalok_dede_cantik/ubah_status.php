<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'katalogapp');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$status = $_GET['status'];

// Update status pengaduan
$query = "UPDATE laporan_pengaduan SET status='$status' WHERE id='$id'";
if ($conn->query($query) === TRUE) {
    // Jika status adalah "selesai", tambahkan data pengaduan ke tabel notifications
    if ($status == 'selesai') {
        // Ambil detail pengaduan yang selesai
        $get_laporan = "SELECT nama_pengguna, deskripsi FROM laporan_pengaduan WHERE id='$id'";
        $laporan_result = $conn->query($get_laporan);
        $laporan = $laporan_result->fetch_assoc();
        
        $pesan = "Permitaan dari " . htmlspecialchars($laporan['nama_pengguna']) . ": " . htmlspecialchars($laporan['deskripsi']);
        $insert_notification = "INSERT INTO notifications (message, is_read) VALUES ('$pesan', 0)";
        $conn->query($insert_notification);
    }
}

// Redirect kembali ke halaman laporan
header("Location: admin_laporan.php");
$conn->close();
?>
