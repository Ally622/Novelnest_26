<?php
session_start();
include 'header.php'; // Include the consistent header
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Reset Password - NovelNest</title>
</head>
<body>

<div class="reset-container">
  <h2>Reset Password</h2>
  <p>Enter your email, temporary token, and new password.</p>

  <form id="resetForm">
    <input type="email" id="email" placeholder="Email" required><br>
    <input type="text" id="token" placeholder="Temporary Token" required><br>
    <input type="password" id="newPassword" placeholder="New Password" required><br>
    <button type="submit">Reset Password</button>
  </form>

  <div class="message" id="message"></div>
</div>

<script>
document.getElementById('resetForm').addEventListener('submit', function(e){
    e.preventDefault();

    const email = document.getElementById('email').value.trim();
    const token = document.getElementById('token').value.trim();
    const newPassword = document.getElementById('newPassword').value.trim();

    const msgDiv = document.getElementById('message');

    if(!email || !token || !newPassword){
        msgDiv.style.color = 'red';
        msgDiv.textContent = 'Please fill in all fields.';
        return;
    }

    const btn = document.querySelector('button');
    btn.disabled = true;
    btn.textContent = 'Resetting...';

    const formData = `email=${encodeURIComponent(email)}&token=${encodeURIComponent(token)}&password=${encodeURIComponent(newPassword)}`;

    fetch('auth/update_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.textContent = 'Reset Password';
        if(data.success){
            msgDiv.style.color = 'green';
            msgDiv.textContent = data.message + " Redirecting to login...";
            setTimeout(() => { window.location.href = 'login.php'; }, 2000);
        } else {
            msgDiv.style.color = 'red';
            msgDiv.textContent = data.message;
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.textContent = 'Reset Password';
        msgDiv.style.color = 'red';
        msgDiv.textContent = 'Failed to connect to backend.';
    });
});
</script>

</body>
</html>
