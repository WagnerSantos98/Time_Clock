<?php
session_start();

include_once("db/conexao.php");
    //Definir fuso horário padrão
    date_default_timezone_set('America/Sao_Paulo');
$proxNumeroRegistro = 1;

    if (isset($_POST['cadastrar_usuario'])) {
        // Obtenha o próximo número de registro
        $query = "SELECT MAX(numero_registro) AS max_registro FROM colaboradores";
        $result = $conn->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $proxNumeroRegistro = $row['max_registro'] + 1;
    
        // Dados do formulário
        $nomeCompleto = $_POST["nome_completo"];
        $cargo = $_POST["cargo"];
        $setor = $_POST["setor"];
        $celular = $_POST["celular"];
        $email = $_POST["email"];
    
        // Inserir dados na tabela 'colaboradores'
        $sql_register = "INSERT INTO colaboradores (nome_completo, numero_registro, cargo, setor, celular, email)
                            VALUES (:nome_completo, :numero_registro, :cargo, :setor, :celular, :email)";
        
        // Prepare a declaração
        $stmt = $conn->prepare($sql_register);
    
        // Vincule os parâmetros
        $stmt->bindParam(':nome_completo', $nomeCompleto);
        $stmt->bindParam(':numero_registro', $proxNumeroRegistro);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':setor', $setor);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':email', $email);
        
        // Execute a inserção
        $stmt->execute();

        var_dump ("Valor de proxNumeroRegistro após a execução: " . $proxNumeroRegistro);

    }
    
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

    <!--Compiled Google Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/materialize-functions.js"></script>
    <title>Relógio de Ponto</title>
</head>
<body>

  <div class="container">
    <div class="card-panel grey lighten-5">
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
                            if(isset($_SESSION['n           '])){
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

    <!--Menu - Cadastro-->
    <div class="fixed-action-btn horizontal click-to-toggle spin-close">
        <a class="btn-floating btn-large red"><i class="material-icons">menu</i></a>
        <ul>
            <li title="Cadastrar"><a class="waves-effec waves-light btn-floating grey lighten-1 modal-trigger" href="#modal-cadastro"><i class="material-icons">add</i></a></li>
        </ul>
    </div>
  </div>

  <!--Modal Cadastro de Usuário (Colaborador)-->  
  <div id="modal-cadastro" class="modal">
    <div class="modal-content">
        <h4>Cadastro de Usuário</h4>
    <div class="row">
        <form action="actions/register_user.php" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="nome_completo" class="validate">
                    <label for="nome_completo">Nome Completo</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" name="numero_registro" class="validate" value="<?= $proxNumeroRegistro; ?>" readonly> 
                    <label for="numero_registro">Nº de Registro</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="celular" class="validate">
                    <label for="cargo">Cargo</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="setor" class="validate">
                    <label for="setor">Setor</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="cargo" class="validate">
                    <label for="celular">Celular</label>
                </div>
                <div class="input-field col s6">
                    <input type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="modal-footer">
                <button name="cadastrar_usuario" type="submit" class="waves-effect waves-light btn green lighten-1">Salvar</button>
                <a class="modal-close waves-effect waves-light btn red lighten-1">Cancelar</a>
            </div>
        </form>
    </div>
    </div>
  </div>                              
</body>
</html>