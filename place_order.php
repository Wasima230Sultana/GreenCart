<?php
session_start();
include "db.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: add_user.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];

include 'navbar.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Place Order - GreenCart</title>
    <link rel='stylesheet' href='style.css'>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='user-page'>";

// ===== Banner / Image Section =====
echo '
<div class="pt-12 text-center">
    <h1 class="font-bold text-[35px] mb-4">
        Freshness <span class="text-[#ccc]">You Can <br>Count</span> On, Prices You\'ll Love!
    </h1>
    <p class="text-center mx-auto mb-6">
        Shop your daily essentials at unbeatable prices. From fresh produce to pantry staples, we\'ve got you covered every day!
    </p>
    <img src="assets/fruit-basket.png" class="w-[600px] block mx-auto" alt="Fruit Basket">
</div>';

// ===== Place Order Section =====
echo "<div class='container mt-10'>
      <h1 class='text-3xl font-bold mb-5'>📦 Place Your Order</h1>";

// Handle POST (placing order)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    // Get current stock
    $product_result = $conn->query("SELECT name, stock FROM products WHERE id='$product_id'");
    if ($product_result->num_rows == 0) {
        echo "<p class='text-red-600'>❌ Product not found.</p>";
    } else {
        $product = $product_result->fetch_assoc();
        if ($product['stock'] >= $quantity) {
            // Insert order
            $sql = "INSERT INTO orders (buyer_id, product_id, quantity, status)
                    VALUES ('$buyer_id', '$product_id', '$quantity', 'Ordered')";
            if ($conn->query($sql)) {
                // Update product stock
                $new_stock = $product['stock'] - $quantity;
                $conn->query("UPDATE products SET stock='$new_stock' WHERE id='$product_id'");
                echo "<p class='text-green-700 font-bold'>✅ Order placed successfully for {$quantity} x {$product['name']}!</p>";
                echo "<p>Remaining stock: {$new_stock}</p>";
            } else {
                echo "<p class='text-red-600'>❌ Failed to place order. Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='text-red-600'>❌ Not enough stock! Available: {$product['stock']}</p>";
        }
    }
    echo "<a href='place_order.php' class='back-btn mt-5 inline-block'>⬅ Back</a>";
}

// Display products for order
echo "<h2 class='text-2xl font-bold mt-10 mb-4'>Available Products</h2>
      <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5'>";

$result = $conn->query("SELECT * FROM products");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-card bg-white rounded-lg shadow-lg p-5 text-center'>
                <p class='text-gray-500 text-sm'>Product ID: {$row['id']}</p>
                <p class='font-bold text-lg'>{$row['name']}</p>
                <p class='text-green-700 font-semibold'>\${$row['price']}</p>
                <p class='text-sm'>Stock: {$row['stock']}</p>
                <p class='text-sm mt-2'>{$row['description']}</p>";

        if ($row['stock'] > 0) {
            echo "<form method='POST' class='mt-3'>
                    <input type='hidden' name='product_id' value='{$row['id']}'>
                    <input type='number' name='quantity' min='1' max='{$row['stock']}' placeholder='Quantity' required class='border rounded p-1 w-full mb-2'>
                    <button type='submit' class='bg-green-700 text-white px-3 py-1 rounded w-full'>Order</button>
                  </form>";
        } else {
            echo "<p class='text-red-600 mt-2 font-bold'>Out of Stock</p>";
        }

        echo "</div>";
    }
} else {
    echo "<p>No products available at the moment.</p>";
}

echo "</div>"; // end grid
echo "</div>"; // end container

include 'footer.php';
echo "</body></html>";
?>
