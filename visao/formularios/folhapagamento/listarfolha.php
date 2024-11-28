<?php 
session_start();

if (!isset($_SESSION['usuario'])){
header('Location: ../../../index.php');
exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Folha de Pagamento UltraMix RH</title>
  <link rel="stylesheet" href="./../../css/form.css">
  <link rel="stylesheet" href="./../../css/listagem.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
            </div>
            <h1>Listar Folha</h1>
            <?php

if (isset($_SESSION['mensagem'])) {
  echo "<div class='error-message'>{$_SESSION['mensagem']}</div>";
  unset($_SESSION['mensagem']);
}
?>
            
            <?php
    require './.././../../modelo/DAO/ClassUsuarioDAO.php';

    $classUsuarioDAO = new ClassUsuarioDAO();
    $us = $classUsuarioDAO->listarfolhapagamento();

    if (empty($us)){
      $_SESSION['semresultados'] = 'Nenhuma folha de pagamento no sistema.';
      echo "<div class='error-message'>{$_SESSION['semresultados']}</div>";
      unset($_SESSION['semresultados']);
    }else{

      echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Funcionario ID</th>";
            echo "<th>Cargo ID</th>";
            echo "<th>Salario Padrão</th>";
            echo "<th>Benefícios</th>";
            echo "<th>Bônus</th>";
            echo "<th>Valor a Receber</th>";
            echo "</tr>";
    
            echo "<tbody>";

    foreach ($us as $us) {
     
      echo "<tr>";
      echo "<td><p>" . $us['id'] . "</p></td>";
      echo "<td><p>" . $us['funcionario_id'] . "</p></td>";
      echo "<td><p>" . $us['cargo_id'] . "</p></td>";
      echo "<td><p>R$" . $us['salario_bruto'] . "</p></td>";
      echo "<td><p>R$" . $us['beneficios'] . "</p></td>";
      echo "<td><p>R$" . $us['bonus'] . "</p></td>";
      echo "<td><p>R$" . $us['valor_receber'] . "</p></td>";
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