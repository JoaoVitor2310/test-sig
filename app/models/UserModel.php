<?php

require_once '../utils/Conn.php';

class UserModel
{
    public function searchUser($email)
    {

        $conn = new Conn();
        $pdo = $conn->pdo();

        $statement = $pdo->prepare("SELECT email FROM users WHERE email = '$email' LIMIT 1");
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    
    public function insertUser($email, $password)
    {

        $conn = new Conn();
        $pdo = $conn->pdo();

        $statement = $pdo->prepare("INSERT INTO users (email, password) VALUES ('$email', '$password')");
        $success = $statement->execute();

        // Verifica se a inserção foi bem-sucedida
        if ($success) {
            // $query = $pdo->prepare("SELECT id FROM users WHERE email = '$email' LIMIT 1");
            return $email;
        } else {
            return 0;
        }
    }

    public function loginUser($email)
    {
        $conn = new Conn();
        $pdo = $conn->pdo();

        $statement = $pdo->prepare("SELECT * FROM users WHERE email = '$email' LIMIT 1");
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);


        return $user;

        // Verifica se a inserção foi bem-sucedida
        // if ($success) {
        //     // $query = $pdo->prepare("SELECT id FROM users WHERE email = '$email' LIMIT 1");
        //     return $email;
        // } else {
        //     return 0;
        // }
    }
}