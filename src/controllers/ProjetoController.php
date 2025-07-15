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
                $usuariosOrientadores = $this->model->getUsuariosPorTipo('orientador');
                $usuariosCoorientadores = $this->model->getUsuariosPorTipo('coorientador');

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
                $usuariosOrientadores = $this->model->getUsuariosPorTipo('orientador');
                $usuariosCoorientadores = $this->model->getUsuariosPorTipo('coorientador');

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $_POST['imagem_atual'] = $projeto['imagem'];
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

            case 'colaboradores':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID do projeto não fornecido.");
                }

                // Buscar todos os bolsistas e alunos disponíveis
                $usuarios = $this->model->getUsuariosParaColaboracao();

                // Buscar colaboradores já associados
                $colaboradoresAtuais = $this->model->getColaboradores($id);

                // Se for POST, salvar novos colaboradores
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $colaboradores = $_POST['colaboradores'] ?? [];

                    // Deletar antigos
                    $this->model->deleteColaboradores($id);

                    // Adicionar novos colaboradores
                    foreach ($colaboradores as $usuario_id) {
                        $this->model->addColaborador($id, $usuario_id);
                    }

                    header("Location: ?page=projetos&action=colaboradores&id=$id");
                    exit;
                }

                // Passar colaboradores atuais para a view
                $colaboradoresAtuais = $this->model->getColaboradores($id);

                require __DIR__ . '/../views/projetos/colaboradores.php';
                break;

            case 'index':
            default:
                $tipo = $_GET['tipo'] ?? null;
                $termo = $_GET['pesquisa'] ?? null;
                $projetos = $this->model->getAll($tipo, $termo);
                require __DIR__ . '/../views/projetos/index.php';
                break;
        }
    }
}