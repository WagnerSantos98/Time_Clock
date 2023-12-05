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
    $id_usuario = 1;

    //Recuperar o último ponto do usuário
    $sql_ponto = "SELECT id, saida_intervalo, retorno_intervalo, saida FROM pontos WHERE usuario_id =:usuario_id ORDER BY id DESC LIMIT 1";

    $result_ponto = $conn->prepare($sql_ponto);

    $result_ponto->bindParam(':usuario_id',$id_usuario);

    //Executar a QUERY
    $result_ponto->execute();

    //Verificar se encontrou algum registro no banco de dados
    if(($result_ponto)and ($result_ponto)->rowCount() != 0){
        //Realizar a leitura do registro
        $row_ponto = $result_ponto->fetch(PDO:: FETCH_ASSOC);
        var_dump($row_ponto);

        //Extrair para imprimir através do nome da chave no array
        extract($row_ponto);

        //
        if(($saida_intervalo == "") or ($saida_intervalo == null)){

        }
    }else{
        echo "Nenhum ponto encontrado";
    }
?>