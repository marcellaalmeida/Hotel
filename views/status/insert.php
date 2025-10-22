<?php
    require "../../autoload.php";

    // Construir o objeto de Status
    $status = new Status();
    $status->setDescricao($_POST['descricao']);

    // Inserir no Banco de Dados
    $dao = new StatusDAO();
    $dao->create($status);

    // Redirecionar para o index
    header('Location: index.php');

