<?php
session_start();
include 'config/init.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT name, email, address FROM users WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Handle profile update
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = strtolower($_POST['email']);
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, address=? WHERE user_id=?");
    $stmt->bind_param("sssi", $name, $email, $address, $user_id);
    $stmt->execute();

    $msg = "Profile updated successfully!";

    // Refresh user data
    $stmt = $conn->prepare("SELECT name, email, address FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'includes/html_head.php'; ?>
    <title>Profile - Novelnest</title>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container">
        <h1>Your Profile</h1>
        <?php if (!empty($msg)): ?>
            <div class="message success"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
