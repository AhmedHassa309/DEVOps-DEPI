<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        header('Location: register.php');
        exit();
    }

    $line = $username . ':' . $password;
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existing_user,) = explode(':', $user);
        if ($existing_user === $username) {
            header('Location: register.php');
            exit();
        }
    }

    file_put_contents('users.txt', $line . PHP_EOL, FILE_APPEND);
    header('Location: index.php');
    exit();
}
?>