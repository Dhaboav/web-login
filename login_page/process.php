<?php
session_start();

// Define a list of valid users and their passwords
$user_list = [
    ['username' => 'miko', 'password' => '123'],
    ['username' => 'admin', 'password' => 'admin']
];

// Get the user input from the form
$userID = $_POST['userID'];
$password = $_POST['password'];

// Check if the submitted credentials match any user in the list
$authenticated = false;
foreach ($user_list as $user) {
    if ($user['username'] === $userID && $user['password'] === $password) {
        $authenticated = true;
        $_SESSION['username'] = $userID;
        break;
    }
}

if ($authenticated) {
    $_SESSION['login'] = true;
    header('Location: content_page\index.php'); // Redirect to a dashboard or protected page
} else {
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: login.php?error=1');
}
