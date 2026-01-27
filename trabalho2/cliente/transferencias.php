<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");

$mensagem = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emailDestinatario = trim($_POST["destinatario"]);
    $valor = floatval($_POST["valor"]);
    $remetenteId = $_SESSION["user_id"];

    // 1️⃣ Validar valor
    if ($valor <= 0) {
        $erro = "O valor da transferência deve ser superior a zero.";
    } else {

        // 2️⃣ Buscar remetente
        $stmt = $pdo->prepare("SELECT saldo FROM utilizadores WHERE id = ?");
        $stmt->execute([$remetenteId]);
        $remetente = $stmt->fetch();

        if (!$remetente || $remetente["saldo"] < $valor) {
            $erro = "Saldo insuficiente para realizar a transferência.";
        } else {

            // 3️⃣ Buscar destinatário
            $stmt = $pdo->prepare("SELECT id FROM utilizadores WHERE email = ?");
            $stmt->execute([$emailDestinatario]);
            $destinatario = $stmt->fetch();

            if (!$destinatario) {
                $erro = "O destinatário não existe.";
            } else {

                try {
                    // 4️⃣ Iniciar transação
                    $pdo->beginTransaction();

                    // Remover saldo ao remetente
                    $stmt = $pdo->prepare(
                        "UPDATE utilizadores SET saldo = saldo - ? WHERE id = ?"
                    );
                    $stmt->execute([$valor, $remetenteId]);

                    // Adicionar saldo ao destinatário
                    $stmt = $pdo->prepare(
                        "UPDATE utilizadores SET saldo = saldo + ? WHERE id = ?"
                    );
                    $stmt->execute([$valor, $destinatario["id"]]);

                    // 5️⃣ Criar movimentos
                    $stmt = $pdo->prepare(
                        "INSERT INTO movimentos (utilizador_id, tipo, valor, descricao)
                         VALUES (?, ?, ?, ?)"
                    );

                    // Movimento remetente
                    $stmt->execute([
                        $remetenteId,
                        "Transferência enviada",
                        $valor,
                        "Transferência para $emailDestinatario"
                    ]);

                    // Movimento destinatário
                    $stmt->execute([
                        $destinatario["id"],
                        "Transferência recebida",
                        $valor,
                        "Transferência recebida de outro utilizador"
                    ]);

                    // 6️⃣ Confirmar transação
                    $pdo->commit();

                    $mensagem = "Transferência realizada com sucesso!";
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $erro = "Erro ao processar a transferência.";
                }
            }
        }
    }
}

?>

<section class="transferencias">
    <div class="container transfer-container">
        <h1>Transferências</h1>
        <p class="subtitle">Envie dinheiro de forma rápida e segura</p>
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
                type="email"
                name="destinatario"
                placeholder="Email do destinatário"
                required
            >

            <input
                type="number"
                name="valor"
                placeholder="Valor (€)"
                step="0.01"
                min="0.01"
                required
            >

            <button type="submit" class="btn-primary">
                Transferir
            </button>
        </form>
    </div>
</section>
<?php include(BASE_DIR . "includes/footer.php"); ?>