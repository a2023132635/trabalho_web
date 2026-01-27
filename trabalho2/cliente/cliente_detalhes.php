<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");

$isAdmin = (isset($_SESSION["email"]) && $_SESSION["email"] === "admin@gmail.com");
if (!$isAdmin) {
    header("Location: perfil.php");
    exit();
}

$clienteId = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($clienteId <= 0) {
    header("Location: clientes.php");
    exit();
}

// Dados do cliente
$stmt = $pdo->prepare("SELECT id, nome, email, saldo FROM utilizadores WHERE id = ?");
$stmt->execute([$clienteId]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente || $cliente["email"] === "admin@gmail.com") {
    header("Location: clientes.php");
    exit();
}

// Poupança (pode não existir)
$stmt = $pdo->prepare("SELECT saldo FROM contas_poupanca WHERE utilizador_id = ?");
$stmt->execute([$clienteId]);
$poupanca = $stmt->fetch(PDO::FETCH_ASSOC);
$saldoPoupanca = $poupanca ? (float)$poupanca["saldo"] : 0.00;

// Movimentos
$stmt = $pdo->prepare(
    "SELECT tipo, valor, descricao, data
     FROM movimentos
     WHERE utilizador_id = ?
     ORDER BY data DESC"
);
$stmt->execute([$clienteId]);
$movimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include(BASE_DIR . "includes/header.php"); ?>

<section class="movimentos">
    <div class="container">
        <h1>Detalhes do Cliente</h1>
        <p class="subtitle"><?php echo htmlspecialchars($cliente["nome"]); ?> — <?php echo htmlspecialchars($cliente["email"]); ?></p>

        <div class="saldo-card">
            <h2>Saldos</h2>
            <p><strong>Conta à ordem:</strong> €<?php echo number_format((float)$cliente["saldo"], 2); ?></p>
            <p><strong>Conta poupança:</strong> €<?php echo number_format($saldoPoupanca, 2); ?></p>
        </div>

        <div class="top-actions" style="margin-bottom: 20px;">
            <a class="btn" href="clientes.php">← Voltar à lista</a>
        </div>

        <h2 style="margin: 20px 0;">Movimentos</h2>

        <?php if (count($movimentos) === 0): ?>
            <p class="empty">Este cliente ainda não tem movimentos.</p>
        <?php else: ?>
            <table class="movimentos-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movimentos as $m): ?>
                        <?php
                            $classe = "positivo";
                            $valorTxt = "+ €" . number_format((float)$m["valor"], 2);

                            // Se guardas valores negativos (ex: poupança) ele já vem negativo
                            if ((float)$m["valor"] < 0 || $m["tipo"] === "Transferência enviada") {
                                $classe = "negativo";
                                $valorTxt = "€" . number_format((float)$m["valor"], 2);
                            }
                        ?>
                        <tr>
                            <td><?php echo date("d/m/Y H:i", strtotime($m["data"])); ?></td>
                            <td><?php echo htmlspecialchars($m["tipo"]); ?></td>
                            <td><?php echo htmlspecialchars($m["descricao"] ?? ""); ?></td>
                            <td class="<?php echo $classe; ?>"><?php echo $valorTxt; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>