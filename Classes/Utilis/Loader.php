<?php

// Loader thats assembles page from header, page view, footer
// includes matching css and js file

namespace Nafai\Utilis;

require_once __DIR__."/../Logging/Login.php";

use Nafai\Logging\Login;

class Loader {

    private function loadHeader($view_name) {
        echo <<<HTML
            <!DOCTYPE html>
            <html>
            <head>
        HTML;
        
        require_once("Views/head.html");
        
        if (file_exists("CSS/".$view_name.".css")) {
            echo '<link rel="stylesheet" href="CSS/'.$view_name.'.css">';
        }
        if (file_exists("JS/".$view_name.".js")) {
            echo '<script src="JS/'.$view_name.'.js"></script>';
        }

        echo <<<HTML
            </head>
            <body>
        HTML;
    }

    public function loadView($view) {
        session_start();

        $login = new Login();
        $login->login();

        $tmp = explode("/",$view);
        $this->loadHeader(end($tmp));

        include($view.".php");

        require_once("Views/footer.html");
    }
}

?>