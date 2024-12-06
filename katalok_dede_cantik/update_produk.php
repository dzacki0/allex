<?php
session_start();
include 'db_connect.php';

// Initialize message variables
$successMessage = "";
$errorMessage = "";


// Get product ID from URL parameter
$id = intval($_GET['id'] ?? 0);

// Fetch the product details
$product = null;
if ($id) {
    $query = "SELECT * FROM produk WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        $errorMessage = "Produk tidak ditemukan.";
    }
    $query = "SELECT idkategori, nama_kategori FROM kategori";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
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
    $gambarName = $product['gambar']; // Default to existing image
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $gambarTmpPath = $_FILES['gambar']['tmp_name'];
        $gambarName = $_FILES['gambar']['name'];
        $gambarPath = 'uploads/' . $gambarName;

        // Move the uploaded file to the 'uploads' directory
        if (move_uploaded_file($gambarTmpPath, $gambarPath)) {
            // Delete old image if exists
            if (file_exists('uploads/' . $product['gambar']) && $product['gambar']) {
                unlink('uploads/' . $product['gambar']);
            }
        } else {
            $errorMessage = "Error mengupload gambar.";
        }
    }

    if (!$errorMessage) {
        // Update database record
        $query = "UPDATE produk SET nama_aplikasi='$nama_aplikasi', kategori_aplikasi='$kategori_aplikasi', tahun_pembuatan='$tahun_pembuatan', bahasa_pemrograman='$bahasa_pemrograman', `database`='$database', web_server='$web_server', url='$url', developer='$developer', penanggung_jawab='$penanggung_jawab', status_hidup_mati='$status_hidup_mati', gambar='$gambarName' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $successMessage = "Produk berhasil diperbarui!";
            // Redirect to the add product page with a success message
            header("Location: tambah_produk.php?message=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "Error memperbarui produk: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2>Edit Produk</h2>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <form action="update_produk.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_aplikasi" class="form-label">Nama Aplikasi</label>
                    <input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" value="<?php echo htmlspecialchars($product['nama_aplikasi'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
        <label for="kategori_aplikasi" class="form-label">Kategori Aplikasi</label>
                    <select class="form-control" name="kategori_aplikasi" id="kategori_aplikasi" required>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Administrasi">Administrasi</option>
                        <option value="Pertahanan">Pertahanan</option>
    </select>
</div>
                <div class="mb-3">
                    <label for="tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                    <input type="number" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan" value="<?php echo htmlspecialchars($product['tahun_pembuatan'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                    <input type="text" class="form-control" name="bahasa_pemrograman" id="bahasa_pemrograman" value="<?php echo htmlspecialchars($product['bahasa_pemrograman'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="database" class="form-label">Database</label>
                    <input type="text" class="form-control" name="database" id="database" value="<?php echo htmlspecialchars($product['database'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="web_server" class="form-label">Web Server</label>
                    <input type="text" class="form-control" name="web_server" id="web_server" value="<?php echo htmlspecialchars($product['web_server'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Alamat URL</label>
                    <input type="text" class="form-control" name="url" id="url" value="<?php echo htmlspecialchars($product['url'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="developer" class="form-label">Developer</label>
                    <input type="text" class="form-control" name="developer" id="developer" value="<?php echo htmlspecialchars($product['developer'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                    <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" value="<?php echo htmlspecialchars($product['penanggung_jawab'] ?? '', ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status_hidup_mati" class="form-label">Status Hidup/Mati</label>
                    <select class="form-control" name="status_hidup_mati" id="status_hidup_mati" required>
                        <option value="Hidup" <?php echo ($product['status_hidup_mati'] == 'Hidup') ? 'selected' : ''; ?>>Hidup</option>
                        <option value="Mati" <?php echo ($product['status_hidup_mati'] == 'Mati') ? 'selected' : ''; ?>>Mati</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (kosongkan jika tidak diubah)</label>
                    <input type="file" class="form-control" name="gambar" id="gambar">
                    <?php if ($product['gambar']): ?>
                        <img src="uploads/<?php echo $product['gambar']; ?>" alt="Gambar Produk" style="width: 100px; margin-top: 10px;">
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Produk</button>
            </form>
        </div>

        <!-- Display success or error message -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success mt-3">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Display success or error message using SweetAlert2
        
    </script>
    <a href="tambah_produk.php" class="btn btn-primary w-100">Kembali</a>
</body>
</html>
