function imprimirCliente(id) {
    var url = 'ver_clientes.php?id=' + id;
    var janelaImprimir = window.open(url, 'Imprimir Cliente', 'width=800, height=600');
    janelaImprimir.print();
}
function confirmarExclusao(id) {
    var confirmacao = confirm("Tem certeza que deseja excluir? Caso você confirme, não será possível recuperar esses dados.");
    if (confirmacao) {
        window.location.href = 'excluir_clientes.php?id=' + id;
    }
}