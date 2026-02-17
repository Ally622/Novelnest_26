<?php
session_start();
// Optional: clear cart after order
unset($_SESSION['cart']);

// Get user name for personalized message
$user_name = $_SESSION['name'] ?? 'Valued Customer'; // Use $_SESSION['name'] as we use it elsewhere
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Thank You - Novelnest</title>
</head>
<body>
    <?php include_once 'header.php'; ?>

<div class="content-wrapper" style="text-align:center; padding:50px;">
    <h2>Thank You, <?= htmlspecialchars($user_name) ?>!</h2>
    <p>Your order has been placed successfully.</p>
    <p>We will process and deliver it soon.</p>
    <a href="index.php" class="checkout-btn" style="margin-top:20px; display:inline-block;">Back to Home</a>
</div>


<?php include 'footer.php'; ?>
