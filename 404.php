<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * Uses dedicated assets/css/error-404.css + assets/js/error-404.js (loaded only
 * on is_404() in functions.php) to preserve strict per-page CSS/JS isolation.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$ab_home_url = home_url( '/' );
$ab_prev_url = $ab_home_url;
$ab_prev_label_path = '';

$ab_raw_referer = wp_get_referer();
if ( $ab_raw_referer ) {
    $ab_home_host = wp_parse_url( $ab_home_url, PHP_URL_HOST );
    $ab_ref_host  = wp_parse_url( $ab_raw_referer, PHP_URL_HOST );
    $ab_ref_path  = (string) wp_parse_url( $ab_raw_referer, PHP_URL_PATH );
    $ab_cur_uri   = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
    $ab_cur_path  = (string) wp_parse_url( $ab_cur_uri, PHP_URL_PATH );

    if ( $ab_ref_host && $ab_home_host && strtolower( $ab_ref_host ) === strtolower( $ab_home_host ) && $ab_ref_path !== $ab_cur_path ) {
        $ab_prev_url        = $ab_raw_referer;
        $ab_prev_label_path = $ab_ref_path ? $ab_ref_path : '/';
    }
}

$ab_requested_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
if ( '' === $ab_requested_uri ) {
    $ab_requested_uri = '/unknown-url';
}

// Resolve live destination URLs dynamically with safe fallbacks.
$ab_resolve_page_url = static function ( array $slugs, $fallback_path ) {
    foreach ( $slugs as $slug ) {
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( $page && 'publish' === $page->post_status ) {
            $permalink = get_permalink( $page->ID );
            if ( $permalink ) {
                return $permalink;
            }
        }
    }
    return home_url( $fallback_path );
};

$ab_products_url  = $ab_resolve_page_url( array( 'product-range', 'product-families', 'products' ), '/#product-families' );
$ab_hdpe_url      = $ab_resolve_page_url( array( 'hdpe' ), '/hdpe/' );
$ab_knowledge_url = get_post_type_archive_link( 'knowledge' ) ? get_post_type_archive_link( 'knowledge' ) : home_url( '/knowledge/' );
$ab_contact_url   = $ab_resolve_page_url( array( 'contact-us', 'contact' ), '/#quick-enquiry' );
?>
<main id="main-content" class="ab-404-page">

    <!-- 1. SPLIT EQUAL-HEIGHT 404 HERO -->
    <section class="ab-404-hero" aria-labelledby="ab-404-title">
        <div class="ab-wrap">
            <div class="ab-404-hero-grid">

                <div class="ab-404-copy">
                    <span class="ab-eyebrow">Error 404 · Page Not Found</span>
                    <h1 id="ab-404-title">This page has moved or is <span>no longer available.</span></h1>
                    <p class="ab-404-lead">The link you followed may be outdated, renamed, or mistyped. Return directly to the previous page you came from, head back to our homepage, or explore our polymer material directories below.</p>

                    <div class="ab-404-route-meta" role="status" aria-live="polite">
                        <div class="ab-404-route-pill">
                            <span class="ab-404-route-dot" aria-hidden="true"></span>
                            <span class="ab-404-route-label">Requested path:</span>
                            <code class="ab-404-route-code" data-ab-requested-path><?php echo esc_html( $ab_requested_uri ); ?></code>
                        </div>
                        <p class="ab-404-prev-hint" data-ab-prev-hint<?php echo '' === $ab_prev_label_path ? ' hidden' : ''; ?>>
                            Came from: <strong data-ab-prev-value><?php echo esc_html( $ab_prev_label_path ); ?></strong>
                        </p>
                    </div>

                    <div class="ab-404-actions">
                        <a class="ab-btn ab-404-btn-back"
                           href="<?php echo esc_url( $ab_prev_url ); ?>"
                           data-ab-go-back
                           data-fallback-url="<?php echo esc_url( $ab_home_url ); ?>">
                            <svg class="ab-icon ab-404-icon-back" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M20 12H5M11 19l-7-7 7-7" />
                            </svg>
                            <span data-ab-back-text>Back to Previous Page</span>
                        </a>

                        <a class="ab-btn" href="<?php echo esc_url( $ab_home_url ); ?>">
                            <span>Return to Homepage</span>
                            <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                        </a>
                    </div>

                    <div class="ab-404-support-strip" aria-label="Direct supply desk contact">
                        <a class="ab-404-support-item" href="mailto:info@abiroverseas.com">
                            <span class="ab-icon-box" aria-hidden="true">
                                <svg class="ab-icon"><use href="#ab-icon-mail" /></svg>
                            </span>
                            <span>
                                <small>Need a specific grade or TDS?</small>
                                <strong>info@abiroverseas.com</strong>
                            </span>
                        </a>
                        <a class="ab-404-support-item" href="tel:+18565233366">
                            <span class="ab-icon-box" aria-hidden="true">
                                <svg class="ab-icon"><use href="#ab-icon-phone" /></svg>
                            </span>
                            <span>
                                <small>Speak with our supply team</small>
                                <strong>+1 (856) 523 3366</strong>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Right-side equal-height visual container -->
                <div class="ab-404-visual" role="img" aria-label="Error 404 — Polymer supply navigation assistance">
                    <img class="ab-404-bg-img"
                         src="<?php echo esc_url( get_theme_file_uri( '/assets/img/pellets-macro.jpg' ) ); ?>"
                         width="900"
                         height="680"
                         alt=""
                         decoding="async">
                    <div class="ab-404-visual-overlay" aria-hidden="true"></div>

                    <span class="ab-404-visual-badge">HTTP 404 · Route Unavailable</span>

                    <div class="ab-404-code-stage" aria-hidden="true">
                        <span class="ab-404-code-kicker">Status Code</span>
                        <strong class="ab-404-code-num">404</strong>
                        <span class="ab-404-code-sub">Destination Not Found</span>
                    </div>

                    <div class="ab-404-glass-card">
                        <small>Verified Polymer Supply</small>
                        <strong>HDPE · LDPE · LLDPE · PP · PVC · Recycled Resins</strong>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. QUICK RECOVERY DESTINATIONS -->
    <section class="ab-404-destinations" aria-labelledby="ab-404-dest-heading">
        <div class="ab-wrap">
            <div class="ab-404-section-head">
                <span class="ab-eyebrow">Quick Navigation</span>
                <h2 id="ab-404-dest-heading">Where would you like to go next?</h2>
                <p>Jump straight to our core polymer directories, technical resources, or enquiry desk.</p>
            </div>

            <div class="ab-404-grid">
                <article class="ab-404-card">
                    <a class="ab-404-card-link" href="<?php echo esc_url( $ab_products_url ); ?>">
                        <span class="ab-icon-box" aria-hidden="true">
                            <svg class="ab-icon"><use href="#ab-icon-layers" /></svg>
                        </span>
                        <h3>Product Range &amp; Families</h3>
                        <p>Browse virgin, prime-grade, reprocessed, and compounded polymer streams across major resin families.</p>
                        <span class="ab-404-card-cta">Explore Products <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></span>
                    </a>
                </article>

                <article class="ab-404-card">
                    <a class="ab-404-card-link" href="<?php echo esc_url( $ab_hdpe_url ); ?>">
                        <span class="ab-icon-box" aria-hidden="true">
                            <svg class="ab-icon"><use href="#ab-icon-cube" /></svg>
                        </span>
                        <h3>HDPE &amp; Material Specs</h3>
                        <p>Review granule, powder, and compound forms, processing methods, MFR guidance, and FAQs.</p>
                        <span class="ab-404-card-cta">View Material Specs <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></span>
                    </a>
                </article>

                <article class="ab-404-card">
                    <a class="ab-404-card-link" href="<?php echo esc_url( $ab_knowledge_url ); ?>">
                        <span class="ab-icon-box" aria-hidden="true">
                            <svg class="ab-icon"><use href="#ab-icon-compass" /></svg>
                        </span>
                        <h3>Knowledge Center</h3>
                        <p>Read practical polymer comparisons, grade selection guides, and processing notes by resin or topic.</p>
                        <span class="ab-404-card-cta">Browse Articles <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></span>
                    </a>
                </article>

                <article class="ab-404-card">
                    <a class="ab-404-card-link" href="<?php echo esc_url( $ab_contact_url ); ?>">
                        <span class="ab-icon-box" aria-hidden="true">
                            <svg class="ab-icon"><use href="#ab-icon-chat" /></svg>
                        </span>
                        <h3>Request a Custom Quote</h3>
                        <p>Share your target polymer grade, melt flow, quantity, and destination port with our supply team.</p>
                        <span class="ab-404-card-cta">Start an Enquiry <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></span>
                    </a>
                </article>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
