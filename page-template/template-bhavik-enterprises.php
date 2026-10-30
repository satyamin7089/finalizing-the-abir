<?php
/**
 * Template Name: Bhavik Enterprises
 * Template Post Type: page
 *
 * Authorised Distributor landing page for Bhavik Enterprises (India).
 * Uses shared Abiroverseas design tokens, 3D borderless surfaces, and in-page navigation.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header( 'bhavik' );

$ab_contact_result = isset( $_GET['enquiry'] ) ? sanitize_key( wp_unslash( $_GET['enquiry'] ) ) : '';

$bv_phone     = '+91 7007049478';
$bv_phone_raw = '+917007049478';
$bv_whatsapp  = '917007049478';
$bv_email     = 'info@bhavikenterprises.com';
$bv_address   = 'Village Barhat Bangar, Mandhana Bithoor Road, Kanpur – 209217, UP, India';

$bv_products = array(
    array(
        'code'  => 'LDPE · Film & Liner Grades',
        'icon'  => '#ab-icon-layers',
        'title' => 'LDPE',
        'desc'  => 'Low Density Polyethylene supplied in virgin and reprocessed film, liner and general extrusion grades.',
    ),
    array(
        'code'  => 'HDPE · Pipe, Blow & Raffia',
        'icon'  => '#ab-icon-pipe',
        'title' => 'HDPE',
        'desc'  => 'High Density Polyethylene for pressure pipes, blow-moulded containers, crates and industrial parts.',
    ),
    array(
        'code'  => 'PP · Moulding & Extrusion',
        'icon'  => '#ab-icon-mould',
        'title' => 'PP (Polypropylene)',
        'desc'  => 'Homopolymer and copolymer grades suited to high-cycle injection moulding, household ware and packaging.',
    ),
    array(
        'code'  => 'PVC · Rigid & Flexible',
        'icon'  => '#ab-icon-cube',
        'title' => 'PVC',
        'desc'  => 'Polyvinyl Chloride resins and compounds for rigid conduits, agricultural pipes, profiles and cable sheathing.',
    ),
    array(
        'code'  => 'Granules · Sorted & Tested',
        'icon'  => '#ab-icon-recycle',
        'title' => 'Plastic Granules',
        'desc'  => 'Uniform, clean-melt reprocessed thermoplastic granules matched to repeat production runs and target MFI.',
    ),
    array(
        'code'  => 'Prime · Certified Feedstock',
        'icon'  => '#ab-icon-shield',
        'title' => 'Virgin Polymers',
        'desc'  => 'Authorised prime polymer grades backed by Abiroverseas LLC sourcing and batch-level documentation.',
    ),
);

$bv_industries = array(
    array(
        'title' => 'Packaging',
        'tag'   => 'LDPE · HDPE',
        'icon'  => '#ab-icon-package',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-packaging.jpg' ),
        'alt'   => 'Flexible LDPE packaging film rolls and rigid HDPE containers in a modern plant',
        'desc'  => 'Flexible shrink and liner films, heavy-duty industrial bags and rigid blow-moulded containers.',
    ),
    array(
        'title' => 'Pipe Manufacturing',
        'tag'   => 'HDPE · PVC',
        'icon'  => '#ab-icon-pipe',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-pipes.jpg' ),
        'alt'   => 'Extruded black HDPE pipes with teal stripes and grey PVC pipes stacked in a facility',
        'desc'  => 'Water supply pipes, agricultural irrigation lines, cable ducting and rigid drainage extrusion.',
    ),
    array(
        'title' => 'Injection Moulding',
        'tag'   => 'PP · HDPE',
        'icon'  => '#ab-icon-mould',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-moulding.jpg' ),
        'alt'   => 'Precision injection-moulded PP and HDPE closures and components in a steel mould press',
        'desc'  => 'Caps, closures, industrial fittings and high-precision multi-cavity moulded components.',
    ),
    array(
        'title' => 'Industrial Products',
        'tag'   => 'HDPE · PP',
        'icon'  => '#ab-icon-cube',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-industrial.jpg' ),
        'alt'   => 'Heavy-duty moulded HDPE logistics crates, pallets and technical polymer parts',
        'desc'  => 'Material-handling crates, warehouse pallets, chemical drums and rugged technical housings.',
    ),
    array(
        'title' => 'Consumer Goods',
        'tag'   => 'PP · LDPE',
        'icon'  => '#ab-icon-home-goods',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-consumer.jpg' ),
        'alt'   => 'Clean moulded household storage containers and durable consumer plastic ware',
        'desc'  => 'Household storage containers, kitchenware, moulded furniture and everyday lifestyle products.',
    ),
    array(
        'title' => 'Recycling Units',
        'tag'   => 'Virgin · Reprocessed',
        'icon'  => '#ab-icon-recycle',
        'img'   => get_theme_file_uri( '/assets/img/bhavik-ind-recycling.jpg' ),
        'alt'   => 'High-purity virgin and reprocessed polymer granules flowing in a compounding line',
        'desc'  => 'Consistent reprocessed granules and prime blending resins for compounding and reprocessing lines.',
    ),
);

$bv_faqs = array(
    array(
        'cat' => 'Materials',
        'q'   => 'Which polymer families does Bhavik Enterprises supply?',
        'a'   => 'We supply LDPE, HDPE, PP (Polypropylene) and PVC in both virgin polymers and sorted reprocessed plastic granules, matched to your processing route and end-use specification.',
    ),
    array(
        'cat' => 'Partnership',
        'q'   => 'How is Bhavik Enterprises connected with Abiroverseas LLC?',
        'a'   => 'Bhavik Enterprises is the authorised distributor of Abiroverseas LLC in India — combining global polymer sourcing standards with dedicated local stock and dispatch support.',
    ),
    array(
        'cat' => 'Coverage',
        'q'   => 'Where do you deliver across India?',
        'a'   => 'We dispatch Pan-India through our head office in Kanpur (Uttar Pradesh) and active branch hubs in Mumbai and Mundra for rapid port-to-plant and inland movement.',
    ),
    array(
        'cat' => 'Orders',
        'q'   => 'Do you handle both trial batches and recurring bulk truckloads?',
        'a'   => 'Yes. Share your required polymer grade, monthly or per-order tonnage and delivery pin code — we confirm batch availability, packaging and dispatch timelines upfront.',
    ),
    array(
        'cat' => 'Enquiries',
        'q'   => 'What details help us quote the right grade fastest?',
        'a'   => 'Mention the polymer family (LDPE, HDPE, PP, PVC or granules), virgin or reprocessed preference, processing method (film, pipe, blow or injection moulding), quantity and destination city.',
    ),
);
?>
<main id="main-content" class="ab-bhavik-page">

    <!-- 1. Hero -->
    <section class="ab-about-hero" id="bv-hero" aria-labelledby="bv-hero-title">
        <div class="ab-wrap">
            <div class="ab-about-hero-grid">
                <div class="ab-about-hero-copy ab-reveal">
                    <span class="ab-eyebrow">Authorised Distributor of Abiroverseas LLC</span>
                    <h1 id="bv-hero-title">Trusted Plastic Raw Material <span>Supplier in India.</span></h1>
                    <p class="lead ab-lead">Bhavik Enterprises supplies virgin and reprocessed LDPE, HDPE, PP and PVC raw materials to manufacturers across India — backed by verified grade consistency, competitive pricing and dependable dispatch from Kanpur, Mumbai and Mundra.</p>
                    <div class="ab-about-hero-actions ab-hero-actions">
                        <a class="ab-btn" href="#quick-enquiry">REQUEST A QUOTE
                            <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                        </a>
                        <a class="ab-btn ab-btn--outline" href="#products">EXPLORE MATERIALS</a>
                    </div>
                </div>
                <div class="ab-about-hero-art ab-reveal ab-reveal-delay-1" aria-label="Polymer resin materials supplied across India">
                    <img class="ab-hero-img" src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/r-p-10.png' ) ); ?>" width="960" height="720" alt="Virgin and reprocessed polymer resin granules" fetchpriority="high" decoding="async">
                    <span class="art-tag ab-art-tag">LDPE · HDPE · PP · PVC</span>
                    <div class="glass-card ab-hero-glass-card">
                        <small>Pan-India Dispatch</small>
                        <strong>Kanpur · Mumbai · Mundra</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Why Choose Bhavik Enterprises -->
    <section class="ab-section ab-section--white" id="why-bhavik" aria-labelledby="bv-why-title">
        <div class="ab-wrap">
            <div class="ab-section-head ab-reveal">
                <span class="ab-eyebrow">Why buyers work with us</span>
                <h2 id="bv-why-title">Four commitments behind every supply.</h2>
                <p>What industrial processors and procurement teams rely on when sourcing polymer raw materials through Bhavik Enterprises.</p>
            </div>
            <div class="ab-pillars">
                <article class="ab-pillar ab-reveal">
                    <div class="ab-icon-box" aria-hidden="true"><svg class="ab-icon"><use href="#ab-icon-shield" /></svg></div>
                    <h3>Authorised Supply</h3>
                    <p>Official India distribution partner of Abiroverseas LLC with direct, traceable polymer sourcing.</p>
                    <ul>
                        <li>Verified global supply chain</li>
                        <li>Clear grade &amp; batch identity</li>
                    </ul>
                </article>
                <article class="ab-pillar ab-reveal ab-reveal-delay-1">
                    <div class="ab-icon-box" aria-hidden="true"><svg class="ab-icon"><use href="#ab-icon-globe" /></svg></div>
                    <h3>Pan-India Reach</h3>
                    <p>Strategically positioned stock and port connectivity for reliable inland and coastal dispatch.</p>
                    <ul>
                        <li>Head office in Kanpur (UP)</li>
                        <li>Branches in Mumbai &amp; Mundra</li>
                    </ul>
                </article>
                <article class="ab-pillar ab-reveal ab-reveal-delay-2">
                    <div class="ab-icon-box" aria-hidden="true"><svg class="ab-icon"><use href="#ab-icon-layers" /></svg></div>
                    <h3>Consistent Quality</h3>
                    <p>Every lot is matched to your melt-flow, density and processing requirements before dispatch.</p>
                    <ul>
                        <li>Virgin &amp; reprocessed options</li>
                        <li>Repeatable lot-to-lot behaviour</li>
                    </ul>
                </article>
                <article class="ab-pillar ab-reveal ab-reveal-delay-3">
                    <div class="ab-icon-box" aria-hidden="true"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 720 720"
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
</svg></div>
                    <h3>Bulk &amp; Timely Delivery</h3>
                    <p>Structured scheduling and transparent commercial quotes tailored to production timelines.</p>
                    <ul>
                        <li>Full-load &amp; recurring supply</li>
                        <li>Direct WhatsApp &amp; phone desk</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <!-- 3. Who We Are -->
    <section class="ab-section ab-section--mist" id="about" aria-labelledby="bv-about-title">
        <div class="ab-wrap">
            <div class="ab-story">
                <div class="ab-story-visual ab-reveal ab-reveal-delay-1">
                    <img class="ab-story-img" src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/Frame-9.jpg' ) ); ?>" width="960" height="720" alt="Polymer material handling and quality inspection" loading="lazy" decoding="async">
                    <span class="ab-story-chip">India Distribution</span>
                    <div class="ab-story-badge">
                        <strong>Authorised Partner</strong>
                        Abiroverseas LLC · India Network
                    </div>
                </div>
                <div class="ab-story-copy ab-reveal">
                    <span class="ab-eyebrow">Who we are</span>
                    <h2 id="bv-about-title">Built on a trusted partnership with Abiroverseas LLC.</h2>
                    <p>Bhavik Enterprises is a dedicated B2B supplier of thermoplastic raw materials serving extruders, moulders and compounders across India. As the authorised distributor of Abiroverseas LLC, we bridge international polymer sourcing with responsive domestic execution.</p>
                    <p>From our head office in Kanpur and port-linked branches in Mumbai and Mundra, we help manufacturers secure dependable grades of LDPE, HDPE, PP, PVC and reprocessed granules without supply bottlenecks.</p>
                    <div class="ab-story-pills" aria-label="Core supply strengths">
                        <span class="ab-story-pill"><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-check" /></svg> Authorised Abiroverseas LLC distributor</span>
                        <span class="ab-story-pill"><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-check" /></svg> Virgin &amp; reprocessed polymer grades</span>
                        <span class="ab-story-pill"><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-check" /></svg> Kanpur · Mumbai · Mundra network</span>
                        <span class="ab-story-pill"><svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-check" /></svg> Specification-led grade matching</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Our Products -->
    <section class="ab-section ab-section--white" id="products" aria-labelledby="bv-products-title">
        <div class="ab-wrap">
            <div class="ab-head-row">
                <div class="ab-section-head ab-reveal">
                    <span class="ab-eyebrow">Our products</span>
                    <h2 id="bv-products-title">High-quality polymers for diverse industrial uses.</h2>
                    <p>Available across virgin and reprocessed grades — share your processing method, target properties and tonnage for an exact match.</p>
                </div>
                <a class="ab-btn" href="#quick-enquiry">ENQUIRE BY GRADE
                    <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                </a>
            </div>
            <div class="ab-why-grid">
                <?php foreach ( $bv_products as $idx => $product ) : ?>
                    <article class="ab-why-card ab-reveal<?php echo $idx % 3 ? ' ab-reveal-delay-' . ( $idx % 3 ) : ''; ?>">
                        <div class="ab-bv-product-top">
                            <div class="ab-icon-box" aria-hidden="true"><svg class="ab-icon"><use href="<?php echo esc_attr( $product['icon'] ); ?>" /></svg></div>
                            <span class="ab-why-tag"><?php echo esc_html( $product['code'] ); ?></span>
                        </div>
                        <h3><?php echo esc_html( $product['title'] ); ?></h3>
                        <p><?php echo esc_html( $product['desc'] ); ?></p>
                        <a class="ab-link" href="#quick-enquiry">Request availability <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 5. Industries We Serve — Ultra-premium borderless 3D image cards -->
    <section class="ab-section ab-section--mist" id="industries" aria-labelledby="bv-industries-title">
        <div class="ab-wrap">
            <div class="ab-section-head ab-reveal">
                <span class="ab-eyebrow">Industries we serve</span>
                <h2 id="bv-industries-title">Serving diverse industries across India.</h2>
                <p>From high-speed packaging lines to pipe extrusion and compounding units, every polymer grade is matched to how your product is actually manufactured.</p>
            </div>
            <div class="ab-bv-ind-grid">
                <?php foreach ( $bv_industries as $i => $ind ) : ?>
                    <article class="ab-bv-ind-card ab-reveal<?php echo $i % 3 ? ' ab-reveal-delay-' . ( $i % 3 ) : ''; ?>">
                        <div class="ab-bv-ind-media">
                            <img src="<?php echo esc_url( $ind['img'] ); ?>" width="960" height="600" alt="<?php echo esc_attr( $ind['alt'] ); ?>" loading="lazy" decoding="async">
                            <span class="ab-bv-ind-badge"><?php echo esc_html( $ind['tag'] ); ?></span>
                        </div>
                        <div class="ab-bv-ind-body">
                            <div class="ab-icon-box ab-bv-ind-icon" aria-hidden="true">
                                <svg class="ab-icon"><use href="<?php echo esc_attr( $ind['icon'] ); ?>" /></svg>
                            </div>
                            <h3><?php echo esc_html( $ind['title'] ); ?></h3>
                            <p><?php echo esc_html( $ind['desc'] ); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 6. How We Work -->
    <section class="ab-section ab-way-section" id="the-way" aria-labelledby="bv-way-title">
        <div class="ab-wrap">
            <div class="ab-way-intro">
                <div class="ab-section-head ab-reveal">
                    <span class="ab-eyebrow">How we work</span>
                    <h2 id="bv-way-title">From enquiry to dispatch, in four clear steps.</h2>
                    <p>No guesswork on grade or pricing — each stage is confirmed clearly before your material is scheduled for dispatch.</p>
                </div>
                <a class="ab-btn" href="#quick-enquiry">SHARE YOUR REQUIREMENT
                    <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                </a>
            </div>
            <div class="ab-way-grid">
                <article class="ab-way-item ab-reveal">
                    <span class="ab-way-num">01</span>
                    <h3>Share Requirement</h3>
                    <p>Tell us the polymer family, virgin or reprocessed grade, processing method and required tonnage.</p>
                </article>
                <article class="ab-way-item ab-reveal ab-reveal-delay-1">
                    <span class="ab-way-num">02</span>
                    <h3>Grade &amp; Stock Match</h3>
                    <p>We verify current batch availability, melt-flow suitability and port or warehouse stock position.</p>
                </article>
                <article class="ab-way-item ab-reveal ab-reveal-delay-2">
                    <span class="ab-way-num">03</span>
                    <h3>Commercial Quote</h3>
                    <p>Receive transparent landed or ex-hub pricing, packaging details and confirmed dispatch schedule.</p>
                </article>
                <article class="ab-way-item ab-reveal ab-reveal-delay-3">
                    <span class="ab-way-num">04</span>
                    <h3>Pan-India Dispatch</h3>
                    <p>Material moves promptly from Kanpur, Mumbai or Mundra to your plant with direct coordination.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- 7. Common Questions (FAQs) -->
    <section class="ab-section ab-faq-section" id="faqs" aria-labelledby="bv-faq-title">
        <div class="ab-wrap">
            <div class="ab-faq-grid">
                <div class="ab-faq-side ab-reveal">
                    <span class="ab-eyebrow">Common questions</span>
                    <h2 id="bv-faq-title">Before you send an enquiry.</h2>
                    <p>Clear answers on polymer grades, authorised sourcing, order volumes and Pan-India delivery hubs.</p>
                    <div class="ab-faq-help-card">
                        <div class="ab-icon-box" aria-hidden="true">
                            <svg class="ab-icon"><use href="#ab-icon-chat" /></svg>
                        </div>
                        <div class="ab-faq-help-copy">
                            <h3 class="ab-faq-help-title">Have a specific grade enquiry?</h3>
                            <p class="ab-faq-help-sub">Speak directly with our polymer supply team for current stock and pricing.</p>
                            <a class="ab-faq-help-link" href="#quick-enquiry">
                                Go to enquiry form
                                <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ab-faq-accordion ab-reveal ab-reveal-delay-1">
                    <?php foreach ( $bv_faqs as $index => $faq ) : ?>
                        <details class="ab-faq-item" <?php echo 0 === $index ? 'open' : ''; ?>>
                            <summary class="ab-faq-summary">
                                <div class="ab-faq-q-wrap">
                                    <span class="ab-faq-category-tag"><?php echo esc_html( $faq['cat'] ); ?></span>
                                    <h3 class="ab-faq-q"><?php echo esc_html( $faq['q'] ); ?></h3>
                                </div>
                                <span class="ab-faq-trigger-icon" aria-hidden="true">
                                    <svg class="ab-icon"><use href="#ab-icon-plus" /></svg>
                                </span>
                            </summary>
                            <div class="ab-faq-body">
                                <p><?php echo esc_html( $faq['a'] ); ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Call to Action -->
    <section class="ab-final-cta" aria-labelledby="bv-cta-title">
        <div class="ab-wrap ab-final-inner">
            <div class="ab-final-copy">
                <span class="ab-eyebrow">Pan-India Polymer Supply</span>
                <h2 id="bv-cta-title">Source verified LDPE, HDPE, PP &amp; PVC grades with dependable dispatch.</h2>
                <p>Share your polymer family, processing method, required quantity and delivery location. Our Kanpur, Mumbai and Mundra dispatch teams will respond with confirmed availability and competitive pricing.</p>
            </div>
            <div class="ab-final-actions">
                <a class="ab-btn" href="#quick-enquiry">REQUEST A QUOTE
                    <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                </a>
                <a class="ab-btn ab-btn--light" href="tel:<?php echo esc_attr( $bv_phone_raw ); ?>">CALL <?php echo esc_html( $bv_phone ); ?></a>
            </div>
        </div>
    </section>

    <!-- 9. Contact Us & Quick Enquiry -->
    <section class="ab-contact-main ab-section" id="quick-enquiry" aria-labelledby="bv-contact-title">
        <div class="ab-wrap">
            <div class="ab-section-head ab-contact-intro ab-reveal">
                <span class="ab-eyebrow">Contact us</span>
                <h2 id="bv-contact-title">Get in touch with Bhavik Enterprises.</h2>
                <p>Share your material requirement below, or reach our head office and regional dispatch hubs directly by phone, email or WhatsApp.</p>
            </div>

            <?php if ( 'sent' === $ab_contact_result ) : ?>
                <div class="ab-contact-notice ab-contact-notice--success" role="status" aria-live="polite">
                    <strong>Thank you for contacting Bhavik Enterprises.</strong>
                    <span>Your material requirement has been received. Our team will review your specification and contact you shortly.</span>
                </div>
            <?php elseif ( 'error' === $ab_contact_result ) : ?>
                <div class="ab-contact-notice ab-contact-notice--error" role="alert">
                    <strong>We couldn’t submit your enquiry.</strong>
                    <span>Please check the required fields and try again, or call us directly on <?php echo esc_html( $bv_phone ); ?>.</span>
                </div>
            <?php endif; ?>

            <div class="ab-contact-layout">
                <aside class="ab-contact-aside" aria-label="Bhavik Enterprises contact details">
                    <div class="ab-contact-aside-heading">
                        <span class="ab-eyebrow">Direct channels</span>
                        <h3>Talk to our supply desk.</h3>
                        <p>Connect directly for grade availability, bulk pricing and dispatch timelines across India.</p>
                    </div>

                    <div class="ab-bv-contact-details">
                        <div class="ab-contact-detail ab-contact-detail--full">
                            <span class="ab-contact-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.2 7-11.2A7 7 0 0 0 5 9.8C5 14.8 12 21 12 21Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/><circle cx="12" cy="9.8" r="2.5" stroke="currentColor" stroke-width="1.75"/></svg>
                            </span>
                            <span>
                                <small>Registered address</small>
                                <strong><?php echo esc_html( $bv_address ); ?></strong>
                            </span>
                        </div>

                        <a class="ab-contact-detail" href="tel:<?php echo esc_attr( $bv_phone_raw ); ?>">
                            <span class="ab-contact-detail-icon" aria-hidden="true">
                                <svg class="ab-icon"><use href="#ab-icon-phone" /></svg>
                            </span>
                            <span>
                                <small>Call us</small>
                                <strong><?php echo esc_html( $bv_phone ); ?></strong>
                                <em>Direct commercial &amp; dispatch desk</em>
                            </span>
                        </a>

                        <a class="ab-contact-detail" href="mailto:<?php echo esc_attr( $bv_email ); ?>">
                            <span class="ab-contact-detail-icon" aria-hidden="true">
                                <svg class="ab-icon"><use href="#ab-icon-mail" /></svg>
                            </span>
                            <span>
                                <small>Email us</small>
                                <strong><?php echo esc_html( $bv_email ); ?></strong>
                                <em>For specifications &amp; quotations</em>
                            </span>
                        </a>

                        <a class="ab-contact-detail" href="<?php echo esc_url( 'https://wa.me/' . $bv_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
                            <span class="ab-contact-detail-icon" aria-hidden="true">
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
                            </span>
                            <span>
                                <small>WhatsApp</small>
                                <strong><?php echo esc_html( $bv_phone ); ?></strong>
                                <em>Quick grade &amp; stock confirmation</em>
                            </span>
                        </a>

                        <div class="ab-bv-presence-block" aria-label="Our Presence">
                            <span class="ab-bv-presence-title">Our Presence</span>
                            <div class="ab-bv-presence-grid">
                                <div class="ab-contact-detail">
                                    <span class="ab-contact-detail-icon" aria-hidden="true">
                                        <svg class="ab-icon"><use href="#ab-icon-industry" /></svg>
                                    </span>
                                    <span>
                                        <small>Head Office</small>
                                        <strong>Kanpur</strong>
                                        <em>Central North India hub</em>
                                    </span>
                                </div>

                                <div class="ab-contact-detail">
                                    <span class="ab-contact-detail-icon" aria-hidden="true">
                                        <svg class="ab-icon"><use href="#ab-icon-globe" /></svg>
                                    </span>
                                    <span>
                                        <small>Branches</small>
                                        <strong>Mumbai, Mundra</strong>
                                        <em>Port-connected Western hubs</em>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ab-contact-aside-note">
                        <span class="ab-contact-note-dot" aria-hidden="true"></span>
                        <p>Include polymer family, virgin or reprocessed grade, processing method, quantity and destination pin code for fastest turnaround.</p>
                    </div>
                </aside>

                <form class="ab-form-card ab-contact-form" id="bhavik-enquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="ab_material_enquiry">
                    <input type="hidden" name="enquiry_kind" value="bhavik">
                    <?php wp_nonce_field( 'ab_material_enquiry', 'ab_material_enquiry_nonce' ); ?>
                    <label class="ab-honeypot" aria-hidden="true">Leave this field empty<input type="text" name="ab_website" tabindex="-1" autocomplete="off"></label>

                    <div class="ab-contact-form-heading">
                        <span class="ab-eyebrow">Enquiry form</span>
                        <h3>Send us your requirement</h3>
                        <p>Fields marked with an asterisk (*) are required.</p>
                    </div>

                    <div class="ab-form-grid">
                        <div class="ab-field">
                            <label for="bv-name">Full Name <span aria-hidden="true">*</span></label>
                            <input id="bv-name" name="name" type="text" autocomplete="name" required maxlength="120" placeholder="Your full name">
                        </div>
                        <div class="ab-field">
                            <label for="bv-phone">Phone Number <span aria-hidden="true">*</span></label>
                            <input id="bv-phone" name="phone" type="tel" autocomplete="tel" required maxlength="60" placeholder="+91 XXXXX XXXXX">
                        </div>
                        <div class="ab-field">
                            <label for="bv-email">Email Address <span aria-hidden="true">*</span></label>
                            <input id="bv-email" name="email" type="email" autocomplete="email" required maxlength="160" placeholder="you@company.com">
                        </div>
                        <div class="ab-field">
                            <label for="bv-material">Product Required <span aria-hidden="true">*</span></label>
                            <select id="bv-material" name="material" required>
                                <option value="">Select polymer / material</option>
                                <option value="LDPE">LDPE</option>
                                <option value="HDPE">HDPE</option>
                                <option value="PP (Polypropylene)">PP (Polypropylene)</option>
                                <option value="PVC">PVC</option>
                                <option value="Plastic Granules">Plastic Granules (Reprocessed)</option>
                                <option value="Virgin Polymers">Virgin Polymers</option>
                                <option value="Multiple / Other">Multiple / Other</option>
                            </select>
                        </div>
                        <div class="ab-field ab-field--full">
                            <label for="bv-quantity">Approximate Quantity</label>
                            <input id="bv-quantity" name="quantity" type="text" maxlength="120" placeholder="e.g., 10 MT, 1 truckload, or monthly requirement">
                        </div>
                        <div class="ab-field ab-field--full">
                            <label for="bv-message">Requirement Details <span aria-hidden="true">*</span></label>
                            <textarea id="bv-message" name="application" required maxlength="3000" placeholder="Share grade preference, processing method (film, pipe, blow or injection moulding), colour and delivery city."></textarea>
                        </div>
                    </div>

                    <div class="ab-form-foot">
                        <button class="ab-btn ab-contact-submit" type="submit">SEND ENQUIRY
                            <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>
<?php
get_footer( 'bhavik' );