<?php

 class Conn{

   private $host;
   private $user;
   private $password;
   private $bd;

  public function pdo(){

    $host   = "localhost"; // O ideal seria esconder esses dados em um arquivo .env por exemplo, para não ficar exposto
    $user   = "root";
    $password  = "";
    $bd     = "teste-sig";
    try{
      $pdo = new \PDO("mysql:host=$host;dbname=$bd", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8MB4"));

      return $pdo;
    }catch(PDOException $e){
      echo "<div style='margin-top:100px;text-align:center;font-family:arial;'><h1 >Manutenção</h1><p>Retornaremos em breve</p><div>";

      die;
    }
  }

 }

 ?>