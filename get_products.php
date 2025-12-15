<?php
session_start();
include "db.php";

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: add_user.php");
    exit;
}

include 'navbar.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Available Products - GreenCart</title>
    <link rel='stylesheet' href='style.css'>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='user-page'>";

echo "<div class='container'>";

// Fetch products (no farmer_id anymore)
$result = $conn->query("SELECT * FROM products");

if ($result->num_rows > 0) {
    echo "<div class='popular-products'>
            <h1 class='popular-title'>Available Products</h1>
            <div class='grid grid-cols-3 sm:grid-cols-3 md:grid-cols-2 gap-5'>";

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-card bg-white rounded-lg shadow-lg p-5 text-center'>
                    <p class='text-gray-500 text-sm'>Product ID: {$row['id']}</p>
                    <p class='rating'>⭐ 4.5</p>
                    <p class='font-bold text-lg'>{$row['name']}</p>
                    <p class='text-green-700 font-semibold'>\${$row['price']}</p>
                    <p class='text-sm'>Stock: {$row['stock']}</p>
                    <p class='text-sm mt-2'>{$row['description']}</p>
                </div>";
    }

    echo "</div></div>";
} else {
    echo "<p>No products available at the moment.</p>";
}

// Back button
echo "<a href='index.php' class='back-btn mt-5 inline-block'>⬅ Back</a>";
echo "</div>";

include 'footer.php';
echo "</body></html>";
?>
