<?php
session_start();
include_once 'config/init.php'; // Assuming config/init.php is needed here

// Include the consistent header
include_once 'header.php'; // Use the main header.php

$product_id = (int)($_GET['id'] ?? 0);
if($product_id <= 0){
    header("Location: error.php?msg=Invalid product ID.");
    exit;
}

// Fetch product
$stmt = $conn->prepare("
    SELECT p.*, c.category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    WHERE p.product_id = ?
");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if(!$product){
    header("Location: error.php?msg=Product not found.");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title><?= htmlspecialchars($product['name']) ?> - Novelnest</title>
</head>
<body>

<?php // The main header is already included above. ?>

<div class="product-details content-wrapper">

    <!-- Breadcrumb -->
    <p><a href="index.php">Home</a> &raquo;
       <a href="products.php?category=<?= urlencode($product['category_name'] ?? '') ?>">
           <?= htmlspecialchars($product['category_name'] ?? 'All Products') ?>
       </a> &raquo; <?= htmlspecialchars($product['name']) ?>
    </p>

    <div class="product-main">
        <div class="product-image">
            <img src="<?= htmlspecialchars($product['image_url']) ?>"
                 alt="<?= htmlspecialchars($product['name']) ?>"
                 class="product-detail-img">
        </div>

        <div class="product-info">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><strong>Category:</strong> <?= htmlspecialchars($product['category_name'] ?? 'N/A') ?></p>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <p><strong>Price:</strong> KES <?= number_format($product['price'],2) ?></p>
            <p><strong>Stock:</strong> <?= intval($product['stock']) ?></p>

            <!-- Add to cart form -->
            <div style="margin-top:15px;">
                <label>Quantity:
                    <input type="number" id="quantity_<?= $product['product_id'] ?>" value="1" min="1" max="<?= intval($product['stock']) ?>" style="width:60px;">
                </label>
                <button type="button" class="add-btn" onclick="addToCart(<?= $product['product_id'] ?>, document.getElementById('quantity_<?= $product['product_id'] ?>').value)">
                    Add to Cart
                </button>
            </div>

            <p style="margin-top:10px;">
                <a href="wishlist_add.php?id=<?= $product['product_id'] ?>"
                   style="color:#801515; font-weight:bold;">Add to Wishlist</a>
            </p>
        </div>
    </div>
</div>

<style>
/* Local styles for product.php, if any specific needed */
.product-detail-img {
    max-width:300px;
    border-radius:12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
.product-main {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
    align-items: flex-start;
}
.product-info {
    max-width: 500px;
}
</style>
<script>
// addToCart function needs to be globally available
// If products.php already has this, it can be removed
// or ensure this file's script block is after where it's defined.
// For now, assuming it's available from products.php or a global script.
<?php /* This is a placeholder for the addToCart function if not globally available */ ?>
<?php /*
async function addToCart(productId, quantity = 1){
    try {
        const res = await fetch("http://localhost:8000/cart/add_to_cart.php",{
            method:"POST",
            headers:{"Content-Type":"application/x-www-form-urlencoded"},
            body:`product_id=${encodeURIComponent(productId)}&quantity=${encodeURIComponent(quantity)}`
        });
        const data = await res.json();
        if(data.success){
            alert(`${data.message}`);
            // Optionally update cart count here
        } else {
            alert(data.message);
        }
    } catch(err) {
        console.error("Backend error:", err);
        alert("Failed to connect to backend at http://localhost:8000/cart/add_to_cart.php. Make sure PHP server is running and the URL is correct.");
    }
}
*/ ?>
</script>

<?php include_once 'footer.php'; // Use the main footer.php ?>
</body>
</html>
