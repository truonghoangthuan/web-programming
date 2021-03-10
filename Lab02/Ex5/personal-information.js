function isEmpty() {
    var name = document.getElementById("inp-name").value;
    var sex = document.getElementById("inp-sex").checked;
    var email = document.getElementById("inp-email").value;
    var birthday = document.getElementById("inp-birthday").value;
    var address = document.getElementById("inp-address").value;
    var city = document.getElementById("inp-city").value;
    var region = document.getElementById("inp-region").value;
    var zip = document.getElementById("inp-zip").value;

    // console.log(name);
    // console.log(sex);
    // console.log(email);
    // console.log(birthday);
    // console.log(address);
    // console.log(city);
    // console.log(region);

    if (name === "" || 
        sex === false || 
        email === "" || 
        birthday === "" ||
        address === "" ||
        city === "" ||
        region === "" ||
        zip === ""){
        console.log("error!");
    }
}