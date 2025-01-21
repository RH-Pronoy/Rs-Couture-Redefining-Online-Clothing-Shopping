<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch new arrivals from the database
$newArrivalsQuery = "SELECT id, name, price, images FROM new_arrivals ORDER BY id DESC LIMIT 10";
$newArrivalsResult = $conn->query($newArrivalsQuery);

// Fetch sale products from the database
$saleQuery = "SELECT id, name, price, images FROM sale ORDER BY id DESC LIMIT 10";
$saleResult = $conn->query($saleQuery);

// Fetch winter arrivals from the database
$winterQuery = "SELECT id, name, price, images FROM winter ORDER BY id DESC LIMIT 5";
$winterResult = $conn->query($winterQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
.banner {
    background: url('images/b.jpeg') no-repeat center center;
    background-size: cover;
    height: 100vh;
    margin: 0;
    padding: 0;
    position: relative;
}


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
    width: 80%;
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
    background: linear-gradient(120deg,rgb(28, 4, 166),rgb(168, 75, 234));
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.view-details-button:hover {
    background: linear-gradient(120deg,rgb(179, 0, 66),rgb(24, 83, 160));
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

/* Banner Section */
.banner2 {
    background-size: cover;
    background-position: center;
    height: 100vh; /* Full viewport height */
    display: flex;
    align-items: center; /* Vertically center content */
    justify-content: center; /* Horizontally center content */
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    position: relative;
    padding: 0 20px; /* Add padding for small screens */
}

.banner2 .banner-content {
    text-align: center;
    max-width: 600px; /* Limit content width for better readability */
}

.banner2 h1 {
    font-size: 3rem; /* Large title size */
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    letter-spacing: 1.5px;
}

.banner2 h2 {
    font-size: 2rem;
    margin-bottom: 15px;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
}

.banner2 p {
    font-size: 1.2rem;
    margin-bottom: 20px;
    font-family: 'Open Sans', sans-serif;
    line-height: 1.5;
}

.banner2 .shop-now {
    display: inline-block;
    padding: 12px 25px;
    background: linear-gradient(120deg, rgb(28, 4, 166), rgb(168, 75, 234));
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.banner2 .shop-now:hover {
    background: linear-gradient(120deg, rgb(179, 0, 66), rgb(24, 83, 160));
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>


     <!-- Banner Section -->
     <section class="banner"></section>

<br>
    <!-- Banner Section -->
    <section class="banner2" style="background-image: url('images/a-photo-of-a-warm-sweater-pile-on-a-pink_kApitV8wRnOlvEIIe2-Hlg_sIrCN3WeScCH9a7zvuxEcA.jpeg'); background-size: cover; background-position: center; color: #fff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
        <div class="banner-content">
            <h1>WINTER COLLECTION</h1>
            <h2>WINTER REVERIE</h2>
            <p>Embrace The Elegance Of Cold Season Layers</p>
            <a href="winter.php" class="shop-now">SHOP NOW</a>
        </div>
    </section>


 
    
    <!-- Product Section -->
    <div class="sale-section">
        <h2>New Arrivals</h2>
        <div class="product-grid">
            <?php while ($product = $newArrivalsResult->fetch_assoc()): ?>
                <?php 
                    $images = explode(',', $product['images']);
                    $mainImage = $images[0]; // First image as main image
                ?>
                <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>&table=new_arrivals">
               
                        <img src="<?php echo $mainImage; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                        <h3><?php echo $product['name']; ?></h3>
                    </a>
                    <p class="product-price">৳ <?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>&table=new_arrivals" class="view-details-button">View Details</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Sale Section -->
    <div class="winter-section">
        <h2>Sale</h2>
        <div class="product-grid">
            <?php while ($product = $saleResult->fetch_assoc()): ?>
                <?php 
                    $images = explode(',', $product['images']);
                    $mainImage = $images[0]; // First image as main image
                ?>
                <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>&table=sale">

                        <img src="<?php echo $mainImage; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                        <h3><?php echo $product['name']; ?></h3>
                    </a>
                    <p class="product-price">৳ <?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>&table=sale" class="view-details-button">View Details</a>


                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Winter Arrivals Section -->
    <div class="winter-section">
        <h2>Winter Arrivals</h2>
        <div class="product-grid">
            <?php while ($product = $winterResult->fetch_assoc()): ?>
                <?php 
                    $images = explode(',', $product['images']);
                    $mainImage = $images[0]; // First image as main image
                ?>
                <div class="product-card">
                <a href="product.php?id=<?php echo $product['id']; ?>&table=winter" >
                
                        <img src="<?php echo $mainImage; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                        <h3><?php echo $product['name']; ?></h3>
                    </a>
                    <p class="product-price">৳ <?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>&table=winter" class="view-details-button">View Details</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
