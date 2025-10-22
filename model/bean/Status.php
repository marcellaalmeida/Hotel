<?php
class Status {
    // Atributos
    private $idstatus;
    private $descricao;

    // Métodos Getter e Setter

    public function getIdStatus() {
        return $this->idstatus;
    }

    public function setIdStatus($idstatus) {
        $this->idstatus = $idstatus;
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
