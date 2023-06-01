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
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>
    </header>


    <section class="container-middle">
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
            $query = "SELECT username FROM users WHERE username = ?";
            //$result = mysqli_query($dbc, $query) or die("Error");

            /* Inicijalizira statement objekt nad konekcijom */
            $stmt1 = mysqli_stmt_init($dbc);
            /* Povezuje parametre statement objekt s upitom */
            if (mysqli_stmt_prepare($stmt1, $query)) {
                /* Povezuje parametre i njihove tipove s statement objektom */
                mysqli_stmt_bind_param($stmt1, 's', $username);
                /* Izvršava pripremljeni upit i pohranjuje rezultate */
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_store_result($stmt1);
            }
            /* Povezuje atribute iz rezultata s varijablama */
            mysqli_stmt_bind_result($stmt1, $a);
            /* Dohvaća redak iz rezultata, i posprema vrijednosti atributa u varijable
           navedene funkcijom mysqli_stmt_bind_result() */
            mysqli_stmt_fetch($stmt1);

            if (mysqli_stmt_num_rows($stmt1) > 0) {
                echo ('Username already exists!');
            }

            //if (mysqli_num_rows($result) >= 1) {
               // echo "Username already exists!";
            //} 

            else if ($password != $passwordCheck) {
                echo "Passwords do not match!";
            } else {

                $sql = "INSERT INTO users (username, password, level) values (?, ?, 0)";
                /* Inicijalizira statement objekt nad konekcijom */
                $stmt = mysqli_stmt_init($dbc);
                /* Povezuje parametre statement objekt s upitom */
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    /* Povezuje parametre i njihove tipove s statement objektom */
                    mysqli_stmt_bind_param($stmt, 'ss', $username, $hashPassword);
                    /* Izvršava pripremljeni upit */
                    mysqli_stmt_execute($stmt);
                    echo "Registration successful!";
                    header("Location: administrator.php"); // Redirect to administrator.php
                    exit(); // Terminate the current script

                } else {
                    echo "Error.";
                }

                //$insertQuery = "INSERT INTO users (username, password, level) VALUES ('$username','$hashPassword', 0);";
                //
                //if ($result === true) {
                // echo "Registration successful!";
                //}
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