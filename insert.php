<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>WELT</title>
  <meta name="description" content="PWA Project">
  <meta name="author" content="Adrian Lokner Lađević">
  <meta name="keywords" content="HTML, CSS, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="basic-styles.css">
  <link rel="stylesheet" href="class-styles.css">
  <style>
    .container-insert {
      display: flex;
      width: 100%;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-container {
      flex: 1;
      padding: 20px;
    }

    form {
      width: 100%;
      margin: 0 auto;
      background-color: #f4f4f4;
      border-radius: 5px;
      padding: 30px;
      box-sizing: border-box;
    }

    .form-container h2 {
      margin-top: 0;
    }

    .form-container input[type="text"],
    .form-container textarea,
    .form-container select {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: none;
      border-radius: 4px;
      resize: vertical;
      background-color: #f9f9f9;
    }

    .form-container input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .navigation-bar {
      flex: 0 0 200px;
      background-color: #333;
      color: #fff;
      padding: 20px;

    }

    .navigation-bar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .navigation-bar ul li {
      display: block;
      /* Add this line to make each list item appear as a block element */
      margin-bottom: 10px;
    }

    .navigation-bar ul li a {
      color: #fff;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <header>
    <h1>WELT</h1>
    <nav>
      <ul class="ul">

        <li><a href="index.php">Home</a></li>
        <li><a href="category.php?category=politics">Politics</a></li>
        <li><a href="category.php?category=food">Food</a></li>
        <li><a href="login.php">Administrator</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <div class="container-insert">
      <div class="form-container">
        <form enctype="multipart/form-data" name="input" action="script.php" method="POST">
          <h2>Create Post</h2>

          <label for="title">Title:</label>
          <input type="text" name="title" id="title" placeholder="Enter a title" required>

          <label for="summary">Summary:</label>
          <textarea name="summary" id="summary" placeholder="Enter a summary" required></textarea>

          <label for="text">Text:</label>
          <textarea name="text" id="text" placeholder="Enter the text" required></textarea>

          <label for="category">Category:</label>
          <select name="category" id="category" required>
            <option value="">Select a category</option>
            <option value="Politics">Politics</option>
            <option value="Job and career">Job and career</option>
            <option value="Food">Food</option>
          </select>

          <label for="picture">Picture:</label>
          <input type="file" name="picture" id="picture" required>

          <label for="date">Enter a date:</label>
          <input type="date" id="date" name="date">

          <label for="checkbox">Archive?</label>
          <input type="checkbox" name="checkbox" id="checkbox">

          <input type="submit" id="submit" value="Send">
        </form>
      </div>
      <div class="navigation-bar">
        <ul>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Clients</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </section>
  <footer>
    <h1>WELT</h1>
  </footer>
  <script type="text/javascript">

    document.getElementById("submit").onclick = function (event) {
      var isValid = true;

      var title = document.getElementById("title").value;
      var summary = document.getElementById("summary").value;
      var text = document.getElementById("text").value;
      var picture = document.getElementById("picture").value;
      var category = document.getElementById("category").value;

      var errorTitle = document.getElementById("errorTitle");
      var errorSummary = document.getElementById("errorSummary");
      var errorText = document.getElementById("errorText");
      var pictureError = document.getElementById("errorPicture");
      var categoryError = document.getElementById("errorCategory");


      // Provjera naslova vijesti
      if (title.length < 5 || title.length > 30) {
        document.getElementById("title").style.border = "1px solid red";
        errorTitle.innerHTML = "Title must be between 5 and 30 characters long!<br>";
        errorTitle.style.color = "red";

        isValid = false;
      } else {
        errorTitle.style.border = "";
      }

      // Provjera kratkog sadržaja vijesti
      if (summary.length < 10 || summary.length > 100) {
        document.getElementById("summary").style.border = "1px solid red";
        errorSummary.innerHTML = "The summary must have between 10 and 100 characters!<br>";
        errorSummary.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("summary").style.border = "";
      }

      // Provjera teksta vijesti
      if (text.length === 0) {
        document.getElementById("text").style.border = "1px solid red";
        errorText.innerHTML = "Text must not be empty!<br>";
        errorText.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("text").style.border = "";
      }

      // Provjera odabrane slike
      if (picture === "") {
        document.getElementById("picture").style.border = "1px solid red";
        pictureError.innerHTML = "The image must not be empty!<br>";
        pictureError.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("picture").style.border = "";
      }

      // Provjera odabrane kategorije
      if (category === "") {
        document.getElementById("category").style.border = "1px solid red";
        categoryError.innerHTML = "Category must not be empty!<br>";
        categoryError.style.color = "red";


        isValid = false;
      } else {
        document.getElementById("category").style.border = "";
      }

      if (isValid != true) {
        event.preventDefault();
      }

    }

  </script>

</body>

</html>