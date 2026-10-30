<?php
/** Abiroverseas — WordPress theme functions. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'AB_THEME_VERSION', '1.5.7' );

/**
 * Determine whether the current request renders the Bhavik Enterprises page.
 */
function ab_is_bhavik_page() {
    if ( ! is_page() ) {
        return false;
    }
    $page_id  = get_queried_object_id();
    $slug     = $page_id ? get_post_field( 'post_name', $page_id ) : '';
    $template = $page_id ? get_page_template_slug( $page_id ) : '';

    return 'bhavik-enterprises' === $slug
        || in_array( $template, array( 'page-template/template-bhavik-enterprises.php', 'page-templates/template-bhavik-enterprises.php' ), true )
        || is_page_template( array( 'page-template/template-bhavik-enterprises.php', 'page-templates/template-bhavik-enterprises.php' ) );
}

add_action( 'after_setup_theme', 'ab_theme_setup' );
function ab_theme_setup() {
    load_theme_textdomain( 'abiroverseas', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    register_nav_menus( array( 'primary' => 'Primary Menu' ) );
}

add_action( 'init', 'ab_register_content_types' );
function ab_register_content_types() {
    register_post_type( 'knowledge', array(
        'labels' => array(
            'name' => 'Knowledge Center', 'singular_name' => 'Knowledge Article',
            'add_new_item' => 'Add Knowledge Article', 'edit_item' => 'Edit Knowledge Article',
            'new_item' => 'New Knowledge Article', 'view_item' => 'View Knowledge Article',
            'search_items' => 'Search Knowledge Center', 'not_found' => 'No knowledge articles found',
            'menu_name' => 'Knowledge Center',
        ),
        'public' => true, 'show_in_rest' => true, 'has_archive' => 'knowledge',
        'rewrite' => array( 'slug' => 'knowledge', 'with_front' => false ),
        'menu_icon' => 'dashicons-welcome-learn-more', 'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies' => array( 'knowledge_hub', 'knowledge_material', 'knowledge_topic' ),
    ) );

    register_taxonomy( 'knowledge_hub', array( 'knowledge' ), array(
        'labels' => array( 'name' => 'Knowledge Hub', 'singular_name' => 'Knowledge Hub', 'search_items' => 'Search Knowledge Hubs', 'all_items' => 'All Knowledge Hubs', 'parent_item' => 'Parent Hub', 'parent_item_colon' => 'Parent Hub:', 'edit_item' => 'Edit Knowledge Hub', 'add_new_item' => 'Add Knowledge Hub', 'menu_name' => 'Knowledge Hub' ),
        'public' => true, 'show_in_rest' => true, 'hierarchical' => true,
        'rewrite' => array( 'slug' => 'knowledge-hub', 'with_front' => false ),
    ) );
    register_taxonomy( 'knowledge_material', array( 'knowledge' ), array(
        'labels' => array( 'name' => 'Product Type / Material', 'singular_name' => 'Material', 'search_items' => 'Search Materials', 'all_items' => 'All Materials', 'edit_item' => 'Edit Material', 'add_new_item' => 'Add Material', 'menu_name' => 'Product Type / Material' ),
        'public' => true, 'show_in_rest' => true, 'hierarchical' => true,
        'rewrite' => array( 'slug' => 'knowledge-material', 'with_front' => false ),
    ) );
    register_taxonomy( 'knowledge_topic', array( 'knowledge' ), array(
        'labels' => array( 'name' => 'Knowledge Topic / Format', 'singular_name' => 'Knowledge Topic', 'search_items' => 'Search Topics', 'all_items' => 'All Topics', 'edit_item' => 'Edit Topic', 'add_new_item' => 'Add Topic', 'menu_name' => 'Knowledge Topics' ),
        'public' => true, 'show_in_rest' => true, 'hierarchical' => true,
        'rewrite' => array( 'slug' => 'knowledge-topic', 'with_front' => false ),
    ) );
}

add_action( 'wp_enqueue_scripts', 'ab_enqueue_assets' );
function ab_enqueue_assets() {
    $base = get_template_directory_uri();
    $version = AB_THEME_VERSION;
    // A page can legitimately need more than one of the theme's stylesheets.
    $styles = array();
    $script = '';
    if ( is_404() ) { $styles = array( 'error-404.css' ); $script = 'error-404.js'; }
    elseif ( is_singular( 'knowledge' ) ) { $styles = array( 'knowledge.css' ); $script = 'knowledge-single.js'; }
    elseif ( is_post_type_archive( 'knowledge' ) || is_tax( array( 'knowledge_hub', 'knowledge_material', 'knowledge_topic' ) ) ) { $styles = array( 'knowledge.css' ); $script = 'knowledge-hub.js'; }
    elseif ( is_page() ) {
        /*
         * Resolve the page layout by slug first, then by assigned template.
         * This keeps page assets loading even if WordPress returns an empty
         * template slug (for example after a page/template assignment changes).
         */
        $page_id = get_queried_object_id();
        $slug = get_post_field( 'post_name', $page_id );
        $template = get_page_template_slug( $page_id );

        if ( is_front_page() || 'home' === $slug || in_array( $template, array( 'page-template/template-home.php', 'page-templates/template-home.php' ), true ) ) {
            $styles = array( 'home.css' );
            $script = 'home.js';
        } elseif ( 'about' === $slug || in_array( $template, array( 'page-template/template-about.php', 'page-templates/template-about.php' ), true ) ) {
            $styles = array( 'about.css' );
            $script = 'about.js';
        } elseif ( in_array( $slug, array( 'products', 'product-families', 'product-range' ), true ) || in_array( $template, array( 'page-template/template-product-families.php', 'page-template/template-product-range.php', 'page-templates/template-product-families.php', 'page-templates/template-product-range.php' ), true ) ) {
            // Both product directories share one responsive design system and live-search controller.
            $styles = array( 'products.css' );
            $script = 'products.js';
        } elseif ( 'contact-us' === $slug || in_array( $template, array( 'page-template/template-contact.php', 'page-templates/template-contact.php' ), true ) ) {
            // Keep Contact page styling isolated in its own stylesheet.
            $styles = array( 'contact.css' );
        } elseif ( ab_is_bhavik_page() ) {
            // Keep Bhavik Enterprises 100% isolated in its own dedicated stylesheet and script.
            $styles = array( 'bhavik.css' );
            $script = 'bhavik.js';
        } elseif (
            in_array( $slug, array( 'recycled-plastics', 'ps', 'abs', 'eva', 'pvc', 'pp', 'ldpe', 'hdpe', 'material', 'materials' ), true )
            || in_array(
                $template,
                array(
                    'page-template/template-material.php',
                    'page-template/template-material-Recycled-Plastics.php',
                    'page-template/template-material-PS.php',
                    'page-template/template-material-ABS.php',
                    'page-template/template-material-EVA.php',
                    'page-template/template-material-PVC.php',
                    'page-template/template-material-PP.php',
                    'page-template/template-material-LDPE.php',
                    'page-templates/template-material.php',
                    'page-templates/template-material-Recycled-Plastics.php',
                    'page-templates/template-material-PS.php',
                    'page-templates/template-material-ABS.php',
                    'page-templates/template-material-EVA.php',
                    'page-templates/template-material-PVC.php',
                    'page-templates/template-material-PP.php',
                    'page-templates/template-material-LDPE.php',
                ),
                true
            )
        ) {
            $styles = array( 'material.css' );
            $script = 'material.js';
        }
    }
    // Load the declared brand font once so every template, including the shared header, uses the same real font instead of silently falling back.
    $dir = get_template_directory();
    $asset_ver = static function ( $rel_path ) use ( $dir, $version ) {
        $abs = $dir . $rel_path;
        return file_exists( $abs ) ? $version . '.' . (int) filemtime( $abs ) : $version;
    };

    wp_enqueue_style( 'ab-reddit-sans', 'https://fonts.googleapis.com/css2?family=Reddit+Sans:wght@400;500;600;700;800&display=swap', array(), null );
    $last_style = 'ab-reddit-sans';
    foreach ( $styles as $index => $file ) {
        // First sheet keeps the historical 'ab-page-layout' handle; any extra
        // sheet chains behind it so it still loads before site.css.
        $handle = 0 === $index ? 'ab-page-layout' : 'ab-page-layout-' . $index;
        wp_enqueue_style( $handle, $base . '/assets/css/' . $file, array( $last_style ), $asset_ver( '/assets/css/' . $file ) );
        if ( 'products.css' === $file ) {
            wp_add_inline_style(
                $handle,
                '.ab-products-page a{text-decoration:none;}' .
                '.ab-products-page .ab-range-card-foot,.ab-range-card-foot{display:flex;flex-wrap:wrap;align-items:center;justify-content:flex-start;gap:14px;column-gap:14px;row-gap:12px;width:100%;margin-top:22px;}' .
                '.ab-products-page a.ab-range-card-cta,.ab-products-page .ab-range-card-cta,.ab-range-card-cta{display:inline-flex;align-items:center;justify-content:center;gap:9px;width:auto;min-width:0;min-height:48px;padding:13px 22px;border:0 !important;border-radius:14px;background:linear-gradient(180deg,#ff9238 0%,#f58220 54%,#e26d0c 100%);color:#ffffff !important;text-decoration:none !important;text-decoration-line:none !important;text-transform:uppercase !important;letter-spacing:.04em;font-size:16px;font-weight:700;line-height:1.2;cursor:pointer;}' .
                '.ab-products-page a.ab-range-card-cta:link,.ab-products-page a.ab-range-card-cta:visited,.ab-products-page a.ab-range-card-cta:hover,.ab-products-page a.ab-range-card-cta:focus,.ab-products-page a.ab-range-card-cta:active,.ab-products-page a.ab-range-card-cta span{color:#ffffff !important;text-decoration:none !important;text-decoration-line:none !important;}' .
                '@media (max-width:600px){.ab-products-page .ab-range-card-foot,.ab-range-card-foot{display:flex;flex-direction:column;flex-wrap:nowrap;align-items:stretch;gap:12px;}.ab-products-page a.ab-range-card-cta,.ab-products-page .ab-range-card-cta,.ab-range-card-cta{width:100%;justify-content:center;}}'
            );
        } elseif ( 'material.css' === $file ) {
            wp_add_inline_style(
                $handle,
                '@media (max-width:1023px),(max-width:1024px) and (orientation:portrait){.ab-overview-visual{width:100%;height:auto !important;min-height:0 !important;max-height:none !important;overflow:hidden;}.ab-character{height:auto;min-height:0;}.ab-grade-cards{grid-template-columns:minmax(0,1fr) !important;gap:12px;}}' .
                '@media (max-width:600px){.ab-character-grid,.ab-grade-cards{grid-template-columns:minmax(0,1fr) !important;gap:10px;}}'
            );
        }
        $last_style = $handle;
    }
    wp_enqueue_style( 'ab-site-footer', $base . '/assets/css/site.css', array( $last_style ), $asset_ver( '/assets/css/site.css' ) );
    if ( $script ) { wp_enqueue_script( 'ab-page-interactions', $base . '/assets/js/' . $script, array(), $asset_ver( '/assets/js/' . $script ), true ); }
    // One navigation controller serves the shared header on every page.
    wp_enqueue_script( 'ab-navigation', $base . '/assets/js/navigation.js', array(), $asset_ver( '/assets/js/navigation.js' ), true );
}

/** Install starter pages without overwriting existing page copy. */
add_action( 'after_switch_theme', 'ab_install_starter_pages' );
function ab_install_starter_pages() {
    $defaults = require get_template_directory() . '/inc/default-content.php';
    $home_id = 0;
    foreach ( $defaults['pages'] as $page_data ) {
        $page = get_page_by_path( $page_data['slug'], OBJECT, 'page' );
        if ( ! $page ) {
            $id = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $page_data['title'], 'post_name' => $page_data['slug'] ) );
            if ( is_wp_error( $id ) || ! $id ) { continue; }
        } else { $id = $page->ID; }
        update_post_meta( $id, '_wp_page_template', $page_data['template'] );
        if ( ! get_post_meta( $id, 'ab_meta_title', true ) ) { update_post_meta( $id, 'ab_meta_title', $page_data['seo_title'] ); }
        if ( ! get_post_meta( $id, 'ab_meta_description', true ) ) { update_post_meta( $id, 'ab_meta_description', $page_data['seo_description'] ); }
        if ( ! get_post_meta( $id, 'ab_schema_type', true ) ) { update_post_meta( $id, 'ab_schema_type', $page_data['schema_type'] ); }
        if ( ! get_post_meta( $id, 'ab_page_faqs', true ) && ! empty( $page_data['faqs'] ) ) { update_post_meta( $id, 'ab_page_faqs', $page_data['faqs'] ); }
        if ( 'home' === $page_data['slug'] ) { $home_id = (int) $id; }
    }
    if ( $home_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }
    $hub_terms = array( 'HDPE', 'PP', 'LDPE / LLDPE', 'PVC', 'Recycled Polymers' );
    foreach ( $hub_terms as $term ) {
        if ( ! term_exists( $term, 'knowledge_hub' ) ) { wp_insert_term( $term, 'knowledge_hub' ); }
        if ( ! term_exists( $term, 'knowledge_material' ) ) { wp_insert_term( $term, 'knowledge_material' ); }
    }
    foreach ( array( 'Comparisons', 'FAQs', 'Grades & Selection', 'Processing Methods', 'Applications', 'Recycling & Sustainability' ) as $term ) {
        if ( ! term_exists( $term, 'knowledge_topic' ) ) { wp_insert_term( $term, 'knowledge_topic' ); }
    }
    // Create unpublished HDPE article starters so the Knowledge Center has the intended editorial structure without inventing technical copy.
    $starter_articles = array(
        'understanding-hdpe-grades' => array( 'Understanding HDPE Grades', 'Grades & Selection' ),
        'hdpe-processing-methods' => array( 'HDPE Processing Methods', 'Processing Methods' ),
        'hdpe-applications' => array( 'HDPE Applications', 'Applications' ),
        'virgin-vs-recycled-hdpe' => array( 'Virgin vs Recycled HDPE', 'Comparisons' ),
        'hdpe-vs-ldpe' => array( 'HDPE vs LDPE', 'Comparisons' ),
        'melt-flow-index-guide' => array( 'Melt Flow Index Guide', 'Grades & Selection' ),
        'pcr-vs-pir-recycled-plastic' => array( 'PCR vs PIR Recycled Plastic', 'Recycling & Sustainability' ),
        'how-to-select-an-hdpe-grade' => array( 'How to Select an HDPE Grade', 'Grades & Selection' ),
        'hdpe-frequently-asked-questions' => array( 'HDPE Frequently Asked Questions', 'FAQs' ),
    );
    foreach ( $starter_articles as $slug => $starter ) {
        if ( get_page_by_path( $slug, OBJECT, 'knowledge' ) ) { continue; }
        $post_id = wp_insert_post( array( 'post_type' => 'knowledge', 'post_status' => 'draft', 'post_title' => $starter[0], 'post_name' => $slug ) );
        if ( is_wp_error( $post_id ) || ! $post_id ) { continue; }
        update_post_meta( $post_id, 'ab_knowledge_url', $slug );
        $hub = get_term_by( 'slug', 'hdpe', 'knowledge_hub' );
        $material = get_term_by( 'slug', 'hdpe', 'knowledge_material' );
        $topic = get_term_by( 'name', $starter[1], 'knowledge_topic' );
        if ( $hub ) { wp_set_object_terms( $post_id, array( (int) $hub->term_id ), 'knowledge_hub' ); }
        if ( $material ) { wp_set_object_terms( $post_id, array( (int) $material->term_id ), 'knowledge_material' ); }
        if ( $topic ) { wp_set_object_terms( $post_id, array( (int) $topic->term_id ), 'knowledge_topic' ); }
    }
    ab_seed_primary_menu();
    flush_rewrite_rules();
}

/** Create an editable starter menu and assign it to Appearance → Menus → Primary Menu. */
function ab_seed_primary_menu() {
    $locations = get_theme_mod( 'nav_menu_locations', array() );
    if ( ! empty( $locations['primary'] ) && wp_get_nav_menu_object( (int) $locations['primary'] ) ) { return; }
    $menu = wp_get_nav_menu_object( 'Primary Menu' );
    $created = false;
    if ( ! $menu ) {
        $menu_id = wp_create_nav_menu( 'Primary Menu' );
        if ( is_wp_error( $menu_id ) ) { return; }
        $created = true;
    } else { $menu_id = (int) $menu->term_id; }
    if ( $created ) {
        ab_add_primary_menu_item( $menu_id, 'Home', home_url( '/' ) );
        $products = ab_add_primary_menu_item( $menu_id, 'Products', home_url( '/#product-families' ) );
        ab_add_primary_menu_item( $menu_id, 'Product families', home_url( '/#product-families' ), $products );
        ab_add_primary_menu_item( $menu_id, 'HDPE', home_url( '/hdpe/' ), $products );
        ab_add_primary_menu_item( $menu_id, 'Grades & forms', home_url( '/#materials' ), $products );
        ab_add_primary_menu_item( $menu_id, 'Materials', home_url( '/#materials' ) );
        ab_add_primary_menu_item( $menu_id, 'Industries', home_url( '/#markets' ) );
        ab_add_primary_menu_item( $menu_id, 'Resources', home_url( '/knowledge/' ) );
        ab_add_primary_menu_item( $menu_id, 'About Us', home_url( '/about/' ) );
        ab_add_primary_menu_item( $menu_id, 'Get a Custom Quote', home_url( '/#quick-enquiry' ), 0, array( 'ab-nav-quote' ) );
    }
    $locations['primary'] = (int) $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
}

function ab_add_primary_menu_item( $menu_id, $title, $url, $parent = 0, $classes = array() ) {
    return wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title' => $title,
        'menu-item-url' => $url,
        'menu-item-status' => 'publish',
        'menu-item-type' => 'custom',
        'menu-item-parent-id' => (int) $parent,
        'menu-item-classes' => $classes,
    ) );
}
add_action( 'init', 'ab_maybe_seed_primary_menu', 20 );
function ab_maybe_seed_primary_menu() {
    if ( get_theme_mod( 'ab_primary_menu_seeded' ) ) { return; }
    ab_seed_primary_menu();
    set_theme_mod( 'ab_primary_menu_seeded', 1 );
}

/**
 * Create the two product directory pages once, without replacing existing page copy.
 * Existing pages with these slugs keep their titles and content; only their template is assigned.
 */
add_action( 'init', 'ab_ensure_product_directory_pages', 30 );
function ab_ensure_product_directory_pages() {
    if ( get_option( 'ab_product_directory_pages_ready' ) ) { return; }

    $pages = array(
        array(
            'slug' => 'products',
            'title' => 'Product Families',
            'template' => 'page-template/template-product-families.php',
        ),
        array(
            'slug' => 'product-range',
            'title' => 'Product Range',
            'template' => 'page-template/template-product-range.php',
        ),
    );

    foreach ( $pages as $page_data ) {
        $page = get_page_by_path( $page_data['slug'], OBJECT, 'page' );
        if ( ! $page ) {
            $page_id = wp_insert_post( array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_title' => $page_data['title'],
                'post_name' => $page_data['slug'],
            ), true );
            if ( is_wp_error( $page_id ) || ! $page_id ) { continue; }
        } else {
            $page_id = (int) $page->ID;
        }

        update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
    }

    update_option( 'ab_product_directory_pages_ready', 1 );
}
/**
 * Create the Bhavik Enterprises page once on an already-live site.
 * `after_switch_theme` only fires on activation, so the starter data alone
 * would never reach a site that is already running. Nothing existing is
 * overwritten: the page is only created when the slug is missing, and meta
 * values are only written when they are still empty.
 */
add_action( 'init', 'ab_ensure_bhavik_page', 31 );
function ab_ensure_bhavik_page() {
    if ( get_option( 'ab_bhavik_page_ready' ) ) { return; }

    $defaults = require get_template_directory() . '/inc/default-content.php';
    $page_data = null;
    foreach ( $defaults['pages'] as $candidate ) {
        if ( isset( $candidate['slug'] ) && 'bhavik-enterprises' === $candidate['slug'] ) { $page_data = $candidate; break; }
    }
    if ( ! $page_data ) {
        $page_data = array(
            'slug'            => 'bhavik-enterprises',
            'title'           => 'Bhavik Enterprises',
            'template'        => 'page-template/template-bhavik-enterprises.php',
            'seo_title'       => 'Bhavik Enterprises — Authorised Distributor of Abiroverseas LLC in India',
            'seo_description' => 'Bhavik Enterprises supplies virgin and reprocessed LDPE, HDPE, PP and PVC raw materials across India from Kanpur, Mumbai and Mundra.',
            'schema_type'     => 'WebPage',
            'faqs'            => array(),
        );
    }

    $page = get_page_by_path( $page_data['slug'], OBJECT, 'page' );
    if ( $page ) {
        $page_id = (int) $page->ID;
    } else {
        $page_id = wp_insert_post( array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => $page_data['title'],
            'post_name' => $page_data['slug'],
        ), true );
        if ( is_wp_error( $page_id ) || ! $page_id ) { return; }
    }

    if ( ! get_post_meta( $page_id, '_wp_page_template', true ) ) { update_post_meta( $page_id, '_wp_page_template', $page_data['template'] ); }
    if ( ! get_post_meta( $page_id, 'ab_meta_title', true ) ) { update_post_meta( $page_id, 'ab_meta_title', $page_data['seo_title'] ); }
    if ( ! get_post_meta( $page_id, 'ab_meta_description', true ) ) { update_post_meta( $page_id, 'ab_meta_description', $page_data['seo_description'] ); }
    if ( ! get_post_meta( $page_id, 'ab_schema_type', true ) ) { update_post_meta( $page_id, 'ab_schema_type', $page_data['schema_type'] ); }
    if ( ! get_post_meta( $page_id, 'ab_page_faqs', true ) && ! empty( $page_data['faqs'] ) ) { update_post_meta( $page_id, 'ab_page_faqs', $page_data['faqs'] ); }

    update_option( 'ab_bhavik_page_ready', 1 );
}

/**
 * Ensure dedicated Material pages and the Contact Us page exist once on live sites
 * without touching any existing page that already uses the template or slug.
 */
add_action( 'init', 'ab_ensure_material_and_contact_pages', 32 );
function ab_ensure_material_and_contact_pages() {
    if ( get_option( 'ab_material_contact_pages_v156_ready' ) ) { return; }

    $pages = array(
        array(
            'slug'      => 'contact-us',
            'title'     => 'Contact Us',
            'template'  => 'page-template/template-contact.php',
            'templates' => array( 'page-template/template-contact.php', 'page-templates/template-contact.php' ),
        ),
        array(
            'slug'      => 'hdpe',
            'title'     => 'High-Density Polyethylene (HDPE)',
            'template'  => 'page-template/template-material.php',
            'templates' => array( 'page-template/template-material.php', 'page-templates/template-material.php' ),
        ),
        array(
            'slug'      => 'pp',
            'title'     => 'Polypropylene (PP)',
            'template'  => 'page-template/template-material-PP.php',
            'templates' => array( 'page-template/template-material-PP.php', 'page-templates/template-material-PP.php' ),
        ),
        array(
            'slug'      => 'ldpe',
            'title'     => 'LDPE / LLDPE',
            'template'  => 'page-template/template-material-LDPE.php',
            'templates' => array( 'page-template/template-material-LDPE.php', 'page-templates/template-material-LDPE.php' ),
        ),
        array(
            'slug'      => 'pvc',
            'title'     => 'Polyvinyl Chloride (PVC)',
            'template'  => 'page-template/template-material-PVC.php',
            'templates' => array( 'page-template/template-material-PVC.php', 'page-templates/template-material-PVC.php' ),
        ),
        array(
            'slug'      => 'ps',
            'title'     => 'Polystyrene (PS)',
            'template'  => 'page-template/template-material-PS.php',
            'templates' => array( 'page-template/template-material-PS.php', 'page-templates/template-material-PS.php' ),
        ),
        array(
            'slug'      => 'abs',
            'title'     => 'Acrylonitrile Butadiene Styrene (ABS)',
            'template'  => 'page-template/template-material-ABS.php',
            'templates' => array( 'page-template/template-material-ABS.php', 'page-templates/template-material-ABS.php' ),
        ),
        array(
            'slug'      => 'eva',
            'title'     => 'Ethylene Vinyl Acetate (EVA)',
            'template'  => 'page-template/template-material-EVA.php',
            'templates' => array( 'page-template/template-material-EVA.php', 'page-templates/template-material-EVA.php' ),
        ),
        array(
            'slug'      => 'recycled-plastics',
            'title'     => 'Recycled & Reprocessed Plastics',
            'template'  => 'page-template/template-material-Recycled-Plastics.php',
            'templates' => array( 'page-template/template-material-Recycled-Plastics.php', 'page-templates/template-material-Recycled-Plastics.php' ),
        ),
    );

    foreach ( $pages as $page_spec ) {
        $existing_by_tpl = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => array( 'publish', 'draft', 'private', 'pending' ),
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'no_found_rows'  => true,
            'meta_query'     => array(
                array(
                    'key'     => '_wp_page_template',
                    'value'   => $page_spec['templates'],
                    'compare' => 'IN',
                ),
            ),
        ) );
        if ( ! empty( $existing_by_tpl ) ) {
            continue;
        }

        $existing_by_slug = get_page_by_path( $page_spec['slug'], OBJECT, 'page' );
        if ( $existing_by_slug ) {
            if ( ! get_post_meta( $existing_by_slug->ID, '_wp_page_template', true ) ) {
                update_post_meta( $existing_by_slug->ID, '_wp_page_template', $page_spec['template'] );
            }
            continue;
        }

        $new_page_id = wp_insert_post( array(
            'post_type'   => 'page',
            'post_status' => 'publish',
            'post_title'  => $page_spec['title'],
            'post_name'   => $page_spec['slug'],
        ), true );
        if ( ! is_wp_error( $new_page_id ) && $new_page_id ) {
            update_post_meta( $new_page_id, '_wp_page_template', $page_spec['template'] );
        }
    }

    update_option( 'ab_material_contact_pages_v156_ready', 1 );
}

function ab_primary_menu_fallback() {
    $items = array(
        array( 'Home', home_url( '/' ) ),
        array( 'HDPE', home_url( '/hdpe/' ) ),
        array( 'Resources', home_url( '/knowledge/' ) ),
        array( 'About Us', home_url( '/about/' ) ),
        array( 'Get a Custom Quote', home_url( '/#quick-enquiry' ), 'ab-nav-quote' ),
    );
    $html = '<ul id="ab-primary-menu" class="ab-nav-menu">';
    foreach ( $items as $item ) {
        $class = isset( $item[2] ) ? ' class="' . esc_attr( $item[2] ) . '"' : '';
        $html .= '<li' . $class . '><a href="' . esc_url( $item[1] ) . '">' . esc_html( $item[0] ) . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

/** Shared SEO, page-schema and FAQ-schema fields for native Pages. */
add_action( 'add_meta_boxes', 'ab_add_meta_boxes' );
function ab_add_meta_boxes() {
    add_meta_box( 'ab_page_seo', 'Search Preview & Schema', 'ab_page_seo_metabox', 'page', 'normal', 'high' );
    add_meta_box( 'ab_knowledge_builder', 'Knowledge Article Fields', 'ab_knowledge_metabox', 'knowledge', 'normal', 'high' );
    add_meta_box( 'ab_knowledge_workflow', 'Knowledge Center publishing checklist', 'ab_knowledge_help_metabox', 'knowledge', 'side', 'high' );
}
function ab_page_seo_metabox( $post ) {
    wp_nonce_field( 'ab_page_meta_save', 'ab_page_meta_nonce' );
    $title = get_post_meta( $post->ID, 'ab_meta_title', true );
    $desc = get_post_meta( $post->ID, 'ab_meta_description', true );
    $schema = get_post_meta( $post->ID, 'ab_schema_type', true ) ?: 'WebPage';
    $faqs = get_post_meta( $post->ID, 'ab_page_faqs', true );
    if ( ! is_array( $faqs ) ) { $faqs = array(); }
    echo '<p>These fields apply to this Page only. The active Home, About and HDPE templates keep the supplied HTML layout; edit these metadata/schema fields here.</p>';
    echo '<p><label for="ab_meta_title"><strong>SEO title</strong></label><br><input class="widefat" id="ab_meta_title" name="ab_meta_title" maxlength="255" value="' . esc_attr( $title ) . '"></p>';
    echo '<p><label for="ab_meta_description"><strong>Meta description</strong></label><br><textarea class="widefat" rows="3" maxlength="320" id="ab_meta_description" name="ab_meta_description">' . esc_textarea( $desc ) . '</textarea></p>';
    ab_render_social_image_field( $post->ID );
    echo '<p><label for="ab_schema_type"><strong>Page schema type</strong></label><br><select name="ab_schema_type" id="ab_schema_type">';
    foreach ( array( 'WebPage', 'AboutPage', 'ContactPage', 'CollectionPage' ) as $type ) { echo '<option value="' . esc_attr( $type ) . '" ' . selected( $schema, $type, false ) . '>' . esc_html( $type ) . '</option>'; }
    echo '</select> <span class="description">FAQPage schema is created from the question-and-answer rows below.</span></p>';
    ab_render_repeater( 'ab_page_faqs_json', $faqs, 'Page FAQs (used for FAQPage schema)', array( 'question' => 'Question', 'answer' => 'Answer' ), 'Add FAQ' );
}
/**
 * Per-page social share image picker (og:image / twitter:image).
 * The stored URL is used before the Featured image, which is the fallback.
 */
function ab_render_social_image_field( $post_id ) {
    $image_url = (string) get_post_meta( $post_id, 'ab_og_image', true );
    $image_id  = (int) get_post_meta( $post_id, 'ab_og_image_id', true );
    $preview   = $image_url ? '<img src="' . esc_url( $image_url ) . '" alt="" style="display:block;max-width:260px;height:auto;border-radius:6px;">' : '';
    echo '<div class="ab-og-field" style="margin:0 0 18px;">';
    echo '<p style="margin:0 0 6px;"><strong>Social share image (og:image &amp; twitter:image)</strong></p>';
    echo '<input type="hidden" data-ab-og-input name="ab_og_image" value="' . esc_attr( $image_url ) . '">';
    echo '<input type="hidden" data-ab-og-id name="ab_og_image_id" value="' . esc_attr( $image_id ? $image_id : '' ) . '">';
    echo '<div data-ab-og-preview>' . $preview . '</div>';
    echo '<p><button type="button" class="button" data-ab-og-pick>Select share image</button> <button type="button" class="button-link-delete" data-ab-og-clear>Remove</button></p>';
    echo '<p class="description">This page’s own image for Open Graph and Twitter cards. Leave empty to use the Featured image.</p>';
    echo '</div>';
}
add_action( 'admin_print_footer_scripts', 'ab_social_image_admin_script' );
function ab_social_image_admin_script() {
    $screen = get_current_screen();
    if ( ! $screen || 'post' !== $screen->base || 'page' !== $screen->post_type ) { return; }
    wp_enqueue_media();
    ?>
    <script>
    ( function () {
        document.addEventListener( 'click', function ( event ) {
            var pick = event.target.closest( '[data-ab-og-pick]' );
            var clear = event.target.closest( '[data-ab-og-clear]' );
            if ( ! pick && ! clear ) { return; }
            event.preventDefault();
            var field = ( pick || clear ).closest( '.ab-og-field' );
            if ( ! field ) { return; }
            var input = field.querySelector( '[data-ab-og-input]' );
            var idInput = field.querySelector( '[data-ab-og-id]' );
            var preview = field.querySelector( '[data-ab-og-preview]' );
            if ( clear ) {
                input.value = '';
                idInput.value = '';
                preview.innerHTML = '';
                return;
            }
            if ( ! window.wp || ! wp.media ) { return; }
            var frame = wp.media( {
                title: 'Choose the social share image',
                button: { text: 'Use this image' },
                library: { type: 'image' },
                multiple: false
            } );
            frame.on( 'select', function () {
                var attachment = frame.state().get( 'selection' ).first().toJSON();
                input.value = attachment.url;
                idInput.value = attachment.id;
                var thumb = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
                preview.innerHTML = '';
                var img = document.createElement( 'img' );
                img.src = thumb;
                img.alt = '';
                img.style.cssText = 'display:block;max-width:260px;height:auto;border-radius:6px;';
                preview.appendChild( img );
            } );
            frame.open();
        } );
    } )();
    </script>
    <?php
}
function ab_knowledge_metabox( $post ) {
    wp_nonce_field( 'ab_knowledge_save', 'ab_knowledge_nonce' );
    $slug = get_post_meta( $post->ID, 'ab_knowledge_url', true );
    if ( ! $slug ) { $slug = $post->post_name; }
    $fields = array(
        'direct_answer' => get_post_meta( $post->ID, 'abk_direct_answer', true ),
        'why' => get_post_meta( $post->ID, 'abk_why', true ),
        'comparison' => get_post_meta( $post->ID, 'abk_comparison_rows', true ),
        'when' => get_post_meta( $post->ID, 'abk_when_rows', true ),
        'faqs' => get_post_meta( $post->ID, 'abk_faqs', true ),
        'related' => get_post_meta( $post->ID, 'abk_related_links', true ),
    );
    foreach ( $fields as $key => $value ) { if ( ! is_array( $value ) && in_array( $key, array( 'comparison', 'when', 'faqs', 'related' ), true ) ) { $fields[ $key ] = array(); } }
    $seo_title = get_post_meta( $post->ID, 'ab_meta_title', true );
    $seo_desc = get_post_meta( $post->ID, 'ab_meta_description', true );
    $comparison_headers = array(
        'material' => ab_knowledge_meta_default( $post->ID, 'abk_comparison_header_material', 'Material' ),
        'best_for' => ab_knowledge_meta_default( $post->ID, 'abk_comparison_header_best_for', 'Typical fit' ),
        'consideration' => ab_knowledge_meta_default( $post->ID, 'abk_comparison_header_consideration', 'Key consideration' ),
    );
    echo '<div class="ab-admin-knowledge">';
    echo '<section><h3>Article setup & search preview</h3><p><label><strong>Exact URL slug</strong><br><code>/knowledge/</code><input class="regular-text" name="ab_knowledge_url" value="' . esc_attr( $slug ) . '" placeholder="hdpe-vs-ldpe"></label><br><span class="description">Set this independently from the article title. Use one URL segment; WordPress keeps the post slug in sync.</span></p>';
    echo '<p><label><strong>SEO title</strong><br><input class="large-text" name="ab_meta_title" maxlength="255" value="' . esc_attr( $seo_title ) . '"></label></p><p><label><strong>Meta description</strong><br><textarea class="large-text" rows="2" maxlength="320" name="ab_meta_description">' . esc_textarea( $seo_desc ) . '</textarea></label></p><p class="description">Set the WordPress Featured image in the editor sidebar. It appears on Knowledge Hub cards and in this article’s hero.</p></section>';
    echo '<section><h3>Direct answer</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_direct" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_direct', 'Direct answer' ) ) . '"></label><p class="description">A concise answer shown near the start of the article. Select text and use the link button to add an inline link.</p>';
    ab_render_rich_field( 'abk_direct_answer', 'abk_direct_answer', $fields['direct_answer'] );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_direct' );
    echo '</section>';
    echo '<section><h3>Quick comparison</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_comparison" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_comparison', 'Compare materials' ) ) . '"></label><p class="description">Edit the three column headings to suit this article.</p><div class="ab-admin-column-headings">';
    $comparison_header_labels = array( 'material' => 'Column 1 heading', 'best_for' => 'Column 2 heading', 'consideration' => 'Column 3 heading' );
    foreach ( $comparison_headers as $key => $value ) { echo '<label>' . esc_html( $comparison_header_labels[ $key ] ) . '<input class="regular-text" name="abk_comparison_header_' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '"></label>'; }
    echo '</div>';
    ab_render_repeater( 'abk_comparison_rows_json', $fields['comparison'], 'Comparison rows', array( 'material' => 'Material / option', 'best_for' => 'Typical fit', 'consideration' => 'Key consideration' ), 'Add comparison row' );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_comparison' );
    echo '</section>';
    echo '<section><h3>Why materials differ</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_why" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_why', 'Why materials differ' ) ) . '"></label><p class="description">Use the rich text controls for inline links and formatting.</p>';
    ab_render_rich_field( 'abk_why', 'abk_why', $fields['why'] );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_why' );
    echo '</section>';
    echo '<section><h3>When to consider</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_when" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_when', 'When to consider each material' ) ) . '"></label>';
    ab_render_repeater( 'abk_when_rows_json', $fields['when'], 'Selection guidance', array( 'material' => 'Material / situation', 'detail' => 'When to consider it' ), 'Add consideration' );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_when' );
    echo '</section>';
    echo '<section><h3>Frequently asked questions</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_faqs" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_faqs', 'Frequently asked questions' ) ) . '"></label>';
    ab_render_repeater( 'abk_faqs_json', $fields['faqs'], 'Questions & answers', array( 'question' => 'Question', 'answer' => 'Answer (links supported)' ), 'Add FAQ' );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_faqs' );
    echo '</section>';
    echo '<section><h3>Related materials</h3><label class="ab-admin-full"><strong>Section heading</strong><input class="large-text" name="abk_heading_related" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_heading_related', 'Related materials' ) ) . '"></label>';
    ab_render_repeater( 'abk_related_links_json', $fields['related'], 'Related product / material links', array( 'label' => 'Link label', 'url' => 'Full URL or site path' ), 'Add related link' );
    ab_render_knowledge_section_note( $post->ID, 'abk_note_related' );
    echo '</section>';
    echo '<section class="ab-editor-note"><h3>Extra article sections</h3><p>For any additional content, use the standard WordPress block editor for this article. Click the <strong>＋</strong> inserter to add a heading, rich text/links, image, list, quote, table, or group. That content appears after “Why materials differ” and before “When to consider”.</p></section>';
    ab_render_knowledge_section_note( $post->ID, 'abk_note_article_content' );
    echo '<section><h3>Enquiry call-to-action</h3><p class="description">A premium article-end contact panel. Keep the kicker blank to omit it; write the heading and button text for this article.</p><label class="ab-admin-full">Optional kicker<br><input class="large-text" name="abk_cta_kicker" value="' . esc_attr( get_post_meta( $post->ID, 'abk_cta_kicker', true ) ) . '"></label><p><label><strong>CTA heading</strong><br><input class="large-text" name="abk_cta_title" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_cta_title', 'Let’s discuss your material requirement.' ) ) . '"></label></p><p><label><strong>CTA text</strong><br><textarea class="large-text" rows="3" name="abk_cta_text">' . esc_textarea( ab_knowledge_meta_default( $post->ID, 'abk_cta_text', 'Share your process, application and target specification. We’ll help you frame the next step.' ) ) . '</textarea></label></p><p><label><strong>Button text</strong><br><input class="regular-text" name="abk_cta_label" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_cta_label', 'Start a material conversation' ) ) . '"></label></p><p><label><strong>Button URL</strong><br><input class="large-text" name="abk_cta_url" value="' . esc_attr( ab_knowledge_meta_default( $post->ID, 'abk_cta_url', '/#quick-enquiry' ) ) . '" placeholder="/#quick-enquiry"></label></p>';
    ab_render_knowledge_section_note( $post->ID, 'abk_note_cta' );
    echo '</section>';
    echo '</div>';
}
function ab_render_knowledge_section_note( $post_id, $meta_key ) {
    $value = get_post_meta( $post_id, $meta_key, true );
    $heading_key = $meta_key . '_heading';
    $heading = get_post_meta( $post_id, $heading_key, true );
    $has_note = is_string( $value ) && '' !== trim( wp_strip_all_tags( $value ) );
    $has_heading = is_string( $heading ) && '' !== trim( $heading );
    $has_value = $has_note || $has_heading;
    $state_class = $has_value ? ' is-enabled' : '';
    $expanded = $has_value ? 'true' : 'false';
    $button_label = $has_value ? 'Hide note editor' : '+ Add optional note / disclaimer';

    echo '<div class="ab-admin-section-note' . esc_attr( $state_class ) . '" data-section-note>';
    echo '<button type="button" class="button button-secondary ab-section-note-toggle" data-section-note-toggle aria-expanded="' . esc_attr( $expanded ) . '">' . esc_html( $button_label ) . '</button>';
    echo '<div class="ab-admin-section-note-editor"' . ( $has_value ? '' : ' hidden' ) . '>';
    echo '<h4>Optional paragraph after this section</h4><p class="description">Add a paragraph only where needed. You can label it Important, Disclaimer, or with your own heading. Leave the heading blank to show the paragraph without a heading.</p>';
    echo '<p><label class="ab-admin-full"><strong>Heading (optional)</strong><input class="large-text" type="text" name="' . esc_attr( $heading_key ) . '" value="' . esc_attr( $heading ) . '" placeholder="Important, Disclaimer, or your own heading"></label></p>';
    ab_render_rich_field( $meta_key, $meta_key, $value );
    echo '</div></div>';
}
function ab_knowledge_meta_default( $post_id, $key, $default = '' ) {
    return metadata_exists( 'post', $post_id, $key ) ? (string) get_post_meta( $post_id, $key, true ) : $default;
}
function ab_admin_rich_content( $content ) {
    $content = (string) $content;
    return preg_match( '/<[^>]+>/', $content ) ? wp_kses_post( $content ) : wpautop( esc_html( $content ) );
}
function ab_rich_toolbar_html() {
    return '<div class="ab-rich-toolbar" role="toolbar" aria-label="Text formatting"><button type="button" class="button" data-rich-command="bold" aria-label="Bold"><strong>B</strong></button><button type="button" class="button" data-rich-command="italic" aria-label="Italic"><em>I</em></button><button type="button" class="button" data-rich-command="insertUnorderedList" aria-label="Bulleted list">• List</button><button type="button" class="button" data-rich-command="link" aria-label="Insert link">↗ Link</button></div>';
}
function ab_render_rich_field( $id, $name, $content ) {
    echo '<div class="ab-admin-rich-field">' . ab_rich_toolbar_html() . '<div id="' . esc_attr( $id ) . '_visual" class="ab-rich-editable" contenteditable="true" data-rich-field="' . esc_attr( $id ) . '" role="textbox" aria-multiline="true">' . ab_admin_rich_content( $content ) . '</div><textarea hidden name="' . esc_attr( $name ) . '" data-rich-output="' . esc_attr( $id ) . '">' . esc_textarea( $content ) . '</textarea></div>';
}
function ab_knowledge_help_metabox() {
    echo '<p><strong>Article workflow</strong></p><ol><li>Set the custom URL slug and featured image.</li><li>Choose the material and topic terms.</li><li>Write your sections and customize their headings and comparison columns.</li><li>Use the standard WordPress block editor for any extra headings, text, links, images, lists, quotes, or tables.</li></ol><p>Featured images appear in the hub cards and article header. Article URLs remain <code>/knowledge/your-slug/</code>.</p>';
}
function ab_render_repeater( $name, $rows, $label, $columns, $button ) {
    if ( ! is_array( $rows ) ) { $rows = array(); }
    $serialized = wp_json_encode( array_values( $rows ) );
    echo '<section class="ab-admin-repeater" data-repeater data-fields="' . esc_attr( wp_json_encode( array_keys( $columns ) ) ) . '"><h3>' . esc_html( $label ) . '</h3><textarea class="ab-repeater-json" name="' . esc_attr( $name ) . '" hidden>' . esc_textarea( $serialized ) . '</textarea><div class="ab-repeater-rows" data-rows>';
    foreach ( array_values( $rows ) as $row ) {
        echo '<div class="ab-repeater-row" data-row>';
        foreach ( $columns as $key => $caption ) {
            $value = isset( $row[ $key ] ) ? $row[ $key ] : '';
            if ( in_array( $key, array( 'answer', 'detail' ), true ) ) {
                echo '<div class="ab-repeater-rich"><span class="ab-admin-field-title">' . esc_html( $caption ) . '</span>' . ab_rich_toolbar_html() . '<div class="ab-rich-editable" contenteditable="true" data-field="' . esc_attr( $key ) . '" role="textbox" aria-multiline="true">' . ab_admin_rich_content( $value ) . '</div></div>';
            } else {
                echo '<label>' . esc_html( $caption ) . '<textarea data-field="' . esc_attr( $key ) . '" rows="2">' . esc_textarea( $value ) . '</textarea></label>';
            }
        }
        echo '<button type="button" class="button-link-delete" data-remove>Remove row</button></div>';
    }
    echo '</div><button type="button" class="button button-secondary" data-add>' . esc_html( $button ) . '</button></section>';
}



/**
 * Decode and sanitize repeater rows submitted by the Knowledge Article builder.
 * This helper is shared by Page FAQs and Knowledge Article comparison, selection,
 * FAQ, and related-link fields. Rich answer/detail fields retain safe post HTML.
 */
function ab_decode_rows( $field_name, $allowed_fields ) {
    if ( ! isset( $_POST[ $field_name ] ) || ! is_scalar( $_POST[ $field_name ] ) ) {
        return array();
    }

    $raw_rows = wp_unslash( (string) $_POST[ $field_name ] );
    $decoded = json_decode( $raw_rows, true );
    if ( ! is_array( $decoded ) ) {
        return array();
    }

    $rows = array();
    $rich_fields = array( 'answer', 'detail' );

    foreach ( $decoded as $row ) {
        if ( ! is_array( $row ) ) {
            continue;
        }

        $clean_row = array();
        $has_content = false;

        foreach ( $allowed_fields as $field ) {
            $value = isset( $row[ $field ] ) && is_scalar( $row[ $field ] )
                ? (string) $row[ $field ]
                : '';

            if ( in_array( $field, $rich_fields, true ) ) {
                $value = wp_kses_post( $value );
            } elseif ( 'url' === $field ) {
                // Preserve safe absolute URLs and internal paths such as /hdpe/ or /#quick-enquiry.
                $value = esc_url_raw( trim( $value ) );
            } else {
                $value = sanitize_text_field( $value );
            }

            $clean_row[ $field ] = $value;
            if ( '' !== trim( wp_strip_all_tags( $value ) ) ) {
                $has_content = true;
            }
        }

        if ( $has_content ) {
            $rows[] = $clean_row;
        }
    }

    return $rows;
}

add_action( 'save_post_page', 'ab_save_page_meta', 10, 2 );
function ab_save_page_meta( $post_id, $post ) {
    if ( ! isset( $_POST['ab_page_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ab_page_meta_nonce'] ) ), 'ab_page_meta_save' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) { return; }
    update_post_meta( $post_id, 'ab_meta_title', isset( $_POST['ab_meta_title'] ) ? sanitize_text_field( wp_unslash( $_POST['ab_meta_title'] ) ) : '' );
    update_post_meta( $post_id, 'ab_meta_description', isset( $_POST['ab_meta_description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ab_meta_description'] ) ) : '' );
    $allowed = array( 'WebPage', 'AboutPage', 'ContactPage', 'CollectionPage' );
    $schema = isset( $_POST['ab_schema_type'] ) ? sanitize_text_field( wp_unslash( $_POST['ab_schema_type'] ) ) : 'WebPage';
    update_post_meta( $post_id, 'ab_schema_type', in_array( $schema, $allowed, true ) ? $schema : 'WebPage' );
    $faqs = ab_decode_rows( 'ab_page_faqs_json', array( 'question', 'answer' ) );
    update_post_meta( $post_id, 'ab_page_faqs', $faqs );
    update_post_meta( $post_id, 'ab_og_image', isset( $_POST['ab_og_image'] ) && is_scalar( $_POST['ab_og_image'] ) ? esc_url_raw( wp_unslash( $_POST['ab_og_image'] ) ) : '' );
    update_post_meta( $post_id, 'ab_og_image_id', isset( $_POST['ab_og_image_id'] ) && is_scalar( $_POST['ab_og_image_id'] ) ? absint( wp_unslash( $_POST['ab_og_image_id'] ) ) : 0 );
}
add_action( 'save_post_knowledge', 'ab_save_knowledge_meta', 10, 2 );
function ab_save_knowledge_meta( $post_id, $post ) {
    if ( ! isset( $_POST['ab_knowledge_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ab_knowledge_nonce'] ) ), 'ab_knowledge_save' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) { return; }
    $slug = isset( $_POST['ab_knowledge_url'] ) ? sanitize_title( wp_unslash( $_POST['ab_knowledge_url'] ) ) : '';
    update_post_meta( $post_id, 'ab_knowledge_url', $slug );
    if ( $slug && $post->post_name !== $slug && ! get_post_meta( $post_id, '_ab_syncing_slug', true ) ) {
        update_post_meta( $post_id, '_ab_syncing_slug', 1 );
        wp_update_post( array( 'ID' => $post_id, 'post_name' => $slug ) );
        delete_post_meta( $post_id, '_ab_syncing_slug' );
    }
    update_post_meta( $post_id, 'ab_meta_title', isset( $_POST['ab_meta_title'] ) ? sanitize_text_field( wp_unslash( $_POST['ab_meta_title'] ) ) : '' );
    update_post_meta( $post_id, 'ab_meta_description', isset( $_POST['ab_meta_description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ab_meta_description'] ) ) : '' );
    update_post_meta( $post_id, 'abk_direct_answer', isset( $_POST['abk_direct_answer'] ) ? wp_kses_post( wp_unslash( $_POST['abk_direct_answer'] ) ) : '' );
    update_post_meta( $post_id, 'abk_why', isset( $_POST['abk_why'] ) ? wp_kses_post( wp_unslash( $_POST['abk_why'] ) ) : '' );
    foreach ( array( 'abk_heading_direct', 'abk_heading_comparison', 'abk_heading_why', 'abk_heading_when', 'abk_heading_faqs', 'abk_heading_related', 'abk_comparison_header_material', 'abk_comparison_header_best_for', 'abk_comparison_header_consideration', 'abk_cta_title', 'abk_cta_kicker', 'abk_cta_label' ) as $key ) {
        update_post_meta( $post_id, $key, isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '' );
    }
    update_post_meta( $post_id, 'abk_cta_text', isset( $_POST['abk_cta_text'] ) ? sanitize_textarea_field( wp_unslash( $_POST['abk_cta_text'] ) ) : '' );
    update_post_meta( $post_id, 'abk_cta_url', isset( $_POST['abk_cta_url'] ) ? esc_url_raw( wp_unslash( $_POST['abk_cta_url'] ) ) : '' );
    update_post_meta( $post_id, 'abk_comparison_rows', ab_decode_rows( 'abk_comparison_rows_json', array( 'material', 'best_for', 'consideration' ) ) );
    update_post_meta( $post_id, 'abk_when_rows', ab_decode_rows( 'abk_when_rows_json', array( 'material', 'detail' ) ) );
    update_post_meta( $post_id, 'abk_faqs', ab_decode_rows( 'abk_faqs_json', array( 'question', 'answer' ) ) );
    update_post_meta( $post_id, 'abk_related_links', ab_decode_rows( 'abk_related_links_json', array( 'label', 'url' ) ) );
    foreach ( array( 'abk_note_direct', 'abk_note_comparison', 'abk_note_why', 'abk_note_article_content', 'abk_note_when', 'abk_note_faqs', 'abk_note_related', 'abk_note_cta' ) as $note_key ) {
        if ( isset( $_POST[ $note_key ] ) && is_scalar( $_POST[ $note_key ] ) ) {
            update_post_meta( $post_id, $note_key, wp_kses_post( wp_unslash( $_POST[ $note_key ] ) ) );
        }
    }
    foreach ( array( 'abk_note_direct_heading', 'abk_note_comparison_heading', 'abk_note_why_heading', 'abk_note_article_content_heading', 'abk_note_when_heading', 'abk_note_faqs_heading', 'abk_note_related_heading', 'abk_note_cta_heading' ) as $note_heading_key ) {
        update_post_meta( $post_id, $note_heading_key, isset( $_POST[ $note_heading_key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $note_heading_key ] ) ) : '' );
    }
}
add_action( 'admin_enqueue_scripts', 'ab_knowledge_admin_assets' );
function ab_knowledge_admin_assets( $hook ) {
    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) { return; }
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->post_type, array( 'knowledge', 'page' ), true ) ) { return; }
    // The page SEO box uses the media library to pick the social share image.
    if ( 'page' === $screen->post_type ) { wp_enqueue_media(); }
    wp_enqueue_style( 'ab-admin-knowledge', get_template_directory_uri() . '/assets/css/knowledge-admin.css', array(), AB_THEME_VERSION );
    wp_enqueue_script( 'ab-admin-knowledge', get_template_directory_uri() . '/assets/js/knowledge-admin.js', array(), AB_THEME_VERSION, true );
}

/** Editable SEO fields for the Knowledge Center archive (the archive is not a native Page). */
add_action( 'admin_menu', 'ab_knowledge_seo_menu' );
function ab_knowledge_seo_menu() {
    add_submenu_page( 'edit.php?post_type=knowledge', 'Knowledge Center SEO', 'Hub SEO', 'manage_options', 'ab-knowledge-seo', 'ab_knowledge_seo_settings_page' );
}
add_action( 'admin_init', 'ab_register_knowledge_seo_settings' );
function ab_register_knowledge_seo_settings() {
    register_setting( 'ab_knowledge_seo', 'ab_knowledge_archive_title', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    register_setting( 'ab_knowledge_seo', 'ab_knowledge_archive_description', array( 'sanitize_callback' => 'sanitize_textarea_field' ) );
}
function ab_knowledge_seo_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    echo '<div class="wrap"><h1>Knowledge Center archive SEO</h1><p>Set the metadata and CollectionPage schema values for <code>/knowledge/</code>.</p><form method="post" action="options.php">';
    settings_fields( 'ab_knowledge_seo' );
    echo '<table class="form-table"><tr><th><label for="ab_knowledge_archive_title">SEO title</label></th><td><input class="large-text" id="ab_knowledge_archive_title" name="ab_knowledge_archive_title" maxlength="255" value="' . esc_attr( ab_knowledge_archive_title() ) . '"></td></tr><tr><th><label for="ab_knowledge_archive_description">Meta description</label></th><td><textarea class="large-text" rows="3" id="ab_knowledge_archive_description" name="ab_knowledge_archive_description" maxlength="320">' . esc_textarea( ab_knowledge_archive_description() ) . '</textarea></td></tr></table>';
    submit_button();
    echo '</form></div>';
}

/** Native enquiry handlers used by both supplied page forms. */
add_action( 'admin_post_nopriv_ab_material_enquiry', 'ab_handle_material_enquiry' );
add_action( 'admin_post_ab_material_enquiry', 'ab_handle_material_enquiry' );
function ab_handle_material_enquiry() {
    $kind = isset( $_POST['enquiry_kind'] ) && is_scalar( $_POST['enquiry_kind'] ) ? sanitize_key( wp_unslash( $_POST['enquiry_kind'] ) ) : 'general';
    $is_hdpe = 'hdpe' === $kind;
    $fallback = home_url( $is_hdpe ? '/hdpe/' : '/' );
    $referer = wp_get_referer();
    $redirect = wp_validate_redirect( $referer ? $referer : $fallback, $fallback );
    $result = 'error';
    if ( isset( $_POST['ab_material_enquiry_nonce'] ) && is_scalar( $_POST['ab_material_enquiry_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ab_material_enquiry_nonce'] ) ), 'ab_material_enquiry' ) && ( ! isset( $_POST['ab_website'] ) || ( is_scalar( $_POST['ab_website'] ) && '' === (string) $_POST['ab_website'] ) ) ) {
        $name = isset( $_POST['name'] ) && is_scalar( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
        $email = isset( $_POST['email'] ) && is_scalar( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $required_key = $is_hdpe ? 'requirement' : 'message';
        $required = isset( $_POST[ $required_key ] ) && is_scalar( $_POST[ $required_key ] ) ? sanitize_textarea_field( wp_unslash( $_POST[ $required_key ] ) ) : '';
        if ( $name && is_email( $email ) && $required ) {
            $labels = array(
                'company' => 'Company', 'phone' => 'Phone', 'topic' => 'Material / topic', 'material_type' => 'Material type', 'processing_method' => 'Processing method', 'manufacturer' => 'Manufacturer / source', 'grade' => 'Grade', 'form' => 'Form', 'color' => 'Color', 'quantity' => 'Quantity', 'destination' => 'Destination', 'requirement' => 'Requirement', 'pack_size' => 'Pack size', 'frequency' => 'Frequency', 'delivery_date' => 'Required delivery date', 'documents' => 'Documents needed', 'notes' => 'Additional notes', 'message' => 'Message',
            );
            $lines = array( 'Name: ' . $name, 'Email: ' . $email );
            foreach ( $labels as $field => $label ) { if ( isset( $_POST[ $field ] ) && is_scalar( $_POST[ $field ] ) && '' !== (string) $_POST[ $field ] ) { $lines[] = $label . ': ' . sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ); } }
            $attachments = array();
            if ( $is_hdpe && isset( $_FILES['datasheet'] ) && is_array( $_FILES['datasheet'] ) ) {
                $file = $_FILES['datasheet'];
                $upload_error = isset( $file['error'] ) && is_scalar( $file['error'] ) ? (int) $file['error'] : UPLOAD_ERR_NO_FILE;
                if ( UPLOAD_ERR_NO_FILE !== $upload_error ) {
                    $file_size = isset( $file['size'] ) && is_scalar( $file['size'] ) ? (int) $file['size'] : 0;
                    $file_tmp = isset( $file['tmp_name'] ) && is_scalar( $file['tmp_name'] ) ? $file['tmp_name'] : '';
                    $file_name = isset( $file['name'] ) && is_scalar( $file['name'] ) ? $file['name'] : '';
                    $allowed = array( 'pdf' => 'application/pdf', 'doc' => 'application/msword', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'csv' => 'text/csv', 'jpg|jpeg|jpe' => 'image/jpeg', 'png' => 'image/png' );
                    $checked = ( UPLOAD_ERR_OK === $upload_error && $file_size > 0 && $file_size <= 5 * MB_IN_BYTES && $file_tmp && $file_name ) ? wp_check_filetype_and_ext( $file_tmp, $file_name, $allowed ) : array();
                    if ( empty( $checked['type'] ) || ! is_uploaded_file( $file_tmp ) ) { ab_enquiry_redirect( $redirect, 'error', $is_hdpe ); }
                    $attachments[] = $file_tmp;
                    $lines[] = 'Attached file: ' . sanitize_file_name( $file_name );
                }
            }
            $subject = sprintf( '[%s] Material enquiry from %s', $is_hdpe ? 'HDPE' : 'Website', $name );
            $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
            $sent = wp_mail( get_option( 'admin_email' ), $subject, implode( "\n", $lines ), $headers, $attachments );
            if ( $sent ) { $result = 'sent'; }
        }
    }
    ab_enquiry_redirect( $redirect, $result, $is_hdpe );
}
function ab_enquiry_redirect( $url, $result, $is_hdpe ) {
    $url = remove_query_arg( 'ab_enquiry', $url );
    $url = add_query_arg( 'ab_enquiry', $result, $url );
    $url .= $is_hdpe ? '#primary-enquiry' : '#quick-enquiry';
    wp_safe_redirect( $url );
    exit;
}

/** SEO title, description and JSON-LD. An SEO plugin remains the single owner when installed. */
function ab_has_seo_plugin() {
    return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || function_exists( 'aioseo' );
}
add_filter( 'pre_get_document_title', 'ab_filter_document_title', 20 );
function ab_knowledge_archive_title() {
    return get_option( 'ab_knowledge_archive_title', 'Knowledge Center | Polymer Materials & Supply Guidance | Abiroverseas' );
}
function ab_knowledge_archive_description() {
    return get_option( 'ab_knowledge_archive_description', 'Search practical polymer material guides, comparisons, processing notes and FAQs by material, product type or topic.' );
}
function ab_filter_document_title( $title ) {
    if ( is_404() && ! ab_has_seo_plugin() ) { return 'Page Not Found (404) | Abiroverseas'; }
    if ( is_post_type_archive( 'knowledge' ) ) { return ab_knowledge_archive_title() ?: $title; }
    if ( ab_has_seo_plugin() || ! is_singular() ) { return $title; }
    $custom = get_post_meta( get_queried_object_id(), 'ab_meta_title', true );
    return $custom ? $custom : $title;
}
function ab_plugin_seo_title( $title ) {
    if ( is_post_type_archive( 'knowledge' ) ) { return ab_knowledge_archive_title() ?: $title; }
    if ( ! is_singular() ) { return $title; }
    $custom = get_post_meta( get_queried_object_id(), 'ab_meta_title', true );
    return $custom ? $custom : $title;
}
function ab_plugin_seo_description( $description ) {
    if ( is_post_type_archive( 'knowledge' ) ) { return ab_knowledge_archive_description() ?: $description; }
    if ( ! is_singular() ) { return $description; }
    $custom = get_post_meta( get_queried_object_id(), 'ab_meta_description', true );
    return $custom ? $custom : $description;
}
add_filter( 'wpseo_title', 'ab_plugin_seo_title' );
add_filter( 'wpseo_metadesc', 'ab_plugin_seo_description' );
add_filter( 'rank_math/frontend/title', 'ab_plugin_seo_title' );
add_filter( 'rank_math/frontend/description', 'ab_plugin_seo_description' );
add_filter( 'aioseo_title', 'ab_plugin_seo_title' );
add_filter( 'aioseo_description', 'ab_plugin_seo_description' );
add_action( 'wp_head', 'ab_output_seo_and_schema', 3 );
function ab_output_seo_and_schema() {
    if ( ab_has_seo_plugin() ) {
        if ( ! is_singular( array( 'page', 'knowledge' ) ) ) { return; }
        $plugin_post_id = get_queried_object_id();
        $plugin_faqs = 'knowledge' === get_post_type( $plugin_post_id ) ? get_post_meta( $plugin_post_id, 'abk_faqs', true ) : get_post_meta( $plugin_post_id, 'ab_page_faqs', true );
        $plugin_entities = array();
        if ( is_array( $plugin_faqs ) ) {
            foreach ( $plugin_faqs as $faq ) {
                $q = isset( $faq['question'] ) ? trim( wp_strip_all_tags( $faq['question'] ) ) : '';
                $a = isset( $faq['answer'] ) ? trim( wp_strip_all_tags( $faq['answer'] ) ) : '';
                if ( $q && $a ) { $plugin_entities[] = array( '@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $a ) ); }
            }
        }
        if ( $plugin_entities ) {
            $plugin_faq_schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $plugin_entities );
            echo '<script type="application/ld+json">' . wp_json_encode( $plugin_faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
        }
        return;
    }
    if ( is_post_type_archive( 'knowledge' ) ) {
        $url = get_post_type_archive_link( 'knowledge' );
        $title = ab_knowledge_archive_title();
        $description = ab_knowledge_archive_description();
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        $schema = array( '@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => $title, 'description' => $description, 'url' => $url, 'isPartOf' => array( '@type' => 'WebSite', 'name' => get_bloginfo( 'name' ), 'url' => home_url( '/' ) ) );
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
        return;
    }
    if ( is_tax( array( 'knowledge_hub', 'knowledge_material', 'knowledge_topic' ) ) ) {
        $term = get_queried_object();
        $name = $term && isset( $term->name ) ? $term->name : 'Knowledge Center';
        $description = $term && isset( $term->description ) ? wp_strip_all_tags( $term->description ) : '';
        if ( ! $description ) { $description = 'Knowledge Center resources and material guidance for ' . $name . '.'; }
        $title = $name . ' | Knowledge Center | Abiroverseas';
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        $schema = array( '@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => $title, 'description' => $description, 'url' => get_term_link( $term ), 'isPartOf' => array( '@type' => 'WebSite', 'name' => get_bloginfo( 'name' ), 'url' => home_url( '/' ) ) );
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
        return;
    }
    if ( ! is_singular( array( 'page', 'knowledge' ) ) ) { return; }
    $id = get_queried_object_id();
    $description = get_post_meta( $id, 'ab_meta_description', true );
    if ( $description ) { echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n"; }
    $title = get_post_meta( $id, 'ab_meta_title', true );
    if ( ! $title ) { $title = get_the_title( $id ); }
    $page_description = $description ? $description : wp_strip_all_tags( get_the_excerpt( $id ) );
    if ( 'knowledge' === get_post_type( $id ) ) {
        $page_schema = array( '@type' => 'Article', 'headline' => $title, 'description' => $page_description, 'mainEntityOfPage' => get_permalink( $id ), 'datePublished' => get_the_date( DATE_W3C, $id ), 'dateModified' => get_the_modified_date( DATE_W3C, $id ), 'author' => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ), 'publisher' => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ) );
        if ( has_post_thumbnail( $id ) ) { $page_schema['image'] = array( get_the_post_thumbnail_url( $id, 'full' ) ); }
        $faqs = get_post_meta( $id, 'abk_faqs', true );
    } else {
        $type = get_post_meta( $id, 'ab_schema_type', true );
        $page_schema = array( '@type' => $type ? $type : 'WebPage', 'name' => $title, 'description' => $page_description, 'url' => get_permalink( $id ), 'isPartOf' => array( '@type' => 'WebSite', 'name' => get_bloginfo( 'name' ), 'url' => home_url( '/' ) ) );
        $faqs = get_post_meta( $id, 'ab_page_faqs', true );
    }
    $graph = array( $page_schema );
    if ( is_array( $faqs ) && $faqs ) {
        $entities = array();
        foreach ( $faqs as $faq ) {
            $q = isset( $faq['question'] ) ? trim( wp_strip_all_tags( $faq['question'] ) ) : '';
            $a = isset( $faq['answer'] ) ? trim( wp_strip_all_tags( $faq['answer'] ) ) : '';
            if ( $q && $a ) { $entities[] = array( '@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $a ) ); }
        }
        if ( $entities ) { $graph[] = array( '@type' => 'FAQPage', 'mainEntity' => $entities ); }
    }
    $schema = array( '@context' => 'https://schema.org', '@graph' => $graph );
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
}

/**
 * Resolve the social share image for a page: page-level share image first,
 * then the WordPress Featured image. Returns url, width, height and alt text.
 */
function ab_social_share_image( $post_id = 0 ) {
    $post_id = $post_id ? (int) $post_id : (int) get_queried_object_id();
    $image   = array( 'url' => '', 'width' => 0, 'height' => 0, 'alt' => '' );
    if ( ! $post_id ) { return $image; }

    $image_id = (int) get_post_meta( $post_id, 'ab_og_image_id', true );
    $image_url = (string) get_post_meta( $post_id, 'ab_og_image', true );

    if ( ! $image_url && has_post_thumbnail( $post_id ) ) {
        $image_id = (int) get_post_thumbnail_id( $post_id );
    }
    if ( $image_id ) {
        $src = wp_get_attachment_image_src( $image_id, 'full' );
        if ( $src && ! empty( $src[0] ) ) {
            $image = array(
                'url'    => $src[0],
                'width'  => (int) $src[1],
                'height' => (int) $src[2],
                'alt'    => (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
            );
        }
    }
    if ( ! $image['url'] && $image_url ) {
        $image['url'] = $image_url;
    }
    if ( ! $image['url'] && has_post_thumbnail( $post_id ) ) {
        $image['url'] = (string) get_the_post_thumbnail_url( $post_id, 'full' );
    }
    if ( ! $image['alt'] ) { $image['alt'] = get_the_title( $post_id ); }
    return $image;
}

/** Let SEO plugins reuse the same per-page share image when one is installed. */
add_filter( 'wpseo_opengraph_image', 'ab_plugin_social_share_image' );
add_filter( 'wpseo_twitter_image', 'ab_plugin_social_share_image' );
add_filter( 'rank_math/opengraph/facebook/image', 'ab_plugin_social_share_image' );
add_filter( 'rank_math/opengraph/twitter/image', 'ab_plugin_social_share_image' );
function ab_plugin_social_share_image( $image ) {
    if ( ! is_singular() ) { return $image; }
    $share = ab_social_share_image( get_queried_object_id() );
    return $share['url'] ? $share['url'] : $image;
}

/**
 * Open Graph + Twitter Card tags. The page SEO title and meta description are
 * reused as og/twitter title and description; the image is the page's own
 * share image with the Featured image as fallback.
 */
add_action( 'wp_head', 'ab_output_social_meta', 4 );
function ab_output_social_meta() {
    if ( ab_has_seo_plugin() || is_admin() || is_feed() ) { return; }

    $title       = '';
    $description = '';
    $url         = '';
    $type        = 'website';
    $image       = array( 'url' => '', 'width' => 0, 'height' => 0, 'alt' => '' );

    if ( is_404() ) {
        $title = 'Page Not Found (404) | Abiroverseas';
    } elseif ( is_post_type_archive( 'knowledge' ) ) {
        $title       = ab_knowledge_archive_title();
        $description = ab_knowledge_archive_description();
        $url         = get_post_type_archive_link( 'knowledge' );
    } elseif ( is_tax( array( 'knowledge_hub', 'knowledge_material', 'knowledge_topic' ) ) ) {
        $term        = get_queried_object();
        $name        = $term && isset( $term->name ) ? $term->name : 'Knowledge Center';
        $title       = $name . ' | Knowledge Center | Abiroverseas';
        $description = $term && ! empty( $term->description ) ? wp_strip_all_tags( $term->description ) : 'Knowledge Center resources and material guidance for ' . $name . '.';
        $term_link   = $term ? get_term_link( $term ) : '';
        $url         = is_wp_error( $term_link ) ? '' : (string) $term_link;
    } elseif ( is_singular() ) {
        $id          = get_queried_object_id();
        $title       = get_post_meta( $id, 'ab_meta_title', true );
        if ( ! $title ) { $title = get_the_title( $id ); }
        $description = get_post_meta( $id, 'ab_meta_description', true );
        if ( ! $description ) { $description = wp_strip_all_tags( get_the_excerpt( $id ) ); }
        $url         = get_permalink( $id );
        $type        = 'knowledge' === get_post_type( $id ) ? 'article' : 'website';
        $image       = ab_social_share_image( $id );
    } else {
        $title = wp_get_document_title();
    }

    $title       = trim( wp_strip_all_tags( (string) $title ) );
    $description = trim( wp_strip_all_tags( (string) $description ) );

    echo "\n<!-- Abiroverseas social share tags -->\n";
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
    if ( $url ) { echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n"; }
    if ( $title ) {
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    }
    if ( $description ) {
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
    }
    if ( ! empty( $image['url'] ) ) {
        echo '<meta property="og:image" content="' . esc_url( $image['url'] ) . '">' . "\n";
        if ( $image['width'] && $image['height'] ) {
            echo '<meta property="og:image:width" content="' . esc_attr( $image['width'] ) . '">' . "\n";
            echo '<meta property="og:image:height" content="' . esc_attr( $image['height'] ) . '">' . "\n";
        }
        if ( $image['alt'] ) { echo '<meta property="og:image:alt" content="' . esc_attr( $image['alt'] ) . '">' . "\n"; }
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url( $image['url'] ) . '">' . "\n";
        if ( $image['alt'] ) { echo '<meta name="twitter:image:alt" content="' . esc_attr( $image['alt'] ) . '">' . "\n"; }
    } else {
        echo '<meta name="twitter:card" content="summary">' . "\n";
    }
}

/** Convert author-provided internal site paths to absolute, safe home URLs. */
function ab_home_anchor_url( $id ) {
    $id = sanitize_html_class( $id );
    return is_front_page() ? '#' . $id : home_url( '/#' . $id );
}
function ab_content_url( $url ) {
    $url = trim( (string) $url );
    if ( '' === $url ) { return ''; }
    if ( 0 === strpos( $url, '/' ) ) { return home_url( $url ); }
    return esc_url_raw( $url );
}
function ab_knowledge_article_url( $slug ) {
    $article = get_page_by_path( sanitize_title( $slug ), OBJECT, 'knowledge' );
    if ( $article && 'publish' === $article->post_status ) { return get_permalink( $article ); }
    $archive = get_post_type_archive_link( 'knowledge' );
    return $archive ? $archive : home_url( '/knowledge/' );
}
/**
 * Social profiles used by the footer icons and the Contact page social card.
 * Replace the placeholder URLs with the live profile URLs. A URL left empty
 * is skipped, so the remaining icons stay aligned.
 */
function ab_social_links() {
    return apply_filters( 'ab_social_links', array(
        array( 'key' => 'facebook',  'label' => 'Facebook',  'url' => 'https://www.facebook.com/abiroverseas' ),
        array( 'key' => 'linkedin',  'label' => 'LinkedIn',  'url' => 'https://www.linkedin.com/company/abiroverseas/' ),
        array( 'key' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/abiroverseasllc' ),
    ) );
}

/** Inline SVG artwork (24×24, fill = currentColor) for each social network. */
function ab_social_icon_svg( $key ) {
    $paths = array(
        'facebook' => 'M24 12.073C24 5.446 18.627 0 12 0S0 5.446 0 12.073c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073Z',
        'linkedin' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286ZM5.337 7.433a2.062 2.062 0 1 1 0-4.124 2.062 2.062 0 0 1 0 4.124Zm1.782 13.019H3.555V9h3.564v11.452ZM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003Z',
        'instagram' => 'M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0Zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03Zm0 3.678a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324ZM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm7.846-10.405a1.441 1.441 0 1 1-2.88 0 1.441 1.441 0 0 1 2.88 0Z',
    );
    if ( ! isset( $paths[ $key ] ) ) { return ''; }
    return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="' . esc_attr( $paths[ $key ] ) . '" fill="currentColor"/></svg>';
}

/** Print the social icon links (no heading) for the footer and Contact card. */
function ab_social_icon_links( $class = 'ab-social-icons', $aria_label = 'Abiroverseas on social media' ) {
    $links = ab_social_links();
    $html  = '';
    foreach ( $links as $link ) {
        if ( empty( $link['url'] ) ) { continue; }
        $html .= '<a class="ab-social-link ab-social-link--' . esc_attr( $link['key'] ) . '" href="' . esc_url( $link['url'] ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $link['label'] ) . '" title="' . esc_attr( $link['label'] ) . '">' . ab_social_icon_svg( $link['key'] ) . '</a>';
    }
    if ( '' === $html ) { return; }
    echo '<div class="' . esc_attr( $class ) . '" role="group" aria-label="' . esc_attr( $aria_label ) . '">' . $html . '</div>';
}