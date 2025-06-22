<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= isset($projeto) ? 'Editar Projeto' : 'Novo Projeto' ?> | GEOPLANTEX</title>
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

        form input,
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: none;
            background-color: #2a2a2a;
            color: white;
        }

        form textarea {
            resize: vertical;
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
        <h1><?= isset($projeto) ? 'Editar Projeto' : 'Cadastrar Novo Projeto' ?></h1>
        <form method="post" enctype="multipart/form-data">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" required value="<?= $projeto['titulo'] ?? '' ?>">

            <label for="subtitulo">Subtítulo</label>
            <input type="text" name="subtitulo" id="subtitulo" value="<?= $projeto['subtitulo'] ?? '' ?>">

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" rows="5"><?= $projeto['descricao'] ?? '' ?></textarea>

            <label for="orientador">Orientador</label>
            <input type="text" name="orientador" id="orientador" required value="<?= $projeto['orientador'] ?? '' ?>">

            <label for="data_inicio">Data de Início</label>
            <input type="date" name="data_inicio" id="data_inicio" value="<?= $projeto['data_inicio'] ?? '' ?>">

            <label for="data_fim">Data de Fim</label>
            <input type="date" name="data_fim" id="data_fim" value="<?= $projeto['data_fim'] ?? '' ?>">

            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="ativo" <?= (isset($projeto) && $projeto['status'] === 'ativo') ? 'selected' : '' ?>>Ativo</option>
                <option value="concluido" <?= (isset($projeto) && $projeto['status'] === 'concluido') ? 'selected' : '' ?>>Concluído</option>
                <option value="pausado" <?= (isset($projeto) && $projeto['status'] === 'pausado') ? 'selected' : '' ?>>Pausado</option>
            </select>

            <label for="imagem">Imagem do Projeto</label>
            <input type="file" name="imagem" id="imagem">

            <button type="submit">Salvar</button>
        </form>
        <a href="?page=projetos" class="voltar">← Voltar à Lista</a>
    </div>
</body>
</html>