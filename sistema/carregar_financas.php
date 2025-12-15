<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    die("erro");
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT saldo, poupanca, divida FROM financas WHERE user_id = ?");
$stmt->execute([$user_id]);

if ($stmt->rowCount() > 0) {
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
} else {
    echo json_encode(["saldo" => 0, "poupanca" => 0, "divida" => 0]);
}
?>