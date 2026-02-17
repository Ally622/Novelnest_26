<?php
session_start();
include_once 'config/init.php'; // Ensure init.php is included for db access if header.php doesn't do it

// Ensure user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Example: Get cart data from session
// Note: This needs to be updated to fetch cart items from DB using cart/view_cart.php or similar logic.
// For now, assuming $_SESSION['cart'] would be populated from elsewhere if used.
$cart = []; // Initialize empty cart, will be fetched or populated

// Calculate total
$total = 0;
foreach($cart as $item){
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Order Confirmation - Novelnest</title>
</head>
<body>
    <?php include_once 'header.php'; ?>

<div class="content-wrapper">
    <h2>Order Confirmation</h2>

    <?php if(empty($cart)): ?>
        <p style="text-align:center; font-weight:bold;">Your cart is empty.</p>
    <?php else: ?>
        <table style="width:100%; max-width:700px; margin:auto; border-collapse:collapse;">
            <tr style="background:#801515; color:white;">
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <?php foreach($cart as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td style="text-align:center;"><?= (int)$item['quantity'] ?></td>
                <td style="text-align:right;">Ksh <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="text-align:right; font-weight:bold;">Total</td>
                <td style="text-align:right; font-weight:bold;">Ksh <?= number_format($total, 2) ?></td>
            </tr>
        </table>

        <form action="thankyou.php" method="post" style="text-align:center; margin-top:20px;">
            <button type="submit" class="checkout-btn">Confirm Order</button>
        </form>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

