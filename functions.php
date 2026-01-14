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
