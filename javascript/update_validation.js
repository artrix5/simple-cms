document.getElementById("update").onclick = function (event) {
    var isValid = true;

    var title = document.getElementById("title").value;
    var summary = document.getElementById("summary").value;

    var errorTitle = document.getElementById("errorTitle");
    var errorSummary = document.getElementById("errorSummary");

    if (title != "") {
        if (title.length < 5 || title.length > 30) {
            document.getElementById("title").style.border = "1px solid red";
            errorTitle.innerHTML = "Title must be between 5 and 30 characters long!<br>";
            errorTitle.style.color = "red";

            isValid = false;
        } else {
            errorTitle.style.border = "";
        }
    }

    if (summary != "") {
        if (summary.length < 10 || summary.length > 100) {
            document.getElementById("summary").style.border = "1px solid red";
            errorSummary.innerHTML = "The summary must be between 10 and 100 characters long!<br>";
            errorSummary.style.color = "red";

            isValid = false;
        } else {
            document.getElementById("summary").style.border = "";
        }
    }


    if (isValid != true) {
        event.preventDefault();
    }
}


