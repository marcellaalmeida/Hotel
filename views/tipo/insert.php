<?php
    require "../../autoload.php";

    // Construir o objeto do Tipo
    $tipo = new Tipo();
    $tipo->setDescricao($_POST['descricao']);

    // Inserir no Banco de Dados
    $dao = new TipoDAO();
    $dao->create($tipo);

    // Redirecionar para o index
    header('Location: index.php');
?>
