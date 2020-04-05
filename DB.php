<?php

class DB {
    /** @var \PDO PDO client. */
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function get_all_clubs() {
        $stmt = $this->pdo->prepare('SELECT * FROM clubs;');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_club_by_id($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM clubs WHERE id = :id;');
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function get_club_by_name($name) {
        $stmt = $this->pdo->prepare('SELECT * FROM clubs WHERE club_name = :name;');
        $stmt->execute([
            'name' => $name
        ]);
        return $stmt->fetch();
    }

    public function get_clubs_by_league($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM clubs AS c JOIN leagues AS l ON c.league_id = l.id WHERE l.id = :id;');
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetchAll();
    }
}