<?php

$serverName = "localhost:3306";
$username = "root";
$password = "";
$db = "Welt";

$dbc = mysqli_connect($serverName, $username, $password, $db) or die("Error" . mysqli_connect_error());

if (isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['text']) && isset($_POST['category']) && isset($_POST['picture']) && isset($_POST['date'])) {

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $picture = $_POST['picture'];
    $date = $_POST['date'];

    $checkbox = isset($_POST['checkbox']) ? 1 : 0;


    // Insert form data into database
    $query = "INSERT INTO test (title, summary, knjiga, category, picture, datum, checkmark) 
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


