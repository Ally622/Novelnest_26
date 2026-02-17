<?php
session_start();
include_once 'config/init.php';
include_once 'orders/functions.php'; // Include the order functions

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'] ?? 'User';

// Fetch user orders
$user_orders = get_user_orders($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>My Orders - Novelnest & Stationery Hub</title></head>
<body>

<header>
    <h1>NovelNest & Stationery Hub</h1>
    <nav>
        <span>Welcome, <?= htmlspecialchars($user_name) ?></span>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="orders.php">My Orders</a>
        <a href="logout.php" style="padding:5px 10px; background:#801515; color:white; border-radius:5px;">
            Logout
        </a>
    </nav>
</header>

<div class="orders-container">
    <h2>My Orders</h2>

    <?php if (empty($user_orders)): ?>
        <p class="no-orders">You have not placed any orders yet.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td>Ksh <?= htmlspecialchars(number_format($order['total_amount'], 2)) ?></td>
                        <td><?= htmlspecialchars(ucfirst($order['status'])) ?></td>
                        <td><?= htmlspecialchars(ucfirst($order['payment_status'])) ?></td>
                        <td><?= htmlspecialchars(ucfirst($order['payment_method'])) ?></td>
                        <td><?= htmlspecialchars(date('M d, Y H:i', strtotime($order['created_at']))) ?></td>
                        <td><a href="order_details.php?order_id=<?= $order['order_id'] ?>" class="order-detail-link">View Details</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
