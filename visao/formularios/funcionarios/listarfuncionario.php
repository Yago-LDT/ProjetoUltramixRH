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
  <title>Funcionário UltraMix RH</title>
  <link rel="stylesheet" href="./../../css/form.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
            </div>
            <h1>Listar Funcionário</h1>
            <?php

if (isset($_SESSION['mensagem'])) {
  echo "<div class='error-message'>{$_SESSION['mensagem']}</div>";
  unset($_SESSION['mensagem']);
}
?>
            
  
            <?php
        require './.././../../modelo/DAO/ClassUsuarioDAO.php';

        $classUsuarioDAO = new ClassUsuarioDAO();
        $us = $classUsuarioDAO->listarfuncionarios();

        if (empty($us)){
          $_SESSION['semresultados'] = 'Nenhum funcionário no sistema.';
          echo "<div class='error-message'>{$_SESSION['semresultados']}</div>";
          unset($_SESSION['semresultados']);
        }
    
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>Cargo</th>";
        echo "<th>Data de Admissão</th>";
        echo "<th>Telefone</th>";
        echo "<th>Email</th>";
        echo "</tr>";

        echo "<tbody>";

        foreach ($us as $us) {
          echo "<tr>";
          echo "<td>" . $us['id'] . "</td>";
          echo "<td>" . $us['nome'] . "</td>";
          echo "<td>" . $us['cargo'] . "</td>";
          echo "<td>" . $us['data_admissão'] . "</td>";
          echo "<td>" . $us['telefone'] . "</td>";
          echo "<td>" . $us['email'] . "</td>";
          echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
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