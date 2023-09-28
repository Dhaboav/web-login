<?php
session_start();

// Cek jika user sudah login dan session login adalah true
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: content_page/index.php'); // Redirect ke dashboard
    exit; // Akhiri skrip
}

// Definisikan daftar user valid dan kata sandi mereka
$user_list = [
    ['username' => 'miko', 'password' => '123'],
    ['username' => 'admin', 'password' => 'admin']
];

// Cek jika form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan input user dari form
    $userID = $_POST['userID'];
    $password = $_POST['password'];

    // Cek apakah kredensial yang disubmit cocok dengan salah satu user dalam daftar
    $authenticated = false;
    foreach ($user_list as $user) {
        if ($user['username'] === $userID && $user['password'] === $password) {
            $authenticated = true;
            $_SESSION['username'] = $userID;
            $_SESSION['login'] = true;
            header('Location: content_page/index.php'); // Redirect ke dashboard
            exit; // Akhiri skrip
        }
    }

    // Jika kredensial tidak cocok, set pesan kesalahan
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: login.php?error=1'); // Redirect ke halaman login dengan pesan kesalahan
    exit; // Akhiri skrip
}
?>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-container">

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p>Invalid username or password</p>';
        }
        ?>

        <form action="" method="post">
            <input type="text" name="userID" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>

</html>