<?php
include 'connect.php';

if (isset($_POST['update'])) {

    $id = $_POST['article_id'];

    $querySelect = "SELECT title, summary, content, picture, date_published, archive FROM test WHERE id = ?;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $querySelect)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    mysqli_stmt_bind_result($stmt, $titleOld, $summaryOld, $contentOld,  $imageOld, $dateOld, $archiveOld);
    mysqli_stmt_fetch($stmt); 

    if (mysqli_stmt_num_rows($stmt) > 0) {

        $titleNew = (!empty($_POST['title'])) ? $_POST['title'] : $titleOld;
        $summaryNew = (!empty($_POST['summary'])) ? $_POST['summary'] : $summaryOld;
        $contentNew = (!empty($_POST['text'])) ? $_POST['text'] : $contentOld;
        $dateNew = (!empty($_POST['date'])) ? $_POST['date'] : $dateOld;
        $archiveNew = (!empty($_POST['checkbox'])) ? 1 : $archiveOld;

        // Check if a new image file was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageNew = $_FILES['image']['name'];
            $target_dir = 'images/' . $imageNew;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir);
        } else {
            $imageNew = $imageOld;
        }

        mysqli_stmt_close($stmt);

        $queryUpdate = "UPDATE test SET title = ?, summary = ?, content = ?, picture = ?, date_published = ?, archive = ? WHERE id = ?;";
        
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $queryUpdate)) {
            mysqli_stmt_bind_param($stmt, 'sssssii', $titleNew, $summaryNew, $contentNew, $imageNew, $dateNew, $archiveNew, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            echo "Article updated successfully.";
        } else {
            echo "Article not found.";
        }
    }

    mysqli_stmt_close($stmt);

} else if (isset($_POST['delete'])) {

    $id = $_POST['article_id'];

    $queryDelete = "DELETE FROM test WHERE id = ?;";

    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $queryDelete)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
}

mysqli_close($dbc);

echo "Article deleted successfully.";
header("Location:administrator.php");
exit();

?>