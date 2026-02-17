<?php
session_start();
include_once 'config/init.php'; // Assuming config/init.php is needed here

// Include the consistent header
include_once 'header.php'; // Use the main header.php

$category_id = (int)($_GET['id'] ?? 0);
if ($category_id <= 0) {
    // Better to redirect or show a proper error page
    header("Location: error.php?msg=Invalid category ID");
    exit;
}

// Fetch category name
$stmt = $conn->prepare("SELECT category_name FROM categories WHERE category_id=?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$category = $stmt->get_result()->fetch_assoc();

if (!$category) {
    header("Location: error.php?msg=Category not found");
    exit;
}

// Fetch products in category via subcategories
$stmt = $conn->prepare("
    SELECT p.product_id, p.name, p.price, p.image_url
    FROM products p
    JOIN subcategories s ON p.subcategory_id = s.subcategory_id
    WHERE s.category_id = ?
");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$products = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Category: <?= htmlspecialchars($category['category_name']) ?> - Novelnest</title>
</head>
<body>

<?php // The main header is already included above. ?>

<div class="content-wrapper">
    <h2>Category: <?= htmlspecialchars($category['category_name']) ?></h2>

    <?php if ($products->num_rows > 0): ?>
    <div class="products-grid">
        <?php while ($p = $products->fetch_assoc()): ?>
        <div class="product">
            <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="product-img">
            <h3><?= htmlspecialchars($p['name']) ?></h3>
            <p>KES <?= number_format($p['price'],2) ?></p>
            <a class="btn" href="product.php?id=<?= $p['product_id'] ?>">View</a>
            <button class="add-btn" onclick="addToCart(<?= $p['product_id'] ?>)">Add to Cart</button>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <p class="no-products-msg">No products found in this category.</p>
    <?php endif; ?>
</div>

<?php include_once 'footer.php'; // Use the main footer.php ?>
</body>
</html>
