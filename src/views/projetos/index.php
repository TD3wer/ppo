<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Projetos | GEOPLANTEX</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css " integrity="sha512-iecdLmaskl7CVkqkPtElBPsQSXPAUvRSOMc9dLJpuDwcG8uA5vJ2tCS9buZ68zjd37W9hsIiespUdvntg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilo geral */
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: white;
            margin: 0;
            padding: 0;
        }

        /* Barra superior */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #2a2a2a;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 30px;
            height: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Botão para adicionar novo projeto */
        .add-project-btn {
            padding: 12px 24px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .add-project-btn:hover {
            background-color: #666;
        }

        /* Container principal */
        .container {
            padding: 100px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Projeto individual */
        .project-container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .project-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #444;
        }

        .project-details {
            flex: 1;
        }

        .project-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .project-subtitle,
        .project-orientadores,
        .project-date {
            font-size: 16px;
            margin: 5px 0;
            color: #ccc;
        }

        /* Ações (Editar/Excluir) */
        .project-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-left: auto; /* Alinha à direita */
        }

        .project-actions a {
            text-decoration: none;
            color: white;
            background-color: #555;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .project-actions a:hover {
            background-color: #777;
        }

        /* Voltar à página inicial */
        .voltar {
            display: block;
            margin-top: 20px;
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- Barra superior -->
<div class="header">
    <div class="logo">
        <img src="public/img/LogoB.png" alt="Logo Geoplantex">
        <h1>GEOPLANTEX</h1>
    </div>

    <!-- Botão para adicionar novo projeto -->
    <a href="?page=projetos&action=create" class="add-project-btn">+ Novo Projeto</a>

    <!-- Barra de pesquisa -->
    <form class="search-bar" method="get">
        <input type="hidden" name="page" value="<?= htmlspecialchars($_GET['page'] ?? 'projetos') ?>">
        <?php if (isset($_GET['tipo'])): ?>
            <input type="hidden" name="tipo" value="<?= htmlspecialchars($_GET['tipo']) ?>">
        <?php endif; ?>

        <div class="search-container">
            <i class="fas fa-search"></i> <!-- Ícone de lupa -->
            <input type="text" name="pesquisa" placeholder="Pesquisar projeto..." value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>">
        </div>
    </form>
</div>
<!-- Conteúdo principal -->
<div class="container">

    <?php foreach ($projetos as $projeto): ?>
        <?php
// Buscar colaboradores do projeto
$colaboradores = $this->model->getColaboradores($projeto['id']);
?>

<div class="project-container">
    <!-- Imagem do projeto -->
    <img 
        src="<?= !empty($projeto['imagem']) ? 'public/uploads/' . htmlspecialchars($projeto['imagem']) : 'public/img/default.jpg' ?>" 
        alt="Imagem do Projeto" 
        class="project-image"
        onerror="this.src='public/img/default.jpg'; this.onerror=null;"
    >

    <!-- Detalhes do projeto -->
    <div class="project-details">
        <h2 class="project-title"><?= htmlspecialchars($projeto['titulo'] ?? '') ?></h2>
        <p class="project-subtitle"><?= htmlspecialchars($projeto['subtitulo'] ?? '') ?></p>
        
        <!-- Exibir orientador e coorientador -->
        <p class="project-orientadores">
            <strong>Orientador:</strong> <?= htmlspecialchars($projeto['orientador_nome'] ?? 'Não definido') ?><br>
            <strong>Coorientador:</strong> <?= htmlspecialchars($projeto['coorientador_nome'] ?? 'Não definido') ?>
        </p>

        <p class="project-date">Data de início: <?= htmlspecialchars($projeto['data_inicio'] ?? '') ?></p>

        <!-- Colaboradores -->
        <?php
        // Garantir que $colaboradores seja um array e não vazio
        $colaboradoresNomes = !empty($colaboradores) ? array_column($colaboradores, 'nome') : [];
        ?>
        <?php if (!empty($colaboradoresNomes)): ?>
            <p class="project-colaboradores">
                <strong>Colaboradores:</strong>
                <?= htmlspecialchars(implode(', ', $colaboradoresNomes)) ?>
            </p>
        <?php else: ?>
            <p class="project-colaboradores"><strong>Nenhum colaborador associado.</strong></p>
        <?php endif; ?>
    </div>

    <!-- Botões de ação -->
    <div class="project-actions">
        <a href="?page=projetos&action=edit&id=<?= $projeto['id'] ?>">✏️ Editar</a>
        <a href="?page=projetos&action=delete&id=<?= $projeto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este projeto?');">🗑️ Excluir</a>
        <a href="?page=projetos&action=colaboradores&id=<?= $projeto['id'] ?>">👥 Colaboradores</a>
    </div>
</div>
    <?php endforeach; ?>

    <!-- Voltar à página inicial -->
    <a href="?page=home" class="voltar">← Voltar à Home</a>
</div>

</body>
</html>