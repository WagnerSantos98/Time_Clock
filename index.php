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
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="assets/js/app.js"></script>
    <title>Relógio de Ponto</title>
</head>
<body>

  <div class="container">
    <div class="card-panel grey ligthen-2">
        <div class="row">
            <h1>Relógio de Ponto</h1>
            <form class="col s12">
                <div class="col m4">
                    <div class="card-panel teal">
                        <output id="horario" class="time"><?php echo date("d/m/Y H:i:s"); ?></output>
                    </div>
                </div>

                <div class="col m4">
                    <div class="card-panel teal">
                        <label for="">Colaborador</label>
                        <select name="" id="">
                            <option value=""><?php
                            if(isset($_SESSION['nome_colaborador'])){
                                echo $_SESSION['nome_colaborador'];
                            }
                            ?></option>
                        </select>
                        <a href="actions/register_point.php" class="btn btn-primary">Entrada</a>
                        <a href="actions/register_point.php" class="btn btn-primary">Saída</a>
                        <div class="alert alert-primary" role="alert">
                        <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                        ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

    

    <!--<a href="actions/register_point.php">Registar</a>-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
</script>
</body>
</html>