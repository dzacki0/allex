<?php
session_start();
include 'db_connect.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk memeriksa apakah username dan password benar
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login berhasil, set session admin_id
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id']; // Simpan admin_id di session
        header('Location: admin_dashboard.php'); // Redirect ke dashboard
    } else {
        // Jika login gagal, tampilkan pesan error
        echo "<script>alert('Login gagal, username atau password salah'); window.location.href = 'login.php';</script>";
    }
}
?>
