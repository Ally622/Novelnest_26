<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config/init.php';

// Validate order_id
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("<h2>Error</h2><p>No order ID specified.</p>");
}

$order_id = (int) $_GET['order_id'];

// Fetch order and user info, including user_id
$stmt = $conn->prepare("
    SELECT o.order_id, o.user_id, o.total_amount, o.status, o.created_at, 
           u.name AS customer_name, u.email AS customer_email
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    WHERE o.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    die("<h2>Error</h2><p>Order not found.</p>");
}

// Optional: Check that the logged-in user owns this order (if not admin)
if ($_SESSION['user_id'] != $order['user_id']) {
    // Check if admin
    $stmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if (!$user || $user['role'] !== 'admin') {
        die("<h2>Access Denied</h2><p>You cannot view this order.</p>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Order #<?= $order['order_id']; ?> - Novelnest</title>
    <style>
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h1 {
            text-align: center;
            color: #801515;
        }
        a.back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 15px;
            background: #801515;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .order-meta p {
            margin: 5px 0;
            color: #333;
        }
        ul#order-items {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }
        .order-item {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 220px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .order-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .order-item h3 {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
        .order-item p {
            margin: 3px 0;
            color: #555;
            font-size: 14px;
        }
        .order-summary {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Order #<?= $order['order_id']; ?> Details</h1>
    <a class="back-btn" href="orders.php">&larr; Back to Orders</a>

    <div class="order-meta">
        <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
        <p><strong>Placed on:</strong> <?= htmlspecialchars($order['created_at']); ?></p>
        <p><strong>Customer:</strong> <?= htmlspecialchars($order['customer_name']); ?> (<?= htmlspecialchars($order['customer_email']); ?>)</p>
    </div>

    <ul id="order-items">
        <li>Loading order items...</li>
    </ul>

    <div class="order-summary">
        Total: $<span id="order-total"><?= number_format($order['total_amount'], 2); ?></span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderId = <?= $order_id; ?>;
    const orderItemsContainer = document.getElementById('order-items');

    fetch(`orders/order_details_fetch.php?order_id=${orderId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.items.length > 0) {
                orderItemsContainer.innerHTML = '';
                data.items.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'order-item';
                    li.innerHTML = `
                        <img src="images/${item.image}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p>Quantity: ${item.quantity}</p>
                        <p>Price: $${parseFloat(item.unit_price).toFixed(2)}</p>
                    `;
                    orderItemsContainer.appendChild(li);
                });
            } else {
                orderItemsContainer.innerHTML = '<li>No items found for this order.</li>';
            }
        })
        .catch(error => {
            console.error('Error fetching order details:', error);
            orderItemsContainer.innerHTML = '<li>Error loading order details.</li>';
        });
});
</script>
</body>
</html>
