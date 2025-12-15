<?php
include "db.php";

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>GreenCart Data Viewer</title>
    <link rel='stylesheet' href='style.css'>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-gray-100'>";

/* ===== NAVBAR (optional) ===== */
if (file_exists("navbar.php")) {
    include "navbar.php";
}

echo "<div class='container mx-auto p-6 bg-white mt-6 rounded shadow'>";
echo "<h2 class='text-3xl font-bold mb-6'>🌱 GreenCart Data Viewer</h2>";

/* ================= PRODUCTS ================= */
echo "<h3 class='text-2xl font-semibold mb-3'>📦 Products</h3>";

$product_sql = "SELECT * FROM products";
$product_result = $conn->query($product_sql);

if ($product_result->num_rows > 0) {
    echo "<table class='table-auto w-full border-collapse border border-gray-400 mb-8'>
            <tr class='bg-gray-200'>
                <th class='border px-4 py-2'>ID</th>
                <th class='border px-4 py-2'>Product</th>
                <th class='border px-4 py-2'>Price</th>
                <th class='border px-4 py-2'>Stock</th>
                <th class='border px-4 py-2'>Description</th>
            </tr>";

    while ($row = $product_result->fetch_assoc()) {
        echo "<tr>
                <td class='border px-4 py-2'>{$row['id']}</td>
                <td class='border px-4 py-2'>{$row['name']}</td>
                <td class='border px-4 py-2'>৳ {$row['price']}</td>
                <td class='border px-4 py-2'>{$row['stock']}</td>
                <td class='border px-4 py-2'>{$row['description']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

/* ================= UPDATE ORDER STATUS ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $_POST['status'], $_POST['order_id']);
    $stmt->execute();

    echo "<p class='text-green-700 font-semibold mb-4'>
            ✅ Order #{$_POST['order_id']} updated to {$_POST['status']}
          </p>";
}

/* ================= ORDERS ================= */
echo "<h3 class='text-2xl font-semibold mb-3'>🛒 Orders</h3>";

$order_sql = "
    SELECT o.*, b.name AS buyer_name, p.name AS product_name
    FROM orders o
    JOIN users b ON o.buyer_id = b.id
    JOIN products p ON o.product_id = p.id
";
$order_result = $conn->query($order_sql);

if ($order_result->num_rows > 0) {
    echo "<table class='table-auto w-full border-collapse border border-gray-400'>
            <tr class='bg-gray-200'>
                <th class='border px-4 py-2'>ID</th>
                <th class='border px-4 py-2'>Buyer</th>
                <th class='border px-4 py-2'>Product</th>
                <th class='border px-4 py-2'>Quantity</th>
                <th class='border px-4 py-2'>Status</th>
                <th class='border px-4 py-2'>Update</th>
            </tr>";

    while ($row = $order_result->fetch_assoc()) {
        echo "<tr>
                <td class='border px-4 py-2'>{$row['id']}</td>
                <td class='border px-4 py-2'>{$row['buyer_name']}</td>
                <td class='border px-4 py-2'>{$row['product_name']}</td>
                <td class='border px-4 py-2'>{$row['quantity']}</td>
                <td class='border px-4 py-2'>{$row['status']}</td>
                <td class='border px-4 py-2'>
                    <form method='POST' class='flex gap-2'>
                        <input type='hidden' name='order_id' value='{$row['id']}'>
                        <select name='status' class='border px-2 py-1'>
                            <option value='Ordered' ".($row['status']=='Ordered'?'selected':'').">Ordered</option>
                            <option value='Shipped' ".($row['status']=='Shipped'?'selected':'').">Shipped</option>
                            <option value='Delivered' ".($row['status']=='Delivered'?'selected':'').">Delivered</option>
                        </select>
                        <button class='bg-blue-500 text-white px-3 py-1 rounded'>Update</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

echo "<a href='index.php' class='inline-block mt-6 text-blue-600'>⬅ Back</a>";
echo "</div>";

/* ===== FOOTER (optional) ===== */
if (file_exists("footer.php")) {
    include "footer.php";
}

echo "</body></html>";
?>
