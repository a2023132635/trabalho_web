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

    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<header class="header">
    <div class="header-container">

        <a href="../index.php" class="logo-area">
            <img src="../assets/img/logo.png" class="logo-img" alt="Banco Novo">
            <span>BANCO NOVO</span>
        </a>

        <nav class="nav">
            <a href="../index.php">Home</a>
            <a href="../index.php#contas">Contas</a>
            <a href="../public/sobre.php">Ajuda</a>
<?php if (isset($_SESSION['user_id'])): ?>
    
        <a href="../cliente/perfil.php" style="margin-right: 10px; font-weight: bold; color: #333; text-decoration: none;">
            Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>
        </a>
    
        <a href="../cliente/logout.php" class="btn" style="background-color: #dc3545;">
            Sair
        </a>

<?php else: ?>

        <a href="../public/login.php" class="btn">
            Área de Cliente
        </a>

<?php endif; ?>
        </nav>
    </div>
</header>