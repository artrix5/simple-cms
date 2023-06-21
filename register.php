<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT - Register</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="register_validation.js" type="text/javascript" defer></script>

</head>

<body>

    <?php include 'header.php'; ?>

    <section>
        <div class="container-register">
            <form method="POST" class="register-form">
                <h2 class="center">REGISTER</h2>

                <label for="username">Username:</label>
                <input type="text" name="username" id="username" autocomplete="off" autofocus required><br>
                <span id="errorUsername"></span>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>
                <span id="errorPassword"></span>

                <label for="passwordCheck">Repeat password:</label>
                <input type="password" name="passwordCheck" id="passwordCheck" required><br>
                <span id="errorPasswordCheck"></span>

                <input type="submit" name="submit" id="submit" value="Register">

                <p class="center">Already have an account? <a class="login-link" href="login.php">Login here.</a>
                </p>
            </form>
    </section>

    <?php
    include 'connect.php';

    if ($dbc) {
        if (isset($_POST["submit"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordCheck = $_POST["passwordCheck"];
            $hashedPassword = password_hash($password, CRYPT_BLOWFISH);
            $level = 0;
            $query = "SELECT username FROM users WHERE username = ?";

            $stmt = mysqli_stmt_init($dbc);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }

            mysqli_stmt_fetch($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                echo "<script type='text/javascript'>";
                echo "document.getElementById('username').style.border = '1px solid red';";
                echo "document.getElementById('errorUsername').innerHTML = 'Username already exists!';";
                echo "document.getElementById('errorUsername').style.color = 'red';";
                echo "</script>";
            } else {

                $query = "INSERT INTO users (username, password, level) values (?, ?, ?)";
                $stmt = mysqli_stmt_init($dbc);

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssi', $username, $hashedPassword, $level);
                    mysqli_stmt_execute($stmt);

                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $level;

                    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {

                        header("location:index.php");
                        exit();
                    }

                } else {
                    echo "Error.";
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