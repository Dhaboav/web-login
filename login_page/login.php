<?php session_start();
if (isset($_SESSION['userID'])) {
    header('Location: konten/index.php');
    exit;
}
?>

<?php
$link = mysqli_connect('localhost', 'root', '12345678', 'uas');
if (isset($_POST['login'])) {
    $user = trim($_POST['userID']);
    $psw = trim($_POST['password']);

    if ($user == 'admin' or $psw == 'admin') {
        $_SESSION['userID'] = "Adminstrator";
        header('Location: konten/index.php');
        exit;
    } else {
        $sql = "SELECT count(*) FROM mahasiswa WHERE nim = '$user' AND nama = '$psw'";
        $data = mysqli_fetch_row(mysqli_query($link, $sql));
        if ($data[0] != 0) {
            $_SESSION['userID'] = "$user";
            header('Location: konten/index.php');
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header('Location: login.php?error=1');
            exit;
        }
    }
}
?>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <button type="submit" name="login">LOGIN</button>
        </form>
    </div>
</body>

</html>
