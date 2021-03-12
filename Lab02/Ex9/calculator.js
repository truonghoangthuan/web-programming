function displayButton(btn) {
    document.getElementById("text-box").value += btn;
}

function clearButton() {
    document.getElementById("text-box").value = "";
}

function solve() {
    var res = eval(document.getElementById("text-box").value);
    document.getElementById("text-box").value = res;
}

function changeTheme() {
    var color = document.getElementById("theme-select-dropdown").value;
    console.log(color);
    switch (color) {
        case "Light":
            document.getElementById("themes").href = "calculator-light.css";
            break;
            
        case "Dark":
            document.getElementById("themes").href = "calculator-dark.css";
            break;

        case "Colorful":
            document.getElementById("themes").href = "calculator-colorful.css";
            break;
    
        default:
            break;
    }
}