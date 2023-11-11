<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../login.php');
    exit;
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header('Location: ../login.php');
    exit;
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="user">
            <i id="profile-img" class='bx bx-user'></i>
            <?php echo "<h2>$userID</h2>";?>
        </div>
        <nav>
            <a href="index.php">
                <span class="menu">
                    <i class='bx bx-home-alt-2'></i>
                    <p>Home</p>
                </span>
            </a>
            <a href="mhs.php">
                <span class="menu">
                    <i class='bx bxs-book-content'></i>
                    <p>Mahasiswa</p>
                </span>
            </a>        
            <a href="matkul.php">
                <span class="menu">
                    <i class='bx bxs-book-content'></i>
                    <p>Matakuliah</p>
                </span>
            </a>
        </nav>
        <a href="?logout=1">
            <span class="menu">
                <i class='bx bx-log-out'></i>
                <p>Logout</p>
            </span>
        </a>
    </header>
    <main>
        <section class="user-dashboard">
            <?php 
            $link = mysqli_connect('localhost', 'root', '12345678', 'uas');
            $sql = "SELECT * FROM mahasiswa WHERE nim='$userID'";
            $data = mysqli_fetch_row(mysqli_query($link, $sql));

            if ($userID == 'Adminstrator') {
                echo "
            <h2 id='first-msg'>Selamat Datang, $userID</h2>
            <div class='data'>
                <i id='img-user' class='bx bx-image-alt'></i>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: $userID</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: Dosen</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: Pria</td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone</td>
                        <td>: 0882xxxxx</td>
                    </tr>
                </table>
            </div>";} else {
                echo"
            <h2 id='first-msg'>Selamat Datang, $data[1]</h2>
            <div class='data'>
                <i id='img-user' class='bx bx-image-alt'></i>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:  $data[1]</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:  $data[0]</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: $data[2]</td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone</td>
                        <td>: $data[3]</td>
                    </tr>
                </table>
            </div>";}
            ?>   
        </section>
    </main>
</body>
</html>