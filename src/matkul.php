<?php
session_start();

$link = mysqli_connect('localhost', 'root', '12345678', 'uas');
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header('Location: login.php');
    exit;
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id-kelas'];
    $kelas = $_POST['nama'];
    $sks = $_POST['sks'];
    $dosen = $_POST['dosen'];
    mysqli_query($link, "INSERT INTO `mata_kuliah` (`id_matakuliah`, `nama_matakuliah`, `sks`, `dosen_pengampu`) VALUES ('$id', '$kelas', '$sks', '$dosen')");
    echo "<meta http-equiv='refresh' content='0; url=matkul.php'>";
} elseif (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    mysqli_query($link, "DELETE FROM `mata_kuliah` WHERE id_matakuliah='$id'");
    echo "<meta http-equiv='refresh' content='0; url=matkul.php'>";
} elseif (isset($_POST['edit'])) {
    $id = $_POST['id-kelas'];
    $kelas = $_POST['nama'];
    $sks = $_POST['sks'];
    $dosen = $_POST['dosen'];
    mysqli_query($link, "UPDATE `mata_kuliah` SET `nama_matakuliah`='$kelas', `sks`='$sks', `dosen_pengampu`='$dosen' WHERE `id_matakuliah`='$id'");
    echo "<meta http-equiv='refresh' content='0; url=matkul.php'>";
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah</title>
    <link rel="stylesheet" href="..\css\content.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    </style>
</head>

<body>
    <header>
        <div class="user">
            <i id="profile-img" class='bx bx-user'></i>
            <?php echo "<h2>$userID</h2>"; ?>
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
    
    <div class="table_header">
        <table>
            <?php
            if ($userID == 'Adminstrator') {
                echo "
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Sks</th>
                <th>Dosen</th>
                <th>Editor</th>
            </tr>";
            } else {
                echo "
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Sks</th>
                <th>Dosen</th>
            </tr>";
            }
            ?>
        </table>
    </div>
    <div class="data_matkul">
        <table>
            <?php
            $sql = "SELECT * FROM mata_kuliah";
            $result = mysqli_query($link, $sql);

            if ($result) {
                while ($data = mysqli_fetch_assoc($result)) {
                    if ($userID == 'Adminstrator') {
                        echo "
            <tr>
                <td>{$data['id_matakuliah']}</td>
                <td>{$data['nama_matakuliah']}</td>
                <td>{$data['sks']}</td>
                <td>{$data['dosen_pengampu']}</td>
                <td class='centered_cell'>
                    <a href='matkul.php?ubah&kode={$data['id_matakuliah']}'>Edit</a>
                    <a href='matkul.php?hapus&id={$data['id_matakuliah']}'>Delete</a>
                </td>
            </tr>";
                    } else {
                        echo "
            <tr>
                <td>{$data['id_matakuliah']}</td>
                <td>{$data['nama_matakuliah']}</td>
                <td>{$data['sks']}</td>
                <td>{$data['dosen_pengampu']}</td>
            </tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['ubah'])) {
        $id = $_GET['kode'];
        $sql = "SELECT * FROM mata_kuliah WHERE id_matakuliah='$id'";
        $data = mysqli_fetch_assoc(mysqli_query($link, $sql));
        echo "
    <div class='form_matakuliah'>
        <form action='matkul.php' method='POST'>
            <table>
                <tr>
                    <td>Kode</td>
                    <td><input type='text' name='id-kelas' value='{$data['id_matakuliah']}'></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type='text' name='nama' value='{$data['nama_matakuliah']}'></td>
                </tr>
                <tr>
                    <td>Sks</td>
                    <td><input type='number' name='sks' value='{$data['sks']}'></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td><input type='text' name='dosen' value='{$data['dosen_pengampu']}'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='edit' value='Simpan'></td>
                </tr>
            </table>
        </form>
    </div>";
    } else {
        if ($userID == 'Adminstrator') {
            echo "
    <div class='form_matakuliah'>
        <form action='matkul.php' method='POST'>
            <table>
                <tr>
                    <td>Kode</td>
                    <td><input type='text' name='id-kelas'></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type='text' name='nama'></td>
                </tr>
                <tr>
                    <td>Sks</td>
                    <td><input type='number' name='sks'></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td><input type='text' name='dosen'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='simpan' value='Simpan'></td>
                </tr>
            </table>
        </form>
    </div>";
        }
    ?>
    <?php
    }
    ?>
</body>
</html>