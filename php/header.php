<header>
    <div class="header">
        <div class='header-left'>
            <h1 class="title">WELT</h1>
        </div>

        <?php

        session_start();

        if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
            $username = $_SESSION['username'];
            $level = $_SESSION['level'];

            echo "<div class='header-right'>";
            echo "<button onclick='confirmLogout()' class='logout-button'>Logout</button>";
            echo "</div>";
        } else {
            echo "<div class='header-right'>";
            echo "<button onclick='login()' class='login-button'>Login</button>";
            echo "</div>";
        }

        ?>

    </div>

    <?php include '../html/navigation.html'; ?>

</header>