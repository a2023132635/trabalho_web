<?php
session_start();
require "sistema/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = $pdo->prepare("SELECT * FROM utilizadores WHERE email = ?");
    $sql->execute([$email]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: perfil.php");
        exit;
    } else {
        $erro = "Email ou palavra-passe incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.min.css">
</head>

<body>

<header>
    <div class="logo">
      <a href="index.php"><img src="imgs/logo.png"></a>
      <h1>Iniciar Sessão</h1>
    </div>
</header>

<main>
<section class="form-container">

<h2>Login</h2>

<?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

<form method="POST">
    <div class="mb-2">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Palavra-passe</label>
        <input name="password" type="password" class="form-control" required>
    </div>

    <button class="btn-primary" style="margin-top: 15px;">Entrar</button>
</form>

<p style="text-align:center;margin-top:12px;">
    Não tens conta? <a href="registo.php">Registar</a>
</p>

</section>
</main>

</body>
</html>

