<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");


$mensagem = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valor = floatval($_POST["valor"]);
    $userId = $_SESSION["user_id"];

    if ($valor <= 0) {
        $erro = "O valor do depósito deve ser superior a zero.";
    } else {
        try {
            $pdo->beginTransaction();

            // Atualizar saldo
            $stmt = $pdo->prepare(
                "UPDATE utilizadores SET saldo = saldo + ? WHERE id = ?"
            );
            $stmt->execute([$valor, $userId]);

            // Criar movimento
            $stmt = $pdo->prepare(
                "INSERT INTO movimentos (utilizador_id, tipo, valor, descricao)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([
                $userId,
                "Depósito",
                $valor,
                "Depósito de saldo"
            ]);

            $pdo->commit();
            $mensagem = "Depósito realizado com sucesso!";
        } catch (Exception $e) {
            $pdo->rollBack();
            $erro = "Erro ao realizar o depósito.";
        }
    }
}
?>

<section class="transferencias">
    <div class="container transfer-container">
        <h1>Depositar Dinheiro</h1>
        <p class="subtitle">Adicione saldo à sua conta</p>
        <div style="margin-bottom: 20px; margin-top: 10px;">
            <a href="perfil.php" class="btn">
                &larr; Voltar ao Perfil
            </a>
        </div>

        <?php if ($mensagem): ?>
            <p class="success"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <?php if ($erro): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="POST" class="transfer-form">
            <input
                type="number"
                name="valor"
                placeholder="Valor a depositar (€)"
                step="0.01"
                min="0.01"
                required
            >

            <button type="submit" class="btn-primary">
                Depositar
            </button>
        </form>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>