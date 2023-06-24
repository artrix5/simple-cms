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
  <script src="../javascript/insert_validation.js" type="text/javascript" defer></script>
  <script src="../javascript/fetch_id.js" type="text/javascript" defer></script>
  <script src="../javascript/login_functions.js" type="text/javascript" defer></script>
</head>

<body>

  <?php include 'header.php'; ?>

  <section>

    <div class="form-container">

      <form id="insert-form" enctype="multipart/form-data" method="POST">

        <?php

        if (isset($_SESSION['username']) && isset($_SESSION['level'])) {

          $username = $_SESSION['username'];
          $level = $_SESSION['level'];

          if ($level == 1) {
            echo "<p class='green'>Welcome $username.</p>";
            echo "<p class='black'>You have administrator rights. </p>";
          }

        }

        ?>

        <h2>CREATE A NEW ARTICLE:</h2>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <span id="errorTitle"></span>

        <label for="summary">Summary:</label>
        <textarea name="summary" id="summary"></textarea>
        <span id="errorSummary"></span>

        <label for="text">Text:</label>
        <textarea name="text" id="text"></textarea>
        <span id="errorText"></span>

        <label for="category">Category:</label>
        <select name="category" id="category">
          <option class="bigger-text" value="">Select a category:</option>
          <option class="bigger-text" value="Politics">Politics</option>
          <option class="bigger-text" value="Food">Food</option>
        </select>
        <span id="errorCategory"></span>

        <div>
          <label for="image">Image:</label>
          <input type="file" name="image" id="image">
          <span id="errorImage"></span>
          <label for="date">Enter a date:</label>
          <input type="date" name="date" id="date">
          <span id="errorDate"></span>
        </div>

        <label for="checkbox">Save to archive?</label>
        <input type="checkbox" name="checkbox" id="checkbox">

        <div>
          <input type="submit" class="insert-button" value="Create" name="submit" id="submit">
          <input type="button" class="clear-button" value="Clear" name="clear" id="clear"
            onclick="clearForm('insert-form')">
        </div>

      </form>
    </div>

    <aside class="aside">
      <ul>
        <li><a href="administration.php">MODIFY</a></li>
        <li><a href="#">INSERT</a></li>
      </ul>
    </aside>

  </section>

  <hr>

  <?php
  include 'connect.php';
  define('UPLPATH', '../images/');

  $allow = 0;
  $success = 0;
  $allowedExtensions = ['jpg', 'jpeg', 'png']; // Allowed image extensions
  
  echo "<section class='section-vertical'>";

  if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $date_published = $_POST['date'];
    $archive = isset($_POST['checkbox']) ? 1 : 0;


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $image = $_FILES['image']['name'];
      $imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

      // Check if the uploaded file has an allowed image extension
      if (!in_array($imageExtension, $allowedExtensions)) {
        echo "<p class='red'>Invalid file format. Only JPG, JPEG, and PNG files are allowed.</p>";
        $allow = 0;
      } else {
        $target_dir = '../images/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir);
        $allow = 1;
      }
    } else {
      $image = "";
      $allow = 0;
    }

    $query = "INSERT INTO test (title, summary, content, category, picture, date_published, archive) VALUES (?, ?, ?, ?, ?, ?, ?);";

    if ($allow != 0) {

      $stmt = mysqli_stmt_init($dbc);

      if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssi', $title, $summary, $text, $category, $image, $date_published, $archive);
        mysqli_stmt_execute($stmt);
        echo "<p class='green'>The article has been successfully created.</p>";
        $success = 1;
      } else {
        echo "<p class='red'>Error creating article.</p>";
        $success = -1;
      }
      mysqli_stmt_close($stmt);
    } else {
      echo "<p class='red'>Article creation failed.</p>";
      $success = -1;
    }
  }

  if ($success == 1) {
    echo "<article class='article-container'>";
    echo "<h2>" . $title . "</h2>";
    echo "<p>" . $summary . "</p>";
    echo "<p>Date: " . $date_published . "</p>";
    echo "<div class='article-image-container'>";
    echo "<img src='" . UPLPATH . $image . "' alt='" . $title . "'>";
    echo "</div>";
    echo "<p>" . $text . "</p>";
    echo "</article>";
  } else if ($success == 0) {
    echo "<p class='black'>Create a new article to display it.</p>";
  }

  echo "</section>";

  mysqli_close($dbc);
  ?>

  <?php include '../html/footer.html'; ?>

</body>

</html>