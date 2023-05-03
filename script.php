<?php
include 'connect.php';

if (isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['text']) && isset($_POST['category']) && isset($_POST['date'])) {

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $date = $_POST['date'];


    $checkbox = isset($_POST['checkbox']) ? 1 : 0;

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $picture = $_FILES['picture']['name'];
        $target_dir = 'img/' . $picture;
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
    } else {
        $picture = '';
    }


    // Insert form data into database
    $query = "INSERT INTO test (title, summary, content, category, picture, date_published, archive) 
          VALUES ('$title', '$summary', '$text', '$category', '$picture', '$date', '$checkbox')";
    $result = mysqli_query($dbc, $query) or die("Error" . mysqli_error($dbc));

    if ($result) {
        // Display success message
        echo "Form data successfully added to the database.";
    } else {
        // Display error message
        echo "Error adding form data to the database.";
    }

} else {
    echo "Enter all fields before submitting.";
}

mysqli_close($dbc);

?>