<?php
session_start();

// Check if the login session exists
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // If the session doesn't exist or is not set to true, redirect to the login page
    header('Location: ../login.php');
    exit; // Terminate the script
}

// Logout action
if (isset($_GET['logout'])) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    header('Location: ../login.php'); // Redirect to the login page
    exit; // Terminate the script
}
?>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Nilai</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>
            <a href="index.php">Penikmat Konten</a>
        </h1>
    </header>
    <nav>
        <a href="form.php">Link 1</a>
        <a href="nilai.php" style="color: black;">Link 2</a>
        <a href="perulangan.php">Link 3</a>
        <a href="#">Link 4</a>
        <a href="#">Link 5</a>
        <a href="?logout=1" class="logout">Logout</a>
    </nav>
    <section>
        <h1>Kategori Nilai</h1>
        <article class="calc">
            <form action="" method="get">
                <input type="number" name="nilai-input" placeholder="Nilai" required>
                <button type="submit" name="hitung">Hitung</button>
            </form>
            <div class="calc-result">
                <?php
                if (isset($_GET['hitung'])) {
                    $range = false;
                    $lulus = false;
                    $nilai = $_GET['nilai-input'];
                    echo "<p> Nilai: $nilai </p>";
                    if ($nilai >= 0 && $nilai <= 100) {
                        $range = true;
                        if ($nilai >= 80) {
                            echo "<p>Kategori: A</p>";
                            $lulus = true;
                        } elseif ($nilai >= 70) {
                            echo "<p>Kategori: B</p>";
                            $lulus = true;
                        } elseif ($nilai >= 60) {
                            echo "<p>Kategori: C</p>";
                        } elseif ($nilai >= 50) {
                            echo "<p>Kategori: D</p>";
                        } else {
                            echo "<p>Kategori: E</p>";
                        }

                        if ($lulus) {
                            echo "<p> Anda Lulus Passing Grade </p>";
                        } else {
                            echo "<p> Anda Tidak Lulus Passing Grade </p>";
                        }
                    } else {
                        echo "<p>Masukan dari 0-100!</p>";
                    }
                }
                ?>
            </div>
        </article>
    </section>

</body>

</html>