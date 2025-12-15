<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simulador de Finanças Pessoais</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>

<body>

  <header>
    <div class="logo">
      <a href="index.php">
        <img src="imgs/logo.png" alt="Logo">
      </a>
      <h1>Simulador de Finanças Pessoais</h1>
    </div>

    <div class="auth-buttons">
    <?php if (isset($_SESSION["user_id"])): ?>
      <a href="perfil.php" class="btn-secondary">Perfil</a>
      <a href="logout.php" class="btn-secondary">Terminar Sessão</a>
    <?php else: ?>
      <a href="login.php" class="btn-secondary">Entrar</a>
      <a href="registo.php" class="btn-secondary">Registar</a>
    <?php endif; ?>
    </div>

  </header>

  <main>
    <section class="saldo-section">
      <button class="btn-light">Saldo Atual: <span id="saldoIndex">€ 0</span></button>
      <button class="btn-light selected">Poupança: <span id="poupancaIndex">€ 0</span></button>
      <button class="btn-dark">Dívidas: <span id="dividaIndex">€ 0</span></button>
    </section>


    <section class="acoes">
      <div class="acoes-grid">
        <a href="gestao.php" class="btn-action">Gastar</a>
        <a href="gestao.php" class="btn-action">Poupar</a>
        <a href="gestao.php" class="btn-action">Investir</a>
        <a href="gestao.php" class="btn-action">Pagar Dívida</a>
      </div>
    </section>

   <div class="acoes-extra">
      <a href="eventos.php" class="btn-dark btn-largo">
        Acontecimentos Aleatórios
      </a>

      <div class="financas-actions">
        <button onclick="guardarProgressoBD()" class="btn-primary">
          Guardar Progresso
        </button>

        <button onclick="resetFinancas()" class="btn-danger">
          Reset
        </button>
      </div>
    </div>
  
  </main>


  <script src="script.js"></script>
</body>
</html>
