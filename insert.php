<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>WELT</title>
  <meta name="description" content="PWA Project">
  <meta name="author" content="Adrian Lokner Lađević">
  <meta name="keywords" content="HTML, CSS, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="insert_validation.js" defer></script>
  <script src="fetch_id.js" type="text/javascript" defer></script>
</head>

<body>

  <?php include 'header.php'; ?>

  <section>

    <div class="form-container">
      <form id="insert-form" enctype="multipart/form-data" method="POST">
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
          <option value="">Select a category</option>
          <option value="Politics">Politics</option>
          <option value="Job and career">Job and career</option>
          <option value="Food">Food</option>
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
          <input type="submit" class="insert-button" name="submit" id="submit" value="Create">
          <input type="button" class="clear-button" value="Clear" onclick="clearForm('insert-form')">
          <span id="messageSuccess"></span>
        </div>

      </form>
    </div>

    <aside class="navigation-bar">
      <ul>
        <li><a href="administrator.php">MODIFY</a></li>
        <li><a href="#">INSERT</a></li>
      </ul>
    </aside>

  </section>

  <hr>

  <h2 class="heading">CREATED ARTICLE:</h2>

  <section>

    <?php

    include 'connect.php';
    define('UPLPATH', 'images/');

    if (isset($_POST['submit'])) {

      $title = $_POST['title'];
      $summary = $_POST['summary'];
      $text = $_POST['text'];
      $category = $_POST['category'];
      $date_published = $_POST['date'];

      $archive = isset($_POST['checkbox']) ? 1 : 0;

      if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = 'images/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir);
      } else {
        $image = '';
      }

      $query = "INSERT INTO test (title, summary, content, category, picture, date_published, archive) VALUES (?, ?, ?, ?, ?, ?, ?);";

      $stmt = mysqli_stmt_init($dbc);

      if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssssi', $title, $summary, $text, $category, $image, $date_published, $archive);

        mysqli_stmt_execute($stmt);

        echo "<script type='text/javascript'>";
        echo "document.getElementById('messageSuccess').innerHTML = 'Article successfully created.';";
        echo "document.getElementById('messageSuccess').style.setProperty('font-size', '20px');";
        echo "document.getElementById('messageSuccess').style.color = 'green';";
        echo "</script>";

        echo "<article class=\"article-page\">";
        echo "<h2>" . $title . "</h2>";
        echo "<p>" . $summary . "</p>";
        echo "<p>Date: " . $date_published . "</p>";
        echo "<div class=\"article-image-container\">";
        echo "<img src='" . UPLPATH . $image . "' alt='" . $title . "'>";
        echo "</div>";
        echo "<p>" . $text . "</p>";
        echo "</article>";
      }
    }

    mysqli_close($dbc);
    ?>

  </section>

  <footer>
    <h1>WELT</h1>
  </footer>

</body>

</html>