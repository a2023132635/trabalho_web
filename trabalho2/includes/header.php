<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Banco Novo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/trabalho2/assets/css/style.css">

</head>
<body>

<header class="header">
    <div class="header-container">

        <a href="/trabalho2/index.php" class="logo-area">
            <img src="/trabalho2/assets/img/logo.png" class="logo-img" alt="Banco Novo">
            <span>BANCO NOVO</span>
        </a>

        <nav class="nav">
            <a href="/trabalho2/index.php">Home</a>
            <a href="/trabalho2/index.php#contas">Contas</a>
            <a href="/trabalho2/public/sobre.php">Ajuda</a>
<?php if (isset($_SESSION['user_id'])): ?>
    
        <a href="/trabalho2/cliente/perfil.php" style="margin-right: 10px; font-weight: bold; color: #333; text-decoration: none;">
            Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>
        </a>
    
        <a href="/trabalho2/cliente/logout.php" class="btn" style="background-color: #dc3545;">
            Sair
        </a>

<?php else: ?>

        <a href="/trabalho2/public/login.php" class="btn">
            Área de Cliente
        </a>

<?php endif; ?>
        </nav>
    </div>
</header>