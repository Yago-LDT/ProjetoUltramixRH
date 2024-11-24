<?php 
session_start();

if (!isset($_SESSION['usuario'])){
header('Location: index.php');
exit();
}

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
                <h2>Novos usuários</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="img/usuario-removebg-preview.png">
                        <h2>Beatriz</h2>
                        
                    </div>
                    <div class="user">
                        <img src="img/usuario-removebg-preview.png">
                        <h2>Lucas</h2>
                       
                    </div>
                    <div class="user">
                        <img src="img/usuario-removebg-preview.png">
                        <h2>Marcos</h2>
                        
                    </div>
                    <div class="user">
                        <a href="visao/formularios/login/cadastrarlogin.php" target="_blank">
                        <img src="img/mais-removebg-preview.png">
                        </a>
                        <h2>Mais</h2>
                        <p>Novo Cadastro</p>
                    </div>
                </div>
            </div>

            <div class="recent-orders">
                <h2>Cadastros Recentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>ID Cadastro</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="#">Mostrar Mais</a>
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
                        <p>Olá,<b>Administrador</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="img/usuario-removebg-preview.png">
                    </div>
                </div>

            </div>

            <div class="user-profile">
                <div class="logo">
                    <h2>Dashboard De Gestão</h2>
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