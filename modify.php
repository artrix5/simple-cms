<?php
include 'connect.php';

if (isset($_POST['update'])) {

    // Get the article ID from the form data
    $id = $_POST['article_id'];
    // Check if the article exists in the database
    //$sql = "SELECT * FROM test WHERE id = $id";
    $stmt = mysqli_prepare($dbc, "SELECT * FROM test WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //$result = mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $title = (!empty($_POST['title'])) ? $_POST['title'] : $row['Title'];
        $summary = (!empty($_POST['summary'])) ? $_POST['summary'] : $row['Summary'];
        $content = (!empty($_POST['text'])) ? $_POST['text'] : $row['content'];
        $date = (!empty($_POST['date'])) ? $_POST['date'] : $row['date_published'];


         // Check if a new image file was uploaded
         if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
            $image = $_FILES['picture']['name'];
            $target_dir = 'img/' . $image;
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
        } else {
            $image = $row['picture'];
        }

        //$sql = "UPDATE test SET title = '$title', summary = '$summary', content = '$content', picture = '$image', date_published = '$date' WHERE id = $id";
        //mysqli_query($dbc, $sql);
        $stmt = mysqli_prepare($dbc, "UPDATE test SET title = ?, summary = ?, content = ?, picture = ?, date_published = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssssi", $title, $summary, $content, $image, $date, $id);
        mysqli_stmt_execute($stmt);
        echo "Article updated successfully.";

        // Redirect to a success page or display a success message
        //header('Location: success.php');
        //exit;

    } else {
        echo "Article not found.";
        // Redirect to a success page or display a success message
        //header('Location: success.php');
        //exit;
    }

} else if (isset($_POST['delete'])) {
    // Handle delete button click - delete article
    $id = $_POST['article_id'];
    //$sql = "DELETE FROM test WHERE id = $id";
    $stmt = mysqli_prepare($dbc, "DELETE FROM test WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    //mysqli_query($dbc, $sql);
    echo "Article deleted successfully.";

    // Redirect to a success page or display a success message
    //header('Location: success.php');
    exit;
}

mysqli_close($dbc);
?>