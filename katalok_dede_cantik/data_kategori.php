<?php
// Koneksi ke database
include 'db_connect.php';

// Query untuk menghitung jumlah aplikasi per kategori
$query = "SELECT kategori_aplikasi, COUNT(*) AS jumlah FROM produk GROUP BY kategori_aplikasi";
$result = mysqli_query($conn, $query);

// Inisialisasi array untuk menyimpan kategori dan jumlah aplikasi
$categories = [];
$counts = [];

// Fetch data dari query
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['kategori_aplikasi'];
    $counts[] = $row['jumlah'];
}

// Konversi data ke format JSON untuk dikirim ke JavaScript
$categories_json = json_encode($categories);
$counts_json = json_encode($counts);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
           body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif; /* Menggunakan font dari Google */
        }
        h2 {
            color: white; /* Warna teks putih */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sedikit bayangan */
        }
        body {
            padding-top: 70px; /* Beri ruang untuk navbar tetap di atas */
            background-color: #f8f9fa;
        }
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -2;
            opacity: 0.8;
        }
        .background-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        body {
          padding-top: 70px; /* Ruang untuk navbar fixed */
          background-color: #f8f9fa;
          color: #fff;
      }

        /* Styling Navbar */
        .navbar {
            background-color: #343a40;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-brand span {
            font-weight: bold;
            font-size: 1.5rem;
            color: #00bcd4;
        }

        .navbar-nav .nav-link {
            font-size: 1rem;
            color: #fff;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #00bcd4;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%28%255, 255, 255, 1%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .nav-item .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar .btn-custom {
            background-color: #00bcd4;
            color: #fff;
            border-radius: 30px;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }

        .navbar .btn-custom:hover {
            background-color: #008ba3;
        }

        /* Penyesuaian untuk tampilan mobile */
        @media (max-width: 992px) {
            .navbar-nav {
                flex-direction: column;
                align-items: center;
            }

            .navbar-nav .nav-link {
                margin-right: 0;
                padding: 10px 0;
                text-align: center;
            }

            .navbar-brand span {
                font-size: 1.2rem; /* Ukuran font lebih kecil di mobile */
            }

            .navbar .btn-custom {
                width: 100%;
                margin-top: 10px;
            }
        }
  
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        h2 {
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -2;
            opacity: 0.8;
        }
        .background-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        .chart-container {
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
         <!-- Background Overlay -->
         <div class="background-overlay"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="ww.png" alt="Logo"> <!-- Tambahkan URL logo di sini -->
            Katalog.<span>APP</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_kategori.php">Data Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dataapp.php">Data Aplikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengguna_laporan.php">Form Permintaan</a>
                </li>
            </ul>
            <a href="login.php" class="btn btn-custom">Masuk</a>
        </div>
    </div>
</nav>





<div class="background-overlay"></div>

<div class="container">
    <h2 class="text-center mb-4">Jumlah Aplikasi Berdasarkan Kategori</h2>
    <div class="row">
        <!-- Diagram Batang -->
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="text-center">Diagram Batang</h5>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Diagram Pie -->
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="text-center">Diagram Pie</h5>
                <canvas id="categoryPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Data dari PHP (dikirim sebagai JSON)
    const categories = <?php echo $categories_json; ?>;
    const counts = <?php echo $counts_json; ?>;

    // Membuat diagram batang
    const ctx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(ctx, {
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
    const categoryPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
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