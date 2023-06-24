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
    <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
    <script src="../javascript/login_validation.js" type="text/javascript" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
</head>

<body>

    <?php
    include 'header.php';

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {

        $level = $_SESSION['level'];

        if ($level == 1) {
            header("Location: administration.php");
            exit();
        } else {
            echo "<script type='text/javascript'>alert('You do not have administrator rights.');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
            exit();
        }
    }

    ?>

    <section>
        <div class="container-left">
            <aside class="register-aside">
                <h1>Welcome!</h1>
                <p class="bigger-text">Create an account or sign in to continue.</p>
                <button id="register-button" class="register-button" onclick="showRegisterScreen()">Register</button>
            </aside>
        </div>
        <div id="background" class="container-right">
            <form method="POST" class="login-form">

                <h2 class="center">LOGIN</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off">
                <span id="errorUsername"></span>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span id="errorPassword"></span>

                <input type="submit" name="submit" id="submit" value="Login">

                <?php
                include 'connect.php';

                if ($dbc) {
                    if (isset($_POST["submit"])) {

                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        $query = "SELECT username, password, level FROM users WHERE username = ?;";

                        $stmt = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 's', $username);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        mysqli_stmt_bind_result($stmt, $user, $hashedPassword, $level);

                        mysqli_stmt_fetch($stmt);

                        if (mysqli_stmt_num_rows($stmt) > 0) {

                            if (password_verify($password, $hashedPassword)) {

                                $_SESSION['username'] = $user;
                                $_SESSION['level'] = $level;

                                // 1 is admin, 0 is normal user
                                if ($level == 1) {
                                    mysqli_stmt_close($stmt);
                                    mysqli_close($dbc);
                                    header("Location: administration.php");
                                    exit();
                                } else {
                                    mysqli_stmt_close($stmt);
                                    mysqli_close($dbc);
                                    header("Location: index.php");
                                    exit();
                                }
                            } else {
                                echo "<p class='red'>Wrong username or password.</p>";
                            }
                        } else {
                            echo "<p class='red'>The user doesn't exist.</p>";
                        }

                        mysqli_stmt_close($stmt);
                    }
                }

                mysqli_close($dbc);
                ?>

            </form>
        </div>
    </section>

    <?php include '../html/footer.html'; ?>

</body>

</html>