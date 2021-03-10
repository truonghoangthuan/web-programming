function validationInformation() {
    var name = document.getElementById("inp-name").value;
    var sex = document.getElementById("inp-sex").checked;
    var email = document.getElementById("inp-email").value;
    var birthday = document.getElementById("inp-birthday").value;
    var address = document.getElementById("inp-address").value;
    var city = document.getElementById("inp-city").value;
    var region = document.getElementById("inp-region").value;
    var zip = document.getElementById("inp-zip").value;

    //Check empty field
    if (name === "" || 
        sex === false || 
        email === "" || 
        birthday === "" ||
        address === "" ||
        city === "" ||
        region === "" ||
        zip === ""){
        alert("Please enter your information!");
        return;
    }

    //Email validation
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (mailformat.test(email) === false) {
        alert("Please enter valid email!");
        return;
    }

    //Date validation
    var dateformat = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
    if (dateformat.test(birthday) === false) {
        alert("Please enter valid date!");
        return;
    }

    //ZIP code validation
    var newZip = parseInt(zip);
    if (zip.length !== 5 || Number.isInteger(newZip) === false) {
        alert("Please enter valid ZIP code!");
        return;
    }
}