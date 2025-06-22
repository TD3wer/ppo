<?php
require_once __DIR__ . '/../models/Pesquisa.php';

class PesquisaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Pesquisa($pdo);
    }

    public function index() {
        $pesquisas = $this->model->getAll();
        require_once __DIR__ . '/../views/pesquisas/index.php';
    }

    public function handleRequest() {
        $this->index();
    }
}
