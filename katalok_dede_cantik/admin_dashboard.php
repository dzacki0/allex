<?php
session_start();
include 'db_connect.php';

// Query untuk mendapatkan kategori dan jumlah aplikasi
$categoryQuery = "SELECT kategori_aplikasi, COUNT(*) as count FROM produk GROUP BY kategori_aplikasi";
$categoryResult = mysqli_query($conn, $categoryQuery);

$categories = [];
$counts = [];

while ($row = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = $row['kategori_aplikasi'];
    $counts[] = $row['count'];
}

// Konversi array PHP ke JSON
$categories_json = json_encode($categories);
$counts_json = json_encode($counts);
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
            color: #333;
        }

        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }

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

        .content {
            margin-left: 250px;
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            border-top: 8px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .dropdown-menu .dropdown-item {
            color: white;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #0069d9;
        }

        .chart-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .chart-card {
            padding: 1rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                    <i class="bi bi-speedometer2"></i> 
                    <i class=""></i> Dashboard
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
                    <i class="bi bi-people"></i> Form Permintaan
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
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h2 class="text-center mb-4">Jumlah Aplikasi Berdasarkan Kategori</h2>

        <!-- Diagram Batang -->
        <div class="chart-container">
            <div class="chart-card">
                <h5 class="text-center">Diagram Batang</h5>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Diagram Pie -->
        <div class="chart-container mt-4">
            <div class="chart-card">
                <h5 class="text-center">Diagram Pie</h5>
                <canvas id="categoryPieChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari PHP (dikirim sebagai JSON)
        const categories = <?php echo $categories_json; ?>;
        const counts = <?php echo $counts_json; ?>;

        // Membuat diagram batang
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Jumlah Aplikasi',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        });

        // Membuat diagram pie
        const ctxPie = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Jumlah Aplikasi',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>