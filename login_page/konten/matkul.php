<?php
session_start();

$link = mysqli_connect('localhost', 'root', '12345678', 'uas');
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
    <title>Mata Kuliah</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form_matakuliah {
            margin-top: 30px;
            margin-left: 10px;
            border: 5px solid black;
            width: 400px;
            padding: 15px;
        }

        .data_matkul {
            display: flex;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-top: 50px;
        }

        .data_matkul table {
            font-family: 'Courier New', Courier, monospace;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }

        .data_matkul td,
        .data_matkul th {
            border: 1px solid black;
        }

        .data_matkul th {
            padding: 20px;
            background-color: blue;
            color: aliceblue;
        }

        .data_matkul a {
            text-decoration: none;
            color: blue;
        }

        .data_matkul a:hover {
            text-decoration: none;
            color: red;
        }

        .centered_cell {
            text-align: center;
            vertical-align: middle;
            padding: 0 10px;
        }
    </style>
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
    ?>
    <div class="form_matakuliah">
        <form action="matkul.php" method="POST">
            <table>
                <tr>
                    <td>Kode</td>
                    <td><input type="text" name='id-kelas'></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name='nama'></td>
                </tr>
                <tr>
                    <td>Sks</td>
                    <td><input type="number" name='sks'></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td><input type="text" name='dosen'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='simpan' value='Simpan'></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    }
    ?>
    <div class="data_matkul">
        <table>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Sks</th>
                <th>Dosen</th>
                <th>Editor</th>
            </tr>
            <?php
            $sql = "SELECT * FROM mata_kuliah";
            $result = mysqli_query($link, $sql);

            if ($result) {
                while ($data = mysqli_fetch_assoc($result)) {
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
                }
            }
            ?>
        </table>
    </div>
</body>
</html>