$(document).ready(function () {
    $("#entregaprevista").mask("00/00/0000");
    $("#datacompra").mask("00/00/0000");
    $("#datachegada").mask("00/00/0000");

    $("#valor").keyup(function (event) {
        var valorAtual = event.target.value;
        var valorNumerico = valorAtual.replace(/[^\d]+/g, '');
        formatarMoeda(valorNumerico);
    });

    $(".alert").fadeIn(300).delay(2500).fadeOut(400);
});
function formatarMoeda(valor) {
    var numero = parseFloat(valor) / 100;
    var valorFormatado = numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    $("#valor").val(valorFormatado);
}
function validarData() {
    var dataCompra = document.getElementById("datacompra").value;
    var entregaPrevista = document.getElementById("entregaprevista").value;
    var dataChegada = document.getElementById("datachegada").value;

    var partesDataCompra = dataCompra.split('/');
    var partesEntregaPrevista = entregaPrevista.split('/');
    var partesDataChegada = dataChegada.split('/');

    var diaCompra = parseInt(partesDataCompra[0]);
    var mesCompra = parseInt(partesDataCompra[1]);
    var anoCompra = parseInt(partesDataCompra[2]);

    if (diaCompra < 1 || diaCompra > 31 || mesCompra < 1 || mesCompra > 12 || anoCompra < 2024) {
        alert("Coloque uma data válida");
        return false;
    }

    var diaEntregaPrevista = parseInt(partesEntregaPrevista[0]);
    var mesEntregaPrevista = parseInt(partesEntregaPrevista[1]);
    var anoEntregaPrevista = parseInt(partesEntregaPrevista[2]);

    if (diaEntregaPrevista < 1 || diaEntregaPrevista > 31 || mesEntregaPrevista < 1 || mesEntregaPrevista > 12 || anoEntregaPrevista < 2024) {
        alert("Coloque uma data válida");
        return false;
    }

    var diaDataChegada = parseInt(partesDataChegada[0]);
    var mesDataChegada = parseInt(partesDataChegada[1]);
    var anoDataChegada = parseInt(partesDataChegada[2]);

    if (diaDataChegada < 1 || diaDataChegada > 31 || mesDataChegada < 1 || mesDataChegada > 12 || anoDataChegada < 2024) {
        alert("Coloque uma data válida");
        return false;
    }

    return true;
}