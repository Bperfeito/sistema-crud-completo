<?php

include("db/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "UPDATE clientes SET
nome='$nome',
email='$email',
telefone='$telefone'
WHERE id=$id";

if($conn->query($sql) === TRUE){

    header("Location: index.php");

}else{

    echo "Erro ao atualizar: " . $conn->error;

}

?>