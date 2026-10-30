# Abiroverseas Polymer Materials — WordPress Theme (`v1.5.6`)

A custom, lightweight classic WordPress theme (`abiroverseas-theme`) engineered for **Abiroverseas LLC** and its authorised India distributor landing page (**Bhavik Enterprises**).

This `README.md` is written so any developer, designer, or site administrator can understand **the entire theme flow, file map, CSS/JS isolation rules, header/footer setup, and editing workflow in one read**.

---

## 1. High-Level Theme Flow (How a Request Renders)

```text
Incoming WordPress URL
        │
        ├──► Global Pages & Knowledge Center
        │       1. Loads header.php        (Global topbar + Appearance → Menus primary nav + SVG sprite)
        │       2. Runs Page / CPT Template (e.g., template-home.php, template-product-range.php, single-knowledge.php)
        │       3. Enqueues ONLY that page's CSS + JS (via ab_enqueue_assets() in functions.php) + site.css + navigation.js
        │       4. Loads footer.php        (Global 4-column Abiroverseas footer + scroll-to-top button)
        │
        └──► Bhavik Enterprises (/bhavik-enterprises/)
                1. Loads header-bhavik.php (Standalone Header Two — same visual layout & logo, #anchor nav, India contact bar)
                2. Runs page-template/template-bhavik-enterprises.php
                3. Enqueues ONLY bhavik.css + bhavik.js + site.css + navigation.js
                4. Loads footer-bhavik.php (Standalone Footer Two — same 4-column layout & white logo, Kanpur/Mumbai/Mundra details)
```

---

## 2. Directory Structure at a Glance

```text
abiroverseas-theme/
├── style.css                                   # WordPress theme header metadata (v1.5.5)
├── functions.php                               # Theme setup, per-page CSS/JS enqueue, CPT/taxonomies, SEO/FAQ meta, enquiry handler
├── header.php                                  # Global Header One (Abiroverseas LLC sitewide navigation & SVG icon sprite)
├── footer.php                                  # Global Footer One (Abiroverseas LLC 4-column footer)
├── header-bhavik.php                           # Standalone Header Two — dedicated to Bhavik Enterprises (get_header('bhavik'))
├── footer-bhavik.php                           # Standalone Footer Two — dedicated to Bhavik Enterprises (get_footer('bhavik'))
├── 404.php                                     # Custom Error 404 page with smart "Back to Previous Page" button
├── page.php / index.php                        # Fallback standard WordPress page & index templates
├── archive-knowledge.php                       # Knowledge Center hub (/knowledge/) with search & taxonomy filters
├── single-knowledge.php                        # Single Knowledge Center article (/knowledge/{slug}/)
├── taxonomy-knowledge_hub.php                  # Knowledge Hub taxonomy archive
├── taxonomy-knowledge_material.php             # Knowledge Material taxonomy archive
├── taxonomy-knowledge_topic.php                # Knowledge Topic taxonomy archive
├── inc/
│   └── default-content.php                     # Starter page definitions & default SEO/FAQ metadata seeded once on activation
├── page-template/
│   ├── template-home.php                       # Front Page / Home
│   ├── template-about.php                      # About Us (/about/)
│   ├── template-contact.php                    # Contact Us (/contact-us/)
│   ├── template-product-families.php           # Product Families 6-card searchable directory (/products/)
│   ├── template-product-range.php              # Product Range 12-card 2x2 3D borderless directory (/product-range/)
│   ├── template-bhavik-enterprises.php         # Bhavik Enterprises standalone distributor page (/bhavik-enterprises/)
│   ├── template-material.php                   # HDPE Material Page (/hdpe/)
│   ├── template-material-LDPE.php              # LDPE Material Page (/ldpe/)
│   ├── template-material-PP.php                # Polypropylene (PP) Material Page (/pp/)
│   ├── template-material-PVC.php               # PVC Material Page (/pvc/)
│   ├── template-material-PS.php                # Polystyrene (PS) Material Page (/ps/)
│   ├── template-material-ABS.php               # ABS Material Page (/abs/)
│   ├── template-material-EVA.php               # EVA Material Page (/eva/)
│   └── template-material-Recycled-Plastics.php # Recycled Plastics Material Page (/recycled-plastics/)
└── assets/
    ├── css/
    │   ├── home.css                            # Isolated styles for Home page ONLY
    │   ├── about.css                           # Isolated styles for About Us page ONLY
    │   ├── contact.css                         # Isolated styles for Contact Us page ONLY
    │   ├── products.css                        # Isolated styles for Product Families & 2x2 Product Range ONLY
    │   ├── material.css                        # Isolated styles for the 8 Material pages ONLY
    │   ├── knowledge.css                       # Isolated styles for Knowledge Center archive & articles ONLY
    │   ├── bhavik.css                          # Isolated styles for Bhavik Enterprises page ONLY
    │   ├── error-404.css                       # Isolated styles for Error 404 page ONLY
    │   ├── site.css                            # Shared header, topbar, mobile nav, 4-column footer & scroll-to-top ONLY
    │   └── knowledge-admin.css                 # WP Admin meta box styles for Knowledge Center editor
    ├── js/
    │   ├── navigation.js                       # Shared mobile drawer & scroll-to-top controller (loaded on every page)
    │   ├── home.js                             # Home hero photo slider & scroll reveal
    │   ├── about.js                            # About scroll reveal & FAQ category tabs
    │   ├── products.js                         # Live instant client-side search filter for Product Families & Product Range
    │   ├── material.js                         # Material gallery carousel & scroll reveal
    │   ├── bhavik.js                           # Bhavik Enterprises scroll reveal controller
    │   ├── error-404.js                        # Smart "Back to Previous Page" referrer & history controller (404 ONLY)
    │   ├── knowledge-hub.js                    # Knowledge Hub filter interactions
    │   ├── knowledge-single.js                 # Single Knowledge article TOC / interactions
    │   └── knowledge-admin.js                  # WP Admin repeater & rich-text controls
    └── img/                                    # Bundled polymer & industrial photography assets
```

---

## 3. Strict Per-Page CSS & JS Isolation (Core Rule)

**Every page type owns its own dedicated CSS file.** Do **not** place page-specific card or section rules into `site.css`, and do **not** chain unrelated page stylesheets together.

`ab_enqueue_assets()` in `functions.php` resolves the current route (by slug first, then by assigned template) and loads **only** that route's CSS and JS:

| Page / Route | PHP Template | Dedicated CSS | Dedicated JS | Header / Footer |
| :--- | :--- | :--- | :--- | :--- |
| **Home** (`/`) | `page-template/template-home.php` | `home.css` | `home.js` | `header.php` / `footer.php` |
| **About Us** (`/about/`) | `page-template/template-about.php` | `about.css` | `about.js` | `header.php` / `footer.php` |
| **Contact Us** (`/contact-us/`) | `page-template/template-contact.php` | `contact.css` | — | `header.php` / `footer.php` |
| **Product Families** (`/products/`) | `page-template/template-product-families.php` | `products.css` | `products.js` | `header.php` / `footer.php` |
| **Product Range** (`/product-range/`) | `page-template/template-product-range.php` | `products.css` | `products.js` | `header.php` / `footer.php` |
| **Material Pages** (`/hdpe/`, `/pp/`, `/ldpe/`, `/pvc/`, `/ps/`, `/abs/`, `/eva/`, `/recycled-plastics/`) | `page-template/template-material*.php` | `material.css` | `material.js` | `header.php` / `footer.php` |
| **Knowledge Hub** (`/knowledge/` & taxonomies) | `archive-knowledge.php`, `taxonomy-*.php` | `knowledge.css` | `knowledge-hub.js` | `header.php` / `footer.php` |
| **Knowledge Article** (`/knowledge/{slug}/`) | `single-knowledge.php` | `knowledge.css` | `knowledge-single.js` | `header.php` / `footer.php` |
| **Bhavik Enterprises** (`/bhavik-enterprises/`) | `page-template/template-bhavik-enterprises.php` | `bhavik.css` | `bhavik.js` | `header-bhavik.php` / `footer-bhavik.php` |
| **Error 404** (any missing URL) | `404.php` | `error-404.css` | `error-404.js` | `header.php` / `footer.php` |

> **What `site.css` & `navigation.js` do:** Loaded on all front-end views solely to power the sticky header bar, topbar ticker, mobile hamburger drawer, 4-column footer, and floating back-to-top button.

---

## 4. Separate Headers & Footers (Global vs Bhavik Enterprises)

To make ongoing maintenance effortless without conditional tangles:

1. **Global Site (`header.php` + `footer.php`)**
   - Used by Home, About, Contact, Products, all 8 Material pages, and Knowledge Center.
   - Pulls primary menu items dynamically from **Appearance → Menus → Primary Menu**.
   - Displays Abiroverseas LLC contact info (`info@abiroverseas.com`, `+1 (856) 523 3366`).

2. **Bhavik Enterprises (`header-bhavik.php` + `footer-bhavik.php`)**
   - Loaded via `get_header( 'bhavik' );` and `get_footer( 'bhavik' );` inside `template-bhavik-enterprises.php`.
   - Keeps the **exact same visual header/footer layout and Abiroverseas logos** (`ABIR-Logo.png` & `Abir-Logo_white-textr-1.png`) as the global site.
   - Uses clean in-page anchor navigation (`#bv-hero`, `#about`, `#products`, `#industries`, `#the-way`, `#faqs`, `#quick-enquiry`) so visitors stay on the Bhavik landing page.
   - Displays Bhavik Enterprises' India details:
     - **Address:** Village Barhat Bangar, Mandhana Bithoor Road, Kanpur – 209217, UP, India
     - **Phone / WhatsApp:** `+91 7007049478`
     - **Email:** `info@bhavikenterprises.com`
     - **Our Presence:** **Head Office:** Kanpur and **Branches:** Mumbai, Mundra (stacked vertically inside the Contact Us section across desktop, tablet landscape, and mobile)

---

## 5. Visual & UI Design System Conventions

When editing or adding sections, follow these established design rules:

- **All Buttons = Borderless 3D Orange Accent (Subtle Shadows):** Every button across the theme (`.ab-btn`, `.ab-btn--blue`, `.ab-btn--outline`, `.ab-btn--light`, `.ab-contact-submit`, `.ab-range-card-cta`, `.kh-button`, `.kh-button-light`, `.kh-enquiry-button`, header quote button, footer CTA, and scroll-to-top) uses the orange accent gradient (`#ff9238 → #f58220 → #e26d0c`), white text, **`border: 0`**, and restrained 3D elevation shadows in both resting and `:hover` states.
- **Unified Eyebrows & Equal-Height Split/Hero Images:** Every page (including Bhavik Enterprises) shares the exact `.ab-eyebrow` design (`17px` desktop/tablet-landscape, `15px` tablet portrait, `14px` mobile, `#008080` teal text or `#a8ded6` on dark sections, and a `24px × 2px` `#f58220` orange leading dash aligned to the first line) and stretches right-side banner/split image containers (`align-items: stretch` + `position: absolute; inset: 0` cover media) to equal the exact height of the left-side copy container on desktop and tablet landscape (`>= 1024px`).
- **Borderless 3D Image Cards:**
  - **Bhavik "Industries We Serve"** (`#industries` in `bhavik.css`) uses a 3-column desktop / 2-column tablet / 1-column mobile borderless 3D pedestal card with a rounded 16:10 photo stage, frosted badge, and floating `#008080` icon box overlapping the image bottom.
  - **Product Range** (`#ab-range-grid` in `products.css`) uses the same borderless 3D image-card craft in a **2×2 layout** (`repeat(2, minmax(0, 1fr))` on desktop & tablet, `1fr` on mobile), paired with a recessed borderless spec table and two separate 3D orange CTA buttons (`Explore <Material>` + `Enquire Now`) per card, isolated strictly inside `products.css`.
- **Bhavik FAQ Question Boxes:** Styled in `bhavik.css` (`.ab-faq-item`) with a tinted sage-mist 3D surface, **no border and no left accent bar**, 3D circular rotating trigger icon, and recessed white answer well so each question stands out cleanly against the white section background.
- **Unified Icon Boxes:** Icon containers (`.ab-icon-box`, `.ab-contact-detail-icon`, `.ab-range-card-icon`) use the `#008080` teal palette on soft 3D surfaces.
- **Clean Photography:** Banner and slider images do not render decorative circle/ring overlays on top of photography.

---

## 6. Forms & Lead Submission Flow

All enquiry forms across **Home**, **Contact Us**, **all 8 Material pages**, and **Bhavik Enterprises** post securely to WordPress `admin-post.php` (`action=ab_material_enquiry`, handled in `functions.php`):

1. Verifies WordPress nonce (`ab_material_enquiry_nonce`) and invisible honeypot (`ab_website`).
2. Sanitizes all submitted fields (`name`, `company`, `email`, `phone`, `material`, `quantity`, `application`, `enquiry_kind`).
3. Supports optional spec/datasheet file attachments up to 5 MB (`.pdf`, `.doc`, `.docx`, `.xls`, `.xlsx`, `.csv`, `.jpg`, `.jpeg`, `.png`) on Material forms without exposing uploads in the public Media Library.
4. Sends formatted notification email to **Settings → General → Administration Email Address** and redirects back to the originating page with `?enquiry=sent` (or `?enquiry=error`).

---

## 7. Knowledge Center Architecture (`/knowledge/`)

- **Custom Post Type:** `knowledge` (URL structure `/knowledge/{exact-slug}/`).
- **Taxonomies:**
  1. `knowledge_hub` — Material/topic hubs (HDPE, PP, LDPE / LLDPE, PVC, Recycled Polymers)
  2. `knowledge_material` — Product Type / Material filter
  3. `knowledge_topic` — Topic filter (Comparisons, FAQs, Grades & Selection, Processing Methods, Applications, Recycling & Sustainability)
- **Structured Editor Fields (`functions.php`):** Custom native meta boxes let editors manage Exact URL Slug, SEO Title/Description, Direct Answer, 3-Column Comparison Table, Why Materials Differ, WordPress Block Editor extra content, When to Consider, FAQs (auto-generating `FAQPage` JSON-LD schema), Related Materials, and Article-End CTA — with zero paid plugin dependencies.

---

## 8. Installation & Quick Editing Guide

### Installing the Theme
1. Zip the `abiroverseas-theme/` directory (ensuring `style.css` is at the root of the archive).
2. In WordPress Admin, go to **Appearance → Themes → Add New → Upload Theme**, upload the zip, and click **Activate**.
3. Starter pages (`Home`, `About`, `HDPE`, `Product Families`, `Product Range`, `Bhavik Enterprises`) and the starter `Primary Menu` are created automatically without overwriting existing content.
4. Visit **Settings → Permalinks** and click **Save Changes** once to flush `/knowledge/` rewrite rules.
5. Ensure brand logo uploads exist at `/wp-content/uploads/2026/10/ABIR-Logo.png` and `/wp-content/uploads/2026/10/Abir-Logo_white-textr-1.png`.

### Common Maintenance Tasks
- **Edit Global Header / Menu / Footer:** Edit `header.php`, `footer.php`, or **Appearance → Menus → Primary Menu**.
- **Edit Bhavik Header / Footer / Contact Info:** Edit `header-bhavik.php`, `footer-bhavik.php`, and the `$bv_*` variables at the top of `page-template/template-bhavik-enterprises.php`.
- **Edit Styles Safely:** Open only the target page's CSS file in `assets/css/` (see the table in Section 3) and bump `AB_THEME_VERSION` in `functions.php` so browsers fetch the updated stylesheet immediately.
- **Requirements:** WordPress 6.0+ and PHP 7.4+. No WooCommerce or ACF Pro required.
