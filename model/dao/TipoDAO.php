<?php
class TipoDAO {
    public function create($tipo) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO tipo (descricao)
                 VALUES (:descricao)"
            );
            $query->bindValue(':descricao', $tipo->getDescricao(), PDO::PARAM_STR);

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
            $query = BD::getConexao()->prepare("SELECT * FROM tipo");

            if (!$query->execute())
                print_r($query->errorInfo());

            $tipos = array();
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $linha) {
                $tipo = new Tipo();
                $tipo->setIdTipo($linha['idtipo']);
                $tipo->setDescricao($linha['descricao']);

                array_push($tipos, $tipo);
            }

            return $tipos;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
            return array();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM tipo WHERE idtipo = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $tipo = new Tipo();
                $tipo->setIdTipo($linha['idtipo']);
                $tipo->setDescricao($linha['descricao']);
                return $tipo;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
            return null;
        }
    }

    public function update($tipo) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE tipo
                 SET descricao = :descricao
                 WHERE idtipo = :id"
            );
            $query->bindValue(':descricao', $tipo->getDescricao(), PDO::PARAM_STR);
            $query->bindValue(':id', $tipo->getIdTipo(), PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare("DELETE FROM tipo WHERE idtipo = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
            return false;
        }
    }

    public function findByDescricao($descricao) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM tipo WHERE descricao LIKE :descricao");
            $query->bindValue(':descricao', '%' . $descricao . '%', PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $tipo = new Tipo();
                $tipo->setIdTipo($linha['idtipo']);
                $tipo->setDescricao($linha['descricao']);
                return $tipo;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #6: " . $e->getMessage();
            return null;
        }
    }
}
?>
