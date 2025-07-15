<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Colaboradores do Projeto | GEOPLANTEX</title>
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

        form select, form input {
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
        <h1>Colaboradores do Projeto</h1>
        <form method="post">
            <label for="colaboradores">Selecione Bolsistas ou Alunos</label>
            <select name="colaboradores[]" id="colaboradores" multiple size="10" required>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>">
                        <?= htmlspecialchars($usuario['nome']) ?> (<?= htmlspecialchars($usuario['tipo']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Salvar Colaboradores</button>
        </form>
        <a href="?page=projetos" class="voltar">← Voltar à Lista</a>
    </div>
</body>
</html>