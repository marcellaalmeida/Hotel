<?php
class FuncionarioDAO {
    public function create($funcionario) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO funcionario (nome, cargo, salario)
                 VALUES (:nome, :cargo, :salario)"
            );
            $query->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cargo', $funcionario->getCargo(), PDO::PARAM_STR);
            $query->bindValue(':salario', $funcionario->getSalario(), PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());
            else
                return BD::getConexao()->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro #1: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM funcionario");

            if (!$query->execute())
                print_r($query->errorInfo());

            $funcionarios = array();
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $linha) {
                $funcionario = new Funcionario();
                $funcionario->setId($linha['id_funcionario']);
                $funcionario->setNome($linha['nome']);
                $funcionario->setCargo($linha['cargo']);
                $funcionario->setSalario($linha['salario']);

                array_push($funcionarios, $funcionario);
            }

            return $funcionarios;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
            return array();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM funcionario WHERE id_funcionario = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $funcionario = new Funcionario();
                $funcionario->setId($linha['id_funcionario']);
                $funcionario->setNome($linha['nome']);
                $funcionario->setCargo($linha['cargo']);
                $funcionario->setSalario($linha['salario']);
                return $funcionario;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
            return null;
        }
    }

    public function update($funcionario) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE funcionario
                 SET nome = :nome, cargo = :cargo, salario = :salario
                 WHERE id_funcionario = :id"
            );
            $query->bindValue(':nome', $funcionario->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cargo', $funcionario->getCargo(), PDO::PARAM_STR);
            $query->bindValue(':salario', $funcionario->getSalario(), PDO::PARAM_STR);
            $query->bindValue(':id', $funcionario->getId(), PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare("DELETE FROM funcionario WHERE id_funcionario = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
            return false;
        }
    }

    public function findByNome($nome) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM funcionario WHERE nome LIKE :nome");
            $query->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $funcionario = new Funcionario();
                $funcionario->setId($linha['id_funcionario']);
                $funcionario->setNome($linha['nome']);
                $funcionario->setCargo($linha['cargo']);
                $funcionario->setSalario($linha['salario']);
                return $funcionario;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #6: " . $e->getMessage();
            return null;
        }
    }
}
?>
