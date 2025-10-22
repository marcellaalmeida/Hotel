<?php
    require "../../autoload.php";

    // Construir o objeto do Funcionário
    $funcionario = new Funcionario();
    $funcionario->setNome($_POST['nome']);
    $funcionario->setCargo($_POST['cargo']);
    $funcionario->setSalario($_POST['salario']);

    // Inserir no Banco de Dados
    $dao = new FuncionarioDAO();
    $dao->create($funcionario);

    // Redirecionar para o index
    header('Location: index.php');
