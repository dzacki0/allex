<?php
session_start();
include 'db_connect.php';

// Handle category filtering
$selectedCategory = $_GET['category'] ?? '';

// Fetch products based on selected category
$productsQuery = $selectedCategory ? 
    "SELECT * FROM produk WHERE kategori_aplikasi = '$selectedCategory' ORDER BY id DESC" : 
    "SELECT * FROM produk ORDER BY id DESC";
$productsResult = mysqli_query($conn, $productsQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f8f9fa;
            padding-top: 70px; /* For fixed navbar */
        }

        h2 {
            color: #2c3e50;
            font-weight: bold;
        }

        p {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
        }

        .btn {
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #007bff;
        }

        body {
          padding-top: 70px; /* Ruang untuk navbar fixed */
          background-color: #f8f9fa;
          color: #fff;
      }

      /* Styling Navbar */
      .navbar {
          background-color: #343a40; /* Navbar gelap */
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow lebih lembut */
          padding: 1rem 2rem; /* Padding yang lebih proporsional */
      }

      .navbar-brand {
          display: flex;
          align-items: center;
      }

      .navbar-brand img {
          height: 50px; /* Ukuran logo */
          margin-right: 10px; /* Jarak logo dengan teks */
      }

      .navbar-brand span {
          font-weight: bold;
          font-size: 1.5rem;
          color: #00bcd4; /* Warna khusus untuk brand */
      }

      .navbar-nav .nav-link {
          font-size: 1.2rem; /* Ukuran font yang lebih besar */
          color: #black; /* Warna putih */
          margin-right: 1.5rem;
          transition: color 0.3s ease;
      }

      .navbar-nav .nav-link:hover {
          color: #00bcd4; /* Warna hover biru */
      }

      .navbar-toggler {
          border: none; /* Hapus border */
      }

      .navbar-toggler-icon {
          background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%28%255, 255, 255, 1%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
      }

      /* Navbar collapse styling */
      .navbar-collapse {
          justify-content: flex-end; /* Navbar items di kanan */
      }

      .nav-item .nav-link {
          padding: 0.5rem 1rem;
          border-radius: 30px; /* Membuat efek tombol pada nav item */
          transition: background-color 0.3s ease;
      }

      .nav-item .nav-link:hover {
          background-color: rgba(255, 255, 255, 0.1); /* Hover dengan efek transparan */
      }

      /* Style tombol pada navbar */
      .navbar .btn-custom {
          background-color: #00bcd4;
          color: #fff;
          border-radius: 30px;
          padding: 0.5rem 1rem;
          transition: background-color 0.3s ease;
      }

      .navbar .btn-custom:hover {
          background-color: #008ba3; /* Tombol hover dengan warna biru lebih gelap */
      }

      @media (max-width: 992px) {
          .navbar-nav .nav-link {
              margin-right: 0; /* Hilangkan margin pada mobile */
              text-align: center; /* Teks rata tengah di mobile */
              padding: 10px 0;
          }
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

        .category-buttons {
            margin: 30px 0;
            text-align: center;
        }

        .category-buttons .btn {
            margin: 0 10px;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 15px;
            border: 2px solid #333;
            background-color: #000;
            color: #fff;
            transition: 0.3s ease;
        }

        .category-buttons .btn:hover {
            background-color: #444;
            border-color: #00bcd4;
        }

        .product-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: contain;
            border-radius: 10px;
            background-color: #fff;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .product-card {
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Background Overlay -->
    <div class="background-overlay"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="intex.php">
                <img src="ww.png" alt="Logo" style="height: 90px;">
                Katalog.<span>APP</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_kategori.php">Data Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="dataapp.php">Data Aplikasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="pengguna_laporan.php">Form Permintaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="product-container">
            <h2>Produk untuk <?php echo htmlspecialchars($selectedCategory); ?></h2>
            <!-- Display Product Images -->
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($productsResult)): ?>
                <div class="col-md-4 mb-4">
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($row['nama_aplikasi']); ?>" 
                         class="img-fluid product-image" 
                         data-bs-toggle="modal" 
                         data-bs-target="#productModal" 
                         data-id="<?php echo $row['id']; ?>">
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary w-100 mt-4">Kembali ke Home</a>
    </div>

    <!-- Product Details Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product details will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var productModal = document.getElementById('productModal');
            productModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var productId = button.getAttribute('data-id');

                // Fetch product details via AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'detail_produk.php?id=' + productId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var product = JSON.parse(xhr.responseText);
                        var modalBody = productModal.querySelector('.modal-body');
                        modalBody.innerHTML = `
                            <div class="container">
                                <h4>${product.nama_aplikasi}</h4>
                                <p><strong>Kategori:</strong> ${product.kategori_aplikasi}</p>
                                <p><strong>Tahun:</strong> ${product.tahun_pembuatan}</p>
                                <p><strong>Bahasa Pemrograman:</strong> ${product.bahasa_pemrograman}</p>
                                <p><strong>Database:</strong> ${product.database}</p>
                                <p><strong>Web Server:</strong> ${product.web_server}</p>
                                <p><strong>URL:</strong> <a href="${product.url}" target="_blank">${product.url}</a></p>
                                <p><strong>Developer:</strong> ${product.developer}</p>
                                <p><strong>Responsible Party:</strong> ${product.pihak_pemangku}</p>
                                <p><strong>Status:</strong> ${product.status}</p>
                                <img src="uploads/${product.gambar}" class="img-fluid" alt="${product.nama_aplikasi}">
                            </div>
                        `;
                    }
                };
                xhr.send();
            });
        });
    </script>
</body>
</html>
