 <?php
include "db.php";


// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashed for security
    $role = $_POST['role'];


    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password','$role')";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<div class='container'>";
    if ($conn->query($sql)) {
        echo "<h2>✅ User Added Successfully</h2>";
    } else {
        echo "<h2>❌ Failed to Add User</h2>";
        echo "<p>Error: " . $conn->error . "</p>";
    }
    echo "<a href='index.html'>⬅ Back</a>";
    echo "</div>";
    exit;
}


// Show registration form
echo "<link rel='stylesheet' href='style.css'>";
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
?>


