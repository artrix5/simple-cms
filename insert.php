<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <title>WELT</title>
  <meta name="description" content="PWA Project">
  <meta name="author" content="Adrian Lokner Lađević">
  <meta name="keywords" content="HTML, CSS, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header>

    <h1>WELT</h1>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="category.php?category=politics">Politics</a></li>
            <li><a href="category.php?category=food">Food</a></li>
            <li><a href="login.php">Administrator</a></li>
        </ul>
    </nav>

  </header>

  <main>
    <form enctype="multipart/form-data" name="input" action="script.php" method="POST">
      <label for="title">Title:</label>
      <input type="text" name="title" id="title">
      <span id="errorTitle" class="error"></span>
      </br>

      <label for="summary">Summary:</label>
      <textarea name="summary" id="summary"></textarea>
      <span id="errorSummary" class="error"></span>
      </br>

      <label for="text">Text:</label>
      <textarea name="text" id="text"></textarea>
      <span id="errorText" class="error"></span>
      </br>

      <label for="category">Category:</label>
      <select name="category" id="category">
        <option value="Politics">Politics</option>
        <option value="Job and career">Job and career</option>
        <option value="Food">Food</option>
      </select>
      <span id="errorCategory" class="error"></span>
      </br>

      <label for="picture">Picture:</label>
      <input type="file" name="picture" id="picture">
      <span id="errorPicture" class="error"></span>
      </br>

      <label for="date">Enter a date:</label>
      <input type="date" id="date" name="date">
      <br><br>

      <label for="checkbox">Archive?</label>
      <input type="checkbox" name="checkbox" id="checkbox">
      </br>

      <button type="submit" id="submit">Send</button>
      </br>

    </form>
  </main>

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