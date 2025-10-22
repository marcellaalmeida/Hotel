<?php
class Funcionario {
    // Atributos
    private $id_funcionario;
    private $nome;
    private $cargo;
    private $salario;

    // Métodos Getter e Setter

    public function getId() {
        return $this->id_funcionario;
    }

    public function setId($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }

    // Método para retornar uma string do objeto
    public function __toString() {
        return $this->nome;
    }
}
?>
