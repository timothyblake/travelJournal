<?php
// template-parts/navigation/navigation-primary.php
?>
<nav id="site-navigation" class="main-navigation" aria-label="Primary Menu">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
    ) );
    ?>
</nav>
