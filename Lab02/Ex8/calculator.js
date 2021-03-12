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