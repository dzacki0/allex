
<?php
// Include the database connection
include 'db_connect.php';

// Fetch all products from the database
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
            padding-top: 70px; /* Beri ruang untuk navbar tetap di atas */
            background-color: #f8f9fa;
        }

        body {
            position: relative;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
            color: white; /* Set default text color to white */
        }
        /* Overlay redup */
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -2; /* Overlay background di bawah konten */
            opacity: 0.8; /* Atur kegelapan background */
        }
        .background-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7); /* Overlay warna hitam semi-transparan */
            z-index: -1; /* Overlay transparan */
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
            background-color: #000; /* Black background for category buttons */
            color: #fff; /* White text color */
            transition: 0.3s ease;
        }
        .category-buttons .btn:hover {
            background-color: #444; /* Darker black on hover */
            border-color: #00bcd4;
        }
        .product-section {
            margin-top: 40px;
        }
        .product-card {
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.6); /* Dark background for product card */
        }
        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .product-card .card-body {
            padding: 15px;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
        }
        .product-details {
            display: none;
        }
        .product-card.show-details .product-details {
            display: block;
        }
        .product-card img {
    width: 100%;
    height: 200px; /* Atur tinggi gambar agar seragam */
    object-fit: cover; /* Mengisi area gambar tanpa mengubah rasio */
    border-radius: 10px; /* Berikan sudut bulat pada gambar */
}
.product-card img {
    width: 100%;
    height: 200px; /* Tetapkan tinggi gambar yang seragam */
    object-fit: contain; /* Menyesuaikan gambar dalam kotak tanpa pemotongan */
    background-color: #fff; /* Tambahkan warna latar belakang untuk gambar */
    border-radius: 10px; /* Berikan sudut bulat pada gambar */
}


        .fade-in {
            opacity: 0; /* Mulai dari transparan */
            animation: fadeInPage 2s forwards; /* Animasi memudar masuk */
        }
        @keyframes fadeInPage {
            from {
                opacity: 0;
                transform: translateY(20px); /* Awal dari posisi lebih rendah */
            }
            to {
                opacity: 1;
                transform: translateY(0); /* Posisi akhir */
            }
        }
        .intro-section {
            background-color: rgba(0, 0, 0, 0.7); /* Background gelap untuk bagian deskripsi */
            padding: 30px 15px;
            margin-bottom: 30px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }
        .intro-section h1 {
            font-size: 2em;
            margin-bottom: 15px;
            animation: typing 4s steps(50, end), blink 0.75s step-end infinite;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid #00bcd4; /* Cursor effect */
        }
        .intro-section p {
            font-size: 1.2em;
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        @keyframes blink {
            50% { border-color: transparent; }
        }
        .search-results {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping if needed */
    justify-content: center; /* Center the items horizontally */
    margin-top: 10px; /* Add some space above the results */
}

.product-card {
    border-radius: 10px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: 0.3s;
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.6);
    overflow: hidden;
    margin: 10px;
    flex: 0 1 200px; /* Control the width of each card */
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
          color: #fff; /* Warna putih */
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
   
    </style>
    <br>
    <br>
</head>
<body class="fade-in">
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
        <p>      

    <!-- Intro Section -->
    <div class="container intro-section">
        <h1>Selamat Datang di Katalog Aplikasi Kementerian Pertahanan</h1>
        <p>
            Katalog Aplikasi Kementerian Pertahanan adalah aplikasi berbasis web yang dirancang untuk menyediakan informasi terperinci tentang berbagai aplikasi yang digunakan di lingkungan Kementerian Pertahanan. Aplikasi ini memungkinkan pengguna untuk menelusuri aplikasi berdasarkan kategori, tahun pembuatan, bahasa pemrograman, dan atribut lainnya.
        </p>
        <p>
            Dengan tampilan yang intuitif dan informasi yang komprehensif, katalog ini bertujuan untuk memudahkan akses dan pemahaman mengenai aplikasi-aplikasi yang mendukung berbagai fungsi dan tugas di Kementerian Pertahanan.
        </p>
    </div>

    <!-- Kategori Section -->
    <div class="container text-center">
        <h2 class="my-4">KATEGORI</h2>
        <div class="container text-center button-container">
            <p>Pilih kategori untuk melihat produk:</p>
            <a href="kategori_aplikasi.php?category=Keuangan" class="btn btn-primary btn-lg">Keuangan</a>
            <a href="kategori_aplikasi.php?category=Administrasi" class="btn btn-secondary btn-lg">Administrasi</a>
            <a href="kategori_aplikasi.php?category=Pertahanan" class="btn btn-success btn-lg">Pertahanan</a>
        </div>
    </div>


    <br>
<br>
<br>

<!-- Search Form -->
<div class="container search-form">
    <form method="GET" action="search.php" id="searchForm">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Cari aplikasi..." oninput="liveSearch(this.value)">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
</div>

<!-- Search Results Section -->
<div class="container">
    <div id="searchResults" class="search-results">
        <!-- Results will be appended here -->
    </div>
</div>


<div id="searchResults" class="container"></div>

    <!-- Produk Section -->
    <div class="container product-section">
        <h2 class="text-center mb-4">PRODUK APP</h2>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4">
                    <div class="product-card mb-4" onclick="toggleDetails(this)">
                        <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_aplikasi']); ?>" class="img-fluid">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama_aplikasi']); ?></h5>
                            <div class="product-details">
                                <p class="card-text"><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori_aplikasi']); ?></p>
                                <p class="card-text"><strong>Tahun Pembuatan:</strong> <?php echo htmlspecialchars($row['tahun_pembuatan']); ?></p>
                                <p class="card-text"><strong>Bahasa Pemrograman:</strong> <?php echo htmlspecialchars($row['bahasa_pemrograman']); ?></p>
                                <p class="card-text"><strong>Database:</strong> <?php echo htmlspecialchars($row['database']); ?></p>
                                <p class="card-text"><strong>Web Server:</strong> <?php echo htmlspecialchars($row['web_server']); ?></p>
                                <p class="card-text"><strong>URL:</strong> <a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank"><?php echo htmlspecialchars($row['url']); ?></a></p>
                                <p class="card-text"><strong>Developer:</strong> <?php echo htmlspecialchars($row['developer']); ?></p>
                                <p class="card-text"><strong>Penanggung Jawab:</strong> <?php echo htmlspecialchars($row['penanggung_jawab']); ?></p>
                                <p class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($row['status_hidup_mati']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>
    function liveSearch(query) {
        if (query.length === 0) {
            document.getElementById("searchResults").innerHTML = "";
            return;
        }

        // Use Fetch API to get search results
        fetch(`search.php?search=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("searchResults").innerHTML = data;
            });
    }
</script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript untuk Toggle Details -->
    <script>
        function toggleDetails(card) {
            card.classList.toggle('show-details');
        }
    </script>
</body>
</html>