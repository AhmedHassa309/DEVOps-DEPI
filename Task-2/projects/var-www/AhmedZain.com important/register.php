<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
        $error = 'Please fill in all fields.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        $userLine = "$username:$password\n";

        if (!file_exists('users.txt')) {
            file_put_contents('users.txt', '');
        }

        $users = file('users.txt', FILE_IGNORE_NEW_LINES);
        $exists = false;

        foreach ($users as $user) {
            list($storedUser, $storedEmail, ) = explode('|', $user);
            if ($storedUser === $username || $storedEmail === $email) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $error = 'Username or email already exists.';
        } else {
            file_put_contents('users.txt', $userLine . PHP_EOL, FILE_APPEND);
            $_SESSION['username'] = $username;
            header('Location: welcome.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .toggle-password {
            cursor: pointer;
            margin-left: 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Create New Account</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="email" name="email" placeholder="Email"><br>

        <input type="password" id="password" name="password" placeholder="Password">
        <span class="toggle-password" onclick="togglePassword('password')">👁️</span><br>

        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php">Sign in here</a></p>

    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>