<?php
session_start();
    //Definir fuso horário padrão
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relógio de Ponto</title>
</head>
<body>
    <h1>Registar Ponto</h1>

    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
  ?>

    <!--Seletor horário-->
    <p id="horario"><?php echo date("d/m/Y H:i:s"); ?></p>

    <a href="actions/register_point.php">Registar</a>

    <script src="js/app.js"></script>
</body>
</html>