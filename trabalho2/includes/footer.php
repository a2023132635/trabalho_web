<footer class="footer">
    <div class="container footer-content">

        <p>© <?php echo date("Y"); ?> Banco Novo. Todos os direitos reservados.</p>

        <div class="footer-links">
            <a href="/trabalho2/index.php">Home</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/trabalho2/cliente/perfil.php">Ir para a área de cliente</a>
            <?php else: ?>
                <a href="/trabalho2/public/registo.php">Criar Conta</a>
            <?php endif; ?>
            
            <a href="/trabalho2/public/sobre.php">Sobre nós</a>
        </div>

    </div>
</footer>

</body>
</html>