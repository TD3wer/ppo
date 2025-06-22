<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Projetos | GEOPLANTEX</title>
    <link rel="stylesheet" href="public/css/style.css">
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

        /* Container principal */
        .container {
            padding: 100px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
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
        }

        .project-details {
            flex: 1;
        }

        .project-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .project-subtitle {
            font-size: 18px;
            color: #ccc;
            margin: 5px 0;
        }

        .project-date {
            font-size: 14px;
            color: #aaa;
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
        <a href="?page=projetos&action=create" class="add-project-btn">+ Novo Projeto</a>
    </div>

    <!-- Conteúdo principal -->
    <div class="container">
        <?php foreach ($projetos as $projeto): ?>
            <div class="project-container">
                <!-- Imagem do projeto -->
                <img src="<?= isset($projeto['imagem']) ? 'public/uploads/' . $projeto['imagem'] : 'public/img/default.jpg' ?>" alt="Imagem do Projeto" class="project-image">

                <!-- Detalhes do projeto -->
                <div class="project-details">
                    <h2 class="project-title"><?= htmlspecialchars($projeto['titulo']) ?></h2>
                    <p class="project-subtitle"><?= htmlspecialchars($projeto['subtitulo']) ?></p>
                    <p class="project-date">Data do Projeto: <?= htmlspecialchars($projeto['data_inicio']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Voltar à página inicial -->
        <a href="?page=home" class="voltar">← Voltar à Home</a>
    </div>
</body>
</html>