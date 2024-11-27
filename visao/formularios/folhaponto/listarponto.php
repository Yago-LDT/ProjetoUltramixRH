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
  <title>Folha de ponto UltraMix RH</title>
  <link rel="stylesheet" href="./../../css/form.css">
  <link rel="stylesheet" href="./../../css/listagem.css"> <!-- Adicionado o novo CSS -->
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
            </div>
            <h1>Listar Ponto</h1>
            <?php

if (isset($_SESSION['mensagem'])) {
  echo "<div class='error-message'>{$_SESSION['mensagem']}</div>";
  unset($_SESSION['mensagem']);
}
?>
            
            <?php
    require './.././../../modelo/DAO/ClassUsuarioDAO.php';

    $classUsuarioDAO = new ClassUsuarioDAO();
    $us = $classUsuarioDAO->listarfolhaponto();

    if (empty($us)){
      $_SESSION['semresultados'] = 'Nenhuma folha de ponto no sistema.';
      echo "<div class='error-message'>{$_SESSION['semresultados']}</div>";
      unset($_SESSION['semresultados']);
    }

    echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Funcionário ID</th>";
        echo "<th>Horário Chegada</th>";
        echo "<th>Horário Saída</th>";
        echo "<th>Telefone</th>";
        echo "<th>Horas</th>";
        echo "</tr>";

        echo "<tbody>";

    foreach ($us as $us) {
      echo "<div>";
    	echo "<table>";
      echo "<tr>";
      echo "<td><p>" . $us['id'] . "</p></td>";
      echo "<td><p>" . $us['funcionario_id'] . "</p></td>";
      echo "<td><p>" . $us['horario_chegada'] . "</p></td>";
      echo "<td><p>" . $us['horario_saida'] . "</p></td>";
      echo "<td><p>" . $us['horas'] . "</p></td>";
      echo "</tr>";
      echo "</table>";
      echo "<div>";

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
    </body>
    </html>