<?php

// require_once 'UserModel.php';

class UserController
{
    public function register()
    {
        // Aqui você pode realizar qualquer lógica necessária para registrar o usuário
        // Por exemplo, acessar os dados do formulário e salvar no banco de dados

        // Suponha que os dados do formulário estejam disponíveis no $_POST
        $email = isset ($_POST['email']) ? $_POST['email'] : null;
        $password = isset ($_POST['password']) ? $_POST['password'] : null;

        if ($email === null || $password === null) { //Se não tiverem os dados, eles virão como null e será lançada uma exceção
            throw new InvalidArgumentException('Email ou senha não foram fornecidos');
        }
        echo json_encode(array('message' => 'Usuário registrado com sucesso'));

        // Debug
        // die;

        // Criptografa a senha (recomendado)
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // // Cria uma instância do modelo de usuário
        // $userModel = new UserModel();

        // // Chama o método para registrar o usuário
        // $userModel->registerUser($email, $hashedPassword);

        // // Responde com uma mensagem de sucesso
        // echo json_encode(array('message' => 'Usuário registrado com sucesso'));
    }
}