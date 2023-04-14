<?php

// Provides access to database version 1.0

namespace Nafai\Database;

class DBManager {
    private static ?DBManager $db_manager;
    private static $mysqli;

    private function __construct() {
        self::$mysqli = new \mysqli("127.0.0.1", "root", "", "rogue-like", 3306);
    }
    
    public function __destruct() {
        self::$mysqli->close();
    }

    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton");
    }

    public static function getInstance() {
        if (!isset(self::$db_manager)) {
            self::$db_manager = new self();
        }

        return self::$db_manager;
    }

    //##########Database access##########

    public function addUser($nickname, $password): bool {
        $sql = self::$mysqli->prepare("INSERT INTO users (nickname, password) VALUES (?,?)");
        $sql->bind_param("ss", $nickname, $password);
        $result = $sql->execute();
        $sql->close();

        return $result;
    }

    public function getUserByNicknameAndPassword($nickname, $password): \mysqli_result {
        $sql = self::$mysqli->prepare("SELECT * FROM users WHERE nickname = ? AND password = ?");
        $sql->bind_param("ss", $nickname, $password);
        $sql->execute();

        return$sql->get_result();
    }

    public function getUserById($id): \mysqli_result {
        $sql = self::$mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        return $sql->get_result();
    }

    public function __call($method, $arguments) {
        switch ($method) {
            case "getUser":
                if (count($arguments) == 1) {
                    return call_user_func_array(array($this, "getUserById"), $arguments);
                } else if (count($arguments) == 2) {
                    return call_user_func_array(array($this, "getUserByNicknameAndPassword"), $arguments);
                }
                break;

        }
    }

}

?>