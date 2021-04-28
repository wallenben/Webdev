function submitForm() {
    var fname = document.getElementById("firstname");
    var fnameLabel = document.getElementById("fnameLabel");
    var lname = document.getElementById("lastname");
    var lnameLabel = document.getElementById("lnameLabel");
    var streetLabel = document.getElementById("streetLabel");
    var street = document.getElementById("street");
    var cityLabel = document.getElementById("cityLabel");
    var city = document.getElementById("city");
    var state = document.getElementById("state");
    var zip = document.getElementById("zip");
    var items = document.getElementsByClassName("items");
    var noItemsSelected = true;
    var cc = document.getElementsByName("credit");
    var noccSelected = true;
    var orderingForm = document.forms["orderForm"];
    var stateStringCheck = /^[a-zA-Z]+$/;
    var zipStringCheck = /^[0-9]+$/;
    for (i = 0; i < items.length; i++) {
        if (items[i].checked) {
            noItemsSelected = false;
        }
    }
    for (i = 0; i < cc.length; i++) {
        if (cc[i].checked) {
            noccSelected = false;
        }
    }


    if (fname.value) {
        fnameLabel.style.color = "black";
    }
    if (lname.value) {
        lnameLabel.style.color = "black";
    }
    if (street.value) {
        streetLabel.style.color = "black";
    }
    if (city.value) {
        cityLabel.style.color = "black";
    }
    if (!fname.value) {
        fnameLabel.style.color = "red";
    } else if (!lname.value) {
        lnameLabel.style.color = "red";
    } else if (!street.value) {
        streetLabel.style.color = "red";
    } else if (!city.value) {
        cityLabel.style.color = "red";
        //you could combine these two elseif functions below, but it would be verbose
    } else if (state.value.length != 2) {
        alert("State has to only have two letters.");
    } else if (!state.value.match(stateStringCheck)) {
        alert("Only A-Z characters please.");
    } else if (zip.value.length != 5) {
        alert("Zip code must be five digits long.");
    } else if (!zip.value.match(zipStringCheck)) {
        alert("Only numbers please.");
    } else if (noItemsSelected == true) {
        alert("Please select an item.");
    } else if (noccSelected == true) {
        alert("Please select a payment method.");
    } else {
        if (confirm("Are you ready to purchase?")) {
            orderingForm.submit();
        }
    }
}