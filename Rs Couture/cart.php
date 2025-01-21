<?php
session_start();
include 'header.php';
$conn = new mysqli('localhost', 'root', '', 'fashion_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle item removal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $item_id = intval($_POST['item_id']);
    echo "<pre>Item ID to be removed: $item_id</pre>"; // Debugging line to ensure ID is being passed
    
    // Loop through the cart to find and remove the item
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] === $item_id) {
            echo "<pre>Removing item with ID: $item_id</pre>"; // Debugging line to see if the item is identified correctly
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    
    // Re-index the cart array to remove any gaps in the array indexing
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    
    // Check if the item was removed and the session updated correctly
    echo "<pre>Updated cart session: " . print_r($_SESSION['cart'], true) . "</pre>"; // Debugging line to see if the cart is updated

    // Redirect back to cart page
    header("Location: cart.php");
    exit;
}

// Checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (empty($_SESSION['cart'])) {
        echo "<script>alert('Cart is empty. Add items before checking out.');</script>";
        header("Location: cart.php");
        exit;
    }

    // Calculate order subtotal
    $order_subtotal = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $_SESSION['cart']));
    
    // Delivery cost logic
    $delivery_cost = isset($_POST['delivery_option']) ? $_POST['delivery_option'] : 0;
    
    // Calculate total order price
    $order_total = $order_subtotal + $delivery_cost;

    // Insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, subtotal, delivery_cost, order_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param('iddd', $_SESSION['user_id'], $order_total, $order_subtotal, $delivery_cost);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert items into 'order_items' table
    $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, size, quantity, price_per_product, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $item_total_price = $item['price'] * $item['quantity'];
        $item_stmt->bind_param('iissidd', $order_id, $item['id'], $item['name'], $item['size'], $item['quantity'], $item['price'], $item_total_price);
        $item_stmt->execute();
    }

    $_SESSION['last_order'] = [
        'items' => $_SESSION['cart'],
        'total' => $order_total
    ];

    $_SESSION['cart'] = []; // Empty cart after order
    header("Location: thank_you.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            font-family: Arial, sans-serif;
        }
        .cart-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
        }
        .checkout-button {
            margin-top: 20px;
            text-align: center;
        }
        .checkout-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .checkout-button button:hover {
            background-color: #45a049;
        }
        .empty-message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }
        .remove-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }
        .remove-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
<div class="cart-container">
        <h2>Your Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="empty-message">Your cart is empty. <a href="shop.php">Shop now</a></p>
        <?php else: ?>
            <form method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars($item['size']); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>৳ <?php echo number_format($item['price'], 2); ?></td>
                                <td>৳ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="remove-button" name="remove_item">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div>
                    <label for="delivery_option">Choose delivery option:</label><br>
                    <label>
                        <input type="radio" name="delivery_option" value="50" checked> Pickup (50৳)
                    </label><br>
                    <label>
                        <input type="radio" name="delivery_option" value="100"> Home Delivery (100৳)
                    </label>
                </div>
                
                <div class="checkout-button">
                    <button type="submit" name="checkout">Proceed to Checkout</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
