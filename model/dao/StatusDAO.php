<?php
class StatusDAO {
    public function create($status) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO status (descricao)
                 VALUES (:descricao)"
            );
            $query->bindValue(':descricao', $status->getDescricao(), PDO::PARAM_STR);

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
            $query = BD::getConexao()->prepare("SELECT * FROM status");

            if (!$query->execute())
                print_r($query->errorInfo());

            $listastatus = array();
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $linha) {
                $status = new Status();
                $status->setIdStatus($linha['idstatus']);
                $status->setDescricao($linha['descricao']);

                array_push($listastatus, $status);
            }

            return $listastatus;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
            return array();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM status WHERE idstatus = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $status = new Status();
                $status->setIdStatus($linha['idstatus']);
                $status->setDescricao($linha['descricao']);
                return $status;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
            return null;
        }
    }

    public function update($status) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE status
                 SET descricao = :descricao
                 WHERE idstatus = :idstatus"
            );
            $query->bindValue(':descricao', $status->getDescricao(), PDO::PARAM_STR);
            $query->bindValue(':idstatus', $status->getIdStatus(), PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare("DELETE FROM status WHERE idstatus = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
            return false;
        }
    }

    public function findByDescricao($descricao) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM status WHERE descricao LIKE :descricao");
            $query->bindValue(':descricao', '%' . $descricao . '%', PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $status = new Status();
                $status->setIdStatus($linha['idstatus']);
                $status->setDescricao($linha['descricao']);
                return $status;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #6: " . $e->getMessage();
            return null;
        }
    }
}
?>
