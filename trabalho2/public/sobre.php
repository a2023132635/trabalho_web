<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

$sucesso = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "Anónimo";
    $email = $_POST["email"] ?? "";
    $assunto = trim($_POST["assunto"]);
    $mensagem = trim($_POST["mensagem"]);

    if ($assunto === "" || $mensagem === "") {
        $erro = "Preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO mensagens (nome, email, assunto, mensagem)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$nome, $email, $assunto, $mensagem]);

        $sucesso = "Mensagem enviada com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Sobre Nós - Banco Novo</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<section class="contact">
    <div class="container contact-grid">

        <!-- INFO -->
        <div class="contact-info">
            <h1>Sobre o Banco Novo</h1>
            <p>
                O Banco Novo é um banco digital focado na simplicidade,
                segurança e proximidade com o cliente.
            </p>

            <h3>Contactos</h3>
            <p>📧 banconovo@gmail.com</p>
            <p>📞 912345678</p>
        </div>

        <!-- FORM -->
        <div class="contact-form">
            <h2>Alguma dúvida? Envie-nos mensagem</h2>

            <?php if ($sucesso): ?><p class="success"><?= $sucesso ?></p><?php endif; ?>
            <?php if ($erro): ?><p class="error"><?= $erro ?></p><?php endif; ?>

            <form method="POST">
                <input type="text" name="nome" placeholder="O seu nome">
                <input type="email" name="email" placeholder="O seu email">

                <input type="text" name="assunto" placeholder="Assunto" required>
                <textarea name="mensagem" placeholder="Mensagem" required></textarea>

                <button type="submit" class="btn-primary">
                    Enviar mensagem
                </button>
            </form>
        </div>

    </div>
</section>

</body>
</html>