<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Pesquisas - Geoplantex</title>
  <link rel="stylesheet" href="public/css/style.css" />
</head>
<body>
  <header>
    <div class="logo">
      <img src="public/img/LogoB.png" alt="Logo GEOPLANTEX">
      <span>GEOPLANTEX</span>
    </div>
    <nav>
      <a href="?page=home">Home</a>
      <a href="?page=projetos">Projetos</a>
      <a href="?page=pesquisas">Pesquisas</a>
      <a href="?page=auxilios">Auxílio</a>
    </nav>
  </header>
  <main>
    <h1>Pesquisas dos Alunos</h1>
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>Tema</th>
          <th>Autores</th>
          <th>Arquivos</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($pesquisas as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['tema']) ?></td>
          <td><?= htmlspecialchars($p['autores']) ?></td>
          <td><a href="<?= htmlspecialchars($p['arquivo']) ?>" target="_blank">Download</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</body>
</html>
