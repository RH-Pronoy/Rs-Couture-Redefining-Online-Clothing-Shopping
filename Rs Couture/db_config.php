<?php
// db_config.php
$conn = new mysqli('localhost', 'root', '', 'fashion_store');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
