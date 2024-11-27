<?php 
session_start();

if (!isset($_SESSION['usuario'])){
header('Location:../../../index.php');
exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fornecedor UltraMix RH</title>
  <link rel="stylesheet" href="./../../css/form.css">
  <link rel="stylesheet" href="./../../css/listagem.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
            </div>
            <h1>Listar Fornecedor</h1>
            <?php


  if (isset($_SESSION['mensagem'])) {
    echo "<div class='error-message'>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']);
  }
?>
<br>
            
            <?php
    require './.././../../modelo/DAO/ClassUsuarioDAO.php';

    $ClassUsuarioDAO = new ClassUsuarioDAO();
    $us = $ClassUsuarioDAO->listarfornecedores();

  if (empty($us)){
    $_SESSION['semresultados'] = 'Nenhum fornecedor no sistema.';
    echo "<div class='error-message'>{$_SESSION['semresultados']}</div>";
    unset($_SESSION['semresultados']);
  }else{

  echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>Produto</th>";
        echo "<th>CNPJ</th>";
        echo "<th>Telefone</th>";
        echo "<th>Email</th>";
        echo "<th>Última Remessa</th>";
        echo "<th>Próxima Remessa</th>";
        echo "</tr>";

        echo "<tbody>";
    foreach ($us as $us) {
      
      echo "<tr>";
      echo "<td><p>" . $us['id'] . "</p></td>";
      echo "<td><p>" . $us['nome'] . "</p></td>";
      echo "<td><p>" . $us['produto'] . "</p></td>";
      echo "<td><p>" . $us['CNPJ'] . "</p></td>";
      echo "<td><p>" . $us['telefone'] . "</p></td>";
      echo "<td><p>" . $us['email'] . "</p></td>";
      echo "<td><p>" . $us['ultima_remessa'] . "</p></td>";
      echo "<td><p>" . $us['proxima_remessa'] . "</p></td>";
      echo "</tr>";
      
          }
          echo "</tbody>";
          echo "</table>";
    }

?>
<br><br>
<button type="button" class="btn-submit" onclick="window.location.href='../../../menu.php'">Voltar</button>
            
            <div id="error-message" class="error-message"></div>

            </div>

        </div>
    </div>
    <script src=""></script>
    </body>
    </html>