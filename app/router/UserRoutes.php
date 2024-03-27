<?php

require_once '../controller/UserController.php';
require_once '../models/UserModel.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);



if (isset ($data) && !empty ($data) && array_key_exists('confirm_password', $data)) { // Register

    $userController = new UserController();
    $response = $userController->register($data);

    // Envia a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else if (isset ($data) && !empty ($data)) { // Login

    $userController = new UserController();
    $response = $userController->login($data);

    // Envia a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}



