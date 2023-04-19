<?php

// Manages account creating and authentication

namespace Nafai\Logging;

require_once "Classes/Database/DBManager.php";

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
    
    public function login(): array {
        $result = array("success" => 0, "message" => "");
        $flag = false;

        if (isset($_SESSION['isLogged'])) {
            $result["message"] = "User already logged in";
        } else if (isset($_COOKIE['token']) && isset($_COOKIE['user_id'])) {
            $userTokens = $db_manager->getTokens($_COOKIE['user_id']);

            if (count($userTokens) == 0) {
                $result["message"] = "No active tokens";
            } else {
                foreach ($userTokens as $token) {
                    if ($token[0] == $_COOKIE['token']) {
                        $flag = true;
                        break;
                    }
                }
            }
        } else if (isset($_POST['username']) && isset($_POST['password'])) {
            $userData = $db_manager->getUser($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT));

            if (count($userData) == 0) {
                $result["message"] = "Wrong username or password";
            } else {
                $_COOKIE['user_id'] = $userData[0];
                $flag = true;
            }

            if ($_POST['remeberMe']) {
                $generatedToken = bin2hex(random_bytes(16));
                if ($db_manager->addToken($_COOKIE['user_id'], $generatedToken, date('Y-m-d', strtotime($Date. ' + 30 days')))) {
                    $_COOKIE['token'] = $generatedToken;
                }
            }
        } else {
            $result["message"] = "No credentials";
        }

        if ($flag) {
            $result["success"] = 1;
            $_SESSION['isLogged'] = true;
        }

        return $result;
    }
}

?>