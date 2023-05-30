<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT - Register</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="basic-styles.css">
    <link rel="stylesheet" href="class-styles.css">

</head>

<body>
    <header>

        <div class="heading-container">
            <h1>WELT</h1>
        </div>

        <nav>
            <ul class="main-menu-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>
    </header>


    <section>
        <div>
            <form method="POST" class="login-form">
                <h2 class="center">Register</h2>

                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br><br>

                <label for="passwordCheck">Repeat password:</label>
                <input type="password" name="passwordCheck" id="passwordCheck" required><br><br>

                <input type="submit" name="submit" value="Register">

                <p class="center">Already have an account? <a class="login-link" href="login.php">Login here.</a>
            </p>

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
            $passwordCheck = $_POST["passwordCheck"];
            $hashPassword = password_hash($password, CRYPT_BLOWFISH);
            $query = "SELECT username FROM users WHERE username = '$username';";
            $result = mysqli_query($dbc, $query) or die("Error");

            if (mysqli_num_rows($result) >= 1) {
                echo "Username already exists!";
            } else if ($password != $passwordCheck) {
                echo "Passwords do not match!";
            } else {
                $insertQuery = "INSERT INTO users (username, password, level) VALUES ('$username','$hashPassword', 0);";
                $result = mysqli_query($dbc, $insertQuery) or die("Error");

                if ($result === true) {
                    echo "Registration successful!";
                }
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