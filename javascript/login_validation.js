
document.getElementById("submit").onclick = function (event) {
    var isValid = true;

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var errorUsername = document.getElementById("errorUsername");
    var errorPassword = document.getElementById("errorPassword");

    if (username.trim() === "") {
        document.getElementById("username").style.border = "1px solid red";
        errorUsername.innerHTML = "Field cannot be empty!<br>";
        errorUsername.style.color = "red";

        isValid = false;
    }

    else {
        errorUsername.innerHTML = ""; // Clear the error message
        document.getElementById("username").style.border = ""; // Remove the red border
    }

    if (password.trim() === "") {
        document.getElementById("password").style.border = "1px solid red";
        errorPassword.innerHTML = "Field cannot be empty!<br>";
        errorPassword.style.color = "red";

        isValid = false;
    }

    else {
        errorPassword.innerHTML = ""; 
        document.getElementById("password").style.border = ""; 
    }



    if (isValid != true) {
        event.preventDefault();
    }

}

