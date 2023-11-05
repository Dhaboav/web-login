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
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis-kelamin'];
    $no_hp = $_POST['no-tlp'];
    mysqli_query($link, "INSERT INTO `mahasiswa` (`nim`, `nama`, `jenis_kelamin`, `no_hp`) VALUES ('$nim', '$nama', '$jenis_kelamin', '$no_hp')");
    echo "<meta http-equiv='refresh' content='0; url=mhs.php'>";
} elseif (isset($_GET['hapus'])) {
    $nim = $_GET['nim']; // Changed from POST to GET
    mysqli_query($link, "DELETE FROM `mahasiswa` WHERE nim='$nim'");
    echo "<meta http-equiv='refresh' content='0; url=mhs.php'>";
} elseif (isset($_POST['edit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis-kelamin'];
    $no_hp = $_POST['no-tlp'];
    mysqli_query($link, "UPDATE `mahasiswa` SET nama='$nama', jenis_kelamin='$jenis_kelamin', no_hp='$no_hp' WHERE nim='$nim'");
    echo "<meta http-equiv='refresh' content='0; url=mhs.php'>";
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .table_header {
            display: flex;
            text-align: center;
            padding: 20px 0px;
            margin-top: 10px;
        }

        .table_header table {
            font-family: 'Courier New', Courier, monospace;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            background-color: blueviolet;
        }

        .table_header th {
            padding: 20px;
            background-color: blue;
            color: aliceblue;
        }

        .data_mahasiswa {
            display: flex;
            text-align: center;
            padding: 20px 0px;
            margin-top: -20px;
            max-height: 200px;
            overflow-y: auto;
        }

        .data_mahasiswa table {
            font-family: 'Courier New', Courier, monospace;
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }

        .data_mahasiswa td {border: 1px solid black;}
        .data_mahasiswa th {
            padding: 20px;
            background-color: blue;
            color: aliceblue;
        }

        .data_mahasiswa a {
            text-decoration: none;
            color: blue;
        }

        .data_mahasiswa a:hover {
            text-decoration: none;
            color: red;
        }

        .centered_cell {
            text-align: center;
            vertical-align: middle;
            padding: 0px 10px;
        }

        .form_mahasiswa {
            margin: 10px auto;
            border: 5px solid black;
            width: 400px;
            padding: 15px;
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
    <div class="table_header">
        <table>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No Hp</th>
                <th>Editor</th>
            </tr>
        </table>
    </div>
    <div class="data_mahasiswa">
        <table>
            <?php
            $sql = "SELECT * FROM mahasiswa";
            $result = mysqli_query($link, $sql);
            if ($result) {
                while ($data = mysqli_fetch_assoc($result)) {
                    if ($userID == 'Adminstrator') {
                        echo "
            <tr>
                <td>{$data['nim']}</td>
                <td>{$data['nama']}</td>
                <td>{$data['jenis_kelamin']}</td>
                <td>{$data['no_hp']}</td>
                <td class='centered_cell'>
                    <a href='mhs.php?ubah&kode={$data['nim']}'>Edit</a>
                    <a href='mhs.php?hapus&nim={$data['nim']}'>Delete</a>
                </td>
            </tr>";
                    } else {
                        if ($data['nama'] == $userID) {
                            echo "
            <tr>
                <td>{$data['nim']}</td>
                <td>{$data['nama']}</td>
                <td>{$data['jenis_kelamin']}</td>
                <td>{$data['no_hp']}</td>
                <td class='centered_cell'>
                    <a href='mhs.php?ubah&kode={$data['nim']}'>Edit</a>
                </td>
            </tr>";
                        } else {
                            echo "
            <tr>
                <td>{$data['nim']}</td>
                <td>{$data['nama']}</td>
                <td>{$data['jenis_kelamin']}</td>
                <td>{$data['no_hp']}</td>
                <td></td>
            </tr>";
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_GET['ubah'])) {
        $id = $_GET['kode'];
        $sql = "SELECT * FROM mahasiswa WHERE nim='$id'";
        $data = mysqli_fetch_assoc(mysqli_query($link, $sql));
        echo "
    <div class='form_mahasiswa'>
        <form action='mhs.php' method='POST'>
            <table>
                <tr>
                    <td>NIM</td>
                    <td><input type='text' name='nim' value='{$data['nim']}'></td>
                </tr>
                <tr>
                    <td>NAMA</td>
                    <td><input type='text' name='nama' value='{$data['nama']}'></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><input type='text' name='jenis-kelamin' value='{$data['jenis_kelamin']}'></td>
                </tr>
                <tr>
                    <td>Nomor Telp</td>
                    <td><input type='number' name='no-tlp' value='{$data['no_hp']}'></td>
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
    <div class='form_mahasiswa'>
        <form action='mhs.php' method='POST'>
            <table>
                <tr>
                    <td>NIM</td>
                    <td><input type='text' name='nim'></td>
                </tr>
                <tr>
                    <td>NAMA</td>
                    <td><input type='text' name='nama'></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><input type='text' name='jenis-kelamin'></td>
                </tr>
                <tr>
                    <td>Nomor Telp</td>
                    <td><input type='number' name='no-tlp'></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' name='simpan' value='Simpan'></td>
                </tr>
            </table>
        </form>
    </div>";}
    ?>

    <?php
    }
    ?>
</body>

</html>