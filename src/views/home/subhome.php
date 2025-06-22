<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>GEOPLANTEX - Subhome</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background: url('public/img/BG.png') no-repeat center center/cover;
      overflow: hidden;
    }

    .container {
      position: relative;
      width: 100vw;
      height: 100vh;
    }

    .ellipse {
      position: absolute;
      border-radius: 50%;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      text-align: right;
      color: #fff;
      font-size: 40px;
      font-weight: 400;
      transition: transform 0.3s ease;
    }

    .ellipse a {
      color: #fff;
      text-decoration: none;
      display: block;
      width: 100%;
      padding-right: 20px;
    }

    .ellipse1 {
      width: 224px;
      height: 224px;
      background: #292a27;
      top: 33.5%;
      left: 20%;
      z-index: 4;
      justify-content: center;
      text-align: center;
    }

    .ellipse1 a {
      padding-right: 0;
    }

    .ellipse2 {
      width: 450px;
      height: 328px;
      background: #006838;
      top: 28%;
      left: 20%;
      z-index: 3;
    }

    .ellipse3 {
      width: 698px;
      height: 410px;
      background: #55833d;
      top: 24%;
      left: 20%;
      z-index: 2;
    }

    .ellipse4 {
      width: 1002px;
      height: 521px;
      background: #66994b;
      top: 17.5%;
      left: 20%;
      z-index: 1;
    }

    .ellipse:hover {
      cursor: pointer;
      transform: scale(1.02);
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 30px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo img {
      height: 50px;
    }

    .logo span {
      font-size: 1.5em;
      color: white;
      font-weight: bold;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      right: 30px;
      color: white;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="public/img/LogoB.png" alt="Logo GEOPLANTEX" />
      <span>GEOPLANTEX</span>
    </div>

    <!-- Ellipses com links -->
    <div class="ellipse ellipse4"><a href="#">INTERCÂMBIO</a></div>
    <div class="ellipse ellipse3"><a href="?page=auxilios">EXTENSÃO</a></div>
    <div class="ellipse ellipse2"><a href="?page=pesquisas">PESQUISA</a></div>
    <div class="ellipse ellipse1"><a href="#">ENSINO</a></div>

    <div class="footer">www.geoplantex.com</div>
  </div>
</body>
</html>
