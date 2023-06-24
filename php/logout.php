<?php

// Destroy all sessions
session_start();
session_destroy();

// Redirect the user to the login page or any other desired location
header("Location: login.php");
exit();

?>