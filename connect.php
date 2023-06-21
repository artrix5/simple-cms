<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "Welt";

$dbc = mysqli_connect($server, $user, $pass, $db) or die('Error connecting to MySQL server: ' . mysqli_connect_error());
mysqli_set_charset($dbc, "utf8");

?>