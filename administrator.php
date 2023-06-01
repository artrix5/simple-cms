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
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>
    </header>

    <section class="container-admin">
        <div class="form-container">
            <form id="article-form" enctype="multipart/form-data" method="post" action="modify.php">
                <h2>Modify article:</h2>
                <label for="article_id">Article ID:</label>
                <input type="text" name="article_id" id="article_id" required>

                <label for="title">Title:</label>
                <input type="text" name="title" id="title">

                <label for="summary">Summary:</label>
                <textarea name="summary" id="summary"></textarea>

                <label for="text">Text:</label>
                <textarea name="text" id="text"></textarea>

                <label for="picture">Picture:</label>
                <input type="file" name="picture" id="picture"><br><br>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date"><br><br>

                <input type="submit" class="update-button" name="update" value="Update">
                <input type="submit" class="delete-button" name="delete" value="Delete">
                <input type="submit" class="clear-button" name="clear" value="Clear" onclick="clearForm()">

            </form>
        </div>

        <div class="navigation-bar">
            <ul>
                <li><a href="#">Modify</a></li>
                <li><a href="insert.php">Insert</a></li>
            </ul>
        </div>
    </section>

    <section>
        <div class="form-container">
            <form method="POST">
                <h2>Select Category:</h2>

                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="all">All</option>
                    <option value="politics">Politics</option>
                    <option value="food">Food</option>
                </select>
                <input type="submit" class="search-button" name="search" value="Search">

            </form>
        </div>
    </section>

    <div class="background">
        <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        if (isset($_POST['category']) && isset($_POST['search'])) {
            $category = $_POST['category'];

            // Query to retrieve articles from the database
            if ($category == "all") {
                $sql = "SELECT id, title, summary, picture, date_published, category FROM test ORDER BY date_published LIMIT 4";
                echo "<h2 class=\"subheading\">ALL</h2>";
            } else {
                $sql = "SELECT id, title, summary, picture, date_published, category FROM test WHERE category = '$category' ORDER BY date_published";
                echo "<h2 class=\"subheading\">" . strtoupper($category) . "</h2>";
            }

            echo "<section>";
            // Execute the query
            $result = mysqli_query($dbc, $sql);

            // Loop through the result set and display each article
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<article>";
                    echo "<input type='radio' name='article_checkbox' class='article-checkbox' onclick='setArticleId(this)' data-article-id='" . $row['id'] . "'>";
                    echo "<div class='image-container'>";
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
        } else {
            echo "Search articles!";
        }

        // Close the database connection
        mysqli_close($dbc);
        ?>

        </section>
    </div>

    <footer>
        <h1>WELT</h1>
    </footer>

    <script>
        function setArticleId(checkbox) {
            var articleIdInput = document.getElementById("article_id");
            var checkboxes = document.getElementsByClassName("article-checkbox");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== checkbox) {
                    checkboxes[i].checked = false;
                }
            }
            if (checkbox.checked) {
                articleIdInput.value = checkbox.getAttribute("data-article-id");
            } else {
                articleIdInput.value = "";
            }
        }

        function clearForm() {
            document.getElementById("article-form").reset();
        }

    </script>
</body>

</html>