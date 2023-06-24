<?php
header('Content-Type: text/html; charset=utf-8');

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "Welt";

$dbc = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$dbc) {
    die("Error connecting to MySQL server: " . mysqli_connect_error());
}

mysqli_set_charset($dbc, "utf8");

?>