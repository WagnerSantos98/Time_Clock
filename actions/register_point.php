<?php
session_start();

//Limpar o buffer
ob_start();

include_once("../db/conexao.php");
    //Definir fuso horário padrão
    date_default_timezone_set('America/Sao_Paulo');
    
    //Gerar o horário atual
    $horario_atual = date("H:i:s");

    //Gerar data atual no formato salvo em BD
    $data_entrada = date('Y/m/d');

    //ID fixo para teste
    $id_usuario = 1;

    //Recuperar o último ponto do usuário
    $sql_ponto = "SELECT id AS id_ponto, saida_intervalo, retorno_intervalo, saida 
                  FROM pontos 
                  WHERE colaborador_id =:colaborador_id 
                  ORDER BY id DESC LIMIT 1";

    $result_ponto = $conn->prepare($sql_ponto);

    $result_ponto->bindParam(':colaborador_id',$id_usuario);

    //Executar a QUERY
    $result_ponto->execute();

    //Verificar se encontrou algum registro no banco de dados
    if(($result_ponto)and ($result_ponto)->rowCount() != 0){
        //Realizar a leitura do registro
        $row_ponto = $result_ponto->fetch(PDO:: FETCH_ASSOC);

        //Extrair para imprimir através do nome da chave no array
        extract($row_ponto);

        //Verificar se o usuário bateu o pontop de saída para o intervalo
        if(($saida_intervalo == "") or ($saida_intervalo == null)){
            //Colunas que deve receber o valor
            $col_tipo_registro = "saida_intervalo";

            //Tipo de registro
            $tipo_registro = "editar";

            //Texto parcial que deve ser apresentado para o usuário
            $text_tipo_registro = "saída intervalo"; 
        }else if(($retorno_intervalo == "") or ($retorno_intervalo == null)){ //Verificar se o usuário bateu o ponto de retorno do intervalo
            //Colunas que deve receber o valor
            $col_tipo_registro = "retorno_intervalo";

            //Tipo de registro
            $tipo_registro = "editar";

            //Texto parcial que deve ser apresentado para o usuário
            $text_tipo_registro = "retorno intervalo"; 
        }
        else if(($saida == "") or ($saida == null)){ //Verificar se o usuário bateu o ponto de saída
            //Colunas que deve receber o valor
            $col_tipo_registro = "saida";

            //Tipo de registro
            $tipo_registro = "editar";

            //Texto parcial que deve ser apresentado para o usuário
            $text_tipo_registro = "saída"; 
        }else{ //Criar novo registro no BD com horário de entrada

            //Tipo de registro
            $tipo_registro = "entrada";

            //Texto parcial que deve ser apresentado para o usuário
            $text_tipo_registro = "entrada"; 
        }
    }else{
         //Tipo de registro
         $tipo_registro = "entrada";

         //Texto parcial que deve ser apresentado para o usuário
         $text_tipo_registro = "entrada"; 
    }

    //verificar o tipo de registro, novo ponto ou editar registro existente
    switch ($tipo_registro) {
        //Acessa o case quando deve editar o registro
        case "editar": 
            //Query para editar no banco de dados
            $query_horario = "UPDATE pontos SET $col_tipo_registro =:horario_atual 
                              WHERE id=:id LIMIT 1";

            //Preparar a Query
            $cad_horario = $conn->prepare($query_horario);

            //Substituir o link da Query pelo valor
            $cad_horario->bindParam(':horario_atual',$horario_atual);
            $cad_horario->bindParam(':id',$id_ponto);
            break;
        default:
        
           $query_horario = "INSERT INTO pontos (data_entrada, entrada, colaborador_id) VALUES (:data_entrada, :data_entrada, :colaborador_id)";

           //Preparar a Query
           $cad_horario = $conn->prepare($query_horario);

           //Substituir o link da Query pelo valor
           $cad_horario->bindParam(':data_entrada',$data_entrada);
           $cad_horario->bindParam(':entrada',$horario_atual);
           $cad_horario->bindParam(':colaborador_id',$id_usuario);
        break;

    }

    //Executar a QUERY
    $cad_horario->execute();

    //Acessa o IF quando cadastrar com sucesso
    if($cad_horario->rowCount()){
        $_SESSION ['msg'] = "<p style='color: white;'>Horário de $text_tipo_registro cadastrado com sucesso!</p>";
        header("Location:../index.php");
    }else{
        $_SESSION ['msg'] = "<p style='color: red;'>Horário de $text_tipo_registro não cadastrado com sucesso!</p>";
        header("Location:../index.php");
    }
?>