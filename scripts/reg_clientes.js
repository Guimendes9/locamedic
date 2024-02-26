$(document).ready(function () {
    $("#telefone").mask("(00) 00000-0000");
    $(".alert").fadeIn(300).delay(2500).fadeOut(400);
});

function buscarCep() {
    let cep = document.getElementById("cep").value;
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(dados => {
            document.getElementById("estado").value = dados.uf;
            document.getElementById("cidade").value = dados.localidade;
            document.getElementById("bairro").value = dados.bairro;
            document.getElementById("rua").value = dados.logradouro;
        });
}
document.getElementById("cep").addEventListener("change", buscarCep);
function mascaraMutuario(o, f) {
    v_obj = o
    v_fun = f
    setTimeout('execmascara()', 1)
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}
function cpfCnpj(v) {
    v = v.replace(/\D/g, "")
    if (v.length <= 11) {
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
    } else {
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
    }
    return v
}
function formatarDocumento(input) {
    var documento = input.value.replace(/\D/g, '');

    if (documento.length === 11) {
        input.value = documento.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    } else if (documento.length === 14) {
        input.value = documento.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
    } else {
        input.value = '';
    }
}
function validarForm() {
    var documento = document.getElementById('documento').value.replace(/\D/g, '');
    if (documento.length === 11 || documento.length === 14) {
        return true;
    } else {
        alert('Por favor, insira um CPF ou CNPJ válido.');
        return false;
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var inputDocumento = document.getElementById('documento');
    inputDocumento.addEventListener('input', function () {
        mascaraMutuario(this, cpfCnpj);
    });
    inputDocumento.addEventListener('blur', function () {
        formatarDocumento(this);
    });
});
function formatarMoeda(valor) {
    var numero = parseFloat(valor.replace(/[^\d]+/g, '')) / 100;
    var valorFormatado = numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    document.getElementById('valor').value = valorFormatado;
}
document.getElementById('valor').addEventListener('keyup', function (event) {
    var valorAtual = event.target.value;
    var valorNumerico = valorAtual.replace(/[^\d]+/g, '');
    formatarMoeda(valorNumerico);
});