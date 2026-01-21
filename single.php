<?php
// Minimal single.php — fixed loop and balanced tags
get_header(); ?>

<main id="site-content" class="wrap">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

        <!-- Hero / Featured image area -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-hero vh-75 d-flex align-items-center" style="background: linear-gradient(rgba(0,0,0,0.30), rgba(0,0,0,0.50)), url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'featured-xl' ) ); ?>) center / cover no-repeat; background-color: #000;">
              <div class="post-hero-inner container">
                <h1 class="main-title text-uppercase text-center text-white" style="text-shadow: 0 2px 6px rgba(0,0,0,0.45);"><?php the_title(); ?></h1>
                <?php if ( get_the_excerpt() ) : ?><p class="text-center text-white d-mobile-hidden" style="text-shadow: 0 1px 3px rgba(0,0,0,0.35);"><?php echo esc_html( get_the_excerpt() ); ?></p>

                  <div class="d-flex justify-content-center">
                  <a href="#main-content" class="btn-rounded mt-4 mx-auto text-center">Continue Reading</a>

                  </div>

                  <?php endif; ?>
              </div>
            </div>
        <?php endif; ?>

        <section class="post-container  open-post" id="main-content">
            <div class="entry-content py-3">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </div>

            <footer class="entry-footer">
                <?php edit_post_link( __( 'Edit', 'traveljournal' ) ); ?>
            </footer>
        </section>

    </article>


<?php endwhile; endif; ?>

    <?php // Related posts: show 3 most recent posts (exclude current)
    $related_args = array(
        'posts_per_page'      => 3,
        'post__not_in'        => array( get_the_ID() ),
        'ignore_sticky_posts' => 1,
        'orderby'             => 'date',
        'order'               => 'DESC',
    );

    $related_query = new WP_Query( $related_args );
    if ( $related_query->have_posts() ) : ?>

    <section class="py-5 w-100 bg-light d-flex justify-content-center mt-1" >
      <div class="container">
        <h2 class="mb-4 text-center fw-bold"><?php esc_html_e( 'Related Posts', 'traveljournal' ); ?></h2>
        <div class="row g-3">

        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>

          <div class="col-md-4">
            <article class="card h-100">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'featured-card', array( 'class' => 'card-img-top', 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?></a>
              <?php else : ?>
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" class="card-img-top" alt="" />
              <?php endif; ?>

              <div class="card-body">
                <h3 class="card-title fw-bold"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none"><?php the_title(); ?></a></h3>
                <p class="card-text text-muted small"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 20 ) ); ?></p>
                <a href="<?php the_permalink(); ?>" class="stretched-link primary-button"><?php esc_html_e( 'Read more', 'traveljournal' ); ?></a>
              </div>
            </article>
          </div>

        <?php endwhile; ?>

        </div>
      </div>
    </section>

    <?php wp_reset_postdata(); endif; ?>

</main>

<?php get_footer(); ?>
