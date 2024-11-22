<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Funcionário e Cargo UltramixRH</title>
  <link rel="stylesheet" href="./../../css/form.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="./../../img/Logotipo_moderno_minimalista_azul_marinho_para_ecommerce-removebg-preview.png" alt="logo" class="logo">
            </div>
            
            
            <?php
    require './.././../../modelo/DAO/ClassUsuarioDAO.php';

    $classUsuarioDAO = new ClassUsuarioDAO();
    $us = $classUsuarioDAO->listarfuncionariocargo();


      echo "<table>";
      echo "<tr>";
      echo "<td><p>Nome</p></td>";
      echo "<td><p>Cargo</p></td>";
      echo "<td><p>CargaHoraria</p></td>";
      echo "<td><p>FaixaSalarial</p></td>";
      echo "<td><p>CPF</p></td>";
      echo "<td><p>Email</p></td>";
      echo "<td><p>Telefone</p></td>";
      echo "</tr>"; 
      echo "</table>";


    foreach ($us as $us) {
      echo "<div>";
    	echo "<table>";
      echo "<tr>";
      echo "<td><p>" . $us['Nome'] . "</p></td>";
      echo "<td><p>" . $us['Cargo'] . "</p></td>";
      echo "<td><p>" . $us['CargaHoraria'] . "</p></td>";
      echo "<td><p>" . $us['FaixaSalarial'] . "</p></td>";
      echo "<td><p>" . $us['CPF'] . "</p></td>";
      echo "<td><p>" . $us['Email'] . "</p></td>";
      echo "<td><p>" . $us['Telefone'] . "</p></td>";
      echo "</tr>"; 
      echo "</table>";
      echo "<div>";

    }



?>
<br><br>
<button type="button" class="btn-submit" onclick="window.location.href='../../../menu.html'">Voltar</button>
            
            <div id="error-message" class="error-message"></div>

            </div>

        </div>
    </div>
    <script src=""></script>
    </body>
    </html>