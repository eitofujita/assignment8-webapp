<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'])) {
    $login = 'user' . rand(1000, 9999);
    $password = bin2hex(random_bytes(4));

    $_SESSION['user'] = [
        'login' => $login,
        'password' => $password,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
    ];

    echo "User created (fallback):<br>";
    echo "Login: $login<br>Password: $password<br>Email: {$_POST['email']}<br>";
} else {
    echo "Invalid fallback submission.";
}
