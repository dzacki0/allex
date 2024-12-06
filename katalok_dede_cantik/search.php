<?php
// Include the database connection
include 'db_connect.php';

// Get the search term
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch products matching the search term
$query = "SELECT * FROM produk WHERE nama_aplikasi LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Output the product card HTML
        echo '<div class="col-md-4">
                <div class="product-card mb-4">
                    <img src="uploads/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama_aplikasi']) . '" class="img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($row['nama_aplikasi']) . '</h5>
                        <p class="card-text"><strong>Kategori:</strong> ' . htmlspecialchars($row['kategori_aplikasi']) . '</p>
                    </div>
                </div>
              </div>';
    }
} else {
    echo '<p class="text-center">Tidak ada aplikasi yang ditemukan.</p>';
}
?>
