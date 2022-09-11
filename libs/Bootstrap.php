<?php

class Bootstrap {

    function __construct() {
        $url = $_SERVER['REQUEST_URI'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);


        if (!isset($url[2])) {
            require 'controllers/home.php';

            //pour donner focus au lien de la navbar
            define('NAVBAR_LINK', 'home');
            
            $controller = new Home();
            $controller->index();

            //instance du model du controller instancier
            $controller->loadModel('home');

            return false;
        }

        $file = 'controllers/' . $url[2] . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            $this->error();
            return false;
        }

        $mon_controller = ucfirst($url[2]);
        //instance du controller consequent
        $controller = new $mon_controller;
        //instance du model du controller instancier
        $controller->loadModel($url[2]);

        //pour donner focus au lien de la navbar
        define('NAVBAR_LINK', $url[2]);

        //appel dans la methode si le 3eme parametre existe et/ou a un paramtre ou plus
        if (isset($url[5])) {
            if (method_exists($controller, $url[3])) {
                $controller->{$url[3]}($url[4], $url[5]);
            } else {
                $this->error();
            }
        } else {

            if (isset($url[4])) {
                if (method_exists($controller, $url[3])) {
                    $controller->{$url[3]}($url[4]);
                } else {
                    $this->error();
                }
            } else {
                if (isset($url[3])) {
                    if (method_exists($controller, $url[3])) {
                        $controller->{$url[3]}();
                    } else {
                        $this->error();
                    }
                } else {
                    $controller->index();
                }
            }
        }
    }

    private function error() {
        require 'controllers/my_error.php';
        $controller = new My_error();
        $controller->index();
    }

}
