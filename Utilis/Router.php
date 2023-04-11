<?php

namespace Nafai\Utilis;

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
                include($view);
                exit();
            }
        }

        include($this->not_found_view);
    }
}