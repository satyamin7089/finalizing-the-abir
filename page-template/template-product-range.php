<?php
/**
 * Template Name: Product Range — Detailed Cards
 * Template Post Type: page
 * Searchable 2x2 directory with borderless 3D image cards, material guidance, comparison tables,
 * and separate material-explore + enquiry CTA buttons on every card.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

/**
 * Resolve a live WordPress permalink by assigned template first, then by slug,
 * falling back to home_url() (or Knowledge Center archive) so links never break.
 */
$ab_resolve_range_url = static function ( array $slugs, array $templates = array(), $fallback_path = '/', $anchor = '' ) {
    if ( ! empty( $templates ) ) {
        $matched_ids = get_posts(
            array(
                'post_type'      => 'page',
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'no_found_rows'  => true,
                'meta_query'     => array(
                    array(
                        'key'     => '_wp_page_template',
                        'value'   => $templates,
                        'compare' => 'IN',
                    ),
                ),
            )
        );
        if ( ! empty( $matched_ids ) ) {
            $permalink = get_permalink( (int) $matched_ids[0] );
            if ( $permalink ) {
                return $permalink . $anchor;
            }
        }
    }

    foreach ( $slugs as $candidate_slug ) {
        $page_obj = get_page_by_path( $candidate_slug, OBJECT, 'page' );
        if ( $page_obj && 'publish' === $page_obj->post_status ) {
            $permalink = get_permalink( $page_obj->ID );
            if ( $permalink ) {
                return $permalink . $anchor;
            }
        }
    }

    if ( '/knowledge/' === $fallback_path && function_exists( 'get_post_type_archive_link' ) ) {
        $archive_url = get_post_type_archive_link( 'knowledge' );
        if ( $archive_url ) {
            return $archive_url . $anchor;
        }
    }

    return home_url( $fallback_path ) . $anchor;
};

$ab_contact_base_url = $ab_resolve_range_url(
    array( 'contact-us', 'contact' ),
    array( 'page-template/template-contact.php', 'page-templates/template-contact.php' ),
    '/contact-us/'
);

$ab_build_enquire_url = static function ( $topic ) use ( $ab_contact_base_url ) {
    return add_query_arg( 'topic', $topic, $ab_contact_base_url ) . '#quick-enquiry';
};

$ab_range_items = array(
    array(
        'id'            => 'pp',
        'badge'         => '01 · Moulding & Extrusion',
        'icon'          => '#ab-icon-mould',
        'image'         => 'pp-product-image.jpg',
        'alt'           => 'Polypropylene resin granules for injection moulding and extrusion',
        'title'         => 'Polypropylene (PP)',
        'search'        => 'Polypropylene PP polypropylene injection moulding extrusion packaging automotive household',
        'explore_label' => 'EXPLORE PP',
        'explore_url'   => $ab_resolve_range_url(
            array( 'pp', 'polypropylene' ),
            array( 'page-template/template-material-PP.php', 'page-templates/template-material-PP.php' ),
            '/pp/'
        ),
        'enquire_url'   => $ab_build_enquire_url( 'PP' ),
        'points'        => array(
            'Available grades and forms depend on the intended application.',
            'Commonly considered for injection moulding and extrusion routes.',
            'Confirm grade, colour, impact needs, and end-use requirements.',
        ),
        'specs'         => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Injection / extrusion',
            'Compare with'     => 'HDPE: density and application needs differ by grade.',
        ),
    ),
    array(
        'id'            => 'hdpe',
        'badge'         => '02 · Pipe & Blow Moulding',
        'icon'          => '#ab-icon-pipe',
        'image'         => 'hdpe-product-image.png',
        'alt'           => 'High-Density Polyethylene material for pipe and blow moulding applications',
        'title'         => 'High-Density Polyethylene (HDPE)',
        'search'        => 'High-Density Polyethylene HDPE high density polyethylene blow moulding pipe containers crates extrusion injection',
        'explore_label' => 'EXPLORE HDPE',
        'explore_url'   => $ab_resolve_range_url(
            array( 'hdpe', 'high-density-polyethylene' ),
            array( 'page-template/template-material.php', 'page-templates/template-material.php' ),
            '/hdpe/'
        ),
        'enquire_url'   => $ab_build_enquire_url( 'HDPE' ),
        'points'        => array(
            'Consider the required stiffness, impact performance, and service conditions.',
            'Commonly used across blow moulding, extrusion, and selected injection applications.',
            'Confirm whether virgin, recycled, or reprocessed material is suitable.',
        ),
        'specs'         => array(
            'Common forms'     => 'Pellets / granules / compounds',
            'Processing focus' => 'Blow moulding / extrusion',
            'Compare with'     => 'LDPE / LLDPE: typically chosen for different flexibility needs.',
        ),
    ),
    array(
        'id'            => 'ldpe-lldpe',
        'badge'         => '03 · Film & Packaging',
        'icon'          => '#ab-icon-package',
        'image'         => 'ldpe-product-image.png',
        'alt'           => 'LDPE and LLDPE polymer pellets for flexible packaging and film extrusion',
        'title'         => 'LDPE / LLDPE',
        'search'        => 'LDPE LLDPE low density linear low density polyethylene film flexible packaging extrusion',
        'explore_label' => 'EXPLORE LDPE',
        'explore_url'   => $ab_resolve_range_url(
            array( 'ldpe', 'ldpe-lldpe', 'low-density-polyethylene' ),
            array( 'page-template/template-material-LDPE.php', 'page-templates/template-material-LDPE.php' ),
            '/ldpe/'
        ),
        'enquire_url'   => $ab_build_enquire_url( 'LDPE / LLDPE' ),
        'points'        => array(
            'Useful starting families for flexible film and packaging enquiries.',
            'Film grade selection depends on process conditions and target film performance.',
            'Confirm film type, thickness range, sealing needs, and application.',
        ),
        'specs'         => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Film extrusion',
            'Compare with'     => 'HDPE: often selected where more flexibility is needed.',
        ),
    ),
    array(
        'id'            => 'pvc',
        'badge'         => '04 · Rigid & Flexible',
        'icon'          => '#ab-icon-layers',
        'image'         => 'r-p-18.png',
        'alt'           => 'Polyvinyl Chloride compounds and granules for pipes, profiles and cable',
        'title'         => 'Polyvinyl Chloride (PVC)',
        'search'        => 'Polyvinyl Chloride PVC rigid flexible pipes profiles cable construction extrusion',
        'explore_label' => 'EXPLORE PVC',
        'explore_url'   => $ab_resolve_range_url(
            array( 'pvc', 'polyvinyl-chloride' ),
            array( 'page-template/template-material-PVC.php', 'page-templates/template-material-PVC.php' ),
            '/pvc/'
        ),
        'enquire_url'   => $ab_build_enquire_url( 'PVC' ),
        'points'        => array(
            'Rigid and flexible formulations serve different application requirements.',
            'Processing and additives depend on the formulation and target product.',
            'Confirm formulation, regulatory needs, colour, and end-use environment.',
        ),
        'specs'         => array(
            'Common forms'     => 'Compound / granules',
            'Processing focus' => 'Profile / pipe extrusion',
            'Compare with'     => 'PE: formulation and service requirements differ substantially.',
        ),
    ),
    array(
        'id'            => 'abs',
        'badge'         => '05 · Impact & Housings',
        'icon'          => '#ab-icon-industry',
        'image'         => 'Frame-1.jpg',
        'alt'           => 'ABS engineering plastic pellets for moulded housings and technical parts',
        'title'         => 'Acrylonitrile Butadiene Styrene (ABS)',
        'search'        => 'Acrylonitrile Butadiene Styrene ABS engineering plastic impact surface finish injection moulding',
        'explore_label' => 'EXPLORE ABS',
        'explore_url'   => $ab_resolve_range_url(
            array( 'abs', 'acrylonitrile-butadiene-styrene' ),
            array( 'page-template/template-material-ABS.php', 'page-templates/template-material-ABS.php' ),
            '/abs/'
        ),
        'enquire_url'   => $ab_build_enquire_url( 'ABS' ),
        'points'        => array(
            'Consider impact, surface finish, colour, and dimensional requirements.',
            'Often considered for injection-moulded components and housings.',
            'Confirm heat exposure, appearance requirements, and applicable standards.',
        ),
        'specs'         => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Injection moulding',
            'Compare with'     => 'PS / HIPS: toughness and finish requirements may differ.',
        ),
    ),
array(
    'id'            => 'eva',
    'badge'         => '06 · Flexible & Resilient',
    'icon'          => '#ab-icon-industry',
    'image'         => 'eva-product-image.jpg',
    'alt'           => 'EVA (Ethylene Vinyl Acetate) polymer pellets for flexible, resilient, and cushioning applications',
    'title'         => 'Ethylene Vinyl Acetate (EVA)',
    'search'        => 'Ethylene Vinyl Acetate EVA polymer flexible plastic elasticity softness resilience cushioning footwear films adhesives',
    'explore_label' => 'EXPLORE EVA',
    'explore_url'   => $ab_resolve_range_url(
        array( 'eva', 'ethylene-vinyl-acetate' ),
        array( 'page-template/template-material-EVA.php', 'page-templates/template-material-EVA.php' ),
        '/eva/'
    ),
    'enquire_url'   => $ab_build_enquire_url( 'EVA' ),
    'points'        => array(
        'Consider flexibility, softness, elasticity, and cushioning requirements.',
        'Often evaluated for footwear components, flexible products, films, and cushioning applications.',
        'Confirm vinyl acetate content, hardness, processing requirements, and applicable standards.',
    ),
    'specs'         => array(
        'Common forms'     => 'Pellets / granules',
        'Processing focus' => 'Injection moulding / extrusion',
        'Compare with'     => 'PE / PVC: flexibility, resilience, and application requirements may differ.',
    ),
),
    
);
?>
<main id="main-content" class="ab-products-page ab-product-range-page">
    <section class="ab-products-hero" aria-labelledby="ab-range-hero-title">
        <div class="ab-wrap ab-products-hero-grid">
            <div class="ab-products-hero-copy">
                <span class="ab-eyebrow">A closer look at material options</span>
                <h1 id="ab-range-hero-title">Find the right polymer for your process.</h1>
                <p>Review common forms, processing routes, and selection considerations across our material range. Final grade, availability, and specifications are confirmed against your enquiry.</p>
                <div class="ab-products-hero-proof"><span><i aria-hidden="true"></i> Material-first guidance</span><span><i aria-hidden="true"></i> Details verified before commitment</span></div>
            </div>
            <div class="ab-products-hero-art" role="img" aria-label="Close-up of polymer resin material">
                <img src="<?php echo esc_url( get_theme_file_uri( '/assets/img/virgin-vs-recycled.jpg' ) ); ?>" alt="Close-up of polymer resin material" width="900" height="650" fetchpriority="high">
                <span class="ab-products-art-tag">Grades · processing · fit</span>
                <div class="ab-products-art-caption"><span class="ab-products-caption-dot" aria-hidden="true"></span><span><small>Compare with context</small><strong>Start with your application and requirements.</strong></span></div>
            </div>
        </div>
    </section>

    <section class="ab-products-catalog ab-section" aria-labelledby="ab-range-heading">
        <div class="ab-wrap">
            <div class="ab-products-section-head">
                <div><span class="ab-eyebrow">Material guide</span><h2 id="ab-range-heading">Explore the product range</h2><p>Use the search to narrow the directory. Compare common forms and processing considerations, then confirm the exact grade for your use case.</p></div>
                <span class="ab-products-total"><strong data-products-count><?php echo count( $ab_range_items ); ?></strong> materials</span>
            </div>
            <div class="ab-products-search-wrap">
                <label class="ab-products-search" for="ab-range-search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 4.5 4.5"></path></svg><input id="ab-range-search" type="search" placeholder="Search materials, grades, processing or applications…" autocomplete="off" data-product-search aria-controls="ab-range-grid"><kbd>⌕</kbd></label>
                <p class="ab-products-search-hint">Results filter instantly as you type.</p>
            </div>
            <div class="ab-range-grid" id="ab-range-grid" data-product-grid>
                <?php foreach ( $ab_range_items as $item ) : ?>
                    <article class="ab-range-card" id="<?php echo esc_attr( $item['id'] ); ?>" data-product-card data-search="<?php echo esc_attr( $item['search'] ); ?>">
                        <div class="ab-range-card-image">
                            <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/10/' . $item['image'] ) ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" width="800" height="500" loading="lazy" decoding="async">
                            <span class="ab-range-card-badge"><?php echo esc_html( $item['badge'] ); ?></span>
                        </div>
                        <div class="ab-range-card-body">
                            <div class="ab-range-card-icon" aria-hidden="true">
                                <svg class="ab-icon"><use href="<?php echo esc_attr( $item['icon'] ); ?>" /></svg>
                            </div>
                            <h3><?php echo esc_html( $item['title'] ); ?></h3>
                            <ul class="ab-range-points">
                                <?php foreach ( $item['points'] as $point ) : ?>
                                    <li><?php echo esc_html( $point ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="ab-range-table-wrap">
                                <table class="ab-range-table">
                                    <tbody>
                                        <?php foreach ( $item['specs'] as $spec_label => $spec_val ) : ?>
                                            <tr>
                                                <th scope="row"><?php echo esc_html( $spec_label ); ?></th>
                                                <td><?php echo esc_html( $spec_val ); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ab-range-card-foot" role="group" aria-label="<?php echo esc_attr( $item['title'] . ' actions' ); ?>">
                                <a class="ab-range-card-cta" href="<?php echo esc_url( $item['explore_url'] ); ?>" aria-label="<?php echo esc_attr( $item['explore_label'] . ' — ' . $item['title'] ); ?>">
                                    <span><?php echo esc_html( $item['explore_label'] ); ?></span>
                                    <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-arrow" /></svg>
                                </a>
                                <a class="ab-range-card-cta" href="<?php echo esc_url( $item['enquire_url'] ); ?>" aria-label="<?php echo esc_attr( 'ENQUIRE NOW — ' . $item['title'] ); ?>">
                                    <span>ENQUIRE NOW</span>
                                    <svg class="ab-icon" aria-hidden="true"><use href="#ab-icon-chat" /></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="ab-products-empty" data-products-empty hidden><strong>No matching materials found.</strong><span>Try an abbreviation such as PP, HDPE, PVC, or a processing term.</span></div>
            <p class="ab-products-live-status" data-products-status aria-live="polite" role="status"><?php echo count( $ab_range_items ); ?> materials shown</p>
          <!--  <p class="ab-products-disclaimer">All Products Are Dummy</p>-->
        </div>
    </section>
</main>
<?php get_footer(); ?>