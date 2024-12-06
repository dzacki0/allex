

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Laporan Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
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
            padding-top: 20px;
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
    <div class="sidebar">
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
                    <i class="bi bi-people"></i> Laporan
                </a>
            </li>
            
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container">
            <h2 class="text-center">Laporan Permintaan</h2>
            <table class="table table-bordered table-hover mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pengaduan</th>
                        <th>Nama Pengguna</th>
                        <th>Deskripsi Pengaduan</th>
                        <th>Status</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Koneksi ke database
                $conn = new mysqli('localhost', 'root', '', 'katalogapp');

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Mengambil data laporan pengaduan yang belum ditolak
                $query = "SELECT * FROM laporan_pengaduan WHERE status != 'ditolak'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['nama_pengguna']) . "</td>
                                <td>" . htmlspecialchars($row['deskripsi']) . "</td>
                                <td>" . ucfirst(htmlspecialchars($row['status'])) . "</td>
                                <td>" . htmlspecialchars($row['tanggal_pengaduan']) . "</td>
                                <td>
                               <a href='ubah_status.php?id=" . $row['id'] . "&status=selesai' class='btn btn-success btn-sm'>Terima</a>
                                    <a href='ubah_status.php?id=" . $row['id'] . "&status=ditolak' class='btn btn-danger btn-sm'>Tolak</a>
                                
                                   
                                
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada laporan pengaduan</td></tr>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
                  <a href="history_pengaduan.php" class="btn btn-primary btn-lg mt-5 custom-button">History Pengaduan</a>
                </tbody>
            </table>
        </div>
    </div>
    
  
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
