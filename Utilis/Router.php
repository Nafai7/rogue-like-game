<?php

namespace Nafai\Utilis;

require "Utilis/Loader.php";

class Router {
    private $routes = array();
    private $not_found_view;

    public function add($route, $view) {
        $this->routes[$route] = $view;
    }

    public function notFound($view) {
        $this->not_found_view = $view;
    }

    public function matchRoute() {
        foreach ($this->routes as $route => $view) {
            if ($_SERVER["REQUEST_URI"] == $route) {
                $loader = new Loader();
                $loader->loadView($view);
                exit();
            }
        }

        include($this->not_found_view);
    }
}

?>