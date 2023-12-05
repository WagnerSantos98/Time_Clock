<?php

//Inicio da conexão com banco de dados utilizando PDO
$localhost = "localhost";
$user = "root";
$password = "";
$dbname = "time_clock";
$port = 3306;

try{
    //Conexão sem a porta
    $conn = new PDO("mysql:host=$localhost;dbname=" .$dbname, $user, $password);
    //echo "Conexão com banco de dados realizado com sucesso.";
}catch(PDOException $err){
    //echo "Erro: Conexão com banco de dados sem sucesso. Erro gerado " . $err->getMessage();
}


?>