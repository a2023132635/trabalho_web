<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

$isAdmin = (isset($_SESSION["email"]) && $_SESSION["email"] === "admin@gmail.com");
if (!$isAdmin) {
    header("Location: perfil.php");
    exit();
}

$stmt = $pdo->prepare("SELECT id, nome, email FROM utilizadores WHERE email <> ? ORDER BY nome ASC");
$stmt->execute(["admin@gmail.com"]);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include(BASE_DIR . "includes/header.php"); ?>

<section class="movimentos">
    <div class="container">
        <h1>Clientes</h1>
        <p class="subtitle">Lista de clientes registados</p>

        <div style="margin-top: 15px; margin-bottom: 20px;">
            <a href="perfil.php" class="btn">
                &larr; Voltar ao Perfil
            </a>
        </div>

        <?php if (count($clientes) === 0): ?>
            <p class="empty">Ainda não existem clientes.</p>
        <?php else: ?>
            <table class="movimentos-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($c["nome"]); ?></td>
                            <td><?php echo htmlspecialchars($c["email"]); ?></td>
                            <td>
                                <a class="btn" href="cliente_detalhes.php?id=<?php echo (int)$c["id"]; ?>">
                                    Ver detalhes
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>