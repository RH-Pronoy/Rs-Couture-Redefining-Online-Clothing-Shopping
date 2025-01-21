<?php
session_start();
include 'header.php';
$conn = new mysqli('localhost', 'root', '', 'fashion_store');

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch current user details, including address
$stmt = $conn->prepare("SELECT username, email, user_address FROM users WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$errors = [];

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']); // Handle the address field

    if (!empty($username) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($address)) {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, user_address = ? WHERE user_id = ?");
        $stmt->bind_param('sssi', $username, $email, $address, $user_id);
        if ($stmt->execute()) {
            $_SESSION['username'] = $username; // Update session username
            header("Location: profile.php");
            exit;
        } else {
            $errors[] = 'Failed to update profile. Please try again.';
        }
    } else {
        $errors[] = 'Invalid input. All fields are required, and the email must be valid.';
    }
}

// Handle cancel order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];
    $update_status = $conn->prepare("UPDATE orders SET order_status = 'Cancelled' WHERE order_id = ? AND user_id = ?");
    $update_status->bind_param('ii', $order_id, $user_id);
    $update_status->execute();

    header("Location: profile.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
              body {
            background: linear-gradient(120deg, #f0f4f8, #d9e2ec);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-form label {
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
        }

        .profile-form input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 4px #4CAF50;
        }

        .profile-form button {
            padding: 10px 15px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .profile-form button:hover {
            background-color: #45a049;
        }

        .logout {
            margin-top: 20px;
        }

        .logout a {
            text-decoration: none;
            color: white;
            background-color: #ff4c4c;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .logout a:hover {
            background-color: #e03e3e;
        }

        .errors {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .order-history ul {
            text-align: left;
            padding: 0;
            list-style-type: none;
        }

        .order-history ul li {
            background: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .order-history li .order-items {
            margin-top: 10px;
            padding-left: 20px;
            border-top: 1px solid #ddd;
        }

        .order-history li .order-items p {
            margin: 5px 0;
        }

        .cancel-order {
            background-color: red;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        .cancel-order:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    
    <?php if ($errors): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="profile-form">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['user_address']); ?>" required>

        <button type="submit" name="update">Update Profile</button>
    </form>

    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>

    <div class="order-history">
        <h3>Your Order History</h3>
        <?php
        // Fetch user orders
        $order_query = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
        $order_query->bind_param('i', $user_id);
        $order_query->execute();
        $orders = $order_query->get_result();

        if ($orders->num_rows > 0): ?>
            <ul>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <li>
                        <strong>Order #<?php echo htmlspecialchars($order['order_id']); ?>:</strong>
                        ৳<?php echo number_format($order['total_price'], 2); ?>
                        <br>
                        <small>Status: <?php echo htmlspecialchars($order['order_status']); ?></small>
                        <br>
                        <small>Date: <?php echo htmlspecialchars($order['order_date']); ?></small>

                        <div class="order-items">
                            <?php
                            $order_items = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
                            $order_items->bind_param('i', $order['order_id']);
                            $order_items->execute();
                            $items = $order_items->get_result();
                            while ($item = $items->fetch_assoc()): ?>
                                <p><?php echo htmlspecialchars($item['product_name']); ?> (<?php echo htmlspecialchars($item['size']); ?>) - ৳<?php echo number_format($item['price_per_product'], 2); ?> x <?php echo $item['quantity']; ?></p>
                            <?php endwhile; ?>
                        </div>

                        <?php if ($order['order_status'] != 'Cancelled'): ?>
                            <form method="POST" action="profile.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" name="cancel_order" class="cancel-order">Cancel Order</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>You haven't placed any orders yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
