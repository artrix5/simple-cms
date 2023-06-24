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
</head>

<body>

    <section>

        <?php
        include 'connect.php';

        $allowedExtensions = ['jpg', 'jpeg', 'png']; // Allowed image extensions
        $allow = 0;

        $id = $_POST['article_id'];

        $querySelect = "SELECT title, summary, content, picture, date_published, archive FROM test WHERE id = ?;";

        $stmtSelect = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmtSelect, $querySelect)) {
            mysqli_stmt_bind_param($stmtSelect, 'i', $id);
            mysqli_stmt_execute($stmtSelect);
            mysqli_stmt_store_result($stmtSelect);
        }

        mysqli_stmt_bind_result($stmtSelect, $titleOld, $summaryOld, $contentOld, $imageOld, $dateOld, $archiveOld);
        mysqli_stmt_fetch($stmtSelect);

        if (isset($_POST['update'])) {

            if (mysqli_stmt_num_rows($stmtSelect) > 0) {

                $titleNew = (!empty($_POST['title'])) ? $_POST['title'] : $titleOld;
                $summaryNew = (!empty($_POST['summary'])) ? $_POST['summary'] : $summaryOld;
                $contentNew = (!empty($_POST['text'])) ? $_POST['text'] : $contentOld;
                $dateNew = (!empty($_POST['date'])) ? $_POST['date'] : $dateOld;
                $archiveNew = (!empty($_POST['checkbox'])) ? 1 : 0;

                // Check if a new image file was uploaded
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $imageNew = $_FILES['image']['name'];
                    $imageExtension = strtolower(pathinfo($imageNew, PATHINFO_EXTENSION));

                    // Check if the uploaded file has an allowed image extension
                    if (!in_array($imageExtension, $allowedExtensions)) {
                        echo "<div class='middle'>";
                        echo "<p class='red'>Invalid file format. Only JPG, JPEG, and PNG files are allowed.</p>";
                        $allow = 0;
                    } else {
                        $target_dir = '../images/' . $imageNew;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir);
                        $allow = 1;
                    }
                } else {
                    $imageNew = $imageOld;
                    $allow = 1;
                }

                mysqli_stmt_close($stmtSelect);

                $queryUpdate = "UPDATE test SET title = ?, summary = ?, content = ?, picture = ?, date_published = ?, archive = ? WHERE id = ?;";

                if ($allow != 0) {

                    $stmtUpdate = mysqli_stmt_init($dbc);

                    if (mysqli_stmt_prepare($stmtUpdate, $queryUpdate)) {
                        mysqli_stmt_bind_param($stmtUpdate, 'sssssii', $titleNew, $summaryNew, $contentNew, $imageNew, $dateNew, $archiveNew, $id);
                        mysqli_stmt_execute($stmtUpdate);
                        mysqli_stmt_store_result($stmtUpdate);
                        echo "<div class='middle'>";
                        echo "<p class='green'>Article updated successfully.</p>";
                    } else {
                        echo "<div class='middle'>";
                        echo "<p class='red'>Error updating article.</p>";
                    }

                    mysqli_stmt_close($stmtUpdate);

                } else {
                    echo "<p class='red'>Article update failed.</p>";
                }
            } else {
                echo "<div class='middle'>";
                echo "<p class='red'>Article with ID $id not found.</p>";
            }

            mysqli_close($dbc);
            echo "<p class='black'>Redirecting in 4 seconds.</p>";
            echo "</div>";
            header("refresh:4;url=administration.php");
            exit();

        } else if (isset($_POST['delete'])) {

            if (mysqli_stmt_num_rows($stmtSelect) > 0) {

                mysqli_stmt_close($stmtSelect);

                $queryDelete = "DELETE FROM test WHERE id = ?;";

                $stmtDelete = mysqli_stmt_init($dbc);

                if (mysqli_stmt_prepare($stmtDelete, $queryDelete)) {
                    mysqli_stmt_bind_param($stmtDelete, 'i', $id);
                    mysqli_stmt_execute($stmtDelete);
                    mysqli_stmt_store_result($stmtDelete);
                    echo "<div class='middle'>";
                    echo "<p class='green'>Article deleted successfully.</p>";
                } else {
                    echo "<div class='middle'>";
                    echo "<p class='red'>Error deleting article.</p>";
                }

                mysqli_stmt_close($stmtDelete);

            } else {
                echo "<div class='middle'>";
                echo "<p class='red'>Article with ID $id not found.</p>";
            }

            mysqli_close($dbc);
            echo "<p class='black'>Redirecting in 4 seconds.</p>";
            echo "</div>";
            header("refresh:4;url=administration.php");
            exit();
        }

        ?>

    </section>

</body>

</html>