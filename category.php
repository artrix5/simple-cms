<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>

        <h1>WELT</h1>

        <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="category.php?category=politics">Politics</a></li>
            <li><a href="category.php?category=food">Food</a></li>
            <li><a href="login.php">Administrator</a></li>
        </ul>
        </nav>


        <?php

        include 'connect.php';
        define('UPLPATH', 'img/');


        $selectedCategory = $_GET['category'];

        // Prepare the SQL query with a condition for the selected category
        
        $sql = "SELECT * FROM test WHERE category = '$selectedCategory'";


        // Execute the query
        $result = mysqli_query($dbc, $sql);

        // Initialize a counter variable
        $articleCount = 0;

        // Loop through the result set and display each article
        if (mysqli_num_rows($result) > 0) {
            echo "<section>";
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the current article count is a multiple of 4
                if ($articleCount % 4 === 0 && $articleCount !== 0) {
                    echo "</section><section>"; // Start a new section
                }

                echo "<article>";
                echo '<img src="' . UPLPATH . $row['picture'] . '">';
                echo "<h3><a href='article.php?id=" . $row["id"] . "'>" . $row["Title"] . "</a></h3>";
                echo "<p>" . $row["Summary"] . "</p>";
                echo "<p>Date: " . $row["date_published"] . "</p>";
                echo "</article>";

                $articleCount++;
            }

            echo "</section>";
        } else {
            echo "No articles found.";
        }

        // Close the database connection
        mysqli_close($dbc);
        ?>
        </section>


        <footer>

            <h1>WELT</h1>

        </footer>

</body>

</html>