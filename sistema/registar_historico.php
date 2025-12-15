<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    die("erro");
}

$user_id = $_SESSION["user_id"];

$tipo = $_POST["tipo"] ??  null;
$valor = $_POST["valor"] ?? null;
$saldo = $_POST["saldo"] ?? null;

if ($tipo === null || $valor === null || $saldo === null) {
  http_response_code(400);
  exit;
}

$stmt = $pdo->prepare("
    INSERT INTO historico (user_id, tipo, valor, saldo_resultante)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([
  $_SESSION["user_id"],
  $tipo,
  $valor,
  $saldo
]);

echo "ok";
?>