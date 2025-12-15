<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    die("Utilizador não autenticado.");
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("UPDATE financas SET saldo = 0, poupanca = 0, divida = 0 WHERE user_id = ?");
$stmt->execute([$user_id]);

echo "ok";
?>