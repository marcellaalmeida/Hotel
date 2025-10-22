<?php
    require "../../autoload.php";

    // Construir o objeto de Status
    $status = new StatusReserva();
    $status->setIdStatusReserva($_POST['idstatusreserva']);
    $status->setDescricao($_POST['descricao']);

    // Atualizar registro no Banco de Dados
    $dao = new StatusReservaDAO();
    $dao->update($status);

    // Redirecionar para o index
    header('Location: index.php');

