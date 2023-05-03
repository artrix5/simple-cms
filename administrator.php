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
                <li><a href="insert.html">Insert</a></li>
                <li><a href="administrator.php">Administrator</a></li>
            </ul>
        </nav>

    </header>


    <form action="modify_article.php" method="post">
        <label for="action">Select an action:</label>
        <select name="action" id="action">
            <option value="modify">Modify</option>
            <option value="delete">Delete</option>
        </select>
        <label for="article_id">Article ID:</label>
        <input type="text" name="article_id" required><br><br>
        <label for="headline">Headline:</label>
        <input type="text" name="headline"><br><br>
        <label for="content">Content:</label>
        <textarea name="content"></textarea><br><br>
        <label for="image">Image URL:</label>
        <input type="text" name="image"><br><br>
        <label for="delete">Delete Article:</label>
        <input type="checkbox" name="delete"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // Include the database connection file
    include 'connect.php';

    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        // Get the article ID from the form data
        $id = $_POST['article_id'];

        // Check if the article exists in the database
        $sql = "SELECT * FROM test WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // If the delete checkbox is checked, delete the article from the database
            if (isset($_POST['delete'])) {
                $sql = "DELETE FROM test WHERE id = $id";
                mysqli_query($conn, $sql);
                echo "Article deleted successfully.";
            } else {
                // If the delete checkbox is not checked, update the article in the database
                $headline = isset($_POST['headline']) ? $_POST['headline'] : $row['title'];
                $content = isset($_POST['content']) ? $_POST['content'] : $row['knjiga'];
                $image = isset($_POST['image']) ? $_POST['image'] : $row['picture'];

                $sql = "UPDATE test SET title = '$headline', knjiga = '$content', picture = '$image' WHERE id = $id";
                mysqli_query($conn, $sql);
                echo "Article updated successfully.";
            }
        } else {
            echo "Article not found.";
        }
    }

    // Close the database connection
    mysqli_close($dbc);
    ?>


    <footer>

        <h1>WELT</h1>

    </footer>

</body>

</html>