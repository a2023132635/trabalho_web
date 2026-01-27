<?php
include(__DIR__ . "/../../includes/config.php");
include(BASE_DIR . "includes/header.php");
?>

<section class="blog">
    <div class="container">
        <h1>Conta à Ordem</h1>
        <p class="blog-subtitle">A conta ideal para o seu dia a dia</p>

        <article class="blog-article">
            <p>
                A Conta à Ordem do Banco Novo foi criada para simplificar a gestão
                das suas finanças no dia a dia, com total segurança e controlo.
            </p>

            <h2>Principais Vantagens</h2>
            <ul>
                <li>Movimentos e saldo disponíveis em tempo real</li>
                <li>Transferências rápidas e seguras</li>
                <li>Gestão 100% online</li>
            </ul>

            <h2>Para quem é indicada?</h2>
            <p>
                Ideal para quem procura uma conta simples, prática e acessível
                para receber rendimentos e efetuar pagamentos.
            </p>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="/trabalho2/cliente/perfil.php" class="btn-primary">Abrir Conta</a>
<?php else: ?>
    <a href="/trabalho2/public/registo.php" class="btn-primary">Abrir Conta</a>
<?php endif; ?>
        </article>
    </div>
</section>

<?php include(BASE_DIR . "includes/footer.php"); ?>