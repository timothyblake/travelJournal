<?php
// Minimal sidebar.php
if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
    <aside id="sidebar" class="widget-area">
        <?php dynamic_sidebar( 'primary-sidebar' ); ?>
    </aside>
<?php endif; ?>
