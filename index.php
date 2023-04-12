<?php

require "Utilis/Router.php";

use Nafai\Utilis\Router;

$router = new Router();
$router->notFound("Views/not_found.php");
$router->add("/", "Views/home.php");
$router->matchRoute();

?>