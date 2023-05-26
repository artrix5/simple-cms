<?php
$serverName = "localhost:3306";
$username = "root";
$password = "";
$db = "Welt";
// Create connection
$dbc = mysqli_connect($serverName, $username, $password, $db) or die('Error connecting to MySQL server.'); //.mysqli_error());
mysqli_set_charset($dbc, "utf8");
// Check connection
if ($dbc) {
    //echo "Connected successfully";
}
?>