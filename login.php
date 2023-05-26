<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header>

        <div class="title-container">
            <h1>WELT</h1>
            <h2 class="align-right"><a href="login.php">Login</a></h2>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>

    </header>

    <h1>Login</h1>

    <section class="section_login">

        <div class="container-left">
            <img class="image-login" src="earth.jpg" alt="Image">
            <a href="register.php" class="button-register">Register</a>
        </div>


        <div class="container-right">
            <form method="POST" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" name="submit" value="Login">
            </form>
        </div>

    </section>

    <?php

    $servername = "localhost:3306";
    $user = "root";
    $pass = "";
    $db = "welt";

    $dbc = mysqli_connect($servername, $user, $pass, $db) or die("Error" . mysqli_connect_error());

    if ($dbc) {
        if (isset($_POST["submit"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];

            $userSelect = "SELECT * FROM users WHERE username = '$username';";
            $result = mysqli_query($dbc, $userSelect) or die("Error");
            $row = mysqli_fetch_array($result);

            if (password_verify($password, $row["password"])) {
                echo "Login successful!";
                header("Location: insert.php"); // Redirect to administrator.php
                exit; // Terminate the script after redirection
            } else {
                echo "Wrong username or password!";
            }
        }
    }
    mysqli_close($dbc);
    ?>
    <footer>

        <h1>WELT</h1>

    </footer>

</body>

</html>