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
                <li><a href="#">Home</a></li>
                <li><a href="#job_career">Job and career</a></li>
                <li><a href="#food">Food</a></li>
                <li><a href="input.html">Contact</a></li>
                <li><a href="administrator.php">Administrator</a></li>

            </ul>
        </nav>

    </header>

    <?php


    $serverName = "localhost:3306";
    $username = "root";
    $password = "";
    $db = "Welt";

    // Connect to the database
    $conn = mysqli_connect($serverName, $username, $password, $db) or die("Error" . mysqli_connect_error());

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to retrieve articles from the database
    $sql = "SELECT id, title, summary,picture, datum, category FROM test WHERE checkmark = 0 ORDER BY category";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Loop through the result set and display each article
    if (mysqli_num_rows($result) > 0) {
        $current_category = "";
        while ($row = mysqli_fetch_assoc($result)) {
            // Only display the category heading if it has changed
            if ($row["category"] != $current_category) {
                // Close the previous section (if there is one)
                if ($current_category != "") {
                    echo "</section>";
                }
                // Start a new section for the current category
                echo "<h2 id='" . strtolower($row["category"]) . "'>" . $row["category"] . "</h2>";
                echo "<h3><a href='article.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></h3>";
                echo "<section>";
                $current_category = $row["category"];
            }
            echo "<article>";
            echo "<img src='" . $row["picture"] . "' alt='" . $row["title"] . "'>";
            echo "<h3>" . $row["title"] . "</h3>";
            echo "<p>" . $row["summary"] . "</p>";
            echo "<p>Date: " . $row["datum"] . "</p>";
            echo "</article>";
        }
        // Close the last section
        echo "</section>";
    } else {
        echo "No articles found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>


    <footer>

        <h1>WELT</h1>

    </footer>

</body>

</html>