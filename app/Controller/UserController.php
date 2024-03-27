<?php

class UserController
{

    public function register($registerData)
    {
        $email = isset ($registerData['email']) ? $registerData['email'] : null;
        $password = isset ($registerData['password']) ? $registerData['password'] : null;
        $confirm_password = isset ($registerData['confirm_password']) ? $registerData['confirm_password'] : null;

        if (empty ($email) || empty ($password)) { //Se não tiver os dados, eles virão como null ou vazio e será retornado um erro

            http_response_code(400);
            return array(
                'error' => true,
                'message' => 'Dados não preenchidos.'
            );
        }

        if (strlen($password) < 5) {
            http_response_code(400);
            return array(
                'error' => true,
                'message' => 'Senha muito fraca.'
            );
        }
        
        if($password !== $confirm_password){
            http_response_code(400);
            return array(
                'error' => true,
                'message' => 'As senhas não são iguais.'
            );
        }

        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Cria uma instância do modelo de usuário
        $userModel = new UserModel();

        $userFromDB = $userModel->searchUser($email);

        if($userFromDB){
            http_response_code(400);
            return array(
                'error' => true,
                'message' => 'Email já cadastrado.'
            );
        }

        //Chama a função para registrar o usuário
        $dbResponse = $userModel->insertUser($email, $hashedPassword);

        if ($dbResponse == 0) {
            http_response_code(500);
            return array(
                'error' => true,
                'message' => 'Erro ao cadastrar no banco de dados.'
            );
        }

        session_start();
        $_SESSION['login'] = $email;

        http_response_code(201);
        return array(
            'error' => false,
            'message' => 'Usuario registrado com sucesso.'
        );


    }

    public function login($loginData)
    {
        $email = isset ($loginData['email']) ? $loginData['email'] : null;
        $password = isset ($loginData['password']) ? $loginData['password'] : null;

        if (empty ($email) || empty ($password)) { //Se não tiver os dados, eles virão como null ou vazio e será retornado um erro

            http_response_code(400);
            return array(
                'error' => true,
                'message' => 'Dados não preenchidos.'
            );
        }

        // Cria uma instância do modelo de usuário
        $userModel = new UserModel();

        // Chama o método para registrar o usuário
        $dbResponse = $userModel->loginUser($email);

        if (!$dbResponse) {
            http_response_code(404);
            return array(
                'error' => true,
                'message' => 'Usuário não encontrado.'
            );
        }

        if (password_verify($password, $dbResponse['password'])) {
            session_start();
            $_SESSION['login'] = $email;

            http_response_code(201);
            return array(
                'error' => false,
                'message' => 'Login realizado com sucesso.'
            );

        } else {
            http_response_code(403);
            return array(
                'error' => true,
                'message' => 'Senha incorreta.'
            );
        }

    }
}