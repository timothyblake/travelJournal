<?php
// Minimal page.php
get_header(); ?>

<main id="site-content" class="wrap">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </div>

        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
