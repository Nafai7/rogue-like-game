<?php

// Contains

namespace Nafai\Logging;

require "Classes/Database/DBManager.php";

use Nafai\Database\DBManager;

class Login {

    private $db_manager;

    public function __construct() {
        $this->db_manager = DBManager::getInstance();
    }

    public function register($nickname, $password): array {
        $result = array("success" => 0, "message" => "");

        if ($this->db_manager->checkIfUserExists($nickname)) {
            $result["message"] = "Username taken";
        } else if (!$this->db_manager->addUser($nickname, password_hash($password, PASSWORD_DEFAULT))) {
            $result["message"] = "Failed to register";
        } else {
            $result["success"] = 1;
        }

        return $result;
    }
    
    public function login() {

    }
}

?>