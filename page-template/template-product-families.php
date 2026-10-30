<?php
/**
 * Template Name: Product Families — Abiroverseas
 * Template Post Type: page
 * Six-card, searchable product-family overview.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$ab_families = array(
    array( 'slug' => 'pp', 'name' => 'Polypropylene (PP)', 'image' => 'pellets-macro.jpg', 'alt' => 'Polymer pellets representing polypropylene', 'terms' => 'pp polypropylene injection moulding extrusion packaging automotive household' ),
    array( 'slug' => 'hdpe', 'name' => 'High-Density Polyethylene (HDPE)', 'image' => 'virgin-vs-recycled.jpg', 'alt' => 'Polymer material for HDPE applications', 'terms' => 'hdpe high density polyethylene blow moulding pipes containers crates' ),
    array( 'slug' => 'ldpe-lldpe', 'name' => 'LDPE / LLDPE', 'image' => 'pellets-macro.jpg', 'alt' => 'Polymer granules representing LDPE and LLDPE', 'terms' => 'ldpe lldpe low density linear low density polyethylene film flexible packaging' ),
    array( 'slug' => 'pvc', 'name' => 'Polyvinyl Chloride (PVC)', 'image' => 'virgin-vs-recycled.jpg', 'alt' => 'Polymer material for PVC applications', 'terms' => 'pvc polyvinyl chloride pipes profiles cable construction flexible rigid' ),
    array( 'slug' => 'pet', 'name' => 'Polyethylene Terephthalate (PET)', 'image' => 'pellets-macro.jpg', 'alt' => 'Polymer pellets representing PET material', 'terms' => 'pet polyethylene terephthalate bottles packaging sheets thermoforming' ),
    array( 'slug' => 'engineering-plastics', 'name' => 'Engineering Plastics', 'image' => 'virgin-vs-recycled.jpg', 'alt' => 'Industrial polymer materials for engineering applications', 'terms' => 'engineering plastics abs polyamide nylon polycarbonate pom high performance' ),
);
?>
<main id="main-content" class="ab-products-page ab-product-families-page">
    <section class="ab-products-hero" aria-labelledby="ab-products-hero-title">
        <div class="ab-wrap ab-products-hero-grid">
            <div class="ab-products-hero-copy">
                <nav class="ab-products-breadcrumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span aria-hidden="true">/</span><span aria-current="page">Product Families</span></nav>
                <span class="ab-eyebrow">Explore the material range</span>
                <h1 id="ab-products-hero-title">Polymer families for <span>real-world applications.</span></h1>
                <p>Explore the material families we work with. Start with a polymer category, then share your grade, processing route, application, and supply requirements for a more focused enquiry.</p>
                <div class="ab-products-hero-proof"><span><i aria-hidden="true"></i> Specification-led sourcing</span><span><i aria-hidden="true"></i> Grade details confirmed per enquiry</span></div>
            </div>
            <div class="ab-products-hero-art" role="img" aria-label="Close-up of industrial polymer resin pellets">
                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/img/pellets-macro.jpg' ) ); ?>" alt="Close-up of polymer resin pellets" width="900" height="650" fetchpriority="high">
                <span class="ab-products-art-tag">Materials · forms · applications</span>
                <div class="ab-products-art-caption"><span class="ab-products-caption-dot" aria-hidden="true"></span><span><small>Start with the material</small><strong>Find the family that fits your brief.</strong></span></div>
            </div>
        </div>
    </section>

    <section class="ab-products-catalog ab-section" aria-labelledby="ab-family-heading">
        <div class="ab-wrap">
            <div class="ab-products-section-head">
                <div><span class="ab-eyebrow">Product directory</span><h2 id="ab-family-heading">Explore product families</h2><p>Choose a family to review the key selection points and common processing considerations.</p></div>
                <span class="ab-products-total"><strong data-products-count><?php echo count( $ab_families ); ?></strong> families</span>
            </div>
            <div class="ab-products-search-wrap">
                <label class="ab-products-search" for="ab-family-search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 4.5 4.5"></path></svg><input id="ab-family-search" type="search" placeholder="Search product families, polymers or applications…" autocomplete="off" data-product-search aria-controls="ab-family-grid"><kbd>⌕</kbd></label>
                <p class="ab-products-search-hint">Search updates the results as you type.</p>
            </div>
            <div class="ab-family-grid" id="ab-family-grid" data-product-grid>
                <?php foreach ( $ab_families as $index => $family ) : ?>
                    <a class="ab-family-card" href="<?php echo esc_url( home_url( '/product-range/#' . $family['slug'] ) ); ?>" data-product-card data-search="<?php echo esc_attr( $family['name'] . ' ' . $family['terms'] ); ?>">
                        <div class="ab-family-card-image"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/img/' . $family['image'] ) ); ?>" alt="<?php echo esc_attr( $family['alt'] ); ?>" width="720" height="520" loading="lazy"></div>
                        <div class="ab-family-card-title"><h3><?php echo esc_html( $family['name'] ); ?></h3></div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="ab-products-empty" data-products-empty hidden><strong>No matching families found.</strong><span>Try a polymer name, abbreviation, or application.</span></div>
            <p class="ab-products-live-status" data-products-status aria-live="polite" role="status"><?php echo count( $ab_families ); ?> product families shown</p>
        </div>
    </section>
</main>
<?php get_footer(); ?>