<?php
session_start();

// Include DB connection
include_once 'config/init.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input safely
    $name = trim(isset($_POST['name']) ? $_POST['name'] : '');
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($name) || empty($email) || empty($password)) {
        $msg = "All fields are required.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Email already registered.";
        } else {
            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hash);

            if ($stmt->execute()) {
                $msg = "Registration successful! You can now log in.";
                // Optionally redirect to login page
                // header("Location: login.php");
                // exit;
            } else {
                $msg = "Failed to register. Please try again.";
                if ($stmt->error) {
                    $msg .= ' Error: ' . $stmt->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Register - NovelNest</title>
</head>
<body>

<?php include_once 'header.php'; // Include the consistent header ?>

<div class="form-container">
  <h2>Register</h2>
  
  <?php if (!empty($msg)): ?>
    <div class="message" style="color: <?= (strpos($msg, 'successful') !== false) ? 'green' : 'red'; ?>;">
        <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>

    <button type="submit" class="submit-btn">Register</button>
    <div class="login-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </form>
</div>

</body>
</html>