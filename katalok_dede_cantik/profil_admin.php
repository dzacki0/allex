<?php
session_start();
include 'db_connect.php'; // Menghubungkan ke database

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php'); // Jika belum login, arahkan ke halaman login
    exit();
}

// Ambil informasi admin dari database berdasarkan admin_id yang ada di session
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admin WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $admin_id);
$stmt->execute();
$result = $stmt->get_result();

// Jika admin ditemukan, ambil datanya
if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Data admin tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f2f5;
        }
        .profile-container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .profile-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .profile-info {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }
        .profile-info strong {
            color: #222;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    
        body {
            font-family: Arial, sans-serif;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
        }

        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Overlay warna hitam semi-transparan */
            z-index: -1; /* Di bawah konten */
        }

        /* Styling for the sidebar */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 250px;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: white;
            transition: background-color 0.2s;
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
        }

        .sidebar .nav-link:hover {
            background-color: #0069d9;
        }

        .sidebar .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .sidebar .dropdown-menu .dropdown-item {
            color: white;
        }

        .sidebar .dropdown-menu .dropdown-item:hover {
            background-color: #0069d9;
        }

        /* Content area styling */
        .content {
            margin-left: 250px;
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.8); /* Add background color with opacity for readability */
            border-radius: 10px; /* Optional: rounded corners */
            border-top: 8px solid #007bff; /* Garis tepi atas lebih besar */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Opsional: bayangan untuk memberikan efek kedalaman */
        }

        .nav-item .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .nav-item .dropdown-menu .dropdown-item {
            color: white;
        }

        .nav-item .dropdown-menu .dropdown-item:hover {
            background-color: #0069d9;
        }

        .list-group-item.active {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="background-overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center">Admin Dashboard</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data.php">
                    <i class="bi bi-box-seam"></i> Data
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tambah_produk.php">
                    <i class="bi bi-box"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_laporan.php">
                    <i class="bi bi-people"></i> Laporan
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/50" alt="" class="rounded-circle me-2">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="profil_admin.php">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="profile-container">
            <h2 class="profile-title">Profil Admin</h2>
            <p class="profile-info"><strong>ID Admin:</strong> <?php echo htmlspecialchars($admin['id']); ?></p>
            <p class="profile-info"><strong>Nama Admin:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
            <p class="profile-info"><strong>Password Admin (terenkripsi):</strong> <?php echo htmlspecialchars($admin['password']); ?></p>

            <!-- Tambahkan informasi lain sesuai kebutuhan -->
            <a href="admin_dashboard.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
