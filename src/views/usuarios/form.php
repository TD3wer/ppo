<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= isset($usuario) ? 'Editar Usuário' : 'Novo Usuário' ?> | GEOPLANTEX</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 80px auto;
            padding: 40px;
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            color: white;
        }

        .form-container h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: none;
            background-color: #2a2a2a;
            color: white;
        }

        form button {
            padding: 12px 24px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
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
    <div class="form-container">
        <h1><?= isset($usuario) ? 'Editar Usuário' : 'Novo Usuário' ?></h1>
        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required value="<?= $usuario['nome'] ?? '' ?>">

            <label for="login">Login (E-mail ou Usuário)</label>
            <input type="text" name="login" id="login" required value="<?= $usuario['login'] ?? '' ?>">

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" <?= isset($usuario) ? '' : 'required' ?>> <!-- Não obriga edição da senha -->
            
            <label for="idade">Idade</label>
            <input type="number" name="idade" id="idade" value="<?= $usuario['idade'] ?? '' ?>">

            <button type="submit">Salvar</button>
        </form>
        <a href="?page=usuarios" class="voltar">← Voltar à Lista</a>
    </div>
</body>
</html>