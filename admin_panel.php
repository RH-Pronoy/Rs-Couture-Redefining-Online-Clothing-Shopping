<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: adminlogin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></h1>
    <ul>
        <li><a href="manage_products.php">Manage Products</a></li>
        <li><a href="manage_orders.php">Manage Orders</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
