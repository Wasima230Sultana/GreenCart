<?php
include "db.php";
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='https://cdn.tailwindcss.com'></script>
    <title>Available Products - GreenCart</title>
        <link rel='stylesheet' href='style.css'>

</head>
<body class='user-page'>";

include 'navbar.php';

// ===== Banner HTML =====
echo '
<!-- banner starts here -->
<div class="pt-12   ">
    <div class="text-center">
        <h1 class=" font-bold text-[35px]">
            Freshness <span class="text-[#ccc]">You Can <br>Count</span> On, Prices You\'ll Love!
        </h1>
        <p class="text-center mx-auto">Shop your daily essentials at unbeatable prices. From fresh produce to pantry <br>staples, we\'ve got
            you covered every day!</p>
    </div>
    <div>
        <img src="assets/fruit-basket.png" class="w-[600px] block mx-auto" alt="">
    </div>
</div>
';

// If GET request, show the order form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo "<link rel='stylesheet' href='style.css'>";
    echo "<div class='container'>
            <h1>Place Order</h1>
            <form method='POST'>
                <input name='buyer_id' placeholder='Buyer ID' required>
                <input name='product_id' placeholder='Product ID' required>
                <input name='quantity' placeholder='Quantity' required>
            <button>Place Order</button>
                </form>
            <a href='get_orders.php'>⬅ Back</a>
          </div>";
    include 'footer.php';
    exit;
}

// Handle POST request
$data = $_POST ?: json_decode(file_get_contents("php://input"), true);

$buyer_id   = $data['buyer_id'];
$product_id = $data['product_id'];
$quantity   = $data['quantity'];

$sql = "INSERT INTO orders (buyer_id, product_id, quantity, status)
        VALUES ('$buyer_id', '$product_id', '$quantity', 'Ordered')";

echo "<div class='container'>";
if ($conn->query($sql)) {
    echo "<h2>✅ Order Placed Successfully</h2>";
} else {
    echo "<h2>❌ Order Failed</h2>";
}
echo "<a href='index.html'>⬅ Back</a>";
echo "</div>";

include 'footer.php';
echo "</body></html>";
?>
