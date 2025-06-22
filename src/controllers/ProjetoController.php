<?php
require_once __DIR__ . '/../models/Projeto.php';

class ProjetoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Projeto($pdo);
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'index';

        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->insert($_POST);
                    header('Location: ?page=projetos');
                    exit;
                }
                require __DIR__ . '/../views/projetos/form.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    echo "ID não fornecido.";
                    return;
                }

                $projeto = $this->model->getById($id);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $_POST['imagem_atual'] = $projeto['imagem']; // Passa a imagem atual para o model
                    $this->model->update($id, $_POST);
                    header('Location: ?page=projetos');
                    exit;
                }

                require __DIR__ . '/../views/projetos/form.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->delete($id);
                }
                header('Location: ?page=projetos');
                break;

            case 'index':
            default:
                $projetos = $this->model->getAll();
                require __DIR__ . '/../views/projetos/index.php';
                break;
        }
    }
}