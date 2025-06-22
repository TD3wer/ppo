<?php
class Auxilio {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM auxilios");
        return $stmt->fetchAll();
    }
}
