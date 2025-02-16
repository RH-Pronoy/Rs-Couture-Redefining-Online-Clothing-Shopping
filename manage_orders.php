<?php
session_start();
include 'db_config.php';
include 'admin_header.php';

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: adminlogin.php');
    exit;
}

// Fetch all orders
$orderQuery = "SELECT * FROM orders ORDER BY order_date DESC";
$orders = $conn->query($orderQuery);

// Handle Order Status Update
if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    $updateQuery = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $orderId);

    if ($stmt->execute()) {
        $message = "Order status updated successfully.";
    } else {
        $message = "Error updating order status: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Order Deletion
if (isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id'];
    $deleteQuery = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $orderId);
    if ($stmt->execute()) {
        $message = "Order deleted successfully.";
    } else {
        $message = "Error deleting order.";
    }
    $stmt->close();
}
?>
<div class="container">
    <h1>Manage Orders</h1>

    <?php if (isset($message)): ?>
        <div class="alert <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <table class="order-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer ID</th>
                <th>Total Price</th>
                <th>Sub Total</th>
                <th>Delivery</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($orders->num_rows > 0): ?>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td>৳ <?php echo number_format($order['total_price'], 2); ?></td>
                        <td>৳ <?php echo number_format($order['subtotal'], 2); ?></td>
                        <td>৳ <?php echo number_format($order['delivery_cost'], 2); ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                        <td>
                            <!-- Update Status Form -->
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <select name="status">
                                    <option value="Pending" <?php echo $order['order_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Processing" <?php echo $order['order_status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                    <option value="Completed" <?php echo $order['order_status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Cancelled" <?php echo $order['order_status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                                <button type="submit" name="update_status" class="update-btn">Update</button>
                            </form>

                            <!-- Delete Order Form -->
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" name="delete_order" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Product Name</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch items for the current order
                                    $itemQuery = "SELECT * FROM order_items WHERE order_id = ?";
                                    $stmt = $conn->prepare($itemQuery);
                                    $stmt->bind_param("i", $order['order_id']);
                                    $stmt->execute();
                                    $itemsResult = $stmt->get_result();

                                    if ($itemsResult->num_rows > 0):
                                        while ($item = $itemsResult->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $item['id']; ?></td>
                                                <td><?php echo $item['product_name']; ?></td>
                                                <td><?php echo $item['size']; ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                                <td>৳ <?php echo number_format($item['price_per_product'], 2); ?></td>
                                            </tr>
                                        <?php endwhile;
                                    else: ?>
                                        <tr>
                                            <td colspan="5">No items found for this order.</td>
                                        </tr>
                                    <?php endif;
                                    $stmt->close();
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<style>
    .container {
        margin: 20px;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .alert {
        padding: 10px;
        margin-bottom: 15px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .update-btn,
    .delete-btn {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .update-btn:hover,
    .delete-btn:hover {
        background-color: #45a049;
    }

    .delete-btn {
        background-color: #f44336;
    }

    .delete-btn:hover {
        background-color: #d32f2f;
    }
</style>

</body>
</html>
