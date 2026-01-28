<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");

$erro = "";
$sucesso = "";

$userId = $_SESSION["user_id"];

/* 🔹 Buscar saldo da conta à ordem (SEMPRE) */
$stmt = $pdo->prepare("SELECT saldo FROM utilizadores WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

/* 🔹 Garantir que a conta poupança existe */
$stmt = $pdo->prepare(
    "SELECT saldo FROM contas_poupanca WHERE utilizador_id = ?"
);
$stmt->execute([$userId]);
$poupanca = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$poupanca) {
    $stmt = $pdo->prepare(
        "INSERT INTO contas_poupanca (utilizador_id, saldo) VALUES (?, 0)"
    );
    $stmt->execute([$userId]);
}

/* 🔹 Processar formulário */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valor = floatval($_POST["valor"]);

    if ($valor <= 0) {
        $erro = "O valor deve ser superior a zero.";
    } elseif ($user["saldo"] < $valor) {
        $erro = "Saldo insuficiente na conta à ordem.";
    } else {
        try {
            $pdo->beginTransaction();

            // Retirar da conta à ordem
            $stmt = $pdo->prepare(
                "UPDATE utilizadores SET saldo = saldo - ? WHERE id = ?"
            );
            $stmt->execute([$valor, $userId]);

            // Adicionar à poupança
            $stmt = $pdo->prepare(
                "UPDATE contas_poupanca SET saldo = saldo + ? WHERE utilizador_id = ?"
            );
            $stmt->execute([$valor, $userId]);

            // Movimento
            $stmt = $pdo->prepare(
                "INSERT INTO movimentos (utilizador_id, tipo, valor, descricao)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([
                $userId,
                "Transferência para poupança",
                -$valor,
                "Envio para conta poupança"
            ]);

            $pdo->commit();
            $sucesso = "Transferência para poupança realizada com sucesso!";

            // Atualizar saldo local
            $user["saldo"] -= $valor;

        } catch (Exception $e) {
            $pdo->rollBack();
            $erro = "Erro ao transferir para a poupança.";
        }
    }
}
?>

<?php include(BASE_DIR . "includes/header.php"); ?>

<section class="transferencias">
    <div class="container">
        <h1>Conta Poupança</h1>
        <p class="subtitle">Transferir dinheiro para a sua poupança</p>
        <div style="margin-bottom: 20px; margin-top: 10px;">
            <a href="perfil.php" class="btn">
                &larr; Voltar ao Perfil
            </a>
        </div>

        <p class="saldo">
            Saldo disponível na conta à ordem:
            <strong>€<?= number_format($user["saldo"], 2) ?></strong>
        </p>

        <?php if ($erro): ?>
            <p class="error"><?= $erro ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <p class="success"><?= $sucesso ?></p>
        <?php endif; ?>

        <form method="POST" class="transfer-form">
            <input
                type="number"
                name="valor"
                step="0.01"
                min="0.01"
                placeholder="Valor a transferir (€)"
                required
            >

            <button type="submit" class="btn-primary">
                Transferir para Poupança
            </button>
        </form>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>