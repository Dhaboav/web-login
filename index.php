<!-- Version 2.0 -->
<?php session_start();
if (isset($_SESSION['userID'])) {
    header('Location: src\home.php');
    exit;
}
?>

<?php
$link = mysqli_connect('localhost', 'root', '12345678', 'uas');
if (isset($_POST['login'])) {
    $user = trim($_POST['userID']);
    $psw = trim($_POST['password']);

    if ($user == 'admin' and $psw == 'admin') {
        $_SESSION['userID'] = "Adminstrator";
        header('Location: src\home.php');
        exit;
    } else {
        $sql = "SELECT count(*) FROM mahasiswa WHERE nim = '$user' AND nama = '$psw'";
        $data = mysqli_fetch_row(mysqli_query($link, $sql));
        if ($data[0] != 0) {
            $_SESSION['userID'] = "$user";
            header('Location: src\home.php');
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header('Location: index.php?error=1');
            exit;
        }
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css\login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="login-box">
        <form action="" method="post">
            <h1>UAS</h1>
            <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "
            <div class='error-box'>
                <input type='text' name='userID' placeholder='Username' required>
                <i class='bx bxs-user'></i>
            </div>
            <div class='error-box'>
                <input type='password' name='password' placeholder='Password' required>
                <i class='bx bxs-lock-alt'></i>
                <div class='error-msg'>
                    <i class='bx bxs-error-circle'></i>
                    <p>Username atau Password salah</p>
                </div>
            </div>
                
                ";} else {
                    echo "
            <div class='input-box'>
                <input type='text' name='userID' placeholder='Username' required>
                <i class='bx bxs-user'></i>
            </div>
            <div class='input-box'>
                <input type='password' name='password' placeholder='Password' required>
                <i class='bx bxs-lock-alt'></i>
            </div>";}
            ?>

            <button type="submit" name="login">Log In</button>
        </form>
    </div>
</body>

</html>