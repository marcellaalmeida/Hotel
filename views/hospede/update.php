<?php
    require "../../autoload.php";

    // Construir o objeto do Hóspede
    $hospede = new Hospede();
    $hospede->setId($_POST['id']);
    $hospede->setNome($_POST['nome']);
    $hospede->setCpf($_POST['cpf']);
    $hospede->setCep($_POST['cep']);
    $hospede->setNumero($_POST['numero']);

    // Atualizar registro no Banco de Dados
    $dao = new HospedeDAO();
    $dao->update($hospede);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');
