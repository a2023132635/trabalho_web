<?php
include(__DIR__ . "/../includes/config.php");
include(BASE_DIR . "includes/auth.php");
include(BASE_DIR . "includes/db.php");
include(BASE_DIR . "includes/header.php");

$isAdmin = ($_SESSION["email"] === "admin@gmail.com");


$stmt = $pdo->prepare("SELECT nome, email FROM utilizadores WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);

    $stmt = $pdo->prepare("UPDATE utilizadores SET nome = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $_SESSION["user_id"]]);

    $_SESSION["nome"] = $nome;

    header("Location: perfil.php");
    exit();
}
?>


<div class="form-container">
    <h2>Editar Perfil</h2>

    <form method="POST">
        <input type="text" name="nome" value="<?php echo $user["nome"]; ?>" required>
        <input type="email" name="email" value="<?php echo $user["email"]; ?>" required>

        <div style="display:flex; gap:15px;">
            <a href="perfil.php" class="btn-secondary">Cancelar alterações</a>
            <button type="submit" class="btn-primary">Atualizar</button>
        </div>
    </form>
</div>

<?php include("../includes/footer.php"); ?>