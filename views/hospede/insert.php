<?php
    require "../../autoload.php";

    // Construir o objeto do Hospede
    $hospede = new Hospede();
    $hospede->setNome($_POST['nome']);
    $hospede->setCpf($_POST['cpf']);
    $hospede->setCep($_POST['cep']);
    $hospede->setNumero($_POST['numero']);

    // Inserir no Banco de Dados
    $dao = new HospedeDAO();
    $dao->create($hospede);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');
