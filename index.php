<?php
// Minimal index.php for travelJournal theme — loop layout: large, small, small, large, repeat
get_header(); ?>

<main class="row gy-1 gx-1">

<?php if ( have_posts() ) :
    $i = 0;
    while ( have_posts() ) : the_post();
        $pos = $i % 4;

        // Determine layout and image size
        if ( in_array( $pos, array(0, 3), true ) ) {
            // Large article
            $article_class = 'col-12 article-post';
            $img_size = 'featured-xl';
            $title_class = 'main-title fw-bolder text-uppercase';
            $subtitle_class = 'subtitle';
            $wrapper_class = 'full-width-article';
        } else {
            // Small article
            $article_class = 'col-12 col-md-6 article-half article-post';
            $img_size = 'featured-medium';
            $title_class = 'main-title-secondary fw-bolder text-uppercase';
            $subtitle_class = 'subtitle-secondary';
            $wrapper_class = 'half-width-article';
        }

        // Get background image or placeholder
        if ( has_post_thumbnail() ) {
            $bg = esc_url( get_the_post_thumbnail_url( get_the_ID(), $img_size ) );
        } else {
            $bg = esc_url( get_stylesheet_directory_uri() . '/screenshot.png' );
        }
        ?>

        <article class="<?php echo esc_attr( $article_class ); ?> position-relative">
            <a href="<?php the_permalink(); ?>" class="stretched-link"></a>
            <div class="d-flex justify-content-center <?php echo esc_attr( $wrapper_class ); ?> align-items-center" style="background: url(<?php echo $bg; ?>) center / cover no-repeat; background-size: cover; background-size: cover !important; ">
            <div>
                <h2 class="<?php echo esc_attr( $title_class ); ?>"><a href="<?php the_permalink(); ?>" class="stretched-link" style="color:inherit;text-decoration:none"><?php the_title(); ?></a></h2>
                <?php if ( get_the_excerpt() ) : ?>
                <span class="<?php echo esc_attr( $subtitle_class ); ?> text-decoration-none d-block text-center d-mobile-hidden mb-5"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18 ) ); ?></span>
                <?php endif; ?>

                <?php
                $permalink = esc_url( get_permalink() );
                $read_more_text = esc_html__( 'Read more', 'traveljournal' );
                ?>
                <div class="mt-2 text-center">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn-rounded text-deocration-none">
                    <?php echo $read_more_text; ?>
                </a>
                </div>

            </div>
            </div>

        </article>

    <?php
        $i++;
    endwhile;
else : ?>
    <div class="col-12">
        <p><?php esc_html_e( 'No posts found.', 'traveljournal' ); ?></p>
    </div>
<?php endif; ?>

</main>

<?php get_footer(); ?>
