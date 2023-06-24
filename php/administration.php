<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../javascript/fetch_id.js" type="text/javascript" defer></script>
    <script src="../javascript/update_validation.js" type="text/javascript" defer></script>
    <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <section>

        <div class="form-container">
            <form id="modify-form" action="script.php" enctype="multipart/form-data" method="POST">

                <?php

                if (isset($_SESSION['username']) && isset($_SESSION['level'])) {

                    $username = $_SESSION['username'];
                    $level = $_SESSION['level'];

                    if ($level == 1) {
                        echo "<p class='green'>Welcome $username.</p>";
                        echo "<p class='black'>You have administrator rights. </p>";
                    }
                }

                ?>

                <h2>MODIFY AN EXISTING ARTICLE:</h2>
                <label for="article_id">Article ID:</label>
                <input type="number" name="article_id" id="article_id" required>
                <span id="errorID"></span>

                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
                <span id="errorTitle"></span>

                <label for="summary">Summary:</label>
                <textarea name="summary" id="summary"></textarea>
                <span id="errorSummary"></span>

                <label for="text">Text:</label>
                <textarea name="text" id="text"></textarea>

                <div>
                    <label for="image">Picture:</label>
                    <input type="file" name="image" id="image">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                </div>

                <label for="checkbox">Save to archive?</label>
                <input type="checkbox" name="checkbox" id="checkbox">
                <div>
                    <input type="submit" class="update-button" value="Update" name="update" id="update">
                    <input type="submit" class="delete-button" value="Delete" name="delete" id="delete">
                    <input type="button" class="clear-button" value="Clear" name="clear" id="clear"
                        onclick="clearEverything('modify-form','article_checkbox')">
                </div>
            </form>
        </div>

        <aside class="aside">
            <ul>
                <li><a href="#">MODIFY</a></li>
                <li><a href="insert.php">INSERT</a></li>
            </ul>
        </aside>

    </section>

    <hr>

    <section>

        <div class="form-container-search">
            <form method="POST">
                <h2>FIND AND SELECT ARTICLE ID:</h2>
                <select id="category" name="category">
                    <option class="bigger-text" value="politics">Politics</option>
                    <option class="bigger-text" value="food">Food</option>
                </select>
                <input type="submit" class="search-button" name="search" value="Search">
            </form>
        </div>
    </section>

    <?php
    include 'connect.php';
    define('UPLPATH', '../images/');

    if (isset($_POST['category']) && isset($_POST['search'])) {

        $category = $_POST['category'];

        $query = "SELECT id, title, summary, picture, date_published FROM test WHERE category = ? ORDER BY date_published LIMIT 20;";

        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $category);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $id, $title, $summary, $image, $date_published);

        $articleCount = 0;

        echo "<section class='light-gray'>";

        if (mysqli_stmt_num_rows($stmt) > 0) {

            while (mysqli_stmt_fetch($stmt)) {

                if ($articleCount % 4 === 0 && $articleCount !== 0) {
                    echo "</section><section class='light-gray'>";
                }

                echo "<article>";
                echo "<input type='radio' name='article_checkbox' class='article-checkbox' onclick='setArticleId(this)' data-article-id='" . $id . "'>";
                echo "<div class='image-container'>";
                echo '<img src="' . UPLPATH . $image . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "<p>" . $summary . "</p>";
                echo "<p>Date: " . $date_published . "</p>";
                echo "</article>";

                $articleCount++;
            }
        } else {
            echo "<p class='red'>No articles found.</p>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($dbc);
    ?>

    </section>

    <?php include '../html/footer.html'; ?>

</body>

</html>