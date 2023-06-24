<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../javascript/register_validation.js" type="text/javascript" defer></script>
    <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <section>
        <div class="container-register">
            <form method="POST" class="register-form">
                <h2 class="center">REGISTER</h2>

                <label for="username">Username:</label>
                <input type="text" name="username" id="username" autocomplete="off" autofocus><br>
                <span id="errorUsername"></span>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password"><br>
                <span id="errorPassword"></span>

                <label for="passwordCheck">Repeat password:</label>
                <input type="password" name="passwordCheck" id="passwordCheck"><br>
                <span id="errorPasswordCheck"></span>

                <input type="submit" name="submit" id="submit" value="Register">

                <p class="center">Already have an account? <a class="login-link" href="login.php">Login here.</a></p>

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
                            echo "<p class='red'>The username is already taken.</p>";
                            mysqli_stmt_close($stmt);
                        } else {

                            $query = "INSERT INTO users (username, password, level) values (?, ?, ?)";
                            $stmt = mysqli_stmt_init($dbc);

                            if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, 'ssi', $username, $hashedPassword, $level);
                                mysqli_stmt_execute($stmt);

                                $_SESSION['username'] = $username;
                                $_SESSION['level'] = $level;

                                if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
                                    mysqli_stmt_close($stmt);
                                    mysqli_close($dbc);
                                    echo "<p class='green'>Registration successful!</p>";
                                    echo "<p class='black'>Redirecting in 3 seconds.</p>";
                                    header("refresh:3;url=index.php");
                                    exit();
                                }

                            } else {
                                echo "<p class='red'>Error.</p>";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                }
                mysqli_close($dbc);
                ?>

            </form>
    </section>

    <?php include '../html/footer.html'; ?>

</body>

</html>