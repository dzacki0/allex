<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">History Pengaduan Ditolak</h2>
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Pengaduan</th>
                    <th>Nama Pengguna</th>
                    <th>Deskripsi Pengaduan</th>
                    <th>Status</th>
                    <th>Tanggal Pengaduan</th>
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

            // Mengambil data laporan pengaduan yang ditolak
            $query = "SELECT * FROM laporan_pengaduan WHERE status = 'ditolak'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['nama_pengguna']) . "</td>
                            <td>" . htmlspecialchars($row['deskripsi']) . "</td>
                            <td>" . ucfirst(htmlspecialchars($row['status'])) . "</td>
                            <td>" . htmlspecialchars($row['tanggal_pengaduan']) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada laporan pengaduan yang ditolak</td></tr>";
            }

            // Tutup koneksi
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
