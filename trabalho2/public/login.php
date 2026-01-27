<?php
include(__DIR__ . '/../includes/config.php');

include(BASE_DIR . 'includes/db.php');
include(BASE_DIR . 'includes/header.php');

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM utilizadores WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["email"] = $user["email"]; 

        header("Location: /trabalho2/cliente/perfil.php");
        exit();
    } else {
        $erro = "Email ou password incorretos";
    }
}
?>

<div class="form-container">
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Entrar</button>
    </form>
    <p style="color:red;"><?php echo $erro; ?></p>
    <p>Não tem conta? <a href="registo.php">Registar</a></p>
</div>

<?php 
include(BASE_DIR . 'includes/footer.php'); 
?>
