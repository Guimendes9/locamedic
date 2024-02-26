window.onbeforeprint = function () {
    var date = new Date().toLocaleString();
    var printInfo = date + " Imprimir Cliente " + window.location.href + " 1/1";
    document.getElementById('print-header').innerText = printInfo;
};