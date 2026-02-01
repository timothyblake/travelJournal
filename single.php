<?php
// Minimal single.php — fixed loop and balanced tags
get_header(); ?>

<!-- Reading Progress Bar -->
<div class="reading-progress-container">
    <div class="reading-progress-bar" id="readingProgress"></div>
</div>

<main id="site-content" class="wrap">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

        <!-- Breadcrumbs -->
        <div class="breadcrumb-wrapper">
            <?php traveljournal_breadcrumbs(); ?>
        </div>

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

    <?php
    // Related posts: show 3 most recent posts (exclude current) with caching
    $current_post_id = get_the_ID();
    $cache_key = 'related_posts_' . $current_post_id;
    $related_posts = get_transient( $cache_key );

    // If no cached data, query the database
    if ( false === $related_posts ) {
        $related_args = array(
            'posts_per_page'      => 3,
            'post__not_in'        => array( $current_post_id ),
            'ignore_sticky_posts' => 1,
            'orderby'             => 'date',
            'order'               => 'DESC',
            'fields'              => 'ids', // Only get IDs for better performance
        );

        $related_posts = get_posts( $related_args );

        // Cache for 12 hours (43200 seconds)
        set_transient( $cache_key, $related_posts, 12 * HOUR_IN_SECONDS );
    }

    // Create query from cached IDs
    if ( ! empty( $related_posts ) ) {
        $related_query = new WP_Query( array(
            'post__in'            => $related_posts,
            'orderby'             => 'post__in',
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => 1,
        ) );
    }

    if ( ! empty( $related_posts ) && $related_query->have_posts() ) : ?>

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

    <!-- Back to Top Button -->
    <a href="#top" id="backToTop" class="back-to-top" aria-label="Back to top">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </a>

</main>

<?php get_footer(); ?>
