<?php

require_once '../controller/UserController.php';
require_once '../models/UserModel.php';

$jsonData = file_get_contents('php://input');
// $registerData = json_decode($jsonData, true);
$data = json_decode($jsonData, true);

// echo $registerData;
// echo $loginData;
// echo 'teste@gmail.com';
// echo json_encode(['email' => 'teste@gmail.com']);
// echo json_encode($data);

// Register
if (isset ($data) && !empty ($data) && array_key_exists('confirm_password', $data)) {

    $userController = new UserController();
    $response = $userController->register($data);

    // Envia a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Login
if (isset ($data) && !empty ($data)) {

    $userController = new UserController();
    $response = $userController->login($data);

    // Envia a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}