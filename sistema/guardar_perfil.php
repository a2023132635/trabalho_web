<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$nome = $_POST["nome"];
$apelido = $_POST["apelido"];
$avatar = $_POST["avatar"];

$stmt = $pdo->prepare("
  UPDATE utilizadores
  SET nome = ?, apelido = ?, avatar = ?
  WHERE id = ?
");

$stmt->execute([
  $nome,
  $apelido,
  $avatar,
  $_SESSION["user_id"]
]);

// atualizar sessão
$_SESSION["user"]["nome"] = $nome;
$_SESSION["user"]["apelido"] = $apelido;
$_SESSION["user"]["avatar"] = $avatar;

header("Location: perfil.php");
exit;
?>