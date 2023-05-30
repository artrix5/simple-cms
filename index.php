<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
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
            <ul class="main-menu-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
                <li><a href="insert.php">Insert</a></li>
                <li><a href="administrator.php">Admin</a></li>
            </ul>
        </nav>

    </header>

    <div class="background">

        <h2 class="subheading">POLITICS</h2>

        <section>
            <?php
            include 'connect.php';
            define('UPLPATH', 'img/');

            // Query to retrieve articles from the database
            $sql = "SELECT id, title, summary, picture, date_published, category FROM test WHERE archive = 0 AND category = 'Politics' ORDER BY date_published LIMIT 4";

            // Execute the query
            $result = mysqli_query($dbc, $sql);

            // Loop through the result set and display each article
            if (mysqli_num_rows($result) > 0) {
                $current_category = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<article>";
                    echo "<div class=\"image-container\">";
                    echo '<img src="' . UPLPATH . $row['picture'] . '">';
                    echo "</div>";
                    echo "<h3><a href='article.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h3>";
                    echo "<p>" . $row["summary"] . "</p>";
                    echo "<p>Date: " . $row["date_published"] . "</p>";
                    echo "</article>";
                }

            } else {
                echo "No articles found.";
            }

            // Close the database connection
            mysqli_close($dbc);
            ?>
        </section>

        <h2 class="subheading">FOOD</h2>


        <section>
            <?php
            include 'connect.php';

            // Query to retrieve articles from the database
            $sql = "SELECT id, title, summary, picture, date_published, category FROM test WHERE archive = 0 AND category = 'Food' ORDER BY date_published LIMIT 4";

            // Execute the query
            $result = mysqli_query($dbc, $sql);

            // Loop through the result set and display each article
            if (mysqli_num_rows($result) > 0) {
                $current_category = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<article>";
                    echo "<div class=\"image-container\">";
                    echo '<img src="' . UPLPATH . $row['picture'] . '">';
                    echo "</div>";
                    echo "<h3><a href='article.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h3>";
                    echo "<p>" . $row["summary"] . "</p>";
                    echo "<p>Date: " . $row["date_published"] . "</p>";
                    echo "</article>";
                }


            } else {
                echo "No articles found.";
            }

            // Close the database connection
            mysqli_close($dbc);
            ?>
        </section>
    </div>


    <footer>

        <h1 class="footer-title">WELT</h1>

    </footer>

</body>

</html>