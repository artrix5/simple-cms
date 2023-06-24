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
    <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
</head>

<body>

    <?php
    include 'header.php';
    include 'connect.php';
    define('UPLPATH', '../images/');

    // show only articles that are not archived
    $archive = 0;

    $selectedCategory = $_GET['category'];

    echo "<h2 class='heading'>" . strtoupper($selectedCategory) . "</h2>";

    echo "<section>";

    $query = "SELECT id, title, summary, picture, date_published FROM test WHERE category = ? AND archive = ? ORDER BY date_published LIMIT 40;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $selectedCategory, $archive);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    mysqli_stmt_bind_result($stmt, $id, $title, $summary, $image, $date_published);

    $articleCount = 0;

    if (mysqli_stmt_num_rows($stmt) > 0) {

        while (mysqli_stmt_fetch($stmt)) {

            if ($articleCount % 4 === 0 && $articleCount !== 0) {
                echo "</section><section>";
            }

            echo "<article>";
            echo "<div class='image-container'>";
            echo '<img src="' . UPLPATH . $image . '">';
            echo "</div>";
            echo "<h3><a href='article.php?id=" . $id . "'>" . $title . "</a></h3>";
            echo "<p>" . $summary . "</p>";
            echo "<p>Date: " . $date_published . "</p>";
            echo "</article>";

            $articleCount++;
        }

        echo "</section>";
    } else {
        echo "<p class='red'>No articles found.</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($dbc);
    ?>

    </section>

    <?php include '../html/footer.html'; ?>

</body>

</html>