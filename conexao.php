<?php
$servidordb="localhost";
$userdb="root";
$senhadb="";
$nomedb="biblioteca";

$conexao= new mysqli ($servidordb,$userdb,$senhadb,$nomedb);

//if ($conexao->connect_errno){
//    echo "Erro na conexão com o banco de dados:" . $conexao->connect_error;
//}
//else{
//    echo "Conectado com sucesso ao banco de dados!";
//}
?>