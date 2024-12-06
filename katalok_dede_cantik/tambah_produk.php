<?php
session_start();
include 'db_connect.php';

// Fetch all products
$productsQuery = "SELECT * FROM produk ORDER BY id DESC";
$productsResult = mysqli_query($conn, $productsQuery);

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'katalogapp');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil pesan yang belum dibaca
$query = "SELECT * FROM notifications WHERE is_read = 0";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<div class='alert alert-info'>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . htmlspecialchars($row['message']) . "</p>";
    }
    echo "</div>";

    // Update pesan menjadi terbaca
    $update_query = "UPDATE notifications SET is_read = 1 WHERE is_read = 0";
    $conn->query($update_query);
} else {
    echo "<p>Tidak ada notifikasi baru.</p>";
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
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

        /* Styling for table */
        .table-container {
            width: 85%; /* Sesuaikan lebar sesuai kebutuhan */
            margin: 0 auto; /* Pusatkan tabel */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .table td, .table th {
            text-align: center;
        }

        /* Overflow ellipsis for long URLs */
        .url-cell {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }
        
        .custom-button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px); /* Slight lift effect on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .custom-button:active {
            background-color: #003f7f;
            transform: translateY(0); /* Return to original position on click */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .message-button img {
            width: 30px;
            height: 30px;
        }

        .notifications {
            position: fixed;
            top: 90px;
            right: 20px;
            width: 300px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            padding: 10px;
        }

        .notifications ul {
            list-style-type: none;
            padding: 0;
        }

        .notifications ul li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
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
                    Dashboard
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
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h3>Daftar Produk</h3>
       
        <a href="tambah.php" class="btn btn-primary btn-lg mt-5 custom-button">Tambah Produk</a>
       
        <table id="productTable" class="display table table-bordered mt-3">
            
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Aplikasi</th>
                    <th>Kategori</th>
                    <th>Tahun Pembuatan</th>
                    <th>Bahasa Pemrograman</th>
                    <th>Database</th>
                    <th>Web Server</th>
                    <th>URL</th>
                    <th>Developer</th>
                    <th>Penanggung Jawab</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $counter = 1; // Initialize the counter
                while ($row = mysqli_fetch_assoc($productsResult)): ?>
                <tr>
                    <td><?php echo $counter++; ?></td> <!-- Sequential IDs -->
                    <td><?php echo $row['nama_aplikasi']; ?></td>
                    <td><?php echo $row['kategori_aplikasi']; ?></td>
                    <td><?php echo $row['tahun_pembuatan']; ?></td>
                    <td><?php echo $row['bahasa_pemrograman']; ?></td>
                    <td><?php echo $row['database']; ?></td>
                    <td><?php echo $row['web_server']; ?></td>
                    <td class="url-cell"><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a></td>
                    <td><?php echo $row['developer']; ?></td>
                    <td><?php echo $row['penanggung_jawab']; ?></td>
                    <td><?php echo $row['status_hidup_mati']; ?></td>
                    <td><img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_aplikasi']; ?>" style="width: 100px;"></td>
                    <td>
                       <!-- Inside your table where products are listed -->
<td>
    <a href="update_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
</td>
<td>
    <a href="delete_produk.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Hapus</a>
</td>

                </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                "pagingType": "simple", // Adjust pagination type
                "pageLength": 9, // Default number of entries per page
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "search": "Cari:",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
