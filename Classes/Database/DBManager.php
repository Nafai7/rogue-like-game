<?php

// Provides access to database version 1.0
// All queries are parameterized to avoid sql injections

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

    // users
    public function addUser($nickname, $password): bool {
        $sql = self::$mysqli->prepare("INSERT INTO users (nickname, password) VALUES (?,?)");
        $sql->bind_param("ss", $nickname, $password);

        return $sql->execute();
    }

    public function getUserByUsername($nickname): ?array {
        $sql = self::$mysqli->prepare("SELECT * FROM users WHERE nickname = ?");
        $sql->bind_param("s", $nickname);
        $sql->execute();

        return $sql->get_result()->fetch_array();
    }

    public function getUserById($id): ?array {
        $sql = self::$mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        return $sql->get_result()->fetch_array();
    }

    public function checkIfUserExists($nickname): bool {
        $sql = self::$mysqli->prepare("SELECT * FROM users WHERE nickname = ?");
        $sql->bind_param("s", $nickname);
        $sql->execute();
        $sql->store_result();

        if ($sql->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // tokens
    public function addToken($user_id, $token, $expiration): bool {
        $sql = self::$mysqli->prepare("INSERT INTO tokens (user_id, token, expiration) VALUES (?,?,?)");
        $sql->bind_param("iss", $user_id, $token, $expiration);

        return $sql->execute();
    }

    public function getTokens($user_id): ?array {
        $sql = self::$mysqli->prepare("SELECT token, expiration FROM tokens WHERE user_id = ? AND expiration >= NOW()");
        $sql->bind_param("i", $user_id);
        $sql->execute();

        return $sql->get_result()->fetch_all();
    }

    public function getTokensExpiration($token): ?array {
        $sql = self::$mysqli->prepare("SELECT expiration FROM tokens WHERE token BINARY = ?");
        $sql->bind_param("s", $token);
        $sql->execute();

        return $sql->get_result()->fetch_array();
    }

    public function deleteExpiredTokens(): bool {
        return self::$mysqli->query("DELETE FROM tokens WHERE expiration < CURRENT_DATE()");
    }

    // saved_games
    public function addSavedGame($user_id, $data, $score): int {
        $sql = self::$mysqli->prepare("INSERT INTO saved_games (user_id, data, score) VALUES (?,?,?)");
        $sql->bind_param("isi", $user_id, $data, $score);
        $sql->execute();

        return $sql->insert_id;
    }

    public function updateSavedGame($id, $data, $score): bool {
        $sql = self::$mysqli->prepare("UPDATE saved_games SET data = ?, score = ? WHERE id = ?");
        $sql->bind_param("ssi", $data, $score, $id);
        $sql->execute();
        
        if ($sql->affected_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getSavedGames($user_id): ?array {
        $sql = self::$mysqli->prepare("SELECT * FROm saved_games WHERE user_id = ?");
        $sql->bind_param("i", $user_id);
        $sql->execute();

        return $sql->get_result()->fetch_all();
    }

    public function deleteSavedGame($id): bool {
        $sql = self::$mysqli->prepare("DELETE FROM saved_games WHERE id = ?");
        $sql->bind_param("i", $id);
        
        return $sql->execute();
    }

}

?>