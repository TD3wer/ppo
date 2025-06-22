<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Auxílio no Processo de Pesquisa - Geoplantex</title>
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
    <h1>Auxílio no Processo de Pesquisa</h1>
    <ul>
      <?php foreach($auxilios as $a): ?>
        <li><?= htmlspecialchars($a['nome']) ?> - <?= htmlspecialchars($a['descricao']) ?></li>
      <?php endforeach; ?>
    </ul>
  </main>
</body>
</html>
