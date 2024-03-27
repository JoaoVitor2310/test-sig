<?php

if (!isset ($_SESSION)) {
    session_start();
}

if (!isset ($_SESSION['login'])) {
    die ('Você não está logado. <p><a href="?page=login">Logar</a></p>');
}
?>