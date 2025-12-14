<?php
include "db.php";
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Available Products - GreenCart</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body class='user-page'>";

include 'navbar.php';

$result = $conn->query("SELECT * FROM products");

echo "<div class='container'>";

// Popular Products section
echo <<<HTML
<div class="popular-products">
    <h1 class="popular-title">Popular Products</h1>
    <div class="products-grid">
        <div class="product-card">
            <img src="assets/product-onion.png" alt="Onion">
            <div class="product-info">
                <p class="rating">⭐ 4.5</p>
                <p>Onion 1 KG</p>
                <p>$39.99</p>
            </div>
        </div>
        <div class="product-card">
            <img src="assets/product-tomato.png" alt="Tomato">
            <div class="product-info">
                <p class="rating">⭐ 4.5</p>
                <p>Tomato 1 KG</p>
                <p>$40.00</p>
            </div>
        </div>
        <div class="product-card">
            <img src="assets/product-potato.png" alt="Potato">
            <div class="product-info">
                <p class="rating">⭐ 4.5</p>
                <p>Potato 1 KG</p>
                <p>$50.00</p>
            </div>
        </div>
        <div class="product-card">
            <img src="assets/product-tomato.png" alt="Tomato">
            <div class="product-info">
                <p class="rating">⭐ 4.5</p>
                <p>Tomato 1 KG</p>
                <p>$40.00</p>
            </div>
        </div>
    </div>
</div>
HTML;

// Table of products from database
if ($result->num_rows > 0) {
    echo "<table class='product-table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Farmer</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['farmer_id']}</td>
                <td>{$row['name']}</td>
                <td>\${$row['price']}</td>
                <td>{$row['stock']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No products found.</p>";
}

echo "<a href='index.html' class='back-btn'>⬅ Back</a>";
echo "</div>";

include 'footer.php';
echo "</body></html>";
?>
