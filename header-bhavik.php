<?php
/**
 * Standalone Header Two — Dedicated to Bhavik Enterprises (get_header( 'bhavik' )).
 *
 * Completely independent from global header.php for easy management,
 * while preserving the exact same visual layout and Abiroverseas logo
 * with same-page (#anchor) navigation links.
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

<div class="ab-topbar" aria-label="Bhavik Enterprises contact details and polymer supply ticker">
  <div class="ab-wrap ab-topbar-inner">
    <div class="ab-contact-line">
      <span>
        <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-mail" /></svg>
        Email: <a href="mailto:info@bhavikenterprises.com" class="ab-header-contact-link">info@bhavikenterprises.com</a>
      </span><span><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-phone" /></svg>
        Phone: <a href="tel:+917007049478" class="ab-header-contact-link">+91 7007049478</a>
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
    <a class="ab-logo-slot" href="#bv-hero" aria-label="Bhavik Enterprises — back to top">
      <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/BE-header-logo.png' ) ); ?>" alt="Abiroverseas logo">
    </a>
    <button class="ab-nav-toggle" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="primary-navigation">
      <span class="ab-menu-line"></span>
      <span class="ab-menu-line"></span>
      <span class="ab-menu-line"></span>
    </button>
    <nav class="ab-nav-links" id="primary-navigation" aria-label="Bhavik Enterprises navigation">
      <ul id="ab-primary-menu" class="ab-nav-menu">
        <li class="menu-item"><a href="#bv-hero">Home</a></li>
        <li class="menu-item"><a href="#about">About Us</a></li>
        <li class="menu-item"><a href="#products">Products</a></li>
        <li class="menu-item"><a href="#industries">Industries</a></li>
        <li class="menu-item"><a href="#the-way">Process</a></li>
        <li class="menu-item"><a href="#faqs">FAQs</a></li>
        <li class="menu-item ab-nav-quote"><a href="#quick-enquiry">Get a Custom Quote</a></li>
      </ul>
    </nav>
  </div>
</header>

<svg aria-hidden="true" width="0" height="0" class="ab-icon-sprite"><!-- Standalone SVG icon sprite for Bhavik Enterprises. -->
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
  <symbol id="ab-icon-check" viewBox="0 0 24 24">
    <path d="m5 12 4 4L19 6" />
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
  <symbol id="ab-icon-shield" viewBox="0 0 24 24">
    <path d="M12 3 20 6v5c0 5-3.4 8.4-8 10-4.6-1.6-8-5-8-10V6l8-3Z" />
    <path d="m8.5 12 2.2 2.2 4.8-5" />
  </symbol>
  <symbol id="ab-icon-globe" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="9" />
    <path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18" />
  </symbol>
  <symbol id="ab-icon-plus" viewBox="0 0 24 24">
    <path d="M12 5v14M5 12h14" />
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
  <symbol id="ab-icon-home-goods" viewBox="0 0 24 24">
    <rect x="4" y="8" width="16" height="11" rx="2.5" />
    <path d="M3 8h18M9 5h6a1.5 1.5 0 0 1 1.5 1.5V8h-9V6.5A1.5 1.5 0 0 1 9 5Zm1 7h4" />
  </symbol>
  <symbol id="ab-icon-recycle" viewBox="0 0 24 24">
    <path d="m7.5 4.8 3-1.8 3 5.2M4.3 14.5 2.5 11.4l5.2-3M16.8 19.5h-3.6l3-5.2" />
    <path d="M10.5 3h3a2 2 0 0 1 1.7 1l2.3 4M3.2 12.2l1.8 3.1a2 2 0 0 0 1.7 1h4.1M20.8 12.2 19 15.3a2 2 0 0 1-1.7 1h-3.5" />
  </symbol>
</svg>