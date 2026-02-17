<?php
// Include DB connection
include_once 'config/init.php';

// Start session if not started
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$username = null;

// Only fetch username if user is logged in
if(isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['name'];
    }
}
?>

<header>
  <h1>Novelnest & Stationery Hub</h1>
  <nav style="display: flex; align-items: center;">
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>

    <div style="margin-left: auto; display: flex; align-items: center; gap: 10px; font-weight: bold;">
        <?php if($username): ?>
            <span style="color:white;">Welcome, <?php echo htmlspecialchars($username); ?></span>
            <a href="auth/logout.php" class="add-btn" style="padding:5px 10px; font-size:14px;">Logout</a>
        <?php else: ?>
            <a href="login.php" style="color:white;">Login</a>
            <a href="register.php" style="color:white; margin-left:10px;">Register</a>
        <?php endif; ?>
    </div>
  </nav>
</header>
