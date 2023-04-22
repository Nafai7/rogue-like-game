<?php
require_once __DIR__."/../../Classes/Logging/Login.php";

use Nafai\Logging\Login;

$login = new Login();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($login->register());
?>