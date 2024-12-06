<?php
session_start();
include 'db_connect.php';

// Get the product ID from query parameter
$productId = intval($_GET['id']);

// Fetch product details
$query = "SELECT * FROM produk WHERE id = $productId";
$result = mysqli_query($conn, $query);

if ($result) {
    $product = mysqli_fetch_assoc($result);
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}
?>
