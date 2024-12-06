<?php
session_start();
include 'db_connect.php';

// Initialize message variables
$successMessage = "";
$errorMessage = "";

// Handle delete request
$id = $_GET['id'] ?? '';
if ($id) {
    // Fetch product to get the image name
    $productQuery = "SELECT gambar FROM produk WHERE id='$id'";
    $productResult = mysqli_query($conn, $productQuery);
    $product = mysqli_fetch_assoc($productResult);

    if ($product) {
        // Delete the product
        $query = "DELETE FROM produk WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Remove the image from the uploads directory
            $imagePath = 'uploads/' . $product['gambar'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $successMessage = "Produk berhasil dihapus!";
        } else {
            $errorMessage = "Error menghapus produk: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Produk tidak ditemukan.";
    }
}

// Redirect to the products list page after deletion
header('Location:tambah_produk.php'); // Adjust the redirection as needed
exit();
?>
