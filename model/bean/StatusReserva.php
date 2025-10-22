<?php
class StatusReserva {
    // Atributos
    private $idstatus_reserva;
    private $descricao;

    // Métodos Getter e Setter

    public function getIdStatusReserva() {
        return $this->idstatus_reserva;
    }

    public function setIdStatusReserva($idstatus_reserva) {
        $this->idstatus_reserva = $idstatus_reserva;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    // Método para retornar uma string do objeto
    public function __toString() {
        return $this->descricao;
    }
}
?>
