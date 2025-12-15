<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acontecimentos Aleatórios</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>

<body onload=carregarSaldoEventos();>

  <header>
    <div class="logo">
      <a href="index.php">
        <img src="imgs/logo.png" alt="Logo">
      </a>
      <h1>Acontecimentos Aleatórios</h1>
    </div>
   
    <div class="auth-buttons">
      <a href="index.php" class="btn-secondary">← Voltar</a>
    </div>
  </header>

  <main>

    <section class="saldo-info">
      <div class="saldo-card">
        <h3>Saldo Atual</h3>
        <p id="saldoEventos">€ 0</p>
      </div>
    </section>

    <section class="eventos">
      <button class="btn-dark" onclick="gerarEvento()">Gerar Evento Aleatório</button>

      <div id="eventoResultado" class="cartao" style="margin-top:20px;">
        <p id="descricaoEvento">Nenhum evento gerado ainda.</p>
      </div>
    </section>

    <section class="resultado">
      <h2>Resumo Atualizado</h2>
      <p id="resultadoEvento">O saldo mantém-se sem alterações.</p>
    </section>

    <div class="navegacao">
      <a href="index.php" class="btn-primary">← Voltar à Página Inicial</a>
    </div>

    <div class="center-buttons">
      <button onclick="guardarProgressoBD()">Guardar Progresso</button>
      <button onclick="resetFinancas()">Reset</button>
    </div>



  </main>

  <script src="script.js"></script>
</body>
</html>
