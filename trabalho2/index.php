<?php 
include(__DIR__ . "/includes/config.php");
include(BASE_DIR . "includes/header.php");
?>


<!-- HERO -->
<section class="hero">
    <div class="container hero-content">
        <h1>O seu banco digital, simples e seguro</h1>
        <p>Gerencie as suas finanças com confiança, segurança e simplicidade.</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="cliente/perfil.php" class="btn-primary" style="margin:100px;">Ir para a Área de Cliente</a>
        <?php else: ?>
            <a href="public/registo.php" class="btn-primary" style="margin:100px;">Abrir Conta</a>
        <?php endif; ?>

    </div>
</section>

<!-- features -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Destaques</h2>

        <div class="features-grid" style="justify-content: center; display: flex;">

            <a href="public/destaques/seguranca.php" class="feature-card">
                <h3>🔒 Segurança</h3>
                <p>Saiba como protegemos os seus dados e o seu dinheiro.</p>
            </a>

            <a href="public/destaques/rapidez.php" class="feature-card">
                <h3>⚡ Rapidez</h3>
                <p>Descubra como tudo é mais simples e rápido no Banco Novo.</p>
            </a>

        </div>
    </div>
</section>


<!-- PRODUTOS -->
<section class="products" id="contas">
    <div class="container" style="">
        <h2>As nossas contas</h2>

        <div class="products-grid">
            <a href="public/contas/conta_ordem.php" class="product-card">
                <h3>Conta à Ordem</h3>
                <p>Uma conta simples para o dia a dia.</p>
            </a>

            <a href="public/contas/poupanca.php" class="product-card">
                <h3>Poupança</h3>
                <p>Faça crescer o seu dinheiro.</p>
            </a>

            
        </div>
    </div>
</section>


<!-- CALL TO ACTION -->
<section class="cta">
    <div class="container">
        <h2>Abra a sua conta em poucos minutos.</h2>
        <a href="public/registo.php" class="btn-primary" style="margin-top: 10px; display:inline-block;">Criar Conta</a>
    </div>
</section>

<?php include("includes/footer.php"); ?>