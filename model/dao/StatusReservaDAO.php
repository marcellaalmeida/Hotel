<?php
class StatusReservaDAO {
    public function create($statusReserva) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO status_reserva (descricao)
                 VALUES (:descricao)"
            );
            $query->bindValue(':descricao', $statusReserva->getDescricao(), PDO::PARAM_STR);

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
            $query = BD::getConexao()->prepare("SELECT * FROM status_reserva");

            if (!$query->execute())
                print_r($query->errorInfo());

            $lista = [];
            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $linha) {
                $statusReserva = new StatusReserva();
                $statusReserva->setIdStatusReserva($linha['idstatus_reserva']);
                $statusReserva->setDescricao($linha['descricao']);

                $lista[] = $statusReserva;
            }

            return $lista;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
            return [];
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM status_reserva WHERE idstatus_reserva = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $statusReserva = new StatusReserva();
                $statusReserva->setIdStatusReserva($linha['idstatus_reserva']);
                $statusReserva->setDescricao($linha['descricao']);
                return $statusReserva;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
            return null;
        }
    }

    public function update($statusReserva) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE status_reserva
                 SET descricao = :descricao
                 WHERE idstatus_reserva = :id"
            );
            $query->bindValue(':descricao', $statusReserva->getDescricao(), PDO::PARAM_STR);
            $query->bindValue(':id', $statusReserva->getIdStatusReserva(), PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
            return false;
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare("DELETE FROM status_reserva WHERE idstatus_reserva = :id");
            $query->bindValue(':id', $id, PDO::PARAM_INT);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
            return false;
        }
    }

    public function findByDescricao($descricao) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM status_reserva WHERE descricao LIKE :descricao");
            $query->bindValue(':descricao', '%' . $descricao . '%', PDO::PARAM_STR);

            if (!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);

            if ($linha) {
                $statusReserva = new StatusReserva();
                $statusReserva->setIdStatusReserva($linha['idstatus_reserva']);
                $statusReserva->setDescricao($linha['descricao']);
                return $statusReserva;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro #6: " . $e->getMessage();
            return null;
        }
    }
}
?>
