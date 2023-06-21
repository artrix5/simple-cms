<?php
    session_start();
    
    // Function to logout and destroy session
    function logout() {
        // Clear all session variables
        $_SESSION = array();
        
        // Destroy the session
        session_destroy();
        
        // Redirect the user to the login page or any other appropriate page
        header("Location: login.php");
        exit();
    }
    
    // Check if the logout request is received
    if (isset($_POST['logout'])) {
        logout();

    } else {
        // Handle the case where the logout request is not received
        echo "Invalid logout request.";
    }
?>