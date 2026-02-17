<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "novelnest"; // change if needed

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB connection failed']);
    exit;
}

// Hardcoded test login
$email = 'alisha@example.com';
$password = '123456'; // example password

$stmt = $conn->prepare("SELECT user_id, name, password_hash FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$user = $result->fetch_assoc();
if (password_verify($password, $user['password_hash'])) {
    echo json_encode(['success' => true, 'message' => 'Login successful', 'user_id' => $user['user_id'], 'name' => $user['name']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid password']);
}
?>
