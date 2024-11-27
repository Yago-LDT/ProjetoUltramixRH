<?php 
session_start();

if (!isset($_SESSION['usuario'])){
header('Location: index.php');
exit();
}

require 'modelo/DAO/ClassUsuarioDAO.php';

$classUsuarioDAO = new ClassUsuarioDAO();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style.css">    
    <title>Painel Administrador</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="img/lupa-removebg-preview.png">
                    <h2>Analise<span class="danger">Dados</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="menu">


                <a href="#" class="active">
                    <h4>Painel Geral</h4>
                </a>
                <a href="#" id="contratos">
                    <h4>Contratos</h4>
                </a>
                <div class="submenu" id="submenu-contratos">
                    <a href="visao/formularios/contrato/cadastrarcontrato.php">Cadastrar Contrato</a>
                    <a href="visao/formularios/contrato/listarcontrato.php">Listar Contrato</a>
                    <a href="visao/formularios/contrato/alterarcontrato.php">Alterar Contrato</a>
                    <a href="visao/formularios/contrato/excluircontrato.php">Excluir Contrato</a>
                   

                </div>
                <a href="#" id="login">
                    <h4>Login</h4>
                </a>
                <div class="submenu" id="submenu-login">
                    <a href="visao/formularios/login/cadastrarlogin.php">Cadastrar Login</a>
                    <a href="visao/formularios/login/listarlogin.php">Listar Login</a>
                    <a href="visao/formularios/login/excluirlogin.php">Excluir Login</a>
                    <a href="visao/formularios/login/alterarlogin.php">Alterar Login</a>

                </div>

                <a href="#" id="banco-de-horas">
                    <h4>Banco de Horas</h4>
                </a>
                <div class="submenu" id="submenu-Banco">
                    <a href="visao/formularios/bancodehoras/alterarbancohoras.php">Alterar Banco de Horas</a>
                    <a href="visao/formularios/bancodehoras/cadastrarbancohoras.php">Cadastrar Banco</a>
                    <a href="visao/formularios/bancodehoras/excluirbancohoras.php">Excluir Banco</a>
                    <a href="visao/formularios/bancodehoras/listarbancohoras.php">Listar Banco de Horas</a>

                </div>

                <a href="#" id="avaliacao">
                    <h4>Avaliações</h4>
                </a>
                <div class="submenu" id="submenu-avaliacao">
                    <a href="visao/formularios/avaliacao/cadastraravaliacao.php">Cadastrar avaliação</a>
                    <a href="visao/formularios/avaliacao/excluiravaliacao.php">Excluir avaliação</a>
                    <a href="visao/formularios/avaliacao/alteraravaliacao.php">Alterar avaliação</a>
                    <a href="visao/formularios/avaliacao/listaravaliacao.php">Listar avaliação</a>

                </div>

                <a href="#" id="cargo">
                    <h4>Cargos</h4>
                </a>
                <div class="submenu" id="submenu-cargo">
                    <a href="visao/formularios/cargos/cadastrarcargo.php">Cadastrar cargo</a>
                    <a href="visao/formularios/cargos/alterarcargo.php">Alterar cargo</a>
                    <a href="visao/formularios/cargos/excluircargo.php">Excluir cargo</a>
                    <a href="visao/formularios/cargos/listarcargo.php">Listar cargo</a>

                </div>

                <a href="#" id="folha-de-pagamento">
                    <h4>Folha de Pagamento</h4>
                </a>
                <div class="submenu" id="submenu-folha">
                    <a href="visao/formularios/folhapagamento/cadastrarfolha.php">Cadastrar Folha</a>
                    <a href="visao/formularios/folhapagamento/alterarfolha.php">Alterar Folha</a>
                    <a href="visao/formularios/folhapagamento/excluirfolha.php">Excluir Folha</a>
                    <a href="visao/formularios/folhapagamento/listarfolha.php">Listar Folha</a>

                </div>
                

                <a href="#" id="folha-de-ponto">
                    <h4>Folha de Ponto</h4>
                </a>
                <div class="submenu" id="submenu-ponto">
                    <a href="visao/formularios/folhaponto/cadastrarponto.php">Cadastrar Ponto</a>
                    <a href="visao/formularios/folhaponto/alterarponto.php">Alterar Ponto</a>
                    <a href="visao/formularios/folhaponto/excluirponto.php">Excluir Ponto</a>
                    <a href="visao/formularios/folhaponto/listarponto.php">Listar Ponto</a>

                </div>

                <a href="#" id="fornecedores">
                    <h4>Fornecedores</h4>
                </a>
                <div class="submenu" id="submenu-fornecedores">
                    <a href="visao/formularios/fornecedores/cadastrarfornecedor.php">Cadastrar Fornecedor</a>
                    <a href="visao/formularios/fornecedores/alterarfornecedor.php">Alterar Fornecedor</a>
                    <a href="visao/formularios/fornecedores/excluirfornecedor.php">Excluir Fornecedor</a>
                    <a href="visao/formularios/fornecedores/listarfornecedor.php">Listar Fornecedor</a>

                </div>

                <a href="#" id="funcionarios">
                    <h4>Funcionários</h4>
                </a>
                <div class="submenu" id="submenu-funcionarios">
                    <a href="visao/formularios/funcionarios/cadastrarfuncionario.php">Cadastrar Funcionário</a>
                    <a href="visao/formularios/funcionarios/alterarfuncionario.php">Alterar Funcionário</a>
                    <a href="visao/formularios/funcionarios/excluirfuncionario.php">Excluir Funcionário</a>
                    <a href="visao/formularios/funcionarios/listarfuncionario.php">Listar Funcionário</a>

                </div>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <!-- Analyses -->
            <div class="new-users">
                <h2>Dados Gerais</h2>
                <div class="user-list">
                <div class="user">
                        <p><strong>Administradores do sistema</strong></p>
                        <?php
                        
                        $qtd = $classUsuarioDAO->quantidadeadministradores();
                        $quantidade = $qtd['total'];
                         echo " <h2>" . $quantidade. "</h2>"; 
                         
                         ?>
                    </div>    

                    <div class="user">
                        <p><strong>Funcionários no sistema</strong></p>
                        <?php
                        
                        $qtd2 = $classUsuarioDAO->quantidadefuncionarios();
                        $quantidade = $qtd2['total'];
                         echo " <h2>" . $quantidade. "</h2>"; 
                         
                         ?>
                    </div>
                    <div class="user">
                    <p><strong>Fornecedores no sistema</strong></p>
                        <?php
                        
                        $qtd3 = $classUsuarioDAO->quantidadefornecedores();
                        $quantidade = $qtd3['total'];
                         echo " <h2>" . $quantidade. "</h2>"; 
                         
                         ?>
                       
                    </div>
                </div>
            </div>

            <div class="recent-orders">
    <h2>Funcionários e Cargos</h2>
    
    <h2>Filtrar:</h2>
    <form method="GET" action="menu.php">
        <label for="cargo"><strong>Por cargo: </strong></label>
        <select name="cargo" id="cargo">
            <option value="">Todos</option>
            <option value="Operador de Caixa">Operador de Caixa</option>
            <option value="Repositor">Repositor</option>
            <option value="Empacotador">Empacotador</option>
            <option value="Açougueiro">Açougueiro</option>
            <option value="Estoquista">Estoquista</option>
            <option value="Auxiliar Administrativo">Auxiliar Administrativo</option>
        </select>
        <input type="hidden" name="filtrar" value="cargo">
        <button type="submit">Filtrar</button>
    </form>
    <br>
    <form method="GET" action="menu.php">
        <label for="tempo"><strong>Por tempo de empresa:</strong></label>
        <select name="tempo" id="tempo">
            <option value="">Não filtrar</option>
            <option value="novos">Mais novos</option>
            <option value="velhos">Mais velhos</option>
        </select>
        <input type="hidden" name="filtrar" value="tempo">
        <button type="submit">Filtrar</button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Carga Horaria</th>
                <th>Data de Admissão</th>
                <th>Faixa Salarial</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['filtrar'])) {
                $filtrar = $_GET['filtrar'];
                if ($filtrar === 'cargo') {
                    
                    $cargo = $_GET['cargo'] ?? '';
                    $resultados = $cargo ? $classUsuarioDAO->listarfuncionariocargoporcargo($cargo) : [];
                    if (empty($resultados)) {
                        echo "<tr><td colspan='6'>Nenhum funcionário encontrado para o cargo selecionado.</td></tr>";
                    } else {
                        foreach ($resultados as $funcionario) {
                            echo "<tr>
                                <td>" . htmlspecialchars($funcionario['ID']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Nome']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Cargo']) . "</td>
                                <td>" . htmlspecialchars($funcionario['CargaHoraria']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Data de Admissão']) . "</td>
                                <td>" . htmlspecialchars($funcionario['FaixaSalarial']) . "</td>
                            </tr>";
                        }
                    }
                } elseif ($filtrar === 'tempo') {
               
                    $tempo = $_GET['tempo'] ?? '';
                    if ($tempo === 'novos') {
                        $resultados = $classUsuarioDAO->listarfuncionariocargoportempo();
                    } elseif ($tempo === 'velhos') {
                        $resultados = $classUsuarioDAO->listarfuncionariocargoportempoantigo();
                    } else {
                        $resultados = [];
                    }
                    if (empty($resultados)) {
                        echo "<tr><td colspan='6'>Nenhum funcionário encontrado com o filtro de tempo.</td></tr>";
                    } else {
                        foreach ($resultados as $funcionario) {
                            echo "<tr>
                                <td>" . htmlspecialchars($funcionario['ID']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Nome']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Cargo']) . "</td>
                                <td>" . htmlspecialchars($funcionario['CargaHoraria']) . "</td>
                                <td>" . htmlspecialchars($funcionario['Data de Admissão']) . "</td>
                                <td>" . htmlspecialchars($funcionario['FaixaSalarial']) . "</td>
                            </tr>";
                        }
                    }
                }
            } else {
                
                $resultados = $classUsuarioDAO->listarfuncionariocargo();
                if (empty($resultados)) {
                    echo "<tr><td colspan='6'>Nenhum funcionário cadastrado no sistema.</td></tr>";
                } else {
                    foreach ($resultados as $funcionario) {
                        echo "<tr>
                            <td>" . htmlspecialchars($funcionario['ID']) . "</td>
                            <td>" . htmlspecialchars($funcionario['Nome']) . "</td>
                            <td>" . htmlspecialchars($funcionario['Cargo']) . "</td>
                            <td>" . htmlspecialchars($funcionario['CargaHoraria']) . "</td>
                            <td>" . htmlspecialchars($funcionario['Data de Admissão']) . "</td>
                            <td>" . htmlspecialchars($funcionario['FaixaSalarial']) . "</td>
                        </tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>

        </main>

        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Olá,<b><?php echo " " . $_SESSION['usuario'] . ""; ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="img/usuario-removebg-preview.png">
                    </div>
                </div>

            </div>

            <div class="user-profile">
                <div class="logo">
                    <h2>Funcionário melhor avaliado</h2>
                    <br>
                    <?php
                        
                        $melhor = $classUsuarioDAO->melhoravaliacao();
                        
                        if ($melhor) {
                            echo "<h2>" . htmlspecialchars($melhor['Funcionario']) . "</h2>";
                        } else {
                            echo "<h2>Nenhuma avaliação encontrada.</h2>";
                        }
                         ?>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Lembretes</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Conferir Banco de Horas</h3>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Atualização de Contratos</h3>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

            </div>

        </div>


    </div>

    <script src="orders.js"></script>
    <script src="menu.js"></script>
</body>

</html>