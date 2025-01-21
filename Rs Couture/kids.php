<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch winter arrivals from the database
$winterQuery = "SELECT id, name, price, images FROM kids ORDER BY id DESC LIMIT 10";
$winterResult = $conn->query($winterQuery);
?>

 <?php include 'header.php'; ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Product Section */
.product-section {
    padding: 60px 20px;
    background: linear-gradient(120deg, #f9f9f9, #eaf4ff);
    align-items: center;
}

.product-section h2 {
    text-align: center;
    font-size: 2.8rem;
    margin-bottom: 30px;
    color: #222;
    font-family: 'Roboto', sans-serif;
    letter-spacing: 1px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    justify-content: center;
}

.product-card {
    background: #fff;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    position: relative;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%;
    height: auto;
    transition: transform 0.4s ease;
}

.product-card:hover img {
    transform: scale(1.05);
}

.product-card h3 {
    font-size: 1.4rem;
    margin: 20px 15px 10px;
    color: #444;
    font-family: 'Roboto', sans-serif;
}

.product-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #1a73e8;
    margin: 0 15px 20px;
    font-family: 'Poppins', sans-serif;
}

.view-details-button {
    display: block;
    margin: 0 15px 20px;
    padding: 12px 0;
    text-align: center;
    background: linear-gradient(120deg, #1a73e8, #0056b3);
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.view-details-button:hover {
    background: linear-gradient(120deg, #0056b3, #1a73e8);
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}
    </style>
</head>
<body>
    
<div class="winter-section">
        <h2>Kids Collection</h2>
        <div class="product-grid">
            <?php while ($product = $winterResult->fetch_assoc()): ?>
                <?php 
                    $images = explode(',', $product['images']);
                    $mainImage = $images[0]; // First image as main image
                ?>
                <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>&table=kids">
                        <img src="<?php echo $mainImage; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                        <h3><?php echo $product['name']; ?></h3>
                    </a>
                    <p class="product-price">৳ <?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>&table=kids" class="view-details-button">View Details</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>