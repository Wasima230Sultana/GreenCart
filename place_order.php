<?php
include "db.php";


/* If opened directly, show simple HTML form for testing */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<div class='container'>
            <h2>Place Order</h2>
            <form method='POST'>
                <input name='buyer_id' placeholder='Buyer ID' required>
                <input name='product_id' placeholder='Product ID' required>
                <input name='quantity' placeholder='Quantity' required>
                <button>Place Order</button>
            </form>
            <a href='index.html'>⬅ Back</a>
          </div>";
    exit;
}


/* Handle POST (from form or JSON fetch) */
$data = $_POST ?: json_decode(file_get_contents("php://input"), true);


$buyer_id = $data['buyer_id'];
$product_id = $data['product_id'];
$quantity = $data['quantity'];


$sql = "INSERT INTO orders (buyer_id, product_id, quantity, status)
        VALUES ('$buyer_id', '$product_id', '$quantity', 'Ordered')";


echo "<link rel='stylesheet' href='style.css'>";
echo "<div class='container'>";


if ($conn->query($sql)) {
    echo "<h2>✅ Order Placed Successfully</h2>";
} else {
    echo "<h2>❌ Order Failed</h2>";
}


echo "<a href='index.html'>⬅ Back</a>";
echo "</div>";
?>


