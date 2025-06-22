<?php
require_once __DIR__ . '/../models/Auxilio.php';

class AuxilioController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Auxilio($pdo);
    }

    public function index() {
        $auxilios = $this->model->getAll();
        require_once __DIR__ . '/../views/auxilios/index.php';
    }

    public function handleRequest() {
        $this->index();
    }
}
