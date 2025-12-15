<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: add_user.php");
    exit;
}

// Get user info
$name = $_SESSION['name'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenCart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Background image -->
    <img class="bg" src="assets/hero-img.png" alt="Background">

    <!-- Navbar -->
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

    <!-- Main container -->
    <div class="container">
        <h1>🌱 Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p class="local">Local Organic Product Marketplace</p>

        <!-- Links / menu -->
        <?php if($role === 'Farmer'): ?>
            <a href="farmer_dashboard.php">➕ Add / Manage Products</a>
            <a href="view_data.php">🔧 View All Data</a>
        <?php elseif($role === 'Buyer'): ?>
            <a href="get_products.php">📦 View Products</a>
            <a href="place_order.php">🛒 Place Order</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="fh">
            <img src="assets/healthy-100.png" alt="Healthy">
            <p class="fp">GreenCart Project • Web Development</p>
        </div>

        <div class="fm">
            <p>🌱 Copyright ©
                <span id="year"></span> - All rights reserved by GreenCart Industries Ltd
            </p>

            <div class="social">
                <img src="assets/facebook.png" alt="Facebook">
                <img src="assets/linkedin.png" alt="LinkedIn">
                <a class="ai" href="https://github.com/Wasima230Sultana/GreenCart">
                    <img src="assets/github.png" alt="GitHub">
                </a>
                <img src="assets/html-icon.png" alt="HTML">
                <img src="assets/css-icon.png" alt="CSS">
            </div>
        </div>
    </div>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
