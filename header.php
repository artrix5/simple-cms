<header>
    <div class="header">
        <h1>WELT</h1>
        <?php
        session_start();
   
        if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
            $username = $_SESSION['username'];
            $level = $_SESSION['level'];
            
            echo "<div style='text-align: right;'>";
            echo "<form action='logout.php' method='POST'>";
            echo "<input type='submit' name='logout' class='logout-button' value='Logout'>";
            echo "</form>";
            echo "</div>";
        }

        else {
            echo "<div style='text-align: right;'>";
            echo "<form action='login.php' method='POST'>";
            echo "<button type='submit' name='login' class='login-button'>Login</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>

    </div>

    <nav>
        <ul class="main-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="category.php?category=politics">Politics</a></li>
            <li><a href="category.php?category=food">Food</a></li>
            <li><a href="login.php" onclick="check_permissions()">Administrator</a></li>
        </ul>
    </nav>
</header>