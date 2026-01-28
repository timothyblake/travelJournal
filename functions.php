<?php
// Minimal functions.php for travelJournal theme

function traveljournal_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Featured images
    add_theme_support( 'post-thumbnails' );

    // Register a wider range of featured image sizes for responsive use
    // Large hero / full-bleed
    add_image_size( 'featured-xxl', 2000, 1200, true );
    add_image_size( 'featured-xl', 1600, 1000, true );
    add_image_size( 'featured-large', 1400, 900, true );

    // Medium / card
    add_image_size( 'featured-medium', 800, 500, true );
    add_image_size( 'featured-card', 600, 400, true );

    // Small / thumbnails
    add_image_size( 'featured-small', 400, 250, true );
    add_image_size( 'featured-thumb', 150, 150, true );

    // Tall / portrait variant
    add_image_size( 'featured-portrait', 600, 900, true );

    // Wide / landscape variant
    add_image_size( 'featured-landscape', 1200, 675, true );

    // HTML5 markup
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    // Register a primary menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'traveljournal' ),
    ) );
}
add_action( 'after_setup_theme', 'traveljournal_setup' );

// Make custom sizes selectable in the media modal
function traveljournal_image_sizes_names( $sizes ) {
    return array_merge( $sizes, array(
        'featured-xxl'     => __( 'Featured XXL (2000×1200)', 'traveljournal' ),
        'featured-xl'      => __( 'Featured XL (1600×1000)', 'traveljournal' ),
        'featured-large'   => __( 'Featured Large (1400×900)', 'traveljournal' ),
        'featured-medium'  => __( 'Featured Medium (800×500)', 'traveljournal' ),
        'featured-card'    => __( 'Featured Card (600×400)', 'traveljournal' ),
        'featured-landscape'=> __( 'Featured Landscape (1200×675)', 'traveljournal' ),
        'featured-portrait'=> __( 'Featured Portrait (600×900)', 'traveljournal' ),
        'featured-small'   => __( 'Featured Small (400×250)', 'traveljournal' ),
        'featured-thumb'   => __( 'Featured Thumb (150×150)', 'traveljournal' ),
    ) );
}
add_filter( 'image_size_names_choose', 'traveljournal_image_sizes_names' );

function traveljournal_scripts() {
    wp_enqueue_style( 'traveljournal-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );

    // Enqueue comment-reply script when needed
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Enqueue theme JS (in footer)
    wp_enqueue_script( 'traveljournal-theme', get_stylesheet_directory_uri() . '/assets/js/theme.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'traveljournal_scripts' );

// Register widget areas
function traveljournal_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'traveljournal' ),
        'id'            => 'primary-sidebar',
        'description'   => __( 'Main sidebar that appears on the right.', 'traveljournal' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'traveljournal_widgets_init' );

/**
 * Add SEO meta tags (Open Graph, Twitter Cards, Schema.org)
 */
function traveljournal_add_seo_meta_tags() {
    if ( is_singular( 'post' ) ) {
        global $post;
        setup_postdata( $post );

        $title       = get_the_title();
        $excerpt     = get_the_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30 );
        $url         = get_permalink();
        $site_name   = get_bloginfo( 'name' );
        $image_url   = get_the_post_thumbnail_url( $post->ID, 'featured-xl' );

        // Fallback to default image if no featured image
        if ( ! $image_url ) {
            $image_url = get_stylesheet_directory_uri() . '/screenshot.png';
        }

        // Open Graph Tags (Facebook, LinkedIn)
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url( $image_url ) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1600" />' . "\n";
        echo '<meta property="og:image:height" content="1000" />' . "\n";
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '" />' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '" />' . "\n";

        // Twitter Card Tags
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url( $image_url ) . '" />' . "\n";

        // Meta description
        echo '<meta name="description" content="' . esc_attr( $excerpt ) . '" />' . "\n";

        // Schema.org JSON-LD
        $author_name = get_the_author();
        $categories = get_the_category();
        $category_names = array();
        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                $category_names[] = $category->name;
            }
        }

        $schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'BlogPosting',
            'headline'      => $title,
            'description'   => $excerpt,
            'image'         => $image_url,
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => array(
                '@type' => 'Person',
                'name'  => $author_name,
            ),
            'publisher'     => array(
                '@type' => 'Organization',
                'name'  => $site_name,
                'logo'  => array(
                    '@type' => 'ImageObject',
                    'url'   => get_stylesheet_directory_uri() . '/screenshot.png',
                ),
            ),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => $url,
            ),
        );

        if ( ! empty( $category_names ) ) {
            $schema['articleSection'] = $category_names;
        }

        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n" . '</script>' . "\n";

        wp_reset_postdata();
    } elseif ( is_home() || is_front_page() ) {
        // Homepage schema
        $site_name = get_bloginfo( 'name' );
        $site_desc = get_bloginfo( 'description' );
        $site_url  = home_url( '/' );

        echo '<meta name="description" content="' . esc_attr( $site_desc ) . '" />' . "\n";
        echo '<meta property="og:type" content="website" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( $site_name ) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $site_desc ) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $site_url ) . '" />' . "\n";

        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => $site_name,
            'url'      => $site_url,
            'description' => $site_desc,
        );

        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        echo "\n" . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'traveljournal_add_seo_meta_tags' );

/**
 * Generate breadcrumb navigation
 */
function traveljournal_breadcrumbs() {
    // Settings
    $separator          = '<span class="breadcrumb-separator"> / </span>';
    $home_title         = 'Home';

    // Get the current page URL
    global $post;
    $home_link = home_url( '/' );

    // Schema.org breadcrumb list
    $schema_items = array();
    $position = 1;

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb-list">';

    // Home link
    echo '<li class="breadcrumb-item"><a href="' . esc_url( $home_link ) . '">' . esc_html( $home_title ) . '</a></li>';

    $schema_items[] = array(
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => $home_title,
        'item' => $home_link,
    );

    if ( is_single() ) {
        // Get categories
        $categories = get_the_category();

        if ( ! empty( $categories ) ) {
            // Use the first category
            $category = $categories[0];

            // Build category hierarchy
            if ( $category->parent != 0 ) {
                $parent_cats = array();
                $parent_id = $category->parent;

                while ( $parent_id ) {
                    $parent_cat = get_category( $parent_id );
                    $parent_cats[] = $parent_cat;
                    $parent_id = $parent_cat->parent;
                }

                $parent_cats = array_reverse( $parent_cats );

                foreach ( $parent_cats as $parent_cat ) {
                    echo $separator;
                    $cat_link = get_category_link( $parent_cat->term_id );
                    echo '<li class="breadcrumb-item"><a href="' . esc_url( $cat_link ) . '">' . esc_html( $parent_cat->name ) . '</a></li>';

                    $schema_items[] = array(
                        '@type' => 'ListItem',
                        'position' => $position++,
                        'name' => $parent_cat->name,
                        'item' => $cat_link,
                    );
                }
            }

            echo $separator;
            $cat_link = get_category_link( $category->term_id );
            echo '<li class="breadcrumb-item"><a href="' . esc_url( $cat_link ) . '">' . esc_html( $category->name ) . '</a></li>';

            $schema_items[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $category->name,
                'item' => $cat_link,
            );
        }

        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" aria-current="page">' . esc_html( get_the_title() ) . '</li>';

        $schema_items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title(),
            'item' => get_permalink(),
        );

    } elseif ( is_category() ) {
        $category = get_queried_object();

        if ( $category->parent != 0 ) {
            $parent_cats = array();
            $parent_id = $category->parent;

            while ( $parent_id ) {
                $parent_cat = get_category( $parent_id );
                $parent_cats[] = $parent_cat;
                $parent_id = $parent_cat->parent;
            }

            $parent_cats = array_reverse( $parent_cats );

            foreach ( $parent_cats as $parent_cat ) {
                echo $separator;
                echo '<li class="breadcrumb-item"><a href="' . esc_url( get_category_link( $parent_cat->term_id ) ) . '">' . esc_html( $parent_cat->name ) . '</a></li>';
            }
        }

        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" aria-current="page">' . esc_html( $category->name ) . '</li>';

    } elseif ( is_page() ) {
        if ( $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) {
                echo $separator . $crumb;
            }
        }

        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" aria-current="page">' . esc_html( get_the_title() ) . '</li>';

    } elseif ( is_archive() ) {
        echo $separator;
        echo '<li class="breadcrumb-item breadcrumb-current" aria-current="page">' . esc_html( get_the_archive_title() ) . '</li>';
    }

    echo '</ol>';
    echo '</nav>';

    // Output Schema.org JSON-LD
    if ( ! empty( $schema_items ) ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $schema_items,
        );

        echo '<script type="application/ld+json">';
        echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES );
        echo '</script>';
    }
}

/**
 * Clear related posts cache for all posts
 * Called when posts are published, updated, or deleted to ensure fresh content
 */
function traveljournal_clear_related_posts_cache() {
    global $wpdb;

    // Delete all related posts transients
    // This is more efficient than clearing individual transients
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_related_posts_%' OR option_name LIKE '_transient_timeout_related_posts_%'" );
}

/**
 * Clear cache when a post is published or updated
 */
function traveljournal_clear_cache_on_post_save( $post_id, $post, $update ) {
    // Only clear cache for published posts
    if ( 'publish' === $post->post_status && 'post' === $post->post_type ) {
        traveljournal_clear_related_posts_cache();
    }
}
add_action( 'save_post', 'traveljournal_clear_cache_on_post_save', 10, 3 );

/**
 * Clear cache when a post is deleted
 */
function traveljournal_clear_cache_on_post_delete( $post_id ) {
    $post = get_post( $post_id );
    if ( $post && 'post' === $post->post_type ) {
        traveljournal_clear_related_posts_cache();
    }
}
add_action( 'before_delete_post', 'traveljournal_clear_cache_on_post_delete' );

/**
 * Clear cache when a post transitions from another status to published
 */
function traveljournal_clear_cache_on_transition( $new_status, $old_status, $post ) {
    if ( 'publish' === $new_status && 'publish' !== $old_status && 'post' === $post->post_type ) {
        traveljournal_clear_related_posts_cache();
    }
}
add_action( 'transition_post_status', 'traveljournal_clear_cache_on_transition', 10, 3 );
