<?php
// index.php - roteador básico
require_once 'config.php';
require_once 'src/database/Connection.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'usuarios':
        require_once 'src/controllers/UsuarioController.php';
        $pdo = Connection::connect();
        $controller = new UsuarioController($pdo);
        $controller->handleRequest();
        break;

    case 'projetos':
        require_once 'src/controllers/ProjetoController.php';
        $pdo = Connection::connect();
        $controller = new ProjetoController($pdo);
        $controller->handleRequest();
        break;

    case 'pesquisas':
        require_once 'src/controllers/PesquisaController.php';
        $pdo = Connection::connect();
        $controller = new PesquisaController($pdo);
        $controller->handleRequest();
        break;

    case 'auxilios':
        require_once 'src/controllers/AuxilioController.php';
        $pdo = Connection::connect();
        $controller = new AuxilioController($pdo);
        $controller->handleRequest();
        break;

    case 'subhome':
        require_once 'src/views/home/subhome.php';
        break;

    case 'home':
    default:
        require_once 'src/views/home/index.php';
        break;
}
?>