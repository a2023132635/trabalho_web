<?php
include(__DIR__ . "/../../includes/config.php");
include(BASE_DIR . "includes/header.php");
?>

<section class="blog">
    <div class="container">
        <h1>Conta Poupança</h1>
        <p class="blog-subtitle">Comece hoje a poupar para o futuro!</p>

        <article class="blog-article">
            <p>
                A Conta Poupança do Banco Novo ajuda-o a organizar os seus objetivos
                financeiros e a poupar de forma simples e segura.
            </p>

            <h2>Porque escolher a Conta Poupança?</h2>
            <ul>
                <li>Criação rápida e sem burocracias.</li>
                <li>Transferências imediatas entre contas.</li>
                <li>Ideal para poupança mensal.</li>
            </ul>

            <h2>Planeie o seu futuro!</h2>
            <p>
                Defina metas, acompanhe o crescimento das suas poupanças e mantenha
                o controlo total do seu dinheiro.
            </p>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="/trabalho2/cliente/perfil.php" class="btn-primary">Criar Conta Poupança</a>
<?php else: ?>
    <a href="/trabalho2/public/registo.php" class="btn-primary">Criar Conta Poupança</a>
<?php endif; ?>
        </article>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>