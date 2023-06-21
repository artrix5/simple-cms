
    document.getElementById("submit").onclick = function (event) {
      var isValid = true;

      var title = document.getElementById("title").value;
      var summary = document.getElementById("summary").value;
      var text = document.getElementById("text").value;
      var image = document.getElementById("image").value;
      var date = document.getElementById("date").value;
      var category = document.getElementById("category").value;

      var errorTitle = document.getElementById("errorTitle");
      var errorSummary = document.getElementById("errorSummary");
      var errorText = document.getElementById("errorText");
      var errorImage = document.getElementById("errorImage");
      var errorDate = document.getElementById("errorDate");
      var errorCategory = document.getElementById("errorCategory");


      if (title.length < 5 || title.length > 30) {
        document.getElementById("title").style.border = "1px solid red";
        errorTitle.innerHTML = "Title must be between 5 and 30 characters long!<br>";
        errorTitle.style.color = "red";

        isValid = false;
      } else {
        errorTitle.style.border = "";
      }

      if (summary.length < 10 || summary.length > 100) {
        document.getElementById("summary").style.border = "1px solid red";
        errorSummary.innerHTML = "The summary must be between 10 and 100 characters long!<br>";
        errorSummary.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("summary").style.border = "";
      }

      if (text === "") {
        document.getElementById("text").style.border = "1px solid red";
        errorText.innerHTML = "Text can't be empty!<br>";
        errorText.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("text").style.border = "";
      }

      if (image === "") {
        document.getElementById("image").style.border = "1px solid red";
        errorImage.innerHTML = "The image can't be empty!<br>";
        errorImage.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("image").style.border = "";
      }

      if (date === "") {
        document.getElementById("date").style.border = "1px solid red";
        errorDate.innerHTML = "The date can't be empty!<br>";
        errorDate.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("date").style.border = "";
      }

      if (category === "") {
        document.getElementById("category").style.border = "1px solid red";
        errorCategory.innerHTML = "Category can't be empty!<br>";
        errorCategory.style.color = "red";

        isValid = false;
      } else {
        document.getElementById("category").style.border = "";
      }

      if (isValid != true) {
        event.preventDefault();
      }
    }

