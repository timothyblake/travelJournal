<?php
// template-parts/header/site-branding.php
// Minimal site branding (logo + site title/description)
?>
<div class="site-branding">
    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
        <div class="site-logo"><?php the_custom_logo(); ?></div>
    <?php endif; ?>

    <div class="site-title-wrap">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    </div>
</div>
