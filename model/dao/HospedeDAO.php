<?php
class HospedeDAO {
    public function create($hospede) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO hospede (nome, cpf, cep, numero)
                 VALUES (:nome, :cpf, :cep, :numero)"
            );
            $query->bindValue(':nome', $hospede->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $hospede->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':cep', $hospede->getCep(), PDO::PARAM_STR);
            $query->bindValue(':numero', $hospede->getNumero(), PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());
            else
                return BD::getConexao()->lastInsertId(); // Retorna o ID inserido
        } catch (PDOException $e) {
            echo "Erro #1: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM hospede");

            if (!$query->execute())
                print_r($query->errorInfo());

            $hospedes = array();
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $linha) {
                $hospede = new Hospede();
                $hospede->setId($linha['id_hospede']);
                $hospede->setNome($linha['nome']);
                $hospede->setCpf($linha['cpf']);
                $hospede->setCep($linha['cep']);
                $hospede->setNumero($linha['numero']);

                array_push($hospedes, $hospede);
            }

            return $hospedes;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
            return array();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM hospede WHERE id_hospede = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $hospede = new Hospede();
                $hospede->setId($linha['id_hospede']);
                $hospede->setNome($linha['nome']);
                $hospede->setCpf($linha['cpf']);
                $hospede->setCep($linha['cep']);
                $hospede->setNumero($linha['numero']);
                return $hospede;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
            return null;
        }
    }

    public function update($hospede) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE hospede
                 SET nome = :nome, cpf = :cpf, cep = :cep, numero = :numero
                 WHERE id_hospede = :id"
            );
            $query->bindValue(':nome', $hospede->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $hospede->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':cep', $hospede->getCep(), PDO::PARAM_STR);
            $query->bindValue(':numero', $hospede->getNumero(), PDO::PARAM_STR);
            $query->bindValue(':id', $hospede->getId(), PDO::PARAM_INT);

            return $query->execute(); // Retorna true/false
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare("DELETE FROM hospede WHERE id_hospede = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute(); // Retorna true/false
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
            return false;
        }
    }

    public function findByCpf($cpf) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM hospede WHERE cpf = :cpf");
            $query->bindValue(':cpf', $cpf, PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $hospede = new Hospede();
                $hospede->setId($linha['id_hospede']);
                $hospede->setNome($linha['nome']);
                $hospede->setCpf($linha['cpf']);
                $hospede->setCep($linha['cep']);
                $hospede->setNumero($linha['numero']);
                return $hospede;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #6: " . $e->getMessage();
            return null;
        }
    }
}
?>
