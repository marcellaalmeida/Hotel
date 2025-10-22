<?php
    class GerenteDAO {
        public function create($gerente) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto(descricao,valor_unitario,quantidade,id_tipo_produto) 
                     VALUES (:d, :v, :q, :t)"
                );
                $query->bindValue(':d',$gerente->getDescricao(), PDO::PARAM_STR);

                // Bind para a chave estrangeira
                $query->bindValue(':t',$gerente->getFuncionario()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM gerente");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $gerentes = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o TipoProduto
                    $daoGerente = new FuncionarioDAO();
                    $funcionario = $daoGerente->find($linha['id_funcionario']);

                    // Construindo um objeto do Produto
                    $gerente = new Gerente();
                    $gerente->setId($linha['id_gerente']);
                    $gerente->setNivel_Acesso($linha['nivel_acesso']);
                    // Definir o atributo (objeto) TipoProduto
                    $gerente->setFuncionario($funcionario);

                    array_push($gerentes,$gerente);
                }

                return $gerentes;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto WHERE id_produto = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);             

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com o TipoProduto
                $daoGerente = new FuncionarioDAO();
                $Funcionario = $daoGerente->find($linha['id_funcionario']);

                // Construindo um objeto do Produto
                $gerente = new Gerente();
                $gerente->setId($linha['id_gerente']);
                $gerente->setNivel_Acesso($linha['nivel_acesso']);
                // Definir o atributo (objeto) TipoProduto
                $gerente->setFuncionario($Funcionario);

                return $gerente;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($gerente) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE gerente 
                     SET nivel_acesso = :n, id_funcionario = :f 
                     WHERE id_gerente = :g"
                );
                $query->bindValue(':n',$gerente->getNivel_Acesso(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':f',$gerente->getFuncionario()->getId(), PDO::PARAM_INT);
                $query->bindValue(':g',$gerente->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM gerente 
                     WHERE id_gerente = :i"
                );
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }