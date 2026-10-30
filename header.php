<?php
/**
 * Global site header and Appearance > Menus primary navigation.
 * Note: Bhavik Enterprises uses its own standalone header-bhavik.php.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#f6f8f7">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="ab-topbar" aria-label="Contact details and material price information">
  <div class="ab-wrap ab-topbar-inner">
    <div class="ab-contact-line">
      <span>
        <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-mail" /></svg>
        Email: <a href="mailto:info@abiroverseas.com" class="ab-header-contact-link">info@abiroverseas.com</a>
      </span><span><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-phone" /></svg>
        Phone: <a href="tel:+18565233366" class="ab-header-contact-link">+1 (856) 523 3366</a>
      </span>
    </div>
    <div class="ab-ticker" aria-label="Indicative material information, not live prices">
      <span class="ab-ticker-label">Indicative · not live</span>
      <div class="ab-ticker-track"><div class="ab-ticker-items"><span class="ab-ticker-item"><b>HDPE</b><i class="ab-ticker-dot"></i><em>Quote-led</em></span><span class="ab-ticker-item"><b>Polypropylene</b><i class="ab-ticker-dot"></i><em>Enquiry-based</em></span><span class="ab-ticker-item"><b>Polyethylene</b><i class="ab-ticker-dot"></i><em>Confirm by grade</em></span><span class="ab-ticker-item"><b>HDPE</b><i class="ab-ticker-dot"></i><em>Quote-led</em></span><span class="ab-ticker-item"><b>Polypropylene</b><i class="ab-ticker-dot"></i><em>Enquiry-based</em></span><span class="ab-ticker-item"><b>Polyethylene</b><i class="ab-ticker-dot"></i><em>Confirm by grade</em></span></div></div>
    </div>
  </div>
</div>
<header class="ab-mainnav" id="site-header">
  <div class="ab-wrap ab-nav-inner">
    <a class="ab-logo-slot" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Abiroverseas home"><img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/ABIR-Logo.png' ) ); ?>" alt="Abiroverseas logo"></a>
    <button class="ab-nav-toggle" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="primary-navigation"><span class="ab-menu-line"></span><span class="ab-menu-line"></span><span class="ab-menu-line"></span></button>
    <nav class="ab-nav-links" id="primary-navigation" aria-label="Main navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'ab-nav-menu', 'menu_id' => 'ab-primary-menu', 'fallback_cb' => 'ab_primary_menu_fallback', 'depth' => 3 ) ); ?>
    </nav>
  </div>
</header>
<svg aria-hidden="true" width="0" height="0" class="ab-icon-sprite"><!-- Shared icon sprite for global page layouts. -->
<symbol id="ab-icon-arrow" viewBox="0 0 24 24">
      <path d="M4 12h15M13 5l7 7-7 7" />
    </symbol>
<symbol id="ab-icon-mail" viewBox="0 0 24 24">
      <rect x="3" y="5" width="18" height="14" rx="2" />
      <path d="m4 7 8 6 8-6" />
    </symbol>
<symbol id="ab-icon-phone" viewBox="0 0 24 24">
      <path d="M7 3H4a1 1 0 0 0-1 1c0 9.4 7.6 17 17 17a1 1 0 0 0 1-1v-3l-5-2-2 3a14 14 0 0 1-7-7l3-2-2-6Z" />
    </symbol>
<symbol id="ab-icon-whatsapp" viewBox="0 0 24 24">
      <path d="M3.6 20.4 4.9 16A8.3 8.3 0 1 1 8.2 19.2l-4.6 1.2Z" />
      <path d="M9.3 7.7c-.3 0-.6.1-.8.4-.3.3-.7.8-.7 1.6 0 .9.6 1.9 1.6 3 1 1.1 2.3 1.9 3.7 1.9.8 0 1.4-.3 1.8-.7.2-.2.4-.5.4-.8 0-.2-.1-.3-.3-.4l-1.5-.7c-.2-.1-.4 0-.5.1l-.5.6c-.1.1-.2.1-.4.1-.5-.2-1.1-.6-1.6-1.1-.4-.4-.7-.9-.8-1.3 0-.1 0-.3.1-.4l.5-.6c.1-.2.1-.3 0-.5l-.7-1.5c-.1-.2-.2-.2-.4-.2Z" />
    </symbol>
<symbol id="ab-icon-menu" viewBox="0 0 24 24">
      <path d="M4 7h16M4 12h16M4 17h16" />
    </symbol>
<symbol id="ab-icon-check" viewBox="0 0 24 24">
      <path d="m5 12 4 4L19 6" />
    </symbol>
<symbol id="ab-icon-flask" viewBox="0 0 24 24">
      <path d="M9 3h6M10 3v6l-5.5 9.2A2 2 0 0 0 6.2 21h11.6a2 2 0 0 0 1.7-2.8L14 9V3M8 15h8" />
    </symbol>
<symbol id="ab-icon-layers" viewBox="0 0 24 24">
      <path d="m12 3 9 5-9 5-9-5 9-5ZM3 12l9 5 9-5M3 16l9 5 9-5" />
    </symbol>
<symbol id="ab-icon-cube" viewBox="0 0 24 24">
      <path d="m12 3 9 5v8l-9 5-9-5V8l9-5Z" />
      <path d="m3 8 9 5 9-5M12 13v8" />
    </symbol>
<symbol id="ab-icon-industry" viewBox="0 0 24 24">
      <path d="M3 21V9l6 3V9l6 3V5h6v16H3Z" />
      <path d="M7 17h2m3 0h2m3 0h2M17 8h1" />
    </symbol>
<symbol id="ab-icon-truck" viewBox="0 0 24 24">
      <path d="M3 6h12v12H3zM15 10h4l3 4v4h-7z" />
      <circle cx="7.5" cy="19" r="2" />
      <circle cx="18" cy="19" r="2" />
    </symbol>
<symbol id="ab-icon-chat" viewBox="0 0 24 24">
      <path d="M20 11.5a7.5 7.5 0 0 1-7.5 7.5H6l-3 2v-6.5A7.5 7.5 0 1 1 20 11.5Z" />
      <path d="M8 11h8M8 14h5" />
    </symbol>
<symbol id="ab-icon-file" viewBox="0 0 24 24">
      <path d="M6 3h8l5 5v13H6zM14 3v6h5M9 14h7m-7 3h7" />
    </symbol>
<symbol id="ab-icon-shield" viewBox="0 0 24 24">
      <path d="M12 3 20 6v5c0 5-3.4 8.4-8 10-4.6-1.6-8-5-8-10V6l8-3Z" />
      <path d="m8.5 12 2.2 2.2 4.8-5" />
    </symbol>
<symbol id="ab-icon-scale" viewBox="0 0 24 24">
      <path d="M12 3v18M5 7h14M6 7l-4 7h8L6 7Zm12 0-4 7h8l-4-7ZM8 21h8" />
    </symbol>
<symbol id="ab-icon-beaker" viewBox="0 0 24 24">
      <path d="M8 3h8M9 3v7l-5 9a2 2 0 0 0 1.7 3h12.6a2 2 0 0 0 1.7-3l-5-9V3M7 16h10" />
    </symbol>
<symbol id="ab-icon-globe" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="9" />
      <path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18" />
    </symbol>
<symbol id="ab-icon-plus" viewBox="0 0 24 24">
      <path d="M12 5v14M5 12h14" />
    </symbol>
<symbol id="ab-icon-compass" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="9" />
      <path d="m15.5 8.5-2 5-5 2 2-5 5-2Z" />
    </symbol>
<symbol id="ab-icon-target" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="9" />
      <circle cx="12" cy="12" r="5" />
      <circle cx="12" cy="12" r="1.5" fill="currentColor" />
    </symbol>
<symbol id="ab-icon-handshake" viewBox="0 0 24 24">
      <path d="M3 13 7 9l4 4-2 2 3 3 7-7-5-5-2 2-4-4-5 5 0 4Z" />
    </symbol>
<symbol id="ab-icon-sparkle" viewBox="0 0 24 24">
      <path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l3 3M15 15l3 3M18 6l-3 3M9 15l-3 3" />
    </symbol>
<symbol id="ab-icon-users" viewBox="0 0 24 24">
      <circle cx="9" cy="8" r="3.5" />
      <path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6" />
      <circle cx="17" cy="9" r="2.5" />
      <path d="M15 14c3 0 6 2 6 5" />
    </symbol>
<symbol id="ab-icon-leaf" viewBox="0 0 24 24">
      <path d="M5 20c0-10 7-15 15-15 0 10-5 16-15 15Z" />
      <path d="M5 20c3-7 7-10 12-11" />
    </symbol>
<symbol id="ab-icon-package" viewBox="0 0 24 24">
      <path d="m12 3 8.5 4.7v8.6L12 21l-8.5-4.7V7.7L12 3Z" />
      <path d="m3.5 7.7 8.5 4.7 8.5-4.7M12 12.4V21M7.8 5.3l8.4 4.7" />
    </symbol>
<symbol id="ab-icon-pipe" viewBox="0 0 24 24">
      <ellipse cx="6.5" cy="14.5" rx="3" ry="4.5" />
      <path d="M6.5 10h11c1.7 0 3 2 3 4.5S19.2 19 17.5 19h-11" />
      <path d="M9.5 6h8c1.5 0 2.7 1.6 2.9 3.6" />
    </symbol>
<symbol id="ab-icon-mould" viewBox="0 0 24 24">
      <rect x="4" y="4" width="16" height="6.5" rx="1.5" />
      <rect x="4" y="13.5" width="16" height="6.5" rx="1.5" />
      <path d="M9 10.5v3M15 10.5v3M12 2v2M12 20v2" />
    </symbol>
<symbol id="ab-icon-recycle" viewBox="0 0 24 24">
      <path d="m7.5 4.8 3-1.8 3 5.2M4.3 14.5 2.5 11.4l5.2-3M16.8 19.5h-3.6l3-5.2" />
      <path d="M10.5 3h3a2 2 0 0 1 1.7 1l2.3 4M3.2 12.2l1.8 3.1a2 2 0 0 0 1.7 1h4.1M20.8 12.2 19 15.3a2 2 0 0 1-1.7 1h-3.5" />
    </symbol>
</svg>
