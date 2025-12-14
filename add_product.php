<?php
include "db.php";

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <!-- Tailwind CDN -->
    <script src='https://cdn.tailwindcss.com'></script>

    <title>Add Product - GreenCart</title>
</head>
<body class='bg-gradient-to-r from-green-100 to-lime-100 min-h-screen user-page'>";

include 'navbar.php';

/* ===== SERVICES SECTION ===== */
echo "
<div class='w-[70%] mx-auto mt-20'>
    <h1 class='text-green-700 font-bold mb-10  text-4xl'>Services</h1>

    <div class='grid grid-cols-1 sm:grid-cols-3 gap-5'>
        <div class='mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center'>
            <img src='assets/support.png' class='mx-auto mb-4' alt=''>
            <h2 class='font-bold'>24/7 Services</h2>
            <p>We are available round the clock to support farmers and buyers anytime.
Our dedicated team ensures smooth service and quick assistance day and night.</p>
        </div>

        <div class='mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center'>
            <img src='assets/fast-delivery.png' class='mx-auto mb-4' alt=''>
            <h2 class='font-bold'>Fast Delivery</h2>
            <p>Fresh organic products are delivered quickly and safely to your doorstep.
We ensure timely delivery while maintaining quality and freshness.</p>
        </div>

        <div class='mt-5 bg-[#EFEBE3] rounded-xl shadow-lg p-5 text-center'>
            <img src='assets/healthy-100.png' class='mx-auto mb-4' alt=''>
            <h2 class='font-bold'>Healthy Products</h2>
            <p>All our products are organic, natural, and free from harmful chemicals.
Enjoy fresh, nutritious, and safe food for a healthier lifestyle.</p>
        </div>
    </div>
</div>
";


/* If opened directly, show form */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<div class='container'>
            <h1>➕ Add Product</h1>
            <form method='POST'>
                <input name='farmer_id' placeholder='Farmer ID' required>
                <input name='name' placeholder='Product Name' required>
                <input name='price' placeholder='Price' required>
                <input name='stock' placeholder='Stock' required>
                <textarea name='description' placeholder='Description'></textarea>
                <button>Add Product</button>
            </form>
            <a href='index.html'>⬅ Back</a>
          </div>";
          include 'footer.php';
    exit;
}

/* Handle POST (form or JSON) */
$data = $_POST ?: json_decode(file_get_contents("php://input"), true);


$farmer_id = $data['farmer_id'];
$name = $data['name'];
$price = $data['price'];
$stock = $data['stock'];
$description = $data['description'];


$sql = "INSERT INTO products (farmer_id,name,price,stock,description)
        VALUES ('$farmer_id','$name','$price','$stock','$description')";


echo "<link rel='stylesheet' href='style.css'>";
echo "<div class='container'>";


if ($conn->query($sql)) {
    echo "<h2>✅ Product Added Successfully</h2>";
} else {
    echo "<h2>❌ Error Adding Product</h2>";
}


echo "<a href='index.html'>⬅ Back</a>";
echo "</div>";

?>

   