<?php
session_start();
include "db.php";

/* TEMP SESSION (REMOVE IN PRODUCTION) */
$_SESSION['farmer_id'] = 1; // example farmer id
$farmer_id = $_SESSION['farmer_id'];

/* ===== HANDLE ADD PRODUCT ===== */
if (isset($_POST['add_product'])) {
    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $stock       = $_POST['stock'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (farmer_id,name,price,stock,description)
            VALUES ('$farmer_id','$name','$price','$stock','$description')";
    $conn->query($sql);
}

/* ===== HANDLE UPDATE PRODUCT ===== */
if (isset($_POST['update_product'])) {
    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $stock       = $_POST['stock'];
    $description = $_POST['description'];

    $conn->query("UPDATE products SET name='$name', price='$price', stock='$stock', description='$description' WHERE id='$id' AND farmer_id='$farmer_id'");
}

/* ===== HANDLE DELETE PRODUCT ===== */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id='$id' AND farmer_id='$farmer_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard - GreenCart</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="user-page">

<?php include 'navbar.php'; ?>

<!-- ===== SERVICES SECTION ===== -->
<div class="w-[70%] mx-auto mt-20">
    <h1 class="text-green-700 font-bold mb-10 text-4xl text-center">Services</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center">
            <img src="assets/support.png" class="mx-auto mb-4" alt="24/7 Support">
            <h2 class="font-bold text-lg">24/7 Services</h2>
            <p>We are available round the clock to support farmers and buyers anytime. Our dedicated team ensures smooth service and quick assistance day and night.</p>
        </div>

        <div class="mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center">
            <img src="assets/fast-delivery.png" class="mx-auto mb-4" alt="Fast Delivery">
            <h2 class="font-bold text-lg">Fast Delivery</h2>
            <p>Fresh organic products are delivered quickly and safely to your doorstep. We ensure timely delivery while maintaining quality and freshness.</p>
        </div>

        <div class="mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center">
            <img src="assets/healthy-100.png" class="mx-auto mb-4" alt="Healthy Products">
            <h2 class="font-bold text-lg">Healthy Products</h2>
            <p>All our products are organic, natural, and free from harmful chemicals. Enjoy fresh, nutritious, and safe food for a healthier lifestyle.</p>
        </div>
    </div>
</div>

<!-- ===== ADD PRODUCT FORM ===== -->
<div class="container mt-10 bg-white p-6 rounded-lg shadow-lg">
     <h1 class="text-green-700 text-4xl font-bold mb-5">🌱 Farmer Dashboard</h1>
    <h2 class="text-green-700 text-2xl font-bold mb-5">➕ Add Product</h2>
    <form method="POST" class="space-y-4">
        <input name="name" placeholder="Product Name" required class="w-full p-2 border rounded">
        <input name="price" placeholder="Price" required class="w-full p-2 border rounded">
        <input name="stock" placeholder="Stock Quantity" required class="w-full p-2 border rounded">
        <textarea name="description" placeholder="Description" class="w-full p-2 border rounded"></textarea>
        <button name="add_product" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Add Product</button>
    </form>
</div>

<!-- ===== PRODUCT LIST ===== -->
<div class="container mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-green-700 text-2xl font-bold mb-5">📦 My Products</h2>

    <?php
    $result = $conn->query("SELECT * FROM products WHERE farmer_id='$farmer_id'");
    if ($result->num_rows > 0) {
        echo '<table class="w-full border-collapse text-center">
                <tr class="bg-green-700 text-white">
                    <th class="p-2">ID</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Stock</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Actions</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <form method='POST'>
                    <td class='p-2'>{$row['id']}</td>
                    <td class='p-2'><input name='name' value='{$row['name']}' class='w-full p-1 border rounded'></td>
                    <td class='p-2'><input name='price' value='{$row['price']}' class='w-full p-1 border rounded'></td>
                    <td class='p-2'><input name='stock' value='{$row['stock']}' class='w-full p-1 border rounded'></td>
                    <td class='p-2'><input name='description' value='{$row['description']}' class='w-full p-1 border rounded'></td>
                    <td class='p-2'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='update_product' class='bg-green-700 text-white px-2 py-1 rounded hover:bg-green-800 mb-1'>Update</button>
                        <a href='?delete={$row['id']}' onclick='return confirm(\"Delete this product?\")'>
                            <button type='button' class='bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700'>Delete</button>
                        </a>
                    </td>
                </form>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products added yet.</p>";
    }
    ?>
</div>

<br>
<a href="index.php" class="inline-block ml-10 mt-4 text-green-700 font-bold">⬅ Back</a>

<?php include 'footer.php'; ?>
</body>
</html>
