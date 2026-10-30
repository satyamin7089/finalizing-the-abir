<?php
/**
 * Template Name: Support
 * Template Post Type: page
 * Support page using the shared Abiroverseas material-enquiry handler.
 * Same banner + enquiry form layout as the Contact page, with a department-wise
 * contact sidebar (product enquiry, logistics, accounts, operations, sales).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$ab_support_result = '';
if ( isset( $_GET['ab_enquiry'] ) && is_scalar( $_GET['ab_enquiry'] ) ) {
    $ab_support_result = sanitize_key( wp_unslash( $_GET['ab_enquiry'] ) );
}

$ab_support_topics = array(
    'Product enquiry',
    'Material availability',
    'Grade selection help',
    'General business enquiry',
    'Technical guidance',
    'PP',
    'HDPE',
    'LDPE / LLDPE',
    'PVC',
    'PET',
    'ABS',
    'PS / HIPS',
    'Engineering plastics',
    'Masterbatch / additives',
    'Recycled polymers',
    'Other',
);
$ab_selected_topic = '';
if ( isset( $_GET['topic'] ) && is_scalar( $_GET['topic'] ) ) {
    $candidate_topic = sanitize_text_field( wp_unslash( $_GET['topic'] ) );
    if ( in_array( $candidate_topic, $ab_support_topics, true ) ) {
        $ab_selected_topic = $candidate_topic;
    }
}

/* Department-wise contacts. Currently every desk shares the same team email
   and phone — swap the values below when dedicated department lines are ready. */
$ab_support_departments = array(
    array(
        'name'  => 'Product Enquiry',
        'icon'  => '<path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z"/><path d="m4 7.5 8 4.5 8-4.5"/><path d="M12 12v9"/>',
    ),
    array(
        'name'  => 'Logistics',
        'icon'  => '<path d="M3 7h11v10H3z"/><path d="M14 10h4l3 3.5V17h-7z"/><circle cx="7" cy="18.4" r="1.7"/><circle cx="17" cy="18.4" r="1.7"/>',
    ),
    array(
        'name'  => 'Accounts',
        'icon'  => '<path d="M6 3h12v18l-2.4-1.6L13.2 21l-2.4-1.6L8.4 21 6 19.4V3Z"/><path d="M9 8h6M9 11.5h6M9 15h3.5"/>',
    ),
    array(
        'name'  => 'Operations',
        'icon'  => '<circle cx="12" cy="12" r="3"/><path d="M12 2.8v2.6M12 18.6v2.6M2.8 12h2.6M18.6 12h2.6M5.4 5.4l1.9 1.9M16.7 16.7l1.9 1.9M18.6 5.4l-1.9 1.9M7.3 16.7l-1.9 1.9"/>',
    ),
    array(
        'name'  => 'Sales',
        'icon'  => '<path d="M3 17 9 11l3.5 3.5L21 6"/><path d="M15 6h6v6"/>',
    ),
);
$ab_support_mail_icon  = '<rect x="3.5" y="6" width="17" height="12" rx="2"/><path d="m4.5 7.5 7.5 5.5 7.5-5.5"/>';
$ab_support_phone_icon = '<path d="M7.1 3.8H4.8c-.8 0-1.4.7-1.3 1.5.7 7.9 7.1 14.3 15 15 .8.1 1.5-.5 1.5-1.3v-2.3l-4.1-1-1.3 2a14.3 14.3 0 0 1-6.5-6.5l2-1.3-1-4.1z"/>';
?>
<main id="main-content" class="ab-contact-page ab-support-page">
    <!-- Simple banner: shared website banner background, centred heading + intro (same as Privacy Policy banner). -->
    <section class="ab-legal-hero" aria-labelledby="ab-support-title">
        <div class="ab-wrap">
            <h1 id="ab-support-title">Support Abiroverseas.</h1>
            <p>Need help with a product, delivery, invoice or an ongoing order? Reach the right department directly, or send us a message and we’ll route it to the right desk.</p>
        </div>
    </section>

    <section class="ab-contact-main ab-section" id="quick-enquiry" aria-labelledby="ab-support-form-title">
        <div class="ab-wrap">
            <div class="ab-contact-intro">
                <span class="ab-eyebrow">Contact our team</span>
                <h2 id="ab-support-form-title">How can we help you?</h2>
                <p>Share a few details below and tell us what you need help with. If your question is about an existing order or invoice, include the reference so we can respond faster.</p>
            </div>

            <?php if ( 'sent' === $ab_support_result ) : ?>
                <div class="ab-contact-notice ab-contact-notice--success" role="status" aria-live="polite">
                    <strong>Thank you for contacting Abiroverseas.</strong>
                    <span>Your enquiry has been submitted successfully. We’ll review the details and follow up as appropriate.</span>
                </div>
            <?php elseif ( 'error' === $ab_support_result ) : ?>
                <div class="ab-contact-notice ab-contact-notice--error" role="alert">
                    <strong>We couldn’t submit your enquiry.</strong>
                    <span>Please check the required fields and try again. If the problem continues, contact us by email or phone.</span>
                </div>
            <?php endif; ?>

            <div class="ab-contact-layout">
                <aside class="ab-contact-aside" aria-label="Department-wise contact information">
                    <div class="ab-contact-aside-heading">
                        <h3>Department-wise contacts.</h3>
                        <p>Connect directly with the desk you need — product, logistics, accounts, operations or sales — or send the form and we’ll route your message to the right team.</p>
                    </div>
                    <?php foreach ( $ab_support_departments as $ab_department ) : ?>
                        <div class="ab-contact-detail ab-support-dept">
                            <span class="ab-contact-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><?php echo $ab_department['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG ?></svg>
                            </span>
                            <span>
                                <small><?php echo esc_html( $ab_department['name'] ); ?></small>
                                <a class="ab-support-dept-line" href="mailto:info@abiroverseas.com">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><?php echo $ab_support_mail_icon; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG ?></svg>
                                    <span>info@abiroverseas.com</span>
                                </a>
                                <a class="ab-support-dept-line" href="tel:+18565233366">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><?php echo $ab_support_phone_icon; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG ?></svg>
                                    <span>+1 (856) 523 3366</span>
                                </a>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <div class="ab-contact-detail ab-contact-detail--social">
                        <span class="ab-contact-detail-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none"><circle cx="17.5" cy="6" r="2.6" stroke="currentColor" stroke-width="1.7"/><circle cx="6.5" cy="12" r="2.6" stroke="currentColor" stroke-width="1.7"/><circle cx="17.5" cy="18" r="2.6" stroke="currentColor" stroke-width="1.7"/><path d="m8.9 10.7 6.2-3.4M8.9 13.3l6.2 3.4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        </span>
                        <?php ab_social_icon_links( 'ab-contact-social', 'Abiroverseas on social media' ); ?>
                    </div>
                    <div class="ab-contact-aside-note"><span class="ab-contact-note-dot" aria-hidden="true"></span><p>Helpful details include your order or invoice reference, material or grade, quantity, and the best time to reach you.</p></div>
                    <div class="ab-contact-aside-decoration" aria-hidden="true"><span></span><span></span><span></span></div>
                </aside>

                <form class="ab-form-card ab-contact-form" id="ab-contact-enquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="ab_material_enquiry">
                    <input type="hidden" name="enquiry_kind" value="general">
                    <?php wp_nonce_field( 'ab_material_enquiry', 'ab_material_enquiry_nonce' ); ?>
                    <label class="ab-honeypot" aria-hidden="true">Leave this field empty<input type="text" name="ab_website" tabindex="-1" autocomplete="off"></label>

                    <div class="ab-contact-form-heading">
                        <h3>Send us your enquiry</h3>
                        <p>Fields marked with an asterisk are required.</p>
                    </div>
                    <div class="ab-form-grid">
                        <div class="ab-field">
                            <label for="support-name">Full name <span aria-hidden="true">*</span></label>
                            <input id="support-name" name="name" type="text" autocomplete="name" required maxlength="120" placeholder="Your full name">
                        </div>
                        <div class="ab-field">
                            <label for="support-email">Business email <span aria-hidden="true">*</span></label>
                            <input id="support-email" name="email" type="email" autocomplete="email" required maxlength="254" placeholder="name@company.com">
                        </div>
                        <div class="ab-field">
                            <label for="support-company">Company name</label>
                            <input id="support-company" name="company" type="text" autocomplete="organization" maxlength="160" placeholder="Your company">
                        </div>
                        <div class="ab-field">
                            <label for="support-topic">Enquiry type <span aria-hidden="true">*</span></label>
                            <select id="support-topic" name="topic" required>
                                <option value="">Choose a topic</option>
                                <?php foreach ( $ab_support_topics as $ab_topic_option ) : ?>
                                    <option value="<?php echo esc_attr( $ab_topic_option ); ?>"<?php selected( $ab_selected_topic, $ab_topic_option ); ?>><?php echo esc_html( $ab_topic_option ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="ab-field ab-field--full">
                            <label for="support-message">How can we help? <span aria-hidden="true">*</span></label>
                            <textarea id="support-message" name="message" required maxlength="5000" rows="5" placeholder="Tell us about the material, grade, form, application, quantity, or timing you have in mind."></textarea>
                        </div>
                    </div>
                    <div class="ab-form-foot">
                        <button class="ab-btn ab-btn--blue ab-contact-submit" type="submit">Submit enquiry <span aria-hidden="true">↗</span></button>
                        <span class="ab-contact-secure-note"><span aria-hidden="true">✓</span> Your details are used to respond to your enquiry.</span>
                    </div>
                    <p class="ab-form-disclaimer">Your message is sent to the site administrator email configured in WordPress.</p>
                </form>
            </div>
        </div>
    </section>


</main>
<?php get_footer(); ?>
