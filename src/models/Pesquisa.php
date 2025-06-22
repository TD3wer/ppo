<?php
class Pesquisa {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM pesquisas");
        return $stmt->fetchAll();
    }
}
