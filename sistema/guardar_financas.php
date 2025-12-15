<?php
session_start();
require "db.php";


if (!isset($_SESSION["user_id"])) {
    die("Utilizador não autenticado.");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $saldo = $_POST["saldo"] ?? 0;
    $poupanca = $_POST["poupanca"] ?? 0;
    $divida = $_POST["divida"] ?? 0;

    $user_id = $_SESSION["user_id"];

    $stmt = $pdo->prepare("SELECT id FROM financas WHERE user_id = ?");
    $stmt->execute([$user_id]);

    if ($stmt->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE financas SET saldo=?, poupanca=?, divida=? WHERE user_id=?");
        $update->execute([$saldo, $poupanca, $divida, $user_id]);
    } else {
        $insert = $pdo->prepare("INSERT INTO financas (user_id, saldo, poupanca, divida) VALUES (?,?,?,?)");
        $insert->execute([$user_id, $saldo, $poupanca, $divida]);
    }

    echo "ok";
}
?>