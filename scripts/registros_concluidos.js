function confirmarExclusao(id) {
    var confirmacao = confirm("Tem certeza que deseja excluir? Caso você confirme, não será possível recuperar esses dados.");
    if (confirmacao) {
        window.location.href = 'excluir_concluidos.php?id=' + id;
    }
}