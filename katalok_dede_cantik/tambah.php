<?php
session_start();
include 'db_connect.php';

// Initialize message variables
$successMessage = "";
$errorMessage = "";

// Handle message display from URL parameters
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
$query = "SELECT idkategori, nama_kategori FROM kategori";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_aplikasi = $_POST['nama_aplikasi'] ?? '';
    $kategori_aplikasi = $_POST['kategori_aplikasi'] ?? '';
    $tahun_pembuatan = $_POST['tahun_pembuatan'] ?? '';
    $bahasa_pemrograman = $_POST['bahasa_pemrograman'] ?? '';
    $database = $_POST['database'] ?? '';
    $web_server = $_POST['web_server'] ?? '';
    $url = $_POST['url'] ?? '';
    $developer = $_POST['developer'] ?? '';
    $penanggung_jawab = $_POST['penanggung_jawab'] ?? '';
    $status_hidup_mati = $_POST['status_hidup_mati'] ?? '';

    // Handle file upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $gambarTmpPath = $_FILES['gambar']['tmp_name'];
        $gambarName = $_FILES['gambar']['name'];
        $gambarPath = 'uploads/' . $gambarName;

        if (move_uploaded_file($gambarTmpPath, $gambarPath)) {
            $query = "INSERT INTO produk (nama_aplikasi, kategori_aplikasi, tahun_pembuatan, bahasa_pemrograman, `database`, web_server, url, developer, penanggung_jawab, status_hidup_mati, gambar) 
                      VALUES ('$nama_aplikasi', '$kategori_aplikasi', '$tahun_pembuatan', '$bahasa_pemrograman', '$database', '$web_server', '$url', '$developer', '$penanggung_jawab', '$status_hidup_mati', '$gambarName')";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                $successMessage = "Produk berhasil ditambahkan!";
                header("Location: tambah_produk.php?message=" . urlencode($successMessage));
                exit();
            } else {
                $errorMessage = "Error menambahkan produk: " . mysqli_error($conn);
            }
        } else {
            $errorMessage = "Error mengupload gambar.";
        }
    } else {
        $errorMessage = "Gambar tidak valid.";
    }

    if ($errorMessage) {
        header("Location: tambah_produk.php?message=" . urlencode($errorMessage));
        exit();
    }
}

// Handle product deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $successMessage = "Produk berhasil dihapus!";
        header("Location: tambah_produk.php?message=" . urlencode($successMessage));
        exit();
    } else {
        $errorMessage = "Error menghapus produk: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #007bff;
            font-weight: 700;
        }

        .form-control {
            border-radius: 10px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.5rem 2rem;
            font-size: 1.1rem;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-label {
            font-weight: 500;
            font-size: 1.05rem;
        }

        .mb-3 {
            margin-bottom: 1.25rem;
        }

        .input-group {
            border-radius: 10px;
            overflow: hidden;
        }

        .input-group-text {
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Tambah Produk Baru</h2>
            <form action="tambah_produk.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_aplikasi" class="form-label">Nama Aplikasi</label>
                    <input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" required>
                </div>
                <div class="mb-3">
      
        <label for="kategori_aplikasi" class="form-label">Kategori Aplikasi</label>
                    <select class="form-control" name="kategori_aplikasi" id="kategori_aplikasi" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Kategori1">Keuangan</option>
                        <option value="Kategori2">Administrasi</option>
                        <option value="Kategori3">Pertahanan</option>
    </select>
</div>
<div class="mb-3">
                    <label for="tahun_pembuatan" class="form-label">jenis</label>
                    <input type="number" class="form-control" name="jenis" id="jenis" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                    <input type="text" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan" required>
                </div>
                <div class="mb-3">
                    <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                    <input type="text" class="form-control" name="bahasa_pemrograman" id="bahasa_pemrograman" required>
                </div>
                <div class="mb-3">
                    <label for="database" class="form-label">Database</label>
                    <input type="text" class="form-control" name="database" id="database" required>
                </div>
                <div class="mb-3">
                    <label for="web_server" class="form-label">Web Server</label>
                    <input type="text" class="form-control" name="web_server" id="web_server" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Alamat URL</label>
                    <input type="text" class="form-control" name="url" id="url" required>
                </div>
                <div class="mb-3">
                    <label for="developer" class="form-label">Developer</label>
                    <input type="text" class="form-control" name="developer" id="developer" required>
                </div>
                <div class="mb-3">
                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                    <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" required>
                </div>
                <div class="mb-3">
                    <label for="status_hidup_mati" class="form-label">Status Hidup/Mati</label>
                    <select class="form-control" name="status_hidup_mati" id="status_hidup_mati" required>
                        <option value="Hidup">Hidup</option>
                        <option value="Mati">Mati</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Produk</button>
                <br>
                
                <br>
                <a href="tambah_produk.php" class="btn btn-primary w-100">Batal</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>




 