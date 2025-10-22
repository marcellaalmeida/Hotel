<?php
    require "../../autoload.php";

    // Construir o objeto de Status
    $status = new Status();
    $status->setIdStatus($_POST['idstatus']);
    $status->setDescricao($_POST['descricao']);

    // Atualizar registro no Banco de Dados
    $dao = new StatusDAO();
    $dao->update($status);

    // Redirecionar para o index
    header('Location: index.php');

