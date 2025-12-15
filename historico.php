<?php
session_start();
require "sistema/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$stmt = $pdo->prepare("
  SELECT tipo, valor, saldo_resultante, data
  FROM historico
  WHERE user_id = ?
  ORDER BY data DESC
");
$stmt->execute([$_SESSION["user_id"]]);
$historico = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Ações</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
            <img src="imgs/logo.png" alt="Logo">
            </a>
            <h1>Histórico de Ações</h1>
        </div>
   
        <div class="auth-buttons">
            <a href="index.php" class="btn-secondary">← Voltar</a>
        </div>
    </header>

    <main class="perfil-container">
        <table>
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Saldo restante</th>
            </tr>

            <?php foreach ($historico as $h): ?>
            <tr>
                <td><?= $h["data"] ?></td>
                <td><?= $h["tipo"] ?></td>
                <td><?= $h["valor"] ?> €</td>
                <td><?= $h["saldo_resultante"] ?> €</td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>

