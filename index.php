<?php
require_once 'app/controller/UserController.php';

if (isset ($_GET['page'])) {
    $page = $_GET['page'];
    include 'app/View/' . $page . '.php';
} else {
    include 'app/View/index.php';
}

?>