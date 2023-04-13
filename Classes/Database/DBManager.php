<?php

namespace Nafai\Database;

class DBManager {
    private static $db_manager;
    private static $mysqli;

    private function __construct() {
        self::$mysqli = new \mysqli("127.0.0.1", "root", "", "rogue-like", 3306);
    }
    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton");
    }

    public static function getInstance() {
        if (!isset(self::$db_manager)) {
            self::$db_manager = new self();
        }
    }
}

?>