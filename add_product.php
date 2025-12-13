<?php
include "db.php";


/* If opened directly, show form */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<div class='container'>
            <h2>Add Product</h2>
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


