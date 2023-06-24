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

    <?php include 'header.php'; ?>

    <?php
    include 'connect.php';
    define('UPLPATH', '../images/');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "Article ID not provided.";
    }

    $query = "SELECT title, content, picture, date_published, category FROM test WHERE id = ?;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    mysqli_stmt_bind_result($stmt, $title, $text, $image, $date_published, $category);
    mysqli_stmt_fetch($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        echo "<section>";
        echo "<article class='article-container'>";
        echo "<h2>" . $title . "</h2>";
        echo "<p>Date: " . $date_published . "</p>";
        echo "<div class='article-image-container'>";
        echo "<img src='" . UPLPATH . $image . "' alt='" . $title . "'>";
        echo "</div>";
        echo "<p>" . $text . "</p>";
        echo "</article>";

    } else {
        echo "Article not found.";
    }

    echo "</section>";


    mysqli_stmt_close($stmt);
    mysqli_close($dbc);

    ?>

    <?php include '../html/footer.html'; ?>

</body>

</html>