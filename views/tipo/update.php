<?php
    require "../../autoload.php";

    // Construir o objeto do Tipo
    $tipo = new Tipo();
    $tipo->setIdTipo($_POST['idtipo']);
    $tipo->setDescricao($_POST['descricao']);

    // Atualizar registro no Banco de Dados
    $dao = new TipoDAO();
    $dao->update($tipo);

    // Redirecionar para o index
    header('Location: index.php');
?>
