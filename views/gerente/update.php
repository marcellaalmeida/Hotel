<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $gerente = new Gerente();
    $gerente->setNivel_Acesso($_POST['nivel_acesso']);
    $gerente->setId($_POST['id']);

    // Construir um objeto do TipoProduto
    $funcionario = new Funcionario();
    $funcionario->setId($_POST['funcionario']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $gerente->setFuncionario($funcionario);

    // Inserir no Banco de Dados
    $dao = new GerenteDAO();
    $dao->update($gerente);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');