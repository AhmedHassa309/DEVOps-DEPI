<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($saved_user, $saved_pass) = explode(':', $user);
        if ($username === $saved_user && $password === $saved_pass) {
            $_SESSION['username'] = $username;
            header('Location: welcome.php');
            exit();
        }
    }

    header('Location: index.php?error=invalid');
    exit();
}
?>