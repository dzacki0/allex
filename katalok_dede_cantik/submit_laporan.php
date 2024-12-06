<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'katalogapp');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d H:i:s'); // Menyimpan tanggal dan waktu pengaduan

    // Query untuk memasukkan pengaduan ke database
    $query = "INSERT INTO laporan_pengaduan (nama_pengguna, deskripsi, status, tanggal_pengaduan) VALUES ('$nama', '$deskripsi', 'pending', '$tanggal')";

    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Permintaan berhasil dikirim.');
                window.location.href = 'pengguna_laporan.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
