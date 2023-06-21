<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="background_changer.js" type="text/javascript" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

</head>

<body>

    <?php include 'header.php'; ?>

    <section>
        <div class="container-left">
            <aside class="register-aside">
                <h1>Welcome!</h1>
                <p class="bigger-text">Create an account or sign in to continue.</p>
                <button id="register-button" class="register-button">Register</button>
            </aside>
        </div>
        <div id="changeBackground" class="container-right">
            <form method="POST" class="login-form">
                <h2 class="center">LOGIN</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off" autofocus required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span id="error"></span>

                <input type="submit" name="submit" id="submit" value="Login">
            </form>
        </div>
    </section>

    <?php
    include 'connect.php';

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {

        $username = $_SESSION['username'];
        $level = $_SESSION['level'];

        if ($level == 1) {
            header("Location: administrator.php");
            exit();
        } else {
            echo "<script>alert('You do not have administrator rights.');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
            exit();
        }
    }

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

            mysqli_stmt_bind_result($stmt, $usernameCheck, $hashedPassword, $level);

            mysqli_stmt_fetch($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {

                if (password_verify($password, $hashedPassword)) {
                    echo "Login successful!";

                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $level;

                    if ($level == 1) {
                        header("Location: administrator.php");
                        exit();
                    } else {
                        header("Location: index.php");
                        exit();
                    }
                } else {
                    echo "<script type='text/javascript'>";
                    echo "document.getElementById('username').style.border = '1px solid red';";
                    echo "document.getElementById('password').style.border = '1px solid red';";
                    echo "document.getElementById('error').innerHTML = 'Wrong username or password!';";
                    echo "document.getElementById('error').style.color = 'red';";
                    echo "</script>";
                }
            } else {
                echo "<script type='text/javascript'>";
                echo "document.getElementById('username').style.border = '1px solid red';";
                echo "document.getElementById('password').style.border = '1px solid red';";
                echo "document.getElementById('error').innerHTML = 'The user does not exist!';";
                echo "document.getElementById('error').style.color = 'red';";
                echo "</script>";
            }
        }
    }

    mysqli_close($dbc);
    ?>

    <script type="text/javascript">
        // Get the button element
        var registerButton = document.getElementById('register-button');

        // Add a click event listener to the button
        registerButton.addEventListener('click', function () {
            // Redirect to the register.php page
            window.location.href = 'register.php';
        });

    </script>

    <footer>
        <h1>WELT</h1>
    </footer>

</body>

</html>