<?php
include 'init.php';

// Require login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Fetch user info safely
$stmt = $conn->prepare("SELECT username, role FROM users WHERE user_id=? LIMIT 1");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Check if admin
if($user['role'] !== 'admin'){
    echo "<h2>Access Denied</h2><p>You are not authorized to view this page.</p>";
    exit;
}

include '../includes/header.php';
?>

<h2>Admin Panel</h2>
<p>Welcome, <strong><?= htmlspecialchars($user['username']) ?></strong>!</p>

<hr>

<?php
// Combined stats query
$stats = $conn->query("
    SELECT 
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM products) AS total_products,
        (SELECT COUNT(*) FROM orders) AS total_orders,
        (SELECT COUNT(*) FROM categories) AS total_categories
")->fetch_assoc();
?>

<h3>Site Overview</h3>
<ul>
    <li><strong>Total Users:</strong> <?= $stats['total_users'] ?></li>
    <li><strong>Total Products:</strong> <?= $stats['total_products'] ?></li>
    <li><strong>Total Orders:</strong> <?= $stats['total_orders'] ?></li>
    <li><strong>Total Categories:</strong> <?= $stats['total_categories'] ?></li>
</ul>

<hr>

<h3>Management</h3>
<nav>
    <a class="btn" href="admin_users.php">Manage Users</a>
    <a class="btn" href="admin_products.php">Manage Products</a>
    <a class="btn" href="admin_orders.php">Manage Orders</a>
    <a class="btn" href="admin_categories.php">Manage Categories</a>
</nav>

<hr>

<h3>Quick Links</h3>
<nav>
    <a class="btn" href="index.php">View Store</a>
    <a class="btn" href="logout.php">Logout</a>
</nav>

<?php include '../includes/footer.php'; ?>
