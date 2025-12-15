<?php
require "sistema/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["fEmail"];
    $nome = $_POST["fNome"];
    $apelido = $_POST["fApelido"];
    $password = password_hash($_POST["fPassword"], PASSWORD_DEFAULT);

    // Inserir na BD
    $sql = $pdo->prepare("INSERT INTO utilizadores (nome, apelido, email, password)
                          VALUES (?, ?, ?, ?)");
    $sql->execute([$nome, $apelido, $email, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Registo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>

<body>
<header>
  <div class="logo">
    <a href="index.php"><img src="imgs/logo.png"></a>
    <h1>Cria a tua Conta</h1>
  </div>
</header>

<main>
  <section class="form-container">
    <h2>Registo</h2>

    <form method="POST">
        <div class="mb-2">
            <label>Email</label>
            <input name="fEmail" type="email" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Nome</label>
            <input name="fNome" type="text" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Apelido</label>
            <input name="fApelido" type="text" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Palavra-passe</label>
            <input name="fPassword" type="password" class="form-control" required>
        </div>

        <button class="btn-primary" style="margin-top:15px;">Criar Conta</button>
    </form>

    <p style="text-align:center;margin-top:12px;">
        Já tens conta? <a href="login.php">Iniciar Sessão</a>
    </p>
  </section>
</main>
</body>
</html>


