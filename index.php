<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP, Javascript">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <h2 class="heading">POLITICS</h2>

    <section>
        <?php
        include 'connect.php';
        define('UPLPATH', 'images/');

        $category = "Politics";
        $archive = 0;

        $query = "SELECT id, title, summary, picture, date_published, category FROM test WHERE category = ? AND archive = ? ORDER BY date_published LIMIT 4;";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'si', $category, $archive);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $id, $title, $summary, $image, $date_published, $category);

        if (mysqli_stmt_num_rows($stmt) > 0) {

            while (mysqli_stmt_fetch($stmt)) {
                echo "<article>";
                echo "<div class=\"image-container\">";
                echo '<img src="' . UPLPATH . $image . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "<p>" . $summary . "</p>";
                echo "<p>Date: " . $date_published . "</p>";
                echo "</article>";
            }

        } else {
            echo "No articles found.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
        ?>

    </section>

    <h2 class="heading">FOOD</h2>

    <section>
        <?php
        include 'connect.php';

        $query = "SELECT id, title, summary, picture, date_published, category FROM test WHERE category = ? AND archive = ? ORDER BY date_published LIMIT 4;";
        $stmt = mysqli_stmt_init($dbc);

        $category = "Food";
        $archive = 0;

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'si', $category, $archive);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $id, $title, $summary, $image, $date_published, $category);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                echo "<article>";
                echo "<div class=\"image-container\">";
                echo '<img src="' . UPLPATH . $image . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "<p>" . $summary . "</p>";
                echo "<p>Date: " . $date_published . "</p>";
                echo "</article>";
            }

        } else {
            echo "No articles found.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
        ?>

    </section>

    <footer>

        <h1>WELT</h1>

    </footer>

</body>

</html>