<?php

session_start();

require_once '../modelo/ClassUsuario.php';
require_once '../modelo/DAO/ClassUsuarioDAO.php';

$id =@$_POST['idex'];
$excluirid =@$_POST['excluirid'];
$novoid =@$_POST['novoid'];
$usuario =@$_POST['usuario'];
$novousuario =@$_POST['novousuario'];
$senha =@$_POST['senha'];
$novasenha =@$_POST['novasenha'];
//
$nome =@$_POST['nome'];
$cargo =@$_POST['cargo'];
$CPF =@$_POST['cpf'];
$data_admissao =@$_POST['data_admissao'];
$telefone =@$_POST['telefone'];
$email =@$_POST['email'];
//
$produto =@$_POST['produto'];
$CNPJ =@$_POST['CNPJ'];
$ultima_remessa =@$_POST['ultimaremessa'];
$proxima_remessa =@$_POST['proximaremessa'];
//
$titulo =@$_POST['titulo'];
$carga_horaria =@$_POST['cargahoraria'];
$funcao =@$_POST['funcao'];
$salario =@$_POST['salario'];
//
$funcionario_id =@$_POST['funcionarioid'];
$horas_em_banco =@$_POST['horasbanco'];
$ferias =@$_POST['ferias'];
$licencas =@$_POST['licencas'];
//
$produtividade =@$_POST['produtividade'];
$empenho =@$_POST['empenho'];
$relatorio =@$_POST['relatorio'];
$recomenda_promocao =@$_POST['recomendapromocao'];
//
$duracao =@$_POST['duracao'];
$fornecedor_id =@$_POST['fornecedorid'];
$produto_quantidade =@$_POST['produtoquantidade'];
$valor =@$_POST['custos'];
//
$cargo_id =@$_POST['cargoid'];
$salario_bruto =@$_POST['salariobruto'];
$beneficios =@$_POST['beneficios'];
$bonus =@$_POST['bonus'];
$valor_receber =@$_POST['valorreceber'];
//
$horario_chegada =@$_POST['horariochegada'];
$horario_saida =@$_POST['horariosaida'];
$horas =@$_POST['horas'];
//
$acao = $_GET['ACAO'] ?? '';

$processar = new ClassUsuario();

$processar->setId($id);
$processar->setExcluirid($excluirid);
$processar->setNovoid($novoid);
$processar->setUsuario($usuario);
$processar->setNovousuario($novousuario);
$processar->setSenha($senha);
$processar->setNovasenha($novasenha);
//
$processar->setNome($nome);
$processar->setCargo($cargo);
$processar->setCPF($CPF);
$processar->setDataAdmissao($data_admissao);
$processar->setTelefone($telefone);
$processar->setEmail($email);
//
$processar->setProduto($produto);
$processar->setCNPJ($CNPJ);
$processar->setUltimaRemessa($ultima_remessa);
$processar->setProximaRemessa($proxima_remessa);
//
$processar->setTitulo($titulo);
$processar->setCargaHoraria($carga_horaria);
$processar->setFuncao($funcao);
$processar->setSalario($salario);
//
$processar->setFuncionarioId($funcionario_id);
$processar->setHorasEmBanco($horas_em_banco);
$processar->setFerias($ferias);
$processar->setLicencas($licencas);
//
$processar->setProdutividade($produtividade);
$processar->setEmpenho($empenho);
$processar->setRelatorio($relatorio);
$processar->setRecomendaPromocao($recomenda_promocao);
//
$processar->setDuracao($duracao);
$processar->setFornecedorId($fornecedor_id);
$processar->setProdutoQuantidade($produto_quantidade);
$processar->setValor($valor);
//
$processar->setCargoId($cargo_id);
$processar->setSalarioBruto($salario_bruto);
$processar->setBeneficios($beneficios);
$processar->setBonus($bonus);
$processar->setValorReceber($valor_receber);
//
$processar->setHorarioChegada($horario_chegada);
$processar->setHorarioSaida($horario_saida);
$processar->setHoras($horas);


$ClassUsuarioDAO = new ClassUsuarioDAO();

switch($acao) {
//
    case "autenticarlogin":
        $resultado = $ClassUsuarioDAO->login($processar);

        if($resultado){
        $_SESSION['mensagem'] = "Login realizado com sucesso!";
        header('Location: ../menu.php');
        exit();
    
        } else{
        $_SESSION['mensagem'] = "Não foi possível realizar o login, usuário ou senha inválidos!";
            header('Location: ../index.php'); 
            exit();
        }

            break;
//
    case "cadastrarlogin":
        $passwordhash = password_hash($senha, PASSWORD_BCRYPT);
        $processar->setPasswordHash($passwordhash);
        $resultado = $ClassUsuarioDAO->cadastrarlogin($processar);

        if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça o seu login!";
            header('Location: ../index.php');
            exit();
        } else{
            $_SESSION['mensagem'] = "Erro ao realizar o cadastro!";
            header('Location: ../visao/formularios/login/cadastrarlogin.php');

        }

            break;
//
    case "alterarlogin":
        $passwordhash = password_hash($novasenha, PASSWORD_BCRYPT);
        $processar->setPasswordHash($passwordhash);
        $resultado = $ClassUsuarioDAO->alterarlogin($processar);

        if($resultado >= 1) {
            $_SESSION['mensagem'] = "Login alterado com sucesso!";
            header('Location: ../visao/formularios/login/listarlogin.php');
            exit();

        } else{
            $_SESSION['mensagem'] = "Erro ao alterar o login!";
            header('Location: ../visao/formularios/login/alterarlogin.php');
            exit();

        }

            break;
//
    case "excluirlogin":
        $resultado = $ClassUsuarioDAO->excluirlogin($processar);

        if($resultado >= 1) {
            $_SESSION['mensagem'] = "Login excluído com sucesso!";
            header('Location: ../visao/formularios/login/listarlogin.php');
            exit();

        } else{
            $_SESSION['mensagem'] = "Erro ao excluir o login!";
            header('Location: ../visao/formularios/login/excluirlogin.php');

        }

            break;
//
    case "cadastrarfuncionario":
        $resultado = $ClassUsuarioDAO->cadastrarfuncionario($processar);

        if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de funcionário realizado com sucesso!";
            header('Location: ../visao/formularios/funcionarios/listarfuncionario.php');
            exit();
        } else{
            $_SESSION['mensagem'] = "Erro ao realizar o cadastro do funcionário!";
            header('Location: ../visao/formularios/funcionarios/cadastrarfuncionario.php');

        }

            break;
// 
    case "excluirfuncionario":
                $resultado = $ClassUsuarioDAO->excluirfuncionario($processar);
        
                if($resultado) {
                    $_SESSION['mensagem'] = "Funcionário excluido com sucesso!";
                    header('Location: ../visao/formularios/funcionarios/listarfuncionario.php');
                    exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao excluir funcionário!";
                    header('Location: ../visao/formularios/funcionarios/excluirfuncionario.php');
        
                }
        
                    break;
//    
    case "alterarfuncionario":
        $resultado = $ClassUsuarioDAO->alterarfuncionario($processar);
                
                        if($resultado >= 1) {
                            $_SESSION['mensagem'] = "Funcionário alterado com sucesso!";
                            header('Location: ../visao/formularios/funcionarios/listarfuncionario.php');
                            exit();
                
                        } else{
                            $_SESSION['mensagem'] = "Erro ao alterar o funcionário!";
                            header('Location: ../visao/formularios/funcionarios/alterarfuncionario.php');
                            exit();
                
                        }
                
                            break;
//
    case "cadastrarfornecedor":
        $resultado = $ClassUsuarioDAO->cadastrarfornecedor($processar);
                        
                if($resultado >= 1) {
                $_SESSION['mensagem'] = "Cadastro de fornecedor realizado com sucesso!";
                header('Location: ../visao/formularios/fornecedores/listarfornecedor.php');
                exit();
                    } else{
                        $_SESSION['mensagem'] = "Erro ao realizar o cadastro do fornecedor!";
                        header('Location: ../visao/formularios/fornecedores/cadastrarfornecedor.php');
                        
                                }
                        
                                    break;
//   
    case "excluirfornecedor":
        $resultado = $ClassUsuarioDAO->excluirfornecedor($processar);
                                                        
            if($resultado >= 1) {
                $_SESSION['mensagem'] = "Fornecedor excluido com sucesso!";
                header('Location: ../visao/formularios/fornecedores/listarfornecedor.php');
                exit();
                } else{
                $_SESSION['mensagem'] = "Erro ao excluir o fornecedor!";
                header('Location: ../visao/formularios/fornecedores/excluirfornecedor.php');
                                                        
                }
                                                        
                break;
//
    case "alterarfornecedor":
        $resultado = $ClassUsuarioDAO->alterarfornecedor($processar);
            
                    if($resultado >= 1) {
                        $_SESSION['mensagem'] = "Fornecedor alterado com sucesso!";
                        header('Location: ../visao/formularios/fornecedores/listarfornecedor.php');
                        exit();
            
                    } else{
                        $_SESSION['mensagem'] = "Erro ao alterar o fornecedor!";
                        header('Location: ../visao/formularios/fornecedores/alterarfornecedor.php');
                        exit();
            
                    }
            
                        break;
//
    case "cadastrarcargo":
        $resultado = $ClassUsuarioDAO->cadastrarcargo($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de cargo realizado com sucesso!";
            header('Location: ../visao/formularios/cargos/listarcargo.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro do cargo!";
                    header('Location: ../visao/formularios/cargos/cadastrarcargo.php');
                    
                            }
                    
                                break;                 
//
    case "excluircargo":
        $resultado = $ClassUsuarioDAO->excluircargo($processar);

        if($resultado >= 1) {
        $_SESSION['mensagem'] = "Cargo excluido com sucesso!";
        header('Location: ../visao/formularios/cargos/listarcargo.php');
        exit();
         } else{
        $_SESSION['mensagem'] = "Erro ao excluir cargo!";
        header('Location: ../visao/formularios/cargos/excluircargo.php');

        }

        break;
//
    case "alterarcargo":
        $resultado = $ClassUsuarioDAO->alterarcargo($processar);
        
                if($resultado >= 1) {
                    $_SESSION['mensagem'] = "Cargo alterado com sucesso!";
                    header('Location: ../visao/formularios/cargos/listarcargo.php');
                    exit();
        
                } else{
                    $_SESSION['mensagem'] = "Erro ao alterar o cargo!";
                    header('Location: ../visao/formularios/cargos/alterarcargo.php');
                    exit();
        
                }
        
                    break;
//
    case "cadastrarbancodehoras":
         $resultado = $ClassUsuarioDAO->cadastrarbancodehoras($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de horas realizado com sucesso!";
            header('Location: ../visao/formularios/bancodehoras/listarbancohoras.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro de horas!";
                    header('Location: ../visao/formularios/bancodehoras/cadastrarbancohoras.php');
                    
                            }
                    
                                break;
//
    case "excluirbancodehoras":
        $resultado = $ClassUsuarioDAO->excluirbancodehoras($processar);

            if($resultado >= 1) {
        $_SESSION['mensagem'] = "Banco de horas excluído com sucesso!";
        header('Location: ../visao/formularios/bancodehoras/listarbancohoras.php');
        exit();
        } else{
        $_SESSION['mensagem'] = "Erro ao excluir o banco de horas!";
        header('Location: ../visao/formularios/bancodehoras/excluirbancohoras.php');

     }

        break;
//
    case "alterarbancodehoras":
         $resultado = $ClassUsuarioDAO->alterarbancodehoras($processar);
        
                if($resultado >= 1) {
                    $_SESSION['mensagem'] = "Banco de horas alterado com sucesso!";
                    header('Location: ../visao/formularios/bancodehoras/listarbancohoras.php');
                    exit();
        
                } else{
                    $_SESSION['mensagem'] = "Erro ao alterar o banco de horas!";
                    header('Location: ../visao/formularios/bancodehoras/alterarbancohoras.php');
                    exit();
        
                }
        
                    break;

//
    case "cadastraravaliacao":
        $resultado = $ClassUsuarioDAO->cadastraravaliacao($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de avaliação realizado com sucesso!";
            header('Location: ../visao/formularios/avaliacao/listaravaliacao.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro de avaliação!";
                    header('Location: ../visao/formularios/avaliacao/cadastraravaliacao.php');
                    
                            }
                    
                                break;

//
    case "excluiravaliacao":
     $resultado = $ClassUsuarioDAO->excluiravaliacao($processar);

            if($resultado >= 1) {
        $_SESSION['mensagem'] = "Avaliação excluída com sucesso!";
        header('Location: ../visao/formularios/avaliacao/listaravaliacao.php');
        exit();
         } else{
        $_SESSION['mensagem'] = "Erro ao excluir avaliação!";
        header('Location: ../visao/formularios/avaliacao/excluiravaliacao.php');

     }

        break;
//
    case "alteraravaliacao":
        $resultado = $ClassUsuarioDAO->alteraravaliacao($processar);
        
                if($resultado >= 1) {
                    $_SESSION['mensagem'] = "Avaliação alterada com sucesso!";
                    header('Location: ../visao/formularios/avaliacao/listaravaliacao.php');
                    exit();
        
                } else{
                    $_SESSION['mensagem'] = "Erro ao alterar a avaliação!";
                    header('Location: ../visao/formularios/avaliacao/alteraravalicao.php');
                    exit();
        
                }
        
                    break;
//
    case "cadastrarcontrato":
     $resultado = $ClassUsuarioDAO->cadastrarcontrato($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de contrato realizado com sucesso!";
            header('Location: ../visao/formularios/contrato/listarcontrato.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro do contrato!";
                    header('Location: ../visao/formularios/contrato/cadastrarcontrato.php');
                    
                            }
                    
                                break;
//
    case "excluircontrato":
        $resultado = $ClassUsuarioDAO->excluircontrato($processar);

        if($resultado >= 1) {
        $_SESSION['mensagem'] = "Contrato excluido com sucesso!";
        header('Location: ../visao/formularios/contrato/listarcontrato.php');
        exit();
         } else{
        $_SESSION['mensagem'] = "Erro ao excluir contrato!";
        header('Location: ../visao/formularios/contrato/excluircontrato.php');

        }

        break;
//
    case "alterarcontrato":
         $resultado = $ClassUsuarioDAO->alterarcontrato($processar);
        
                if($resultado >= 1) {
                    $_SESSION['mensagem'] = "Contrato alterado com sucesso!";
                    header('Location: ../visao/formularios/contrato/listarcontrato.php');
                    exit();
        
                } else{
                    $_SESSION['mensagem'] = "Erro ao alterar o contrato!";
                    header('Location: ../visao/formularios/contrato/alterarcontrato.php');
                    exit();
        
                }
        
                    break;
//
    case "cadastrarfolhapagamento":
        $resultado = $ClassUsuarioDAO->cadastrarfolhapagamento($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
            header('Location: ../visao/formularios/folhapagamento/listarfolha.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro!";
                    header('Location: ../visao/formularios/folhapagamento/cadastrarfolha.php');
                    
                            }
                    
                                break;
//
    case "excluirfolhapagamento":
     $resultado = $ClassUsuarioDAO->excluirfolhapagamento($processar);

        if($resultado >= 1) {
        $_SESSION['mensagem'] = "Folha de pagamento excluída com sucesso!";
        header('Location: ../visao/formularios/folhapagamento/listarfolha.php');
        exit();
         } else{
        $_SESSION['mensagem'] = "Erro ao excluir folha de pagamento!";
        header('Location: ../visao/formularios/folhapagamento/excluirfolha.php');

        }

        break;
//
    case "alterarfolhapagamento":
            $resultado = $ClassUsuarioDAO->alterarfolhapagamento($processar);
                
                        if($resultado >= 1) {
                            $_SESSION['mensagem'] = "Folha de pagamento alterada com sucesso!";
                            header('Location: ../visao/formularios/folhapagamento/listarfolha.php');
                            exit();
                
                        } else{
                            $_SESSION['mensagem'] = "Erro ao alterar a folha de pagamento!";
                            header('Location: ../visao/formularios/folhapagamento/alterarfolha.php');
                            exit();
                
                        }
                
                            break;
//
    case "cadastrarfolhaponto":
        $resultado = $ClassUsuarioDAO->cadastrarfolhaponto($processar);
                    
            if($resultado >= 1) {
            $_SESSION['mensagem'] = "Cadastro de ponto realizado com sucesso!";
            header('Location: ../visao/formularios/folhaponto/listarponto.php');
            exit();
                } else{
                    $_SESSION['mensagem'] = "Erro ao realizar o cadastro de ponto!";
                    header('Location: ../visao/formularios/folhaponto/cadastrarponto.php');
                    
                            }
                    
                                break;
//
    case "excluirfolhaponto":
        $resultado = $ClassUsuarioDAO->excluirfolhaponto($processar);

         if($resultado >= 1) {
        $_SESSION['mensagem'] = "Ponto excluido com sucesso!";
        header('Location: ../visao/formularios/folhaponto/listarponto.php');
        exit();
        } else{
        $_SESSION['mensagem'] = "Erro ao excluir!";
        header('Location: ../visao/formularios/folhaponto/excluirponto.php');

        }

        break;
//
    case "alterarfolhaponto":
        $resultado = $ClassUsuarioDAO->alterarfolhaponto($processar);
        
                if($resultado >= 1) {
                    $_SESSION['mensagem'] = "Folha de ponto alterada com sucesso!";
                    header('Location: ../visao/formularios/folhaponto/listarponto.php');
                    exit();
        
                } else{
                    $_SESSION['mensagem'] = "Erro ao alterar a folha de ponto!";
                    header('Location: ../visao/formularios/folhaponto/alterarponto.php');
                    exit();
        
                }
        
                    break;
//
    }



?>