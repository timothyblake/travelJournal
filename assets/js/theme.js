(function(){
  'use strict';

  // Menu open/close
  var btn = document.getElementById('sidebarToggle');
  var menu = document.getElementById('fullscreenMenu');
  function openMenu(){
    if(!btn || !menu) return;
    btn.classList.add('active');
    menu.classList.add('open');
    document.body.classList.add('menu-open');
    btn.setAttribute('aria-expanded','true');
    menu.setAttribute('aria-hidden','false');
  }
  function closeMenu(){
    if(!btn || !menu) return;
    btn.classList.remove('active');
    menu.classList.remove('open');
    document.body.classList.remove('menu-open');
    btn.setAttribute('aria-expanded','false');
    menu.setAttribute('aria-hidden','true');
  }
  if(btn && menu){
    btn.addEventListener('click', function(e){
      if(menu.classList.contains('open')) closeMenu(); else openMenu();
    });
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

})();
