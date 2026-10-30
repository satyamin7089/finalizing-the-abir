<?php
/**
 * Template Name: Product Range — Detailed Cards
 * Template Post Type: page
 * Searchable 2x2 directory with borderless 3D image cards, material guidance, and comparison tables.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$ab_range_items = array(
    array(
        'id'      => 'pp',
        'badge'   => '01 · Moulding & Extrusion',
        'icon'    => '#ab-icon-mould',
        'image'   => 'bhavik-ind-moulding.jpg',
        'alt'     => 'Polypropylene resin granules for injection moulding and extrusion',
        'title'   => 'Polypropylene (PP)',
        'search'  => 'Polypropylene PP polypropylene injection moulding extrusion packaging automotive household',
        'points'  => array(
            'Available grades and forms depend on the intended application.',
            'Commonly considered for injection moulding and extrusion routes.',
            'Confirm grade, colour, impact needs, and end-use requirements.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Injection / extrusion',
            'Compare with'     => 'HDPE: density and application needs differ by grade.',
        ),
    ),
    array(
        'id'      => 'hdpe',
        'badge'   => '02 · Pipe & Blow Moulding',
        'icon'    => '#ab-icon-pipe',
        'image'   => 'bhavik-ind-pipes.jpg',
        'alt'     => 'High-Density Polyethylene material for pipe and blow moulding applications',
        'title'   => 'High-Density Polyethylene (HDPE)',
        'search'  => 'High-Density Polyethylene HDPE high density polyethylene blow moulding pipe containers crates extrusion injection',
        'points'  => array(
            'Consider the required stiffness, impact performance, and service conditions.',
            'Commonly used across blow moulding, extrusion, and selected injection applications.',
            'Confirm whether virgin, recycled, or reprocessed material is suitable.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules / compounds',
            'Processing focus' => 'Blow moulding / extrusion',
            'Compare with'     => 'LDPE / LLDPE: typically chosen for different flexibility needs.',
        ),
    ),
    array(
        'id'      => 'ldpe-lldpe',
        'badge'   => '03 · Film & Packaging',
        'icon'    => '#ab-icon-package',
        'image'   => 'bhavik-ind-packaging.jpg',
        'alt'     => 'LDPE and LLDPE polymer pellets for flexible packaging and film extrusion',
        'title'   => 'LDPE / LLDPE',
        'search'  => 'LDPE LLDPE low density linear low density polyethylene film flexible packaging extrusion',
        'points'  => array(
            'Useful starting families for flexible film and packaging enquiries.',
            'Film grade selection depends on process conditions and target film performance.',
            'Confirm film type, thickness range, sealing needs, and application.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Film extrusion',
            'Compare with'     => 'HDPE: often selected where more flexibility is needed.',
        ),
    ),
    array(
        'id'      => 'pvc',
        'badge'   => '04 · Rigid & Flexible',
        'icon'    => '#ab-icon-layers',
        'image'   => 'virgin-vs-recycled.jpg',
        'alt'     => 'Polyvinyl Chloride compounds and granules for pipes, profiles and cable',
        'title'   => 'Polyvinyl Chloride (PVC)',
        'search'  => 'Polyvinyl Chloride PVC rigid flexible pipes profiles cable construction extrusion',
        'points'  => array(
            'Rigid and flexible formulations serve different application requirements.',
            'Processing and additives depend on the formulation and target product.',
            'Confirm formulation, regulatory needs, colour, and end-use environment.',
        ),
        'specs'   => array(
            'Common forms'     => 'Compound / granules',
            'Processing focus' => 'Profile / pipe extrusion',
            'Compare with'     => 'PE: formulation and service requirements differ substantially.',
        ),
    ),
    array(
        'id'      => 'pet',
        'badge'   => '05 · Packaging & Sheet',
        'icon'    => '#ab-icon-cube',
        'image'   => 'pellets-macro.jpg',
        'alt'     => 'Polyethylene Terephthalate resin pellets for bottles and thermoformed sheet',
        'title'   => 'Polyethylene Terephthalate (PET)',
        'search'  => 'Polyethylene Terephthalate PET packaging bottle sheet thermoforming injection',
        'points'  => array(
            'PET grade selection depends on packaging, sheet, or other end-use needs.',
            'Moisture control and processing conditions can be important for many grades.',
            'Confirm application, intrinsic viscosity where relevant, and documentation needs.',
        ),
        'specs'   => array(
            'Common forms'     => 'Resin / pellets',
            'Processing focus' => 'Packaging / sheet routes',
            'Compare with'     => 'PP: clarity, barrier, and performance needs guide selection.',
        ),
    ),
    array(
        'id'      => 'abs',
        'badge'   => '06 · Impact & Housings',
        'icon'    => '#ab-icon-industry',
        'image'   => 'bhavik-ind-industrial.jpg',
        'alt'     => 'ABS engineering plastic pellets for moulded housings and technical parts',
        'title'   => 'Acrylonitrile Butadiene Styrene (ABS)',
        'search'  => 'Acrylonitrile Butadiene Styrene ABS engineering plastic impact surface finish injection moulding',
        'points'  => array(
            'Consider impact, surface finish, colour, and dimensional requirements.',
            'Often considered for injection-moulded components and housings.',
            'Confirm heat exposure, appearance requirements, and applicable standards.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Injection moulding',
            'Compare with'     => 'PS / HIPS: toughness and finish requirements may differ.',
        ),
    ),
    array(
        'id'      => 'ps-hips',
        'badge'   => '07 · GPPS & HIPS',
        'icon'    => '#ab-icon-mould',
        'image'   => 'bhavik-ind-consumer.jpg',
        'alt'     => 'Polystyrene and HIPS granules for consumer goods and thermoforming',
        'title'   => 'Polystyrene / HIPS',
        'search'  => 'PS HIPS polystyrene high impact polystyrene thermoforming packaging injection',
        'points'  => array(
            'General-purpose PS and HIPS have different impact characteristics.',
            'Applications may include packaging, formed parts, and selected moulded products.',
            'Confirm impact needs, food-contact requirements where relevant, and finish.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules',
            'Processing focus' => 'Injection / thermoforming',
            'Compare with'     => 'ABS: compare impact, appearance, and application requirements.',
        ),
    ),
    array(
        'id'      => 'engineering-plastics',
        'badge'   => '08 · Performance Polymers',
        'icon'    => '#ab-icon-shield',
        'image'   => 'bhavik-ind-industrial.jpg',
        'alt'     => 'Engineering plastics including PA, PC and POM for demanding parts',
        'title'   => 'Engineering Plastics',
        'search'  => 'Engineering Plastics nylon polyamide PC polycarbonate POM acetal performance polymers',
        'points'  => array(
            'Choose the polymer family around mechanical, thermal, and chemical demands.',
            'Grade and reinforcement can significantly change performance and processing.',
            'Confirm load, temperature, environment, tolerances, and applicable standards.',
        ),
        'specs'   => array(
            'Common forms'     => 'Resin / pellets / compounds',
            'Processing focus' => 'Grade-dependent moulding / extrusion',
            'Compare with'     => 'Commodity polymers: selection follows the required performance envelope.',
        ),
    ),
    array(
        'id'      => 'masterbatch-additives',
        'badge'   => '09 · Colour & Additives',
        'icon'    => '#ab-icon-flask',
        'image'   => 'pellets-macro.jpg',
        'alt'     => 'Concentrated polymer masterbatch and additive pellets',
        'title'   => 'Masterbatch & Additives',
        'search'  => 'Masterbatch Additives colour additive concentrate pigment UV stabiliser processing aid',
        'points'  => array(
            'Colour and additive concentrates are selected for the base polymer and process.',
            'Let-down ratio and compatibility must be confirmed for the intended formulation.',
            'Share the carrier resin, target colour, dosage, and performance objective.',
        ),
        'specs'   => array(
            'Common forms'     => 'Concentrated pellets',
            'Processing focus' => 'Compounding / extrusion',
            'Compare with'     => 'Pre-coloured resin: dosing and formulation flexibility differ.',
        ),
    ),
    array(
        'id'      => 'recycled-polymers',
        'badge'   => '10 · PCR & PIR Grades',
        'icon'    => '#ab-icon-recycle',
        'image'   => 'bhavik-ind-recycling.jpg',
        'alt'     => 'Recycled and reprocessed PCR and PIR polymer pellets',
        'title'   => 'Recycled & Reprocessed Polymers',
        'search'  => 'Recycled Reprocessed Polymers PCR PIR post consumer post industrial polymer pellets',
        'points'  => array(
            'Material source, consistency, and traceability should be reviewed for each enquiry.',
            'Properties may vary with feedstock, sorting, processing, and grade.',
            'Confirm application limits, test data, documentation, and acceptance criteria.',
        ),
        'specs'   => array(
            'Common forms'     => 'Reprocessed pellets / granules',
            'Processing focus' => 'Application and grade dependent',
            'Compare with'     => 'Virgin resin: source, consistency, and documentation need review.',
        ),
    ),
    array(
        'id'      => 'industrial-compounds',
        'badge'   => '11 · Custom Compounds',
        'icon'    => '#ab-icon-beaker',
        'image'   => 'virgin-vs-recycled.jpg',
        'alt'     => 'Filled and reinforced industrial polymer compounds',
        'title'   => 'Industrial Polymer Compounds',
        'search'  => 'Industrial Polymer Compounds filled polymer reinforced compound custom formulation',
        'points'  => array(
            'Compounds can be formulated around specific processing or end-use needs.',
            'Fillers, reinforcement, and additives affect weight, stiffness, and process behaviour.',
            'Confirm composition, target properties, colour, and validation requirements.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / compounds',
            'Processing focus' => 'Formulation dependent',
            'Compare with'     => 'Unfilled resin: additives and reinforcement alter the performance profile.',
        ),
    ),
    array(
        'id'      => 'polymer-forms',
        'badge'   => '12 · Bulk & Bagged Supply',
        'icon'    => '#ab-icon-truck',
        'image'   => 'bhavik-ind-packaging.jpg',
        'alt'     => 'Polymer resin supplied in pellets, granules and bulk industrial bags',
        'title'   => 'Polymer Forms & Supply',
        'search'  => 'Polymer Forms Supply pellets granules powder compound bulk bags packaging supply',
        'points'  => array(
            'Available forms and packing depend on the specific material and source.',
            'Match form and packaging to handling, storage, and processing requirements.',
            'Confirm quantity, pack size, destination, timing, and required documentation.',
        ),
        'specs'   => array(
            'Common forms'     => 'Pellets / granules / powder',
            'Processing focus' => 'Material and equipment dependent',
            'Compare with'     => 'Compounds: formulation and intended processing need confirmation.',
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
                        <a class="ab-range-card-click" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" aria-label="<?php echo esc_attr( 'Enquire about ' . $item['title'] ); ?>"></a>
                        <div class="ab-range-card-image">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/img/' . $item['image'] ) ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" width="800" height="500" loading="lazy" decoding="async">
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
                            <div class="ab-range-card-foot" aria-hidden="true">
                                <span class="ab-range-card-cta">Enquire Now
                                    <svg class="ab-icon"><use href="#ab-icon-arrow" /></svg>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="ab-products-empty" data-products-empty hidden><strong>No matching materials found.</strong><span>Try an abbreviation such as PP, HDPE, PVC, or a processing term.</span></div>
            <p class="ab-products-live-status" data-products-status aria-live="polite" role="status"><?php echo count( $ab_range_items ); ?> materials shown</p>
            <p class="ab-products-disclaimer">All Products Are Dummy</p>
        </div>
    </section>
</main>
<?php get_footer(); ?>
