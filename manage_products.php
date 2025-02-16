<?php
session_start();
include 'db_config.php';
include 'admin_header.php';
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: adminlogin.php');
    exit;
}

// Helper function to get table-specific data
function getProducts($conn, $table) {
    $query = "SELECT * FROM $table";
    return $conn->query($query);
}

// Categories
$categories = ['sale', 'new_arrivals', 'winter', 'men', 'women', 'kids'];

// Handle product operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $table = $_POST['table'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $images = $_POST['images'];
        $color = $_POST['color'];
        $size = $_POST['sizes'];
        $stock = $_POST['stock'];
        $description = $_POST['Des'];
    
        $query = $conn->prepare("INSERT INTO $table (name, price, images, color, sizes, stock, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('sdsssis', $name, $price, $images, $color, $size, $stock, $description);
        $query->execute();
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $images = $_POST['images'];
        $color = $_POST['color'];
        $size = $_POST['sizes'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];

        $query = $conn->prepare("UPDATE $table SET name = ?, price = ?, images = ?, color = ?, sizes = ?, stock = ?, description = ? WHERE id = ?");
        $query->bind_param('sdsssisi', $name, $price, $images, $color, $size, $stock, $description, $id);
        $query->execute();
    } elseif ($action === 'delete') {
        $id = $_POST['id'];

        $query = $conn->prepare("DELETE FROM $table WHERE id = ?");
        $query->bind_param('i', $id);
        $query->execute();
    }

    header("Location: manage_products.php?table=$table");
    exit;
}

// Select table for current view
$currentTable = $_GET['table'] ?? 'sale';
$products = getProducts($conn, $currentTable);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Manage Products</h1>
    <nav>
        <?php foreach ($categories as $category): ?>
            <a href="manage_products.php?table=<?php echo $category; ?>" <?php if ($currentTable === $category) echo 'style="font-weight: bold;"'; ?>>
                <?php echo ucfirst(str_replace('_', ' ', $category)); ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <h2><?php echo ucfirst(str_replace('_', ' ', $currentTable)); ?> Products</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Color</th>
                <th>Size</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $products->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>৳ <?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($product['color']); ?></td>
                    <td><?php echo htmlspecialchars($product['sizes']); ?></td>
                    <td><?php echo htmlspecialchars($product['stock']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><?php echo htmlspecialchars($product['images']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="table" value="<?php echo $currentTable; ?>">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <button onclick="showEditForm(<?php echo htmlspecialchars(json_encode($product)); ?>)">Edit</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Add New Product</h3>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="table" value="<?php echo $currentTable; ?>">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="color" placeholder="Product Color" required>
        <input type="text" name="size" placeholder="Available Size" required>
        <input type="number" name="stock" placeholder="Available Stock" required>
        <input type="text" name="Des" placeholder="Product Description" required>
        <textarea name="images" placeholder="Image URLs, comma-separated" required></textarea>
        <button type="submit">Add Product</button>
    </form>

    <h3>Edit Product</h3>
    <form method="POST" id="editForm" style="display: none;">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="table" value="<?php echo $currentTable; ?>">
        <input type="hidden" name="id" id="editFormId">
        <input type="text" name="name" id="editFormName" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" id="editFormPrice" placeholder="Price" required>
        <input type="text" name="color" id="editFormColor" placeholder="Product Color" required>
        <input type="text" name="size" id="editFormSize" placeholder="Available Size" required>
        <input type="number" name="stock" id="editFormStock" placeholder="Available Stock" required>
        <input type="text" name="description" id="editFormDescription" placeholder="Product Description" required>
        <textarea name="images" id="editFormImages" placeholder="Image URLs, comma-separated" required></textarea>
        <button type="submit">Update Product</button>
    </form>

    <script>
        function showEditForm(product) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('editFormId').value = product.id;
            document.getElementById('editFormName').value = product.name;
            document.getElementById('editFormPrice').value = product.price;
            document.getElementById('editFormColor').value = product.color;
            document.getElementById('editFormSize').value = product.size;
            document.getElementById('editFormStock').value = product.stock;
            document.getElementById('editFormDescription').value = product.description;
            document.getElementById('editFormImages').value = product.images;
        }
    </script>
</body>
</html>
