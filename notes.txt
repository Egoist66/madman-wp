
<footer id="colophon" class="site-footer">
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer_nav',
            'container' => 'nav',
            'container_class' => 'footer-nav',
            'menu_id' => 'footer_nav-menu'
        )
    ); ?>
</footer>
<?php wp_footer(); ?>

  
</body>
</html>
