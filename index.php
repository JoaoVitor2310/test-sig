<?php
session_start();
if (!isset ($_SESSION['login'])) {
    echo 'Deslogado.';
} else {
    echo $_SESSION['login'];
}

// include ('conn.php'); // Conecta ao banco de dados no Xamp(servidor php/mysql/etc)

require_once 'app/core/Core.php';
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErrorController.php';
require_once 'app/controller/UserController.php';

// require 'app/router/routes.php';

// $core = new Core;
// $core->start($_GET);

// ob_start();
// $output = ob_get_contents();
// ob_end_clean();
// echo 'output: ' . $output;

// if (!isset ($_SESSION['login'])) {
// } else {
$page = $_GET['page'];
if ($page) {
    include 'app/View/' . $page . '.php';
} else {
    include 'app/View/index.php';
}
// }

?>