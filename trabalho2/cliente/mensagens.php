<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

// segurança: só admin
if ($_SESSION["email"] !== "admin@gmail.com") {
    header("Location: perfil.php");
    exit();
}

$stmt = $pdo->query("
    SELECT id, assunto, criada_em
    FROM mensagens
    ORDER BY criada_em DESC
");
$mensagens = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Mensagens Recebidas</title>
    <link rel="stylesheet" href="/trabalho2/assets/css/style.css">
</head>
<body>


<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <a href="/trabalho2/index.php" class="logo-area">
                <img src="/trabalho2/assets/img/logo.png" class="logo-img" alt="Banco Novo">
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

    <!-- CONTEÚDO -->
    <main class="main-content">

        <h1>Mensagens Recebidas</h1>

        <?php if (empty($mensagens)): ?>
            <p class="empty">Ainda não existem mensagens.</p>
        <?php else: ?>

            <div class="movimentos-card">
                <table class="movimentos-table">
                    <thead>
                        <tr>
                            <th>Assunto</th>
                            <th>Data</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mensagens as $m): ?>
                            <tr>
                                <td><?= htmlspecialchars($m["assunto"]) ?></td>
                                <td><?= $m["criada_em"] ?></td>
                                <td style="width: 150px; text-align: center;">
                                    <a href="ver_mensagem.php?id=<?= $m["id"] ?>" class="btn" style="white-space: nowrap; display: inline-block; font-size: 14px; padding: 5px 10px;">
                                        Ver mensagem
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

    </main>
</div>

</body>
</html>