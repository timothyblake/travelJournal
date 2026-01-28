(function(){
  'use strict';

  // Menu open/close
  var btn = document.getElementById('sidebarToggle');
  var mobileBtn = document.getElementById('mobileMenuToggle');
  var menu = document.getElementById('fullscreenMenu');

  function openMenu(){
    if(!menu) return;
    if(btn) btn.classList.add('active');
    if(mobileBtn) mobileBtn.classList.add('active');
    menu.classList.add('open');
    document.body.classList.add('menu-open');
    if(btn) btn.setAttribute('aria-expanded','true');
    if(mobileBtn) mobileBtn.setAttribute('aria-expanded','true');
    menu.setAttribute('aria-hidden','false');
  }

  function closeMenu(){
    if(!menu) return;
    if(btn) btn.classList.remove('active');
    if(mobileBtn) mobileBtn.classList.remove('active');
    menu.classList.remove('open');
    document.body.classList.remove('menu-open');
    if(btn) btn.setAttribute('aria-expanded','false');
    if(mobileBtn) mobileBtn.setAttribute('aria-expanded','false');
    menu.setAttribute('aria-hidden','true');
  }

  function toggleMenu(){
    if(menu.classList.contains('open')) closeMenu(); else openMenu();
  }

  if(menu){
    if(btn) btn.addEventListener('click', toggleMenu);
    if(mobileBtn) mobileBtn.addEventListener('click', toggleMenu);
    menu.addEventListener('click', function(e){ if(e.target === menu) closeMenu(); });
    document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeMenu(); });
  }

  // Share buttons
  function openShare(network){
    var url = encodeURIComponent(location.href);
    var title = encodeURIComponent(document.title || '');
    var shareUrl = '';
    switch(network){
      case 'twitter': shareUrl = 'https://twitter.com/intent/tweet?text='+title+'&url='+url; break;
      case 'facebook': shareUrl = 'https://www.facebook.com/sharer/sharer.php?u='+url; break;
      case 'linkedin': shareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url='+url; break;
      case 'pinterest':
        // Try to get the featured image or first image on the page
        var img = document.querySelector('.featured-image img, article img, .post-thumbnail img');
        var imgUrl = img ? encodeURIComponent(img.src) : '';
        var description = encodeURIComponent(document.querySelector('meta[name="description"]')?.content || title);
        shareUrl = 'https://pinterest.com/pin/create/button/?url='+url+'&media='+imgUrl+'&description='+description;
        break;
      case 'email': shareUrl = 'mailto:?subject='+title+'&body='+url; break;
    }
    if(shareUrl) window.open(shareUrl, '_blank', 'noopener');
  }
  var shareBtns = document.querySelectorAll('.share-btn');
  if(shareBtns && shareBtns.length){
    Array.prototype.forEach.call(shareBtns, function(btn){
      btn.addEventListener('click', function(e){ e.preventDefault(); openShare(this.dataset.network); });
    });
  }

  // Set current year to any element with id "year"
  try{
    var yearEl = document.getElementById('year');
    if(yearEl) yearEl.textContent = new Date().getFullYear();
  }catch(e){}

  // Add Pinterest "Pin It" buttons to images in post content
  function addPinItButtons(){
    // Only run on single post pages
    if(!document.body.classList.contains('single')) return;

    var contentImages = document.querySelectorAll('.entry-content img');
    if(!contentImages || !contentImages.length) return;

    Array.prototype.forEach.call(contentImages, function(img){
      // Skip if already wrapped or very small images
      if(img.parentElement.classList.contains('pin-it-wrapper')) return;
      if(img.naturalWidth < 200 || img.naturalHeight < 200) return;

      // Create wrapper
      var wrapper = document.createElement('div');
      wrapper.className = 'pin-it-wrapper';

      // Wrap the image
      img.parentNode.insertBefore(wrapper, img);
      wrapper.appendChild(img);

      // Create Pin It button
      var pinBtn = document.createElement('button');
      pinBtn.className = 'pin-it-btn';
      pinBtn.setAttribute('aria-label', 'Pin this image on Pinterest');
      pinBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.24 2.63 7.86 6.35 9.35-.09-.79-.17-2 .04-2.86.19-.78 1.24-5.27 1.24-5.27s-.32-.63-.32-1.57c0-1.47.85-2.57 1.91-2.57.9 0 1.34.68 1.34 1.49 0 .91-.58 2.27-.88 3.53-.25 1.06.53 1.92 1.58 1.92 1.9 0 3.36-2 3.36-4.89 0-2.55-1.83-4.34-4.45-4.34-3.03 0-4.81 2.27-4.81 4.62 0 .92.35 1.9.79 2.43.09.1.1.19.07.3-.08.32-.26 1.05-.29 1.2-.04.19-.15.23-.34.14-1.33-.62-2.16-2.57-2.16-4.14 0-3.37 2.45-6.46 7.06-6.46 3.71 0 6.59 2.64 6.59 6.17 0 3.68-2.32 6.64-5.54 6.64-1.08 0-2.1-.56-2.45-1.23 0 0-.54 2.05-.67 2.55-.24.95-.9 2.14-1.34 2.87C9.26 21.84 10.61 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>Pin It';

      // Add click handler
      pinBtn.addEventListener('click', function(e){
        e.preventDefault();
        var imgUrl = encodeURIComponent(img.src);
        var pageUrl = encodeURIComponent(location.href);
        var description = encodeURIComponent(img.alt || document.title || '');
        var pinUrl = 'https://pinterest.com/pin/create/button/?url='+pageUrl+'&media='+imgUrl+'&description='+description;
        window.open(pinUrl, '_blank', 'noopener,width=750,height=550');
      });

      wrapper.appendChild(pinBtn);
    });
  }

  // Run after images load
  if(document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', addPinItButtons);
  } else {
    addPinItButtons();
  }

  // Back to Top button visibility
  var backToTopBtn = document.getElementById('backToTop');
  if(backToTopBtn){
    // Show/hide button on scroll
    var scrollThreshold = 300;
    function toggleBackToTop(){
      if(window.pageYOffset > scrollThreshold){
        backToTopBtn.classList.add('visible');
      } else {
        backToTopBtn.classList.remove('visible');
      }
    }

    // Throttle scroll event for better performance
    var scrollTimeout;
    window.addEventListener('scroll', function(){
      if(scrollTimeout) clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(toggleBackToTop, 100);
    });

    // Check initial scroll position
    toggleBackToTop();
  }

})();
