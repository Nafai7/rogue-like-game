<?php

require "Classes/Utilis/Router.php";

use Nafai\Utilis\Router;

$router = new Router();
$router->notFound("Views/not_found");
$router->add("/", "Views/home");
$router->add("/login", "Views/login");
$router->matchRoute();

?>