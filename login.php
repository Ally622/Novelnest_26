<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Include DB connection
include_once 'config/init.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input safely
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        $msg = "Please enter both email and password.";
    } else {
        // Prepare SQL to prevent SQL injection
        $stmt = $conn->prepare("SELECT user_id, name, password_hash, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $msg = "User not found.";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                // Login successful
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role']; // Store user role in session

                // Redirect based on role
                if ($_SESSION['role'] === 'admin') {
                    header("Location: admin/admin_panel.php");
                } else {
                    header("Location: index.php"); // Assuming index.php is the general user dashboard
                }
                exit;
            } else {
                $msg = "Incorrect password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Login - Novelnest</title>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    
    <?php if (!empty($msg)): ?>
        <div class="message"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </form>
</div>

</body>
</html>
