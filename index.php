<?php
session_start();

include ('conn.php'); // Conecta ao banco de dados no Xamp(servidor php/mysql/etc)

require_once 'app/core/Core.php';
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErrorController.php';
require_once 'app/controller/UserController.php';

require_once 'app/router/routes.php';

// $core = new Core;
// $core->start($_GET);

// ob_start();
// $output = ob_get_contents();
// ob_end_clean();
// echo 'output: ' . $output;

// if (!isset ($session['login'])) {
$template = file_get_contents('app/View/index.html');
// } else {
$page = $_GET['page'];
$template = file_get_contents('app/View/' . $page . '.html');
// }
echo $template;




?>