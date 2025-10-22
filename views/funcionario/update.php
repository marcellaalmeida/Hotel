<?php
    require "../../autoload.php";

    // Construir o objeto do Funcionário
    $funcionario = new Funcionario();
    $funcionario->setId($_POST['id']);
    $funcionario->setNome($_POST['nome']);
    $funcionario->setCargo($_POST['cargo']);
    $funcionario->setSalario($_POST['salario']);

    // Atualizar registro no Banco de Dados
    $dao = new FuncionarioDAO();
    $dao->update($funcionario);

    // Redirecionar para o index
    header('Location: index.php');
