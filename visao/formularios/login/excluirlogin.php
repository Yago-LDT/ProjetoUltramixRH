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
      <title>Excluir Login - UltraMix RH</title>
      <link rel="stylesheet" href="./../../css/form.css">
    </head>
    <body>
    
      <div class="login-container">
        <div class="login-box">
          <div class="logo-container">
            <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
          </div>
          <h1>Excluir Login</h1>
          <?php

  if (isset($_SESSION['mensagem'])) {
    echo "<div class='error-message'>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']);
  }
?>
<br>
          <div class="input-container">
              <form method="post" id="excluirlogin" action="./.././.././../controle/ControleUsuario.php?ACAO=excluirlogin">
              <label for="excluirid">Usuário a ser Excluído</label>
              <input type="text" id="excluirid" name="excluirid" placeholder="Digite o ID" required>
            </div>
            <button type="submit" class="btn-submit">Excluir</button>
            <br><br>
            <button type="button" class="btn-submit" onclick="window.location.href='../../../menu.php'">Voltar</button>
          </form>
          <div id="error-message" class="error-message"></div>

          
        </div>
      </div>
      <script src=""></script>
    </body>
    </html>
    