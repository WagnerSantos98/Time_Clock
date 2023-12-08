<?php
session_start();

include_once("../db/conexao.php");

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
}

?>



