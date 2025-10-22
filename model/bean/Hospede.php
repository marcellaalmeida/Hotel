<?php
class Hospede {
    // Atributos
    private $id_hospede;
    private $nome;
    private $cpf;
    private $cep;
    private $numero;

    // Métodos Getter e Setter

    public function getId() {
        return $this->id_hospede;
    }

    public function setId($id_hospede) {
        $this->id_hospede = $id_hospede;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    // Método para retornar uma string do objeto
    public function __toString() {
        return $this->nome;
    }
}
?>
