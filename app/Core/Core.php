<?php
class Core
{
    public function start($urlGet)
    {
        $action = 'index';

        if (isset ($urlGet['page'])) {
            $controller = ucfirst($urlGet['page'] . 'Controller'); //Iremos "capturar" a página que estamos e colocar "controller" no final
        } else {
            $controller = 'HomeController';
        }

        if (!class_exists($controller)) {
            $controller = 'ErrorController';
        }

        call_user_func(array(new $controller, $action), array());
    }
}

