<?php
// reset_password_confirm.php
session_start();
$token = $_GET['token'] ?? '';
?>

<?php
// reset_password_confirm.php
session_start();
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Reset Password - NovelNest</title>
</head>
<body>

<?php include_once 'header.php'; ?>

<div class="form-container">
  <h2>Reset Password</h2>

  <div id="message" class="message"></div>

  <form id="resetForm">
      <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" name="password" id="password" required>
      </div>
      <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" required>
      </div>
      <button type="submit" class="submit-btn">Reset Password</button>
  </form>
</div>

<script>
document.getElementById("resetForm").addEventListener("submit", function(e){
    e.preventDefault();

    const password = encodeURIComponent(document.getElementById("password").value.trim());
    const confirm = encodeURIComponent(document.getElementById("confirm_password").value.trim());
    const token = encodeURIComponent("<?= htmlspecialchars($token) ?>");

    if(!password || !confirm){
        document.getElementById("message").textContent = "Please fill in all fields.";
        return;
    }

    const btn = document.querySelector(".submit-btn");
    btn.disabled = true;
    btn.textContent = "Resetting...";

    fetch("auth/reset_password.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `password=${password}&confirm_password=${confirm}&token=${token}`
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.textContent = "Reset Password";
        document.getElementById("message").textContent = data.message;
        if(data.success){
            setTimeout(() => {
                window.location.href = "login.php";
            }, 2000); // redirect after 2 seconds
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.textContent = "Reset Password";
        document.getElementById("message").textContent = "An error occurred. Please try again.";
    });
});
</script>

</body>
</html>
