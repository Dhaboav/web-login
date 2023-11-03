<?php
session_start();

if (isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('Location: ../login.php');
    exit;
}

if (isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
} else{
    header('Location: ../login.php');
    exit;
}
?>

<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>UAS</h1>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="mhs.php">Mahasiswa</a>
            <a href="matkul.php">Matakuliah</a>
            <a href="?logout=1">Logout</a>
        </div>
    </div>

    <?php
    $link   = mysqli_connect('localhost', 'root', '12345678', 'uas');
    $sql    = "SELECT * FROM mahasiswa WHERE nama='$userID'";
    $data   = mysqli_fetch_row(mysqli_query($link, $sql));
    echo "
    <div class='pesan'>
        <h3>Selamat Datang, $userID</h3>
    </div>
    <div class='mahasiswa'> 
        <img src='user.png' alt='user' width='190'>
        <table>
            <tr>
                <td><p>Nama</p></td>
                <td>:$data[1]</td>
            </tr>
            <tr>
                <td><p>NIM</p></td>
                <td>:$data[0]</td>
            </tr>
            <tr>
                <td><p>Jenis Kelamin</p></td>
                <td>:$data[2]</td>
            </tr>
            <tr>
                <td><p>Nomor HP</p></td>
                <td>:$data[3]</td>
            </tr>  
        </table>
    </div>
    "
    ?>
</body>
</html>