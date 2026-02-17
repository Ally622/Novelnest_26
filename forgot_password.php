<?php
session_start(); // Assuming session is needed for header.php
include 'header.php'; // Include the consistent header
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Forgot Password - Novelnest</title>
<style>
/* Local styles for forgot_password.php */
.forgot-container {
  max-width: 400px;
  margin: 50px auto;
  padding: 30px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
  text-align: center;
}
.forgot-container h2 {
  color: #801515;
  margin-bottom: 20px;
}
.forgot-container p {
  margin-bottom: 20px;
  color: #555;
}
.forgot-container form {
  display: flex;
  flex-direction: column;
}
.forgot-container input[type="email"] {
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: calc(100% - 22px); /* Adjust for padding and border */
  margin-left: auto;
  margin-right: auto;
}
.forgot-container button {
  padding: 10px;
  background-color: #801515;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
}
.forgot-container button:hover {
  background-color: #660000;
}
.back-login {
  display: block;
  margin-top: 20px;
  color: #801515;
  text-decoration: none;
  font-weight: bold;
}
.back-login:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<div class="forgot-container">
  <h2>Forgot Password</h2>
