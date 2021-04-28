function submitRent() {
    //This function handles basic error-checking for the form prompt.
    var rName = document.getElementById("name");
    var rEmail = document.getElementById("email");
    var orderingForm = document.forms["formFull"];
    var atCheck = rEmail.value.search("@");
    if ((rName.value.length <= 0) || (rEmail.value.length <= 0)) {
        alert("Please fill out both fields to rent a book.");
    }
    else if (atCheck == -1) {
        alert("Please make sure you use a valid email.");
    }
    else {
        orderingForm.submit();
    }

}