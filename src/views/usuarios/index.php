<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários | GEOPLANTEX</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        .container {
            padding: 20px;
        }

        .user-card {
            background-color: #2a2a2a;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .user-card h2 {
            margin: 0;
            font-size: 24px;
        }

        .user-card p {
            margin: 5px 0;
            font-size: 16px;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 10px;
            color: white;
            text-decoration: none;
        }

        .add-user-btn {
            padding: 12px 24px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-user-btn:hover {
            background-color: #666;
        }

        .voltar {
            display: inline-block;
            margin-top: 20px;
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Botão para adicionar novo usuário -->
        <a href="?page=usuarios&action=create" class="add-user-btn">+ Novo Usuário</a>

        <?php foreach ($usuarios as $usuario): ?>
            <div class="user-card">
                <h2><?= htmlspecialchars($usuario['nome']) ?></h2>
                <p><strong>Login:</strong> <?= htmlspecialchars($usuario['login']) ?></p>
                <p><strong>Senha (Hash):</strong> <?= htmlspecialchars($usuario['senha']) ?></p>
                <p><strong>Idade:</strong> <?= htmlspecialchars($usuario['idade']) ?></p>

                <div class="actions">
                    <a href="?page=usuarios&action=edit&id=<?= $usuario['id'] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
                    <a href="?page=usuarios&action=delete&id=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza de que deseja excluir este usuário?');"><i class="fas fa-trash"></i> Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Voltar à página inicial -->
        <a href="?page=home" class="voltar">← Voltar à Home</a>
    </div>
</body>
</html>