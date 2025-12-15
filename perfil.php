<?php
session_start();
require "sistema/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("
    SELECT nome, apelido, email, avatar
    FROM utilizadores
    WHERE id = ?
");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$avatar = $user['avatar'] ?? 'avatar1.png';


if (!$user) {
    die("Erro: utilizador não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>

<body>

<header>
  <div class="logo">
    <a href="index.php"><img src="imgs/logo.png"></a>
    <h1>Perfil do Utilizador</h1>
  </div>

  <div class="auth-buttons">
    <a href="index.php" class="btn-secondary">← Voltar</a>
    <a href="historico.php" class="btn-secondary">Ver Histórico</a>
    <a href="logout.php" class="btn-secondary">Terminar Sessão</a>
  </div>

</header>

<main>

  <div class="perfil-container">
   
    <img src="avatares/<?= htmlspecialchars($avatar) ?>" class="avatar" alt="Avatar do utilizador">

    <h2><?= $user["nome"] . " " . $user["apelido"] ?></h2>
    <p><?= $user["email"] ?></p>

    <a href="editar_perfil.php" class="btn-primary" style="margin-top:20px;">
      Editar Perfil
    </a>
  </div>



</main>

</body>
</html>
