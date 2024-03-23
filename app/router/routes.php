<?php

// Inclui os arquivos necessários
// require_once '../controller/UserController.php';

// Verifica a rota solicitada e chama o controlador correspondente
$requestUri = $_SERVER['REQUEST_URI'];
var_dump($requestUri);

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST' && $requestUri === '/api/register') {
    echo 'RESPOSTA';
    die;
    $userController = new UserController();
    $response = $userController->register();
}

// else {
//     // Se a rota solicitada não for encontrada, retorna um código de status HTTP 404 (Não encontrado)
//     http_response_code(404);
//     echo "Página não encontrada";
// }
