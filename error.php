<?php
$message = $_GET['msg'] ?? 'We are having trouble processing your request.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Error</title>
</head>
<body>
<h1>Something went wrong!</h1>
<p><?= htmlspecialchars($message) ?></p>
<p><a href="index.php">Go Back to Homepage</a></p>
</body>
</html>
