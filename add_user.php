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

// Show registration form
echo "<div class='container'>
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
