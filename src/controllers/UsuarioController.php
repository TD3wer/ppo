<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Usuario($pdo);
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'index';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->insert($_POST);
                    header('Location: ?page=usuarios');
                    exit;
                }
                require __DIR__ . '/../views/usuarios/form.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID não fornecido.");
                }

                $usuario = $this->model->getById($id);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: ?page=usuarios');
                    exit;
                }

                require __DIR__ . '/../views/usuarios/form.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->delete($id);
                }
                header('Location: ?page=usuarios');
                break;

            case 'index':
            default:
                $usuarios = $this->model->getAll();
                require __DIR__ . '/../views/usuarios/index.php';
                break;
        }
    }
}
?>