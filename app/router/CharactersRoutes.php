<?php

require_once '../controller/CharactersController.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



if (isset($_GET) ) { // getCharacters

    $charactersController = new CharactersController();
    $response = $charactersController->getCharacters();

    // Envia a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}



