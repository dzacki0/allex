<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
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
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
        }

        .sidebar .nav-link:hover {
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
                <a class="nav-link active" href="data.php">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" href="admin_home.php">
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
                    <i class="bi bi-people"></i> laporan
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

    <!-- Content Area -->
    <div class="content">
        <h1>Dashboard Admin</h1>
        <h3>Produk Terbaru:</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama Aplikasi</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Bahasa Pemrograman</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Query produk dari database dan tampilkan -->
                <?php
                $productsQuery = "SELECT * FROM produk ORDER BY id DESC LIMIT 10";
                $productsResult = mysqli_query($conn, $productsQuery);
                while ($row = mysqli_fetch_assoc($productsResult)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_aplikasi']); ?></td>
                        <td><?= htmlspecialchars($row['kategori_aplikasi']); ?></td>
                        <td><?= htmlspecialchars($row['tahun_pembuatan']); ?></td>
                        <td><?= htmlspecialchars($row['bahasa_pemrograman']); ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="gambar" style="width: 100px;"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies (Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
