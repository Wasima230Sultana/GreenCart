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

$result = $conn->query("SELECT * FROM orders");

echo "<div class='container'>";
echo "<h2>Orders List</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' width='100%' cellpadding='8'>";
    echo "<tr>
            <th>ID</th>
            <th>Buyer</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Status</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
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

echo "<a href='index.html'>⬅ Back</a>";
echo "</div>";

// Include footer
include 'footer.php';

echo "</body></html>";
?>
