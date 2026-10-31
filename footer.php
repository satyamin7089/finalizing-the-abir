<?php
/**
 * Global site footer used across main Abiroverseas pages and Knowledge Center views.
 * Note: Bhavik Enterprises uses its own standalone footer-bhavik.php.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Partner logo marquee — 5 logos, 4 shown at a time, seamless one-way loop.
   Swap the image files in assets/img/marquee/ (keep the same 240×64 ratio) and
   set each 'url' to the real partner / client link. */
$ab_marquee_logos = array(
    array( 'name' => 'Nexora',   'img' => 'logo-1.svg', 'url' => '#' ),
    array( 'name' => 'Polymax',  'img' => 'logo-2.svg', 'url' => '#' ),
    array( 'name' => 'Vertexa',  'img' => 'logo-3.svg', 'url' => '#' ),
    array( 'name' => 'Corelink', 'img' => 'logo-4.svg', 'url' => '#' ),
    array( 'name' => 'Omnipro',  'img' => 'logo-5.svg', 'url' => '#' ),
);
?>
<!-- Partner logo marquee -->
<section class="ab-logo-marquee-section" aria-labelledby="ab-marquee-title">
  <div class="ab-wrap">
    <div class="ab-marquee-head">
      <span class="ab-eyebrow" id="ab-marquee-title">Our partners</span>
    </div>
    <div class="ab-logo-marquee">
      <div class="ab-logo-track">
        <?php for ( $ab_marquee_pass = 0; $ab_marquee_pass < 2; $ab_marquee_pass++ ) : ?>
        <div class="ab-logo-group"<?php echo 1 === $ab_marquee_pass ? ' aria-hidden="true"' : ''; ?>>
          <?php foreach ( $ab_marquee_logos as $ab_marquee_logo ) : ?>
          <a class="ab-logo-item" href="<?php echo esc_url( $ab_marquee_logo['url'] ); ?>"<?php echo 1 === $ab_marquee_pass ? ' tabindex="-1"' : ''; ?>>
            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/img/marquee/' . $ab_marquee_logo['img'] ) ); ?>" alt="<?php echo esc_attr( $ab_marquee_logo['name'] ); ?>" width="240" height="64" loading="lazy">
          </a>
          <?php endforeach; ?>
        </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>
<footer class="ab-footer">
  <div class="ab-wrap">
    <div class="ab-footer-layout">
      <div class="ab-footer-brand">
        <a class="ab-logo-slot ab-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Abiroverseas home">
          <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/Abir-Logo_white-textr-1.png' ) ); ?>" alt="Abiroverseas logo" onerror="this.hidden=true;this.parentElement.classList.add('logo-missing')">
        </a>
        <p>Plastic raw materials for industrial applications. Share the specification and delivery requirement for review.</p>
        <?php ab_social_icon_links( 'ab-footer-social', 'Abiroverseas on social media' ); ?>
        <div class="ab-footer-contact">
          <span>
            <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-mail" /></svg>
            Email: <a href="mailto:info@abiroverseas.com" class="ab-footer-contact-link">info@abiroverseas.com</a>
          </span>
          <span>
            <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-phone" /></svg>
            Phone: <a href="tel:+18565233366" class="ab-footer-contact-link">+1 (856) 523 3366</a>
          </span>
          <span class="ab-footer-whatsapp-line">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 720 720"
width="18"
height="18">
  <defs>
    <style>
      .cls-1 {
        fill: #00ac55;
      }
    </style>
  </defs>
  <path class="cls-1" d="M360,0C161.18,0,0,161.18,0,360c0,65.41,17.45,126.75,47.94,179.61L0,720l187.02-44.21c51.34,28.18,110.28,44.21,172.98,44.21,198.82,0,360-161.18,360-360S558.82,0,360,0ZM360,655.52c-60.17,0-116.13-17.98-162.82-48.87l-110.49,28.14,30.99-105.61c-33.53-47.93-53.2-106.26-53.2-169.19,0-163.21,132.31-295.52,295.52-295.52s295.52,132.31,295.52,295.52-132.31,295.52-295.52,295.52Z"/>
  <path class="cls-1" d="M444.35,407.52l87.1,41.06c4,1.88,6.56,5.94,6.2,10.34-.94,11.46-5.54,34.43-26.13,55.02-58.12,58.12-162.49-7.64-166.74-10.18-25.67-13.79-50.06-32.24-73.19-55.36-23.12-23.12-41.58-47.52-55.37-73.19-2.55-4.24-68.31-108.61-10.18-166.74,20.59-20.59,43.56-25.19,55.02-26.13,4.41-.36,8.46,2.2,10.34,6.2l41.07,87.1c1.94,4.12,1.09,9.02-2.13,12.24l-30.61,30.61c-6.62,6.62-8.56,16.93-4,25.11,11.17,20.03,26.19,39.32,43.59,57.07,17.75,17.4,37.04,32.43,57.07,43.59,8.18,4.56,18.48,2.62,25.11-4l30.61-30.61c3.22-3.22,8.12-4.08,12.24-2.13Z"/>
</svg>
            WhatsApp: <a href="https://wa.me/18565233366" class="ab-footer-contact-link ab-footer-whatsapp" target="_blank" rel="noopener noreferrer">+1 (856) 523 3366</a>
          </span>
        </div>
      </div>
      <nav class="ab-footer-nav" aria-label="Footer product navigation">
        <strong>Company</strong>
        <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>">Products</a>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a>
        <a href="<?php echo esc_url( home_url( '/knowledge/' ) ); ?>">Knowledge Center</a>
        <a href="<?php echo esc_url( home_url( '/Contact-us/' ) ); ?>">Contact Us</a>
        <a href="<?php echo esc_url( home_url( '/support/' ) ); ?>">Support</a>
      </nav>
      <nav class="ab-footer-nav" aria-label="Footer company navigation">
        <strong>Explore</strong>
        <a href="<?php echo esc_url( home_url( '/products/hdpe/' ) ); ?>">HDPE</a>
        <a href="<?php echo esc_url( home_url( '/products/Ldpe/' ) ); ?>">LDPE</a>
        <a href="<?php echo esc_url( home_url( '/products/pvc/' ) ); ?>">PVC</a>
        <a href="<?php echo esc_url( home_url( '/products/pp/' ) ); ?>">PP</a>
        <a href="<?php echo esc_url( home_url( '/products/eva/' ) ); ?>">EVA</a>
        <a href="<?php echo esc_url( home_url( '/products/abs/' ) ); ?>">ABS</a>
       
      </nav>
      <div class="ab-footer-action">
        <strong>Have a material requirement?</strong>
        <p>Start with the material, process and application details you know.</p>
        <a class="ab-btn" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">REQUEST A QUOTE <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></a>
        <figure class="ab-footer-qr">
          <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/Abir-WA-QR.png' ) ); ?>" alt="WhatsApp QR code to start a chat with the Abiroverseas team" width="132" height="132" loading="lazy" decoding="async" onerror="this.hidden=true;this.parentElement.classList.add('qr-missing')">
        </figure>
      </div>
    </div>
    <div class="ab-footer-bottom">
      <span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Abiroverseas. All rights reserved.</span>
      <span class="ab-footer-legal"><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a><a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">Terms &amp; Conditions</a></span>
      <span>Design and Developed by <a href="https://asrsbot.com/" style="font-weight:700; color:#82969f !important;">ASRSBot Technology</a></span>
    </div>
  </div>
</footer>
<button class="ab-scroll-top" type="button" aria-label="Scroll to top" title="Back to top">
  <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
    <path d="M12 19V5M6 11l6-6 6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  </svg>
</button>
<?php wp_footer(); ?>
</body>
</html>