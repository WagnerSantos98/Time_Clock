<?php

session_start();

ob_start();

include_once("../db/conexao.php");

// Verifica se o número de registro foi enviado pela solicitação AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["number_register"])) {
    $number_register = $_POST["number_register"];

    // Consulta SQL para obter o nome correspondente ao número de registro
    $id_colaborador = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT nome_completo FROM colaboradores WHERE numero_registro = :number_register";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':number_register', $number_register);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result["nome_completo"];
    } else {
        echo "Colaborador não encontrado";
    }
} else {
    echo "Número de registro não fornecido";
}

?>