<?php
include_once("../db/conexao.php");
    //Definir fuso horário padrão
    date_default_timezone_set('America/Sao_Paulo');
    
    //Gerar o horário atual
    $horario_atual = date("H:i:s");
    var_dump($horario_atual);

    //Gerar data atual no formato salvo em BD
    $data_entrada = date('Y-m-d');

    //ID fixo para teste
?>