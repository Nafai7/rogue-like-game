<?php

require "Utilis/Router.php";

use Nafai\Utilis\Router;

$Router = new Router();
$Router->notFound("Views/not_found.php");
$Router->add("/", "Views/home.php");
$Router->matchRoute();

?>