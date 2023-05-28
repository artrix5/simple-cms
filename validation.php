<?php
    session_start();
    
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
            $level = $row['level'];


            if (password_verify($password, $row["password"])) {
                $_SESSION["username"] = $username;
                $_SESSION['level'] = $level;
                echo "Login successful!";

                if ($level == 1) {
                    header("Location: administrator.php"); // Redirect to administrator.php
                    exit; // Terminate the script after redirection
                } else {
                    header("Location: index.php"); // Redirect to index.php
                    exit; // Terminate the script after redirection
                }

            } else {
                echo "Wrong username or password!";
            }
        }
    }
    mysqli_close($dbc);
    ?>