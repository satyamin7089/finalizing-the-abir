(() => {
  const nav = document.querySelector('.ab-nav-links');
  const toggle = document.querySelector('.ab-nav-toggle');
  if (!nav || !toggle || toggle.dataset.navReady === 'true') return;
  toggle.dataset.navReady = 'true';

  const mobileQuery = window.matchMedia('(max-width: 850px)');

  // Size the dropdown against the header's real position instead of a fixed
  // viewport offset, so the last menu item is always reachable on touch.
  const fitPanel = () => {
    if (!mobileQuery.matches) {
      nav.style.removeProperty('--ab-nav-panel-max');
      return;
    }
    const rect = nav.getBoundingClientRect();
    const available = window.innerHeight - Math.max(rect.top, 0) - 12;
    nav.style.setProperty('--ab-nav-panel-max', Math.max(180, Math.round(available)) + 'px');
  };

  const closeSubmenus = (except = null) => {
    nav.querySelectorAll('li.is-submenu-open').forEach((item) => {
      if (item === except) return;
      item.classList.remove('is-submenu-open');
      const button = item.querySelector(':scope > .ab-submenu-toggle');
      if (button) button.setAttribute('aria-expanded', 'false');
    });
  };
  const closeMenu = () => {
    nav.style.removeProperty('display');
    nav.style.removeProperty('--ab-nav-panel-max');
    nav.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Open navigation menu');
    closeSubmenus();
  };

  // Add accessible tap targets beside every WordPress menu item with children.
  nav.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > .sub-menu');
    if (!link || !submenu || item.querySelector(':scope > .ab-submenu-toggle')) return;

    const submenuId = submenu.id || `ab-submenu-${index + 1}`;
    submenu.id = submenuId;
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'ab-submenu-toggle';
    button.setAttribute('aria-label', `Toggle ${link.textContent.trim()} submenu`);
    button.setAttribute('aria-expanded', 'false');
    button.setAttribute('aria-controls', submenuId);
    link.insertAdjacentElement('afterend', button);

    button.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      const willOpen = !item.classList.contains('is-submenu-open');
      closeSubmenus(item);
      item.classList.toggle('is-submenu-open', willOpen);
      button.setAttribute('aria-expanded', String(willOpen));
    });
  });

  // Capture the click before theme/page handlers can swallow it. CSS also keeps
  // the actual button above any overlapping page decoration on touch screens.
  document.addEventListener('click', (event) => {
    const target = event.target instanceof Element ? event.target.closest('.ab-nav-toggle') : null;
    if (target !== toggle) return;
    event.preventDefault();
    event.stopPropagation();
    const open = toggle.getAttribute('aria-expanded') !== 'true';
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');

    if (!open) {
      closeMenu();
      return;
    }

    nav.classList.add('is-open');
    if (mobileQuery.matches) {
      nav.style.setProperty('display', 'flex', 'important');
    }
    // The panel is measured against the header's real position, so every item
    // stays reachable on small screens. The page itself is intentionally left
    // scrollable: locking it with `overflow: hidden` turns the <body> into the
    // scroll container for the sticky header, which makes the header (and this
    // button) disappear once the page is scrolled.
    fitPanel();
  }, true);

  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      if (mobileQuery.matches) closeMenu();
    });
  });

  document.addEventListener('click', (event) => {
    if (mobileQuery.matches && nav.classList.contains('is-open') &&
        !nav.contains(event.target) && !toggle.contains(event.target)) closeMenu();
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    closeMenu();
    toggle.focus();
  });

  const onBreakpointChange = () => {
    closeMenu();
    closeSubmenus();
  };
  if (mobileQuery.addEventListener) mobileQuery.addEventListener('change', onBreakpointChange);
  else mobileQuery.addListener(onBreakpointChange);

  // Keep the open panel inside the viewport after a rotation or toolbar resize.
  const refitPanel = () => {
    if (nav.classList.contains('is-open')) fitPanel();
  };
  window.addEventListener('resize', refitPanel, { passive: true });
  window.addEventListener('orientationchange', refitPanel, { passive: true });
  window.addEventListener('pageshow', () => {
    if (!nav.classList.contains('is-open')) closeMenu();
  });
})();

/* Back-to-top control: shared footer markup is present on every front-end page. */
(() => {
  const button = document.querySelector('.ab-scroll-top');
  if (!button) return;

  const updateVisibility = () => {
    button.classList.toggle('is-visible', window.scrollY > 320);
  };

  button.addEventListener('click', () => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    window.scrollTo({ top: 0, behavior: reducedMotion ? 'auto' : 'smooth' });
  });

  window.addEventListener('scroll', updateVisibility, { passive: true });
  window.addEventListener('pageshow', updateVisibility);
  updateVisibility();
})();