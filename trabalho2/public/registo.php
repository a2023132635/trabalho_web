<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

if (isset($_SESSION["user_id"])) {
    header("Location: ../cliente/perfil.php");
    exit();
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $erro = "Este email já está registado.";
    } else {
        

        if ($email == "admin@gmail.com") {
            $saldo_inicial = 0;
        } else {
            $saldo_inicial = 100;
        }

        $stmt = $pdo->prepare(
            "INSERT INTO utilizadores (nome, email, password, saldo) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$nome, $email, $password, $saldo_inicial]);


        header("Location: login.php");
        exit();
    }
}
?>

<div class="form-container">
    <div style="text-align:center; margin-bottom:20px;">
        <a href="/trabalho2/index.php">
            <img src="/trabalho2/assets/img/logo.png" alt="Banco Novo" class="logo-img">
        </a>
        <h3>BANCO NOVO</h3>
    </div>

    <h2>Registo</h2>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome completo" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Criar Conta</button>
    </form>

    <?php if ($erro): ?>
        <p style="color:red; margin-top:10px;"><?php echo $erro; ?></p>
    <?php endif; ?>

</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>