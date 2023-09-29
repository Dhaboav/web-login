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
    <title>Perulangan</title>
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
        <a href="nilai.php">Link 2</a>
        <a href="perulangan.php" style="color: black;">Link 3</a>
        <a href="#">Link 4</a>
        <a href="#">Link 5</a>
        <a href="?logout=1" class="logout">Logout</a>
    </nav>
    <section>
        <h1>Perulangan</h1>
        <article class="perulangan">
            <?php
            $ganjil = 1;
            echo "<p><b>Ganjil:</b></p>";
            while ($ganjil <= 10) {
                if ($ganjil % 2 != 0) {
                    echo "<p>The number is $ganjil</p>";
                }
                $ganjil++;
            }
            echo "<br><p><b>Genap:</b></p>";
            for ($genap = 10; $genap >= 1; $genap -= 2) {
                echo "<p>The number is $genap</p>";
            }
            ?>

        </article>
    </section>

</body>

</html>