<?php
include "db.php";

// Start HTML
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Add User - GreenCart</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body class='user-page'>"; // Body class for background

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password','$role')";

    echo "<div class='container'>";
    if ($conn->query($sql)) {
        echo "<h2>✅ User Added Successfully</h2>";
    } else {
        echo "<h2>❌ Failed to Add User</h2>";
        echo "<p>Error: " . $conn->error . "</p>";
    }
    echo "<a href='index.html'>⬅ Back</a>";
    echo "</div>";

    // Include footer
    include 'footer.php';
    echo "</body></html>";
    exit;
}
include 'navbar.php';
// Show registration form
echo "


<div class='containerA'>
<div>
<img class='' src='assets/about.png' alt=''>
</div>
<div class='userP'>
<p>At GreenCart, we bring you the finest locally sourced organic products straight from trusted farmers to your doorstep. Our selection includes fresh vegetables, fruits, grains, and other natural products, all grown without harmful pesticides or chemicals.</p>
<p class=''>
100% Organic: Every product is certified and naturally grown.
<br>
</p>
<p>
Support Local Farmers: By buying from us, you empower small-scale farmers in your community.
<br>
</p>
<p>
Eco-Friendly: Sustainable farming practices that protect the environment.
<br>
</p>
<p>
Healthy Lifestyle: Organic products are packed with nutrients, free from synthetic additives.</p>
</div> 

</div>

<div class='container'>
        <h2>➕ Add User</h2>
        <form method='POST'>
            <input type='text' name='name' placeholder='Full Name' required>
            <input type='email' name='email' placeholder='Email' required>
            <input type='password' name='password' placeholder='Password' required>
            <select name='role' required>
                <option value='Farmer'>Farmer</option>
                <option value='Buyer'>Buyer</option>
            </select>
            <button type='submit'>Add User</button>
        </form>
        <a href='index.html'>⬅ Back</a>
      </div>";

// Include footer
include 'footer.php';

echo "</body></html>";
?>
