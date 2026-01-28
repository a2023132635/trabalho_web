<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");
$userId = $_SESSION["user_id"];


// Verificar se já existe conta poupança
$stmt = $pdo->prepare(
    "SELECT id FROM contas_poupanca WHERE utilizador_id = ?"
);
$stmt->execute([$userId]);

if ($stmt->fetch()) {
    // Já existe → vai para perfil
    header("Location: perfil.php");
    exit();
}

// Criar conta poupança
$stmt = $pdo->prepare(
    "INSERT INTO contas_poupanca (utilizador_id, saldo) VALUES (?, 0)"
);
$stmt->execute([$userId]);

// Registar movimento (opcional, mas profissional)
$stmt = $pdo->prepare(
    "INSERT INTO movimentos (utilizador_id, tipo, valor, descricao)
     VALUES (?, ?, ?, ?)"
);
$stmt->execute([
    $userId,
    "Conta Poupança",
    0,
    "Conta poupança criada"
]);

header("Location: perfil.php");
exit();