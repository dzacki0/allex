<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            padding-top: 70px;
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
            opacity: 0.7;
        }
        .background-overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
        
        h2 {
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        
    
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
    <br>
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


    <!-- Form Pengaduan -->
    <div class="container mt-5">
        <h2>Form Permintaan Data Aplikasi</h2>
        <form action="submit_laporan.php" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Detail Permintaan</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
