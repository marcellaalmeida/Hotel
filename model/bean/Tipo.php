<?php
class Tipo {
    // Atributos
    private $idtipo;
    private $descricao;

    // Métodos Getter e Setter

    public function getIdTipo() {
        return $this->idtipo;
    }

    public function setIdTipo($idtipo) {
        $this->idtipo = $idtipo;
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
