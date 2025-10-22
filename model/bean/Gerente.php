<?php
    class Gerente {
        // Atributos
        private $id;
        private $nivel_acesso;
        private $funcionario;

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNivel_Acesso() {
            return $this->nivel_acesso;
        }

        public function setNivel_Acesso($Nivel_Acesso) {
            $this->nivel_acesso = $Nivel_Acesso;
        }

         // Get e set do atributo que faz associação (normal)
        public function getFuncionario() {
            return $this->funcionario;
        }

        public function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }


        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->nivel_acesso;
        }
    }