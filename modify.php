<?php
include 'connect.php';

if (isset($_POST['update'])) {

    // Get the article ID from the form data
    $id = $_POST['article_id'];
    // Check if the article exists in the database
    $sql = "SELECT * FROM test WHERE id = $id";
    $result = mysqli_query($dbc, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $title = (!empty($_POST['title'])) ? $_POST['title'] : $row['title'];
        $summary = (!empty($_POST['summary'])) ? $_POST['summary'] : $row['summary'];
        $content = (!empty($_POST['text'])) ? $_POST['text'] : $row['content'];
        $date = (!empty($_POST['date'])) ? $_POST['date'] : $row['date'];


         // Check if a new image file was uploaded
         if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
            $image = $_FILES['picture']['name'];
            $target_dir = 'img/' . $picture;
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
        } else {
            $image = $row['picture'];
        }

        $sql = "UPDATE test SET title = '$title', summary = '$summary', content = '$content', picture = '$image', date_published = '$date' WHERE id = $id";
        mysqli_query($dbc, $sql);
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
    $sql = "DELETE FROM test WHERE id = $id";
    mysqli_query($dbc, $sql);
    echo "Article deleted successfully.";

    // Redirect to a success page or display a success message
    //header('Location: success.php');
    exit;
}

mysqli_close($dbc);
?>