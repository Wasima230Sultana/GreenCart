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

echo "<div class='container'>";
echo "<h2>🌱 GreenCart Data Viewer</h2>";

/* ================= PRODUCTS TABLE ================= */
echo "<h3>📦 Products</h3>";
$product_result = $conn->query("SELECT * FROM products");

if ($product_result->num_rows > 0) {
    echo "<table border='1' width='100%' cellpadding='8'>
            <tr>
                <th>ID</th>
                <th>Farmer ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Description</th>
            </tr>";

    while ($row = $product_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['farmer_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['stock']}</td>
                <td>{$row['description']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

/* ================= ORDERS TABLE ================= */
echo "<h3>🛒 Orders</h3>";
$order_result = $conn->query("SELECT * FROM orders");

if ($order_result->num_rows > 0) {
    echo "<table border='1' width='100%' cellpadding='8'>
            <tr>
                <th>ID</th>
                <th>Buyer ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>";

    while ($row = $order_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['buyer_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

echo "<a href='index.php'>⬅ Back</a>";
echo "</div>";

include 'footer.php';

echo "</body></html>";
?>
