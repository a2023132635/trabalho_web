<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");


// Buscar movimentos do utilizador
$stmt = $pdo->prepare(
    "SELECT tipo, valor, descricao, data
     FROM movimentos
     WHERE utilizador_id = ?
     ORDER BY data DESC"
);
$stmt->execute([$_SESSION["user_id"]]);
$movimentos = $stmt->fetchAll();
?>

<section class="movimentos">
    <div class="container">
        <h1>Movimentos</h1>
        <p class="subtitle">Histórico de todas as operações realizadas</p>
        <div style="margin-bottom: 20px; margin-top: 10px;">
            <a href="perfil.php" class="btn">
                &larr; Voltar ao Perfil
            </a>
        </div>

        <?php if (count($movimentos) === 0): ?>
            <p class="empty">Ainda não existem movimentos.</p>
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
                    <?php foreach ($movimentos as $mov): ?>
                        <?php
                            $valor = number_format($mov["valor"], 2);
                            $classeValor = "";

                            if ($mov["tipo"] === "Transferência enviada") {
                                $classeValor = "negativo";
                                $valor = "- €" . $valor;
                            } else {
                                $classeValor = "positivo";
                                $valor = "+ €" . $valor;
                            }
                        ?>
                        <tr>
                            <td><?php echo date("d/m/Y H:i", strtotime($mov["data"])); ?></td>
                            <td><?php echo $mov["tipo"]; ?></td>
                            <td><?php echo $mov["descricao"]; ?></td>
                            <td class="<?php echo $classeValor; ?>">
                                <?php echo $valor; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>