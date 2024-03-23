<?php

$hostname = 'localhost';
$database = 'teste-sig';
$user = 'root';
$password = '';

$mysqli = new mysqli($hostname, $user, $password, $database);

if ($mysqli->connect_errno) {
    echo 'Falha ao conectar ao banco de dados: ' . $mysqli->connect_error;
} else {
    echo 'Conexão bem sucedida ao banco de dados.';
}

?>