<?php
session_start();
include_once 'config/init.php'; // Assuming config/init.php is needed here

// Include the consistent header
include_once 'header.php'; // Use the main header.php

$q = $_GET['q'] ?? '';
$q = trim($q);

if($q === '') {
    // Better to redirect or show a proper error page
    header("Location: error.php?msg=Please enter a search term.");
    exit;
}

$stmt = $conn->prepare("SELECT product_id, name, price, image_url FROM products WHERE name LIKE ? OR description LIKE ?");
$search = "%$q%";
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Search Results for "<?= htmlspecialchars($q) ?>" - Novelnest</title>
</head>
<body>

<?php // The main header is already included above. ?>

<div class="content-wrapper">
    <h2>Search results for "<?= htmlspecialchars($q) ?>"</h2>

    <?php if($result->num_rows > 0): ?>
    <div class="products-grid">
        <?php while($product = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-img">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>KES <?= number_format($product['price'],2) ?></p>
                <a class="btn" href="product.php?id=<?= $product['product_id'] ?>">View</a>
                <button class="add-btn" onclick="addToCart(<?= $product['product_id'] ?>)">Add to Cart</button>
            </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <p class="no-products-msg">No products found.</p>
    <?php endif; ?>
</div>

<?php include_once 'footer.php'; // Use the main footer.php ?>
</body>
</html>
