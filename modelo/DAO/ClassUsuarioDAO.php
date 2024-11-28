<?php
require_once 'Conexao.php';


class ClassUsuarioDAO 
{
    public function login (ClassUsuario $loginUsuario) {
        try{
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM login WHERE usuario=:usuario";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':usuario', $loginUsuario->getUsuario());
            $stmt->execute();


            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            

            if ($user === false) {
                return false; 
            } 
                   

                    if (password_verify($loginUsuario->getSenha(), $user['senha'])) {

                        session_start();
                        $_SESSION['usuario'] = $user['usuario']; 
                        
                        return $user;   
                    } else {
                        return false;
                    }

            }catch(PDOException $ex){
            return $ex->getMessage();
             }
    }

    public function cadastrarlogin(ClassUsuario $cadastrarlogin){
            try {
                $pdo = Conexao::getInstance();
                $sql = "INSERT INTO login (usuario, senha) values (?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $cadastrarlogin->getUsuario());
                $stmt->bindValue(2, $cadastrarlogin->getPasswordHash());
                $stmt->execute();
                return TRUE;
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
    }

    public function listarlogins(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM login order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $logins = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $logins;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarlogin(ClassUsuario $alterarlogin){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE login SET usuario=?, senha=? WHERE id=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarlogin->getNovousuario());
            $stmt->bindValue(2, $alterarlogin->getPasswordHash());
            $stmt->bindValue(3, $alterarlogin->getNovoid());
            $stmt->execute();

            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluirlogin($excluirlogin){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM login WHERE id =?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $excluirlogin->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarfuncionario(ClassUsuario $cadastrarfuncionario){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO funcionarios (nome, cargo, CPF, data_admissão, telefone, email) values (?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarfuncionario->getNome());
            $stmt->bindValue(2, $cadastrarfuncionario->getCargo());
            $stmt->bindValue(3, $cadastrarfuncionario->getCPF());
            $stmt->bindValue(4, $cadastrarfuncionario->getDataAdmissao());
            $stmt->bindValue(5, $cadastrarfuncionario->getTelefone());
            $stmt->bindValue(6, $cadastrarfuncionario->getEmail());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirfuncionario($excluirfuncionario){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM funcionarios WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $excluirfuncionario->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function alterarfuncionario(ClassUsuario $alterarfuncionario){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE funcionarios SET nome=?, cargo=?, CPF=?, data_admissão=?, telefone=?, email=? WHERE id=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarfuncionario->getNome());
            $stmt->bindValue(2, $alterarfuncionario->getCargo());
            $stmt->bindValue(3, $alterarfuncionario->getCPF());
            $stmt->bindValue(4, $alterarfuncionario->getDataAdmissao());
            $stmt->bindValue(5, $alterarfuncionario->getTelefone());
            $stmt->bindValue(6, $alterarfuncionario->getEmail());
            $stmt->bindValue(7, $alterarfuncionario->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarfuncionarios(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM funcionarios order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarfornecedor(ClassUsuario $cadastrarfornecedor){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values (?,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarfornecedor->getNome());
            $stmt->bindValue(2, $cadastrarfornecedor->getProduto());
            $stmt->bindValue(3, $cadastrarfornecedor->getCNPJ());
            $stmt->bindValue(4, $cadastrarfornecedor->getTelefone());
            $stmt->bindValue(5, $cadastrarfornecedor->getEmail());
            $stmt->bindValue(6, $cadastrarfornecedor->getUltimaRemessa());
            $stmt->bindValue(7, $cadastrarfornecedor->getProximaRemessa());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirfornecedor($excluirfornecedor){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM fornecedores WHERE id =?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $excluirfornecedor->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarfornecedor(ClassUsuario $alterarfornecedor){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE fornecedores SET nome=?, produto=?, CNPJ=?, telefone=?, email=?, ultima_remessa=?, proxima_remessa=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarfornecedor->getNome());
            $stmt->bindValue(2, $alterarfornecedor->getProduto());
            $stmt->bindValue(3, $alterarfornecedor->getCNPJ());
            $stmt->bindValue(4, $alterarfornecedor->getTelefone());
            $stmt->bindValue(5, $alterarfornecedor->getEmail());
            $stmt->bindValue(6, $alterarfornecedor->getUltimaRemessa());
            $stmt->bindValue(7, $alterarfornecedor->getProximaRemessa());
            $stmt->bindValue(8, $alterarfornecedor->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarfornecedores(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM fornecedores order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarcargo(ClassUsuario $cadastrarcargo){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO cargos (titulo, carga_horaria, funcao, salario) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarcargo->getTitulo());
            $stmt->bindValue(2, $cadastrarcargo->getCargaHoraria());
            $stmt->bindValue(3, $cadastrarcargo->getFuncao());
            $stmt->bindValue(4, $cadastrarcargo->getSalario());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluircargo($idcargo){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM cargos WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $idcargo->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $ex) {
             echo $ex->getMessage();
        }
    }
    
    public function alterarcargo(ClassUsuario $alterarcargo){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE cargos SET titulo=?, carga_horaria=?, funcao=?, faixa_salarial=? WHERE id=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarcargo->getTitulo());
            $stmt->bindValue(2, $alterarcargo->getCargaHoraria());
            $stmt->bindValue(3, $alterarcargo->getFuncao());
            $stmt->bindValue(4, $alterarcargo->getFaixaSalarial());
            $stmt->bindValue(5, $alterarcargo->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarcargos(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM cargos order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarbancodehoras(ClassUsuario          $cadastrarbancodehoras){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarbancodehoras->getFuncionarioId());
            $stmt->bindValue(2, $cadastrarbancodehoras->getHorasEmBanco());
            $stmt->bindValue(3, $cadastrarbancodehoras->getFerias());
            $stmt->bindValue(4, $cadastrarbancodehoras->getLicencas());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirbancodehoras($idbancodehoras){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM banco_horas WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $idbancodehoras->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
             echo $ex->getMessage();
        }
    }

    public function alterarbancodehoras(ClassUsuario $alterarbancodehoras){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE banco_horas SET funcionario_id=?, horas_em_banco=?, ferias=?, licencas=? WHERE id=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarbancodehoras->getFuncionarioId());
            $stmt->bindValue(2, $alterarbancodehoras->getHorasEmBanco());
            $stmt->bindValue(3, $alterarbancodehoras->getFerias());
            $stmt->bindValue(4, $alterarbancodehoras->getLicencas());
            $stmt->bindValue(5, $alterarbancodehoras->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarbancodehoras(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM banco_horas order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarcontrato(ClassUsuario $cadastrarcontratos){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO contratos (fornecedor_id, duracao, produto_quantidade, valor) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarcontratos->getFornecedorId());
            $stmt->bindValue(2, $cadastrarcontratos->getDuracao());
            $stmt->bindValue(3, $cadastrarcontratos->getProdutoQuantidade());
            $stmt->bindValue(4, $cadastrarcontratos->getValor());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluircontrato($excluircontrato){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM contratos WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $excluircontrato->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
             echo $ex->getMessage();
        }
    }

    public function alterarcontrato(ClassUsuario $alterarcontrato){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE contratos SET fornecedor_id=?, duracao=?, produto_quantidade=?, valor=? WHERE id=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarcontrato->getFornecedorId());
            $stmt->bindValue(2, $alterarcontrato->getDuracao());
            $stmt->bindValue(3, $alterarcontrato->getProdutoQuantidade());
            $stmt->bindValue(4, $alterarcontrato->getValor());
            $stmt->bindValue(5, $alterarcontrato->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarcontratos(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM contratos order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarfolhapagamento(ClassUsuario $cadastrarfolhapagamento){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarfolhapagamento->getFuncionarioId());
            $stmt->bindValue(2, $cadastrarfolhapagamento->getCargoId());
            $stmt->bindValue(3, $cadastrarfolhapagamento->getBeneficios());
            $stmt->bindValue(4, $cadastrarfolhapagamento->getBonus());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirfolhapagamento($excluirfolhapagamento){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM folha_pagamento WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $excluirfolhapagamento->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
             echo $ex->getMessage();
        }
    }

    public function alterarfolhapagamento(ClassUsuario $alterarfolhapagamento){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE folha_pagamento SET funcionario_id=?, cargo_id=?, beneficios=?, bonus=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarfolhapagamento->getFuncionarioId());
            $stmt->bindValue(2, $alterarfolhapagamento->getCargoId());
            $stmt->bindValue(3, $alterarfolhapagamento->getBeneficios());
            $stmt->bindValue(4, $alterarfolhapagamento->getBonus());
            $stmt->bindValue(5, $alterarfolhapagamento->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listarfolhapagamento(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM folha_pagamento order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarfolhaponto(ClassUsuario $alterarfolhaponto){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO folha_ponto (funcionario_id, horario_chegada, horario_saida, horas) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarfolhaponto->getFuncionarioId());
            $stmt->bindValue(2, $alterarfolhaponto->getHorarioChegada());
            $stmt->bindValue(3, $alterarfolhaponto->getHorarioSaida());
            $stmt->bindValue(4, $alterarfolhaponto->getHoras());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirfolhaponto($excluirfolhaponto){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM folha_ponto WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $excluirfolhaponto->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
             echo $ex->getMessage();
        }
    }

    public function listarfolhaponto(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM folha_ponto order by (id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $func = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $func;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarfolhaponto(ClassUsuario $alterarfolhaponto){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE folha_ponto SET funcionario_id=?, horario_chegada=?, horario_saida=?, horas=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarfolhaponto->getFuncionarioId());
            $stmt->bindValue(2, $alterarfolhaponto->getHorarioChegada());
            $stmt->bindValue(3, $alterarfolhaponto->getHorarioSaida());
            $stmt->bindValue(4, $alterarfolhaponto->getHoras());
            $stmt->bindValue(5, $alterarfolhaponto->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function cadastraravaliacao(ClassUsuario $cadastraravaliacao){
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastraravaliacao->getFuncionarioId());
            $stmt->bindValue(2, $cadastraravaliacao->getProdutividade());
            $stmt->bindValue(3, $cadastraravaliacao->getEmpenho());
            $stmt->bindValue(4, $cadastraravaliacao->getRelatorio());
            $stmt->bindValue(5, $cadastraravaliacao->getRecomendaPromocao());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluiravaliacao($excluiravaliacao){
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM avaliacoes WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $excluiravaliacao->getExcluirid());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function alteraravaliacao(ClassUsuario $alteraravaliacao){
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE avaliacoes SET funcionario_id=?, produtividade=?, empenho=?, relatorio=?, recomenda_promoção=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alteraravaliacao->getFuncionarioId());
            $stmt->bindValue(2, $alteraravaliacao->getProdutividade());
            $stmt->bindValue(3, $alteraravaliacao->getEmpenho());
            $stmt->bindValue(4, $alteraravaliacao->getRelatorio());
            $stmt->bindValue(5, $alteraravaliacao->getRecomendaPromocao());
            $stmt->bindValue(6, $alteraravaliacao->getNovoid());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function listaravaliacao(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT av.id as 'ID Avaliação', f.id as 'ID Funcionário', f.nome as Funcionário, av.produtividade as Produtividade, av.empenho as Empenho, av.relatorio as Relatório, av.recomenda_promoção as Promoção
            FROM avaliacoes as av
            INNER JOIN funcionarios as f on av.funcionario_id = f.id
            ORDER BY (av.id) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $avaliacoes;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarfuncionariocargo() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT f.id as ID, f.nome as Nome, c.titulo as Cargo, f.data_admissão as 'Data de Admissão', c.carga_horaria as CargaHoraria, c.salario as FaixaSalarial,  f.CPF as CPF, f.email as Email, f.telefone as Telefone
        FROM funcionario_cargo 
        INNER JOIN funcionarios as f ON funcionario_cargo.funcionario_id = f.id
        INNER JOIN cargos as c ON funcionario_cargo.cargo_titulo = c.titulo
        ORDER BY (f.id) asc;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $listarfuncionariocargo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $listarfuncionariocargo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    public function listarfuncionariocargoportempo() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT f.id as ID, f.nome as Nome, c.titulo as Cargo, f.data_admissão as 'Data de Admissão', c.carga_horaria as CargaHoraria, c.salario as FaixaSalarial,  f.CPF as CPF, f.email as Email, f.telefone as Telefone
        FROM funcionario_cargo 
        INNER JOIN funcionarios as f ON funcionario_cargo.funcionario_id = f.id
        INNER JOIN cargos as c ON funcionario_cargo.cargo_titulo = c.titulo
        ORDER BY (f.data_admissão) desc;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $listarfuncionariocargoportempo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $listarfuncionariocargoportempo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    public function listarfuncionariocargoportempoantigo() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT f.id as ID, f.nome as Nome, c.titulo as Cargo, f.data_admissão as 'Data de Admissão', c.carga_horaria as CargaHoraria, c.salario as FaixaSalarial,  f.CPF as CPF, f.email as Email, f.telefone as Telefone
        FROM funcionario_cargo 
        INNER JOIN funcionarios as f ON funcionario_cargo.funcionario_id = f.id
        INNER JOIN cargos as c ON funcionario_cargo.cargo_titulo = c.titulo
        ORDER BY (f.data_admissão) asc;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $listarfuncionariocargoportempoantigo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $listarfuncionariocargoportempoantigo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    public function listarfuncionariocargoporcargo($cargo) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT f.id as ID, f.nome as Nome, c.titulo as Cargo, f.data_admissão as 'Data de Admissão', c.carga_horaria as CargaHoraria, c.salario as FaixaSalarial,  f.CPF as CPF, f.email as Email, f.telefone as Telefone
        FROM funcionario_cargo 
        INNER JOIN funcionarios as f ON funcionario_cargo.funcionario_id = f.id
        INNER JOIN cargos as c ON funcionario_cargo.cargo_titulo = c.titulo
         WHERE c.titulo = ? ORDER BY (c.titulo) asc;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cargo, PDO::PARAM_STR);
            $stmt->execute();
            $listarfuncionariocargoporcargo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $listarfuncionariocargoporcargo;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }
    
    public function quantidadefuncionarios() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT COUNT(*) AS total FROM funcionarios";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $contarfuncionarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contarfuncionarios;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    public function quantidadefornecedores() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT COUNT(*) AS total FROM fornecedores";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $contarfuncionarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contarfuncionarios;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    public function quantidadeadministradores() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT COUNT(*) AS total FROM login";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $contarfuncionarios = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contarfuncionarios;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }
    
    public function melhoravaliacao() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT funcionario_id AS ID, f.nome AS Funcionario, (empenho + produtividade) / 2 AS Media
            FROM avaliacoes
            INNER JOIN funcionarios AS f ON funcionario_id = f.id
                ORDER BY Media DESC
                LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $melhormedia = $stmt->fetch(PDO::FETCH_ASSOC);
            return $melhormedia;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }

    }

    }
