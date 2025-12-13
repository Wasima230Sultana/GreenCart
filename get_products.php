 <?php
include "db.php";


$result = $conn->query("SELECT * FROM products");


echo "<link rel='stylesheet' href='style.css'>";
echo "<div class='container'>";
echo "<h2>Available Products</h2>";


if ($result->num_rows > 0) {
    echo "<table border='1' width='100%' cellpadding='8'>";
    echo "<tr>
            <th>ID</th>
            <th>Farmer</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
          </tr>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['farmer_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['stock']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}


echo "<a href='index.html'>⬅ Back</a>";
echo "</div>";
?>


