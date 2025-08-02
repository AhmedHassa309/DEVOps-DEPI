<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: welcome.php');
    exit();
}
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Login</h2>
<form action="signin.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>
<p style="color:red;">
    <?php if ($error === 'invalid') echo "Invalid credentials."; ?>
</p>
</body>
</html>