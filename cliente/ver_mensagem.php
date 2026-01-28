<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@gmail.com') {
    header("Location: perfil.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: mensagens.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id = ?");
$stmt->execute([$_GET['id']]);
$msg = $stmt->fetch();

if (!$msg) {
    die("Mensagem não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Ler Mensagem - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="dashboard">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="../index.php" class="logo-area">
                <img src="../assets/img/logo.png" class="logo-img" alt="Banco Novo">
                <span>BANCO NOVO</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="perfil.php">Perfil</a>
            <a href="clientes.php">Clientes</a>
            <a href="mensagens.php" class="active">Mensagens</a>
            <a href="logout.php">Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        
        <div style="margin-bottom: 20px;">
            <a href="mensagens.php" class="btn" style="background-color: #6c757d;">&larr; Voltar às mensagens</a>
        </div>

        <div class="perfil-card" style="text-align: left;">
            <h2 style="color: #003366; margin-bottom: 10px;"><?= htmlspecialchars($msg['assunto']) ?></h2>
            
            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">
                <strong>De:</strong> <?= htmlspecialchars($msg['nome']) ?> 
                (&lt;<a href="mailto:<?= htmlspecialchars($msg['email']) ?>"><?= htmlspecialchars($msg['email']) ?></a>&gt;)
            </p>
            
            <p style="color: #999; font-size: 12px; margin-bottom: 20px;">
                Recebida em: <?= $msg['criada_em'] ?>
            </p>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

            <div class="mensagem-corpo" style="line-height: 1.6;">
                <?= nl2br(htmlspecialchars($msg['mensagem'])) ?>
            </div>
        </div>

    </main>
</div>

</body>
</html>