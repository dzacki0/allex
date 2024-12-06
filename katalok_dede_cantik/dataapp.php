<?php
// Include the database connection
include 'db_connect.php';

// Fetch all products from the database, ordered by ID in ascending order
$query = "SELECT * FROM produk ORDER BY id ASC";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aplikasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 2.5rem; /* Larger heading */
        }
        .container {
            width: 90%; /* Further increase container width */
            max-width: 1400px; /* Further increase max-width */
            position: relative;
        }
        table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 0.5rem; /* Increase border-radius for a larger effect */
            overflow: hidden;
            table-layout: fixed;
            margin: 0;
        }
        th, td {
            text-align: center;
            padding: 1rem; /* Further increase padding */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1.25rem; /* Increase font size */
        }
        th {
            background-color: #343a40;
            color: #ffffff;
            border-bottom: 2px solid #dee2e6;
        }
        td a {
            color: #007bff;
            text-decoration: none;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        td a:hover {
            text-decoration: underline;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.75rem 1.25rem; /* Further increase pagination button size */
            font-size: 1.25rem; /* Further increase font size */
            border-radius: 0.5rem;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 1.25rem; /* Further increase font size */
        }
        .dataTables_wrapper .dataTables_filter input {
            font-size: 1.25rem; /* Further increase font size */
            border-radius: 0.5rem;
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
        /* navbar.css */
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
   

        .data-table-wrapper {
            background-color: #f8f9fa;
            padding: 40px; /* Further increase padding */
            border-radius: 0.5rem; /* Further increase border-radius */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Increase shadow */
        }
    </style>
</head>
<body>
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
      <a href="login.php" class="btn btn-custom">masuk</a>
    </div>
  </div>
</nav>


    <!-- Data Aplikasi Section -->
    <div class="container">
        <h2 class="text-center mb-4 text-white">Data Aplikasi</h2>
        <div class="data-table-wrapper">
            <table id="dataTable" class="table table-bordered table-striped bg-dark-custom text-white">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Aplikasi</th>
                        <th>Kategori Aplikasi</th>
                        <th>Tahun Pembuatan</th>
                        <th>Bahasa Pemrograman</th>
                        <th>Database</th>
                        <th>Web Server</th>
                        <th>URL</th>
                        <th>Developer</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_aplikasi']); ?></td>
                            <td><?php echo htmlspecialchars($row['kategori_aplikasi']); ?></td>
                            <td><?php echo htmlspecialchars($row['tahun_pembuatan']); ?></td>
                            <td><?php echo htmlspecialchars($row['bahasa_pemrograman']); ?></td>
                            <td><?php echo htmlspecialchars($row['database']); ?></td>
                            <td><?php echo htmlspecialchars($row['web_server']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank"><?php echo strlen($row['url']) > 50 ? substr(htmlspecialchars($row['url']), 0, 50) . '...' : htmlspecialchars($row['url']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['developer']); ?></td>
                            <td><?php echo htmlspecialchars($row['penanggung_jawab']); ?></td>
                            <td><?php echo htmlspecialchars($row['status_hidup_mati']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pagingType": "simple_numbers",
                "lengthMenu": [5, 10, 25],
                "pageLength": 10,
                "ordering": false,
                "info": true,
                "searching": true,
                "scrollX": true
            });
        });
    </script>
</body>
</html>
