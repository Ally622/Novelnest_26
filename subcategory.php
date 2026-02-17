<?php
session_start();
include_once 'config/init.php'; // Assuming config/init.php is needed here

// Include the consistent header
include_once 'header.php'; // Use the main header.php

$subcategory_id = (int)($_GET['id'] ?? 0);
if ($subcategory_id <= 0) {
    // Better to redirect or show a proper error page
    header("Location: error.php?msg=Invalid subcategory ID");
    exit;
}

// Fetch subcategory name and parent category
$stmt = $conn->prepare("
    SELECT s.subcategory_name, c.category_name
    FROM subcategories s
    JOIN categories c ON s.category_id = c.category_id
    WHERE s.subcategory_id = ?
");
$stmt->bind_param("i", $subcategory_id);
$stmt->execute();
$subcat = $stmt->get_result()->fetch_assoc();

if (!$subcat) {
    header("Location: error.php?msg=Subcategory not found");
    exit;
}

// Fetch products in this subcategory
$stmt = $conn->prepare("
    SELECT product_id, name, price, image_url
    FROM products
    WHERE subcategory_id = ?
");
$stmt->bind_param("i", $subcategory_id);
$stmt->execute();
$products = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title><?= htmlspecialchars($subcat['category_name']) ?> &rarr; <?= htmlspecialchars($subcat['subcategory_name']) ?> - Novelnest</title>
</head>
<body>

<?php // The main header is already included above. ?>

<div class="content-wrapper">
    <h2><?= htmlspecialchars($subcat['category_name']) ?> &rarr; <?= htmlspecialchars($subcat['subcategory_name']) ?></h2>

    <?php if ($products->num_rows > 0): ?>
    <div class="products-grid">
        <?php while ($p = $products->fetch_assoc()): ?>
        <div class="product">
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="product-img">
            <h3><?= htmlspecialchars($p['name']) ?></h3>
            <p>KES <?= number_format($p['price'], 2) ?></p>
            <a class="btn" href="product.php?id=<?= $p['product_id'] ?>">View</a>
            <button class="add-btn" onclick="addToCart(<?= $p['product_id'] ?>)">Add to Cart</button>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <p class="no-products-msg">No products found in this subcategory.</p>
    <?php endif; ?>
</div>

<?php include_once 'footer.php'; // Use the main footer.php ?>
</body>
</html>
