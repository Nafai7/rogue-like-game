<?php

require "Utilis/Router.php";

use Nafai\Utilis\Router;

$router = new Router();
$router->notFound("Views/not_found");
$router->add("/", "Views/home");
$router->matchRoute();

?>