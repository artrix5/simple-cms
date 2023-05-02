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
                <li><a href="index.php">Job and career</a></li>
                <li><a href="index.php">Food</a></li>
                <li><a href="input.html">Contact</a></li>
            </ul>
        </nav>

    </header>


    <?php
    // Get the article ID from the query parameter
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // rest of your code for displaying the article with the given ID
    } else {
        echo "Article ID not provided.";
    }

    // Connect to the database
    $serverName = "localhost:3306";
    $username = "root";
    $password = "";
    $db = "Welt";
    $conn = mysqli_connect($serverName, $username, $password, $db) or die("Error" . mysqli_connect_error());

    // Query to retrieve the article details from the database
    $sql = "SELECT title, knjiga, picture, datum, category FROM test WHERE id = " . $id;

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display the article details
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<img src='" . $row["picture"] . "' alt='" . $row["title"] . "'>";
        echo "<p>" . $row["knjiga"] . "</p>";
        echo "<p>Date: " . $row["datum"] . "</p>";
        echo "<p>Category: " . $row["category"] . "</p>";
    } else {
        echo "Article not found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <footer>

        <h1>WELT</h1>

    </footer>

</body>

</html>