<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-container">

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p>Invalid username or password</p>';
        }
        ?>

        <form action="process.php" method="post">
            <input type="text" name="userID" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>

</html>