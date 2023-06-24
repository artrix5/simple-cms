
document.getElementById("submit").onclick = function (event) {
    var isValid = true;

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var passwordCheck = document.getElementById("passwordCheck").value;

    var errorUsername = document.getElementById("errorUsername");
    var errorPassword = document.getElementById("errorPassword");
    var errorPasswordCheck = document.getElementById("errorPasswordCheck");


    if (username.trim() === "") {
        document.getElementById("username").style.border = "1px solid red";
        errorUsername.innerHTML = "Field cannot be empty!<br>";
        errorUsername.style.color = "red";

        isValid = false;
    }

    else if ((username.length < 5 || username.length > 10) && username.trim() != "") {
        document.getElementById("username").style.border = "1px solid red";
        errorUsername.innerHTML = "Username must be between 5 and 10 characters long!<br>";
        errorUsername.style.color = "red";

        isValid = false;
    }

    else {
        errorUsername.innerHTML = ""; 
        document.getElementById("username").style.border = "1px solid green"; 
    }

    if (password.trim() === "") {
        document.getElementById("password").style.border = "1px solid red";
        errorPassword.innerHTML = "Field cannot be empty!<br>";
        errorPassword.style.color = "red";

        isValid = false;
    }

    else if ((password.length < 5 || password.length > 10) && password.trim() != "") {
        document.getElementById("password").style.border = "1px solid red";
        errorPassword.innerHTML = "Password must be between 5 and 15 characters long!<br>";
        errorPassword.style.color = "red";

        isValid = false;
    }

    else {
        errorPassword.innerHTML = "";
        document.getElementById("password").style.border = "1px solid green";
    }

    if (passwordCheck.trim() === "") {
        document.getElementById("passwordCheck").style.border = "1px solid red";
        errorPasswordCheck.innerHTML = "Field cannot be empty!<br>";
        errorPasswordCheck.style.color = "red";

        isValid = false;
    }

    else if ((password != passwordCheck) && passwordCheck != "") {
        document.getElementById("passwordCheck").style.border = "1px solid red";
        errorPasswordCheck.innerHTML = "Passwords do not match!";
        errorPasswordCheck.style.color = "red";

        isValid = false;
    }

    else {
        errorPasswordCheck.innerHTML = "";
        document.getElementById("passwordCheck").style.border = "1px solid green";
    }

    if (isValid != true) {
        event.preventDefault();
    }

}

