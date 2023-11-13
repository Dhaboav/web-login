<!-- Version 2.0 -->
<?php
session_start();

$link = mysqli_connect('localhost', 'root', '12345678', 'uas');
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit;
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header('Location: ../index.php');
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
    <link rel="stylesheet" href="..\css\content.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Mahasiswa Page*/
        html {font-size: 10px;}
        .mahasiswa {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .mahasiswa table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.1rem;
        }

        /* header */
        .mahasiswa-header {
            border-collapse: collapse;
            border-radius: 3rem;
            overflow: hidden;
        }
        .mahasiswa-header th {
            width: 20%;
            padding: .8rem;
            text-align: center;
            font-size: 2rem;
            color: black;
            background-color: white;
        }

        /* Data */
        .mahasiswa-data {
            width: 100%;
            height: 40rem;
            overflow-y: auto;
        }
        .mahasiswa-data::-webkit-scrollbar {width: .2rem;}
        .mahasiswa-data::-webkit-scrollbar-thumb {background-color: #b1b1b181;}
        .mahasiswa-data td {
            width: 20%;
            padding: .8rem;
            font-size: 1.5rem;
            text-align: center;
            color: white;
        }
        .mahasiswa-data td a {color: white;}
        .mahasiswa-data td a:hover {color: blue;}
        
        /* form */
        .form-mahasiswa {
            border: .5rem solid white;
            border-radius: 3rem;
            width: 40rem;
            padding: 1.5rem;
            font-size: 2rem;
            color: white;
            box-sizing: border-box;
            margin-top: 1rem;
        }
        .form-mahasiswa td {color: white;}
        .form-mahasiswa input {margin:.5rem 0;}
        .form-mahasiswa input[type="submit"] {
            width: 6rem;
            padding: .5rem;
            display: block;
            margin: 1rem auto 0;
            border-radius: 2rem;
            border: none;
        }
        .form-mahasiswa input[type="submit"]:hover {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <div class="user">
            <i id="profile-img" class='bx bx-user'></i>
            <?php echo "<h2>$userID</h2>"; ?>
        </div>
        <nav>
            <a href="home.php">
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
        <section class="mahasiswa">
            <table class="mahasiswa-header">
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No Handphone</th>
                    <th>Editor</th>
                </tr>
            </table>
            <div class="mahasiswa-data">
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
                        <td>
                            <a href='mhs.php?ubah&kode={$data['nim']}'>EDIT</a>
                            <a href='mhs.php?hapus&nim={$data['nim']}'>DELETE</a>
                        </td>
                    </tr>";} else {
                            if ($data['nim'] == $userID) {
                                echo "
                    <tr>
                        <td>{$data['nim']}</td>
                        <td>{$data['nama']}</td>
                        <td>{$data['jenis_kelamin']}</td>
                        <td>{$data['no_hp']}</td>
                        <td><a href='mhs.php?ubah&kode={$data['nim']}'>EDIT</a></td>
                    </tr>";} else {
                        echo"
                    <tr>
                        <td>{$data['nim']}</td>
                        <td>{$data['nama']}</td>
                        <td>{$data['jenis_kelamin']}</td>
                        <td>{$data['no_hp']}</td>
                        <td></td>
                    </tr>";}
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
            <div class='form-mahasiswa'>
                <form action='mhs.php' method='POST'>
                    <table>
                        <tr>
                            <td>NIM</td>
                            <td><input type='text' name='nim' value='{$data['nim']}'></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
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
            </div>";} else {
                if ($userID == 'Adminstrator') {
                    echo "
            <div class='form-mahasiswa'>
                <form action='mhs.php' method='POST'>
                    <table>
                        <tr>
                            <td>NIM</td>
                            <td><input type='text' name='nim'></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
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
            }
            ?>
        </section>
    </main>
</body>

</html>