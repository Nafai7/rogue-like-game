<?php

// Manages account creating and authentication

namespace Nafai\Logging;

require_once __DIR__."/../Database/DBManager.php";

use Nafai\Database\DBManager;

class Login {

    private $db_manager;

    public function __construct() {
        $this->db_manager = DBManager::getInstance();
    }

    public function register($nickname, $password): array {
        $result = array("success" => 0, "message" => "");

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $result["message"] = "No credentials";
        } else if ($this->db_manager->checkIfUserExists($nickname)) {
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
                setcookie('user_id', $userData[0], date('Y-m-d', strtotime(date('Y-m-d', time()). ' + 30 days')));
                $flag = true;
            }

            if ($_POST['remeberMe']) {
                $generatedToken = bin2hex(random_bytes(16));
                if ($db_manager->addToken($_COOKIE['user_id'], $generatedToken, date('Y-m-d', strtotime(date('Y-m-d', time()). ' + 30 days')))) {
                    setcookie('token', $generatedToken, date('Y-m-d', strtotime(date('Y-m-d', time()). ' + 30 days')));
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

    public function logout() {
        if (isset($_SESSION['isLogged'])) {
            unset($_SESSION['isLogged']);
        }
        if (isset($_COOKIE['token']) && isset($_COOKIE['user_id'])) {
            unset($_COOKIE['token']);
            setcookie('token', '', 1);

            unset($_COOKIE['user_id']);
            setcookie('user_id', '', 1);
        }
    }
}

?>