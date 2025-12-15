<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Insert new user
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password','$role')";

    if ($conn->query($sql)) {
        // Auto-login the new user
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;

        // Redirect based on role
        if ($role === 'Farmer') {
            header("Location: farmer_dashboard.php");
            exit;
        } elseif ($role === 'Buyer') {
            header("Location: get_products.php");
            exit;
        }
    } else {
        $error = "❌ Failed to add user: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - GreenCart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="user-page">
 <div class="navbar">
    <div class="nav-left">
        <a  class="brand">🌱 GreenCart</a>
    </div>
    <div class="nav-right-btn">
        <button class="">
            <a href="login.php">Log in</a>
        </button>
        
    </div>
</div>
<!-- ===== INTRO / IMAGE SECTION ===== -->
<div class="containerA" style="display:flex; gap:20px; align-items:center; margin-top:40px;">
    <div>
        <img src="assets/about.png" alt="About GreenCart" style=" max-width:100%; border-radius:12px;">
    </div>
    <div class="userP" style="font-size:18px;">
        <p>At GreenCart, we bring you the finest locally sourced organic products straight from trusted farmers to your doorstep. Our selection includes fresh vegetables, fruits, grains, and other natural products, all grown without harmful pesticides or chemicals.</p>
        <p>✅ <strong>100% Organic:</strong> Every product is certified and naturally grown.</p>
        <p>✅ <strong>Support Local Farmers:</strong> Empower small-scale farmers in your community.</p>
        <p>✅ <strong>Eco-Friendly:</strong> Sustainable farming practices that protect the environment.</p>
        <p>✅ <strong>Healthy Lifestyle:</strong> Organic products are packed with nutrients, free from synthetic additives.</p>
    </div>
</div>

<!-- ===== ADD USER FORM ===== -->
<div class="container" style="margin-top:40px;">
    <h1>👤 Add User</h1>

    <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="Farmer">Farmer</option>
            <option value="Buyer">Buyer</option>
        </select>
        <button type="submit">Add User & Login</button>
    </form>

    <a href="login.php">⬅ Back</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
