<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1️⃣ Check if email exists
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows === 0) {
        $error = "❌ This email is not registered. Please sign up first.";
    } else {
        $user = $result->fetch_assoc();

        // 2️⃣ Verify password
        if (password_verify($password, $user['password'])) {
            // 3️⃣ Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // 4️⃣ Redirect based on role
            if ($user['role'] === 'Farmer') {
                header("Location: farmer_dashboard.php");
                exit;
            } else {
                header("Location: get_products.php");
                exit;
            }
        } else {
            $error = "❌ Incorrect password. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GreenCart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="user-page">
 <div class="navbar">
        <div class="nav-left">
            <a href="index.php" class="brand">🌱 GreenCart</a>
        </div>
        <div class="nav-right-btn">
            <button>
                <a href="logout.php">Logout</a>
            </button>
        </div>
    </div>
<div class="container">
    <h1>👤 Login</h1>

    <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="add_user.php">Sign up here</a></p>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
