<?php
$conn = new mysqli("localhost", "root", "", "greencart", 3307);


if ($conn->connect_error) {
    die("Database Connection Failed");
}
?>


