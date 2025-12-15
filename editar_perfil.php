<?php
session_start();
require "sistema/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("
    SELECT nome, apelido, avatar
    FROM utilizadores
    WHERE id = ?
");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilizador não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $avatar = $_POST["avatar"];

    $stmt = $pdo->prepare("
        UPDATE utilizadores
        SET nome = ?, apelido = ?, avatar = ?
        WHERE id = ?
    ");
    $stmt->execute([$nome, $apelido, $avatar, $user_id]);

    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>
<body>

<header>
  <div class="logo">
    <a href="perfil.php">← Voltar ao Perfil</a>
  </div>
</header>

<main class="perfil-container">

  <h2>Editar Perfil</h2>

  <form method="POST">

    <label>Nome</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($user["nome"]) ?>" required>

    <label>Apelido</label>
    <input type="text" name="apelido" value="<?= htmlspecialchars($user["apelido"]) ?>" required>

    <label>Escolher Avatar</label>

    <div class="avatar-opcoes">
      <?php
      for ($i = 1; $i <= 8; $i++):
        $ficheiro = "avatar$i.png";
        $checked = ($user["avatar"] === $ficheiro) ? "checked" : "";
      ?>
        <label class="avatar-opcao">
          <input type="radio" name="avatar" value="<?= $ficheiro ?>" <?= $checked ?>>
          <img src="avatares/<?= $ficheiro ?>" alt="Avatar <?= $i ?>">
        </label>
      <?php endfor; ?>
    </div>


    <button type="submit" class="btn-primary">Guardar Alterações</button>

  </form>

</main>

</body>
</html>
