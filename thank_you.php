<?php
session_start();
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .thank-you-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #f9f9f9;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .thank-you-container h1 {
            font-size: 2.5rem;
            color: #4CAF50;
        }

        .thank-you-container p {
            font-size: 1.2rem;
            color: #555;
        }

        .thank-you-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 1rem;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .thank-you-container a:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
<div class="thank-you-container">
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed. We'll notify you once it's processed.</p>
    <p>Have a great day!</p>
    
    
    <a href="index.php">Continue Shopping</a>
</div>
</body>
</html>

<?php include 'footer.php'; ?>
