<footer id="site-footer">
      <div class="wrap">
          <p class="text-center pt-4">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> All rights reserved.</p>
      </div>
  </footer>

<div class="fixed-sidebar-left bg-white p-2" aria-hidden="false">
    <div class="social-share d-flex flex-column align-items-center gap-2">
      <span class="visually-hidden" id="share-label">Share this page</span>

      <button type="button" class="btn btn-link p-1 share-btn text-black" data-network="twitter" aria-labelledby="share-label" title="Share on Twitter">
        <!-- Twitter SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M22 5.92c-.66.3-1.37.5-2.12.6a3.64 3.64 0 0 0 1.6-2.02c-.7.42-1.48.72-2.3.88A3.62 3.62 0 0 0 12.6 8.5c0 .28.03.56.1.82A10.3 10.3 0 0 1 3.2 4.8c-.35.6-.55 1.3-.55 2.05 0 1.4.72 2.62 1.82 3.34-.67-.02-1.3-.2-1.86-.5v.05c0 2 1.42 3.7 3.3 4.08-.34.09-.7.14-1.07.14-.26 0-.52-.03-.77-.07.52 1.62 2.04 2.8 3.84 2.84A7.27 7.27 0 0 1 2 19.54 10.3 10.3 0 0 0 7.1 21c6.08 0 9.41-5.04 9.41-9.42v-.43c.64-.46 1.2-1.04 1.64-1.7-.58.26-1.2.44-1.84.52z"/>
        </svg>
      </button>

      <button type="button" class="btn btn-link p-1 share-btn text-black" data-network="facebook" aria-labelledby="share-label" title="Share on Facebook">
        <!-- Facebook SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 4.99 3.66 9.12 8.44 9.93v-7.03H8.08v-2.9h2.36V9.41c0-2.34 1.4-3.63 3.55-3.63 1.03 0 2.11.18 2.11.18v2.32h-1.19c-1.17 0-1.53.73-1.53 1.48v1.78h2.6l-.42 2.9h-2.18v7.03C18.34 21.19 22 17.06 22 12.07z"/>
        </svg>
      </button>

      <button type="button" class="btn btn-link p-1 share-btn text-black" data-network="linkedin" aria-labelledby="share-label" title="Share on LinkedIn">
        <!-- LinkedIn SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M20.45 20.45h-3.56v-5.4c0-1.29-.02-2.95-1.8-2.95-1.8 0-2.08 1.4-2.08 2.86v5.49H8.93V9h3.42v1.56h.05c.48-.9 1.66-1.85 3.42-1.85 3.66 0 4.34 2.41 4.34 5.54v6.7zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/>
        </svg>
      </button>

      <button type="button" class="btn btn-link p-1 share-btn text-black" data-network="pinterest" aria-labelledby="share-label" title="Share on Pinterest">
        <!-- Pinterest SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.63 7.86 6.35 9.35-.09-.79-.17-2 .04-2.86.19-.78 1.24-5.27 1.24-5.27s-.32-.63-.32-1.57c0-1.47.85-2.57 1.91-2.57.9 0 1.34.68 1.34 1.49 0 .91-.58 2.27-.88 3.53-.25 1.06.53 1.92 1.58 1.92 1.9 0 3.36-2 3.36-4.89 0-2.55-1.83-4.34-4.45-4.34-3.03 0-4.81 2.27-4.81 4.62 0 .92.35 1.9.79 2.43.09.1.1.19.07.3-.08.32-.26 1.05-.29 1.2-.04.19-.15.23-.34.14-1.33-.62-2.16-2.57-2.16-4.14 0-3.37 2.45-6.46 7.06-6.46 3.71 0 6.59 2.64 6.59 6.17 0 3.68-2.32 6.64-5.54 6.64-1.08 0-2.1-.56-2.45-1.23 0 0-.54 2.05-.67 2.55-.24.95-.9 2.14-1.34 2.87C9.26 21.84 10.61 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/>
        </svg>
      </button>

      <button type="button" class="btn btn-link p-1 share-btn text-black" data-network="email" aria-labelledby="share-label" title="Share via Email">
        <!-- Email SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.3l-8 4.99-8-4.99V6l8 5 8-5v2.3z"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Fixed right sidebar with hamburger -->
  <div class="fixed-sidebar" aria-hidden="false">
    <button class="hamburger" id="sidebarToggle" aria-expanded="false" aria-label="Open menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>
  </div>

  <!-- Fullscreen menu overlay -->
  <nav class="fullscreen-menu" id="fullscreenMenu" aria-hidden="true">
    <div class="close-hint">Press escape or click outside to close</div>
    <!-- Primary navigation (WP menu) -->
      <nav id="site-navigation" class="main-navigation" aria-label="Primary Menu">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu',
          'container'      => false,
          'menu_class'     => 'nav',
          'depth'          => 2,
          'fallback_cb'    => false,
        ) );
        // Fallback: show pages if no menu assigned
        if ( ! has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array( 'menu_class' => 'nav', 'theme_location' => '', 'fallback_cb' => 'wp_page_menu' ) );
        }
        ?>
      </nav>
  </nav>

  <!-- Bootstrap JS bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php wp_footer(); ?>
</body>
</html>
