

<?php wp_footer(); ?>
<footer class="footer">
    <?php if (is_active_sidebar('footer-widget')) : ?>
        <?php dynamic_sidebar('footer-widget'); ?>
    <?php else : ?>
        <p>Dodajte widget za najbolje ocenjene filmove u admin panelu.</p>
    <?php endif; ?>
    </footer>

</body>
</html>