<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'fashion_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate the table name to prevent SQL injection
$allowed_tables = ['new_arrivals', 'sale', 'winter', 'women', 'men', 'kids'];
$table = isset($_GET['table']) && in_array($_GET['table'], $allowed_tables) ? $_GET['table'] : null;

if (!$table) {
    echo "Invalid table specified.";
    exit;
}

// Fetch product details
$query = "SELECT * FROM $table WHERE id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit;
}

// Extract images
$images = explode(',', $product['images']);

// Handle Add to Cart functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $cart_item = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => intval($_POST['quantity']),
        'size' => $_POST['size']
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $cart_item;

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .product-detail-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-images {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .product-images img {
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .thumbnail-images img {
            cursor: pointer;
            max-width: 100px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h1 {
            margin: 0;
            font-size: 24px;
        }
        .product-info p {
            margin: 10px 0;
        }
        .product-info .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .product-info .add-to-cart:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="product-detail-container">
    <div class="product-images">
        <div class="main-image">
            <img id="mainImage" src="<?php echo $images[0]; ?>" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="thumbnail-images">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo $image; ?>" alt="<?php echo $product['name']; ?>" onclick="changeImage('<?php echo $image; ?>')">
            <?php endforeach; ?>
        </div>
    </div>
    <div class="product-info">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="price">৳ <?php echo number_format($product['price'], 2); ?> (Incl. VAT)</p>
        <p><strong>Color:</strong> <?php echo htmlspecialchars($product['color']); ?></p>

        <form method="POST">
            <!-- Sizes -->
            <!-- Size -->
    <p><strong>Size:</strong>
        <?php
        $sizes = ['S', 'M', 'L', 'XL', 'XXL']; // Hardcode all available sizes since it’s an ENUM in the DB
        foreach ($sizes as $size) {
            // Check if the size is available for the product (you can add more logic here if necessary)
            echo "<label><input type='radio' name='size' value='$size' required> $size</label> ";
        }
        ?>
    </p>

            <!-- Quantity -->
            <p><strong>Qty:</strong>
                <select name="quantity">
                    <?php for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    } ?>
                </select>
            </p>

            <!-- Add to Cart -->
            <button class="add-to-cart" name="add_to_cart">Add to Cart</button>
        </form>

        <p class="free-delivery">FREE DELIVERY on orders over ৳8000</p>
        <p>Product color may vary slightly depending on screen resolution.</p>

        <!-- Product Info -->
        <details>
            <summary>Product Info</summary>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        </details>
    </div>
</div>

<script>
    // Change main image on thumbnail click
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>

</body>
</html>

<?php include 'footer.php'; ?>
