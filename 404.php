<?php
/**
 * 404 Error Page - Travel Journal Theme
 */
get_header(); ?>

<main id="site-content" class="error-404">
    <div class="error-404-content">
        <span class="error-404-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
            </svg>
        </span>
        <h1 class="error-404-title">Lost Your Way?</h1>
        <p class="error-404-message">This destination doesn't exist on our map.<br>Let's get you back on track.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-back-home">
            Back to Homepage
        </a>
    </div>
</main>

<?php get_footer(); ?>
