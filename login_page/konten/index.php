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
    $link           = mysqli_connect('localhost', 'root', '12345678', 'uas');
    $sql            = "SELECT * FROM mahasiswa WHERE nim='$userID'";
    $sql_matkul     = "SELECT COUNT(id_matakuliah) FROM mata_kuliah";
    $sql_mahasiswa  = "SELECT COUNT(nim) FROM mahasiswa";
    $sql_kelamin    = "SELECT jenis_kelamin, COUNT(*) AS total_count FROM mahasiswa GROUP BY jenis_kelamin";
    $data           = mysqli_fetch_row(mysqli_query($link, $sql));
    $matkul         = mysqli_fetch_row(mysqli_query($link, $sql_matkul));
    $mahasiswa      = mysqli_fetch_row(mysqli_query($link, $sql_mahasiswa));
    $result         = mysqli_query($link, $sql_kelamin);
    
    $kelamin = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $jenis_kelamin = $row['jenis_kelamin'];
        $total_count = $row['total_count'];
        $kelamin[$jenis_kelamin] = $total_count;
    }

    if ($userID == 'Adminstrator') {
        echo "
    <div class='pesan'>
        <h3>Selamat Datang, $userID</h3>
    </div>
    <div class='mahasiswa'> 
        <img src='user.png' alt='user' width='190'>
        <table>
            <tr>
                <td><p>Nama</p></td>
                <td>:$userID</td>
            </tr>
            <tr>
                <td><p>Jabatan</p></td>
                <td>:Dosen</td>
            </tr>
            <tr>
                <td><p>Instansi</p></td>
                <td>:Universitas Tanjungpura</td>
            </tr>
            <tr>
                <td><p>Total Matakuliah</p></td>
                <td>:$matkul[0]</td>
            </tr>
            <tr>
                <td><p>Total Mahasiswa</p></td>
                <td>:$mahasiswa[0]</td>
            </tr>
            <tr>
                <td><p>Jenis Kelamin</p></td>
                <td>:Pria(" . $kelamin['Pria'] . ")
            </tr>
            <tr>
                <td></td>
                <td>:Wanita(" . $kelamin['Wanita'] . ")</td>
            </tr>";
    } else {
        echo "
    <div class='pesan'>
        <h3>Selamat Datang, $data[1]</h3>
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
            </tr> ";
    }
    echo "
        </table>
    </div>";

    ?>
</body>

</html>