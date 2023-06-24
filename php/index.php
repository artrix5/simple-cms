<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP, Javascript">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
</head>

<body>

    <?php
    include 'header.php';
    include 'connect.php';
    define('UPLPATH', '../images/');

    // show only articles that are not archived
    $archive = 0;

    $categoryPolitics = "Politics";

    $queryPolitics = "SELECT id, title, summary, picture, date_published FROM test WHERE category = ? AND archive = ? ORDER BY date_published LIMIT 4;";
    $stmtPolitics = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmtPolitics, $queryPolitics)) {
        mysqli_stmt_bind_param($stmtPolitics, 'si', $categoryPolitics, $archive);
        mysqli_stmt_execute($stmtPolitics);
        mysqli_stmt_store_result($stmtPolitics);
    }

    mysqli_stmt_bind_result($stmtPolitics, $id, $title, $summary, $image, $date_published);

    $categoryFood = "Food";

    $queryFood = "SELECT id, title, summary, picture, date_published FROM test WHERE category = ? AND archive = ? ORDER BY date_published LIMIT 4;";
    $stmtFood = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmtFood, $queryFood)) {
        mysqli_stmt_bind_param($stmtFood, 'si', $categoryFood, $archive);
        mysqli_stmt_execute($stmtFood);
        mysqli_stmt_store_result($stmtFood);
    }

    mysqli_stmt_bind_result($stmtFood, $id, $title, $summary, $image, $date_published);
    ?>

    <h2 class="heading">POLITICS</h2>

    <section>
        <?php
        if (mysqli_stmt_num_rows($stmtPolitics) > 0) {
            while (mysqli_stmt_fetch($stmtPolitics)) {
                echo "<article>";
                echo "<div class='image-container'>";
                echo '<img src="' . UPLPATH . $image . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "<p>" . $summary . "</p>";
                echo "<p>Date: " . $date_published . "</p>";
                echo "</article>";
            }
        } else {
            echo "<p class='red'>No articles found.</p>";
        }

        mysqli_stmt_close($stmtPolitics);
        ?>
    </section>

    <h2 class="heading">FOOD</h2>

    <section>
        <?php
        if (mysqli_stmt_num_rows($stmtFood) > 0) {
            while (mysqli_stmt_fetch($stmtFood)) {
                echo "<article>";
                echo "<div class='image-container'>";
                echo '<img src="' . UPLPATH . $image . '">';
                echo "</div>";
                echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
                echo "<p>" . $summary . "</p>";
                echo "<p>Date: " . $date_published . "</p>";
                echo "</article>";
            }
        } else {
            echo "<p class='red'>No articles found.</p>";
        }

        mysqli_stmt_close($stmtFood);
        ?>
    </section>

    <?php include '../html/footer.html';
    mysqli_close($dbc);
    ?>

</body>

</html>