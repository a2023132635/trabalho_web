<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

// Buscar dados do utilizador
$stmt = $pdo->prepare("SELECT nome, email, saldo FROM utilizadores WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

// Buscar conta poupança
$stmt = $pdo->prepare("SELECT saldo FROM contas_poupanca WHERE utilizador_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$poupanca = $stmt->fetch();

// Ver se é admin
$isAdmin = (isset($_SESSION["email"]) && $_SESSION["email"] === "admin@gmail.com");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Área de Cliente - Banco Novo</title>
    <link rel="stylesheet" href="/trabalho2/assets/css/style.css">
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="../index.php" class="logo-area">
                <img src="/trabalho2/assets/img/logo.png" class="logo-img">
                <span>BANCO NOVO</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="perfil.php" class="active">Perfil</a>

            <?php if (!$isAdmin): ?>
                <a href="movimentos.php">Movimentos</a>
                <a href="transferencias.php">Transferências</a>
                <a href="depositar.php">Depositar</a>
            <?php else: ?>
                <a href="clientes.php">Clientes</a>
                <a href="mensagens.php">Mensagens</a>
            <?php endif; ?>

            <a href="logout.php">Logout</a>
        </nav>
    </aside>

    <!-- CONTEÚDO -->
    <main class="main-content">

        <h1><?= $isAdmin ? "Área do Gestor" : "Área de Cliente" ?></h1>
        <p class="subtitle">Bem-vindo, <?= $_SESSION["nome"] ?></p>

        <?php if (!$isAdmin): ?>

            <div class="saldo-card">
                <h2>Saldo Atual</h2>
                <p>€<?= number_format($user["saldo"], 2) ?></p>
            </div>

            <div class="saldo-card">
                <h2>Conta Poupança</h2>

                <?php if ($poupanca): ?>
                    <p>Saldo: €<?= number_format($poupanca["saldo"], 2) ?></p>
                    <a href="transferir_poupanca.php" class="btn" style="margin-top:10px; display:inline-block;">Transferir para Poupança</a>
                <?php else: ?>
                    <p>Ainda não tem conta poupança.</p>
                    <a href="abrir_poupanca.php" class="btn" style="margin-top:10px; display:inline-block;">Abrir Conta Poupança</a>
                <?php endif; ?>
            </div>

            <div class="perfil-card">
                <h2>Dados do Perfil</h2>
                <p><strong>Nome:</strong> <?= $user["nome"] ?></p>
                <p><strong>Email:</strong> <?= $user["email"] ?></p>
                <a href="editar_perfil.php" class="btn">Editar Perfil</a>
            </div>

        <?php else: ?>

            <div class="perfil-card">
                <h2>Dados do Gestor</h2>
                <p><strong>Nome:</strong> Admin</p>
                <p><strong>Email:</strong> admin@gmail.com</p>
            </div>

        <?php endif; ?>

    </main>
</div>

</body>
</html>