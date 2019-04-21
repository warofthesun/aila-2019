<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


add_action('admin_menu', function () {
    add_menu_page(
        'Aila',
        'Aila Settings',
        'manage_options',
        'aila_settings',
        'add_aila_admin_settings_page',
        get_template_directory_uri() . '/images/admin-icon.svg',
        75
    );

    add_action('admin_init', function () {
        register_contact_form_modal_options();
        register_download_modal_options();
        register_contact_form_options();
    });
});

function add_aila_admin_settings_page() {
    require WP_CONTENT_DIR . '/themes/aila/admin/settings.php';
}

function register_contact_form_modal_options() {
    // Contact Form Settings //
    register_setting(
        'aila-modal-options',
        'aila_contact_form_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_form_sub_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_form_shortcode'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_form_thank_you_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_form_thank_you_message'
    );

    // Section //
    add_settings_section(
        'aila-contact-form-modal',
        'Contact Form Modal',
        'aila_contact_form_modal_settings',
        'aila_settings'
    );

    // Contact Form Fields //
    add_settings_field(
        'aila-contact-form-title',
        'Title',
        'render_contact_form_title',
        'aila_settings',
        'aila-contact-form-modal'
    );
    add_settings_field(
        'aila-contact-form-sub-title',
        'Sub-Title',
        'render_contact_form_sub_title',
        'aila_settings',
        'aila-contact-form-modal'
    );
    add_settings_field(
        'aila-contact-form-shortcode',
        'Contact Form Id',
        'render_contact_form_shortcode',
        'aila_settings',
        'aila-contact-form-modal'
    );
    add_settings_field(
        'aila-contact-form-thank-you-title',
        'Thank You Title',
        'render_contact_form_thank_you_title',
        'aila_settings',
        'aila-contact-form-modal'
    );
    add_settings_field(
        'aila-contact-form-thank-you-message',
        'Thank You Message',
        'render_contact_form_thank_you_message',
        'aila_settings',
        'aila-contact-form-modal'
    );
}

function register_download_modal_options() {
    // Download Settings //
    register_setting(
        'aila-modal-options',
        'aila_download_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_download_sub_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_download_shortcode'
    );
    register_setting(
        'aila-modal-options',
        'aila_download_thank_you_title'
    );
    register_setting(
        'aila-modal-options',
        'aila_download_thank_you_message'
    );

    // Section //
    add_settings_section(
        'aila-download-modal',
        'File Download Modal',
        'aila_download_modal_settings',
        'aila_settings'
    );

    // Download Fields //
    add_settings_field(
        'aila-download-title',
        'Title',
        'render_download_title',
        'aila_settings',
        'aila-download-modal'
    );
    add_settings_field(
        'aila-download-sub-title',
        'Sub-Title',
        'render_download_sub_title',
        'aila_settings',
        'aila-download-modal'
    );
    add_settings_field(
        'aila-download-form-shortcode',
        'Download Form Id',
        'render_download_shortcode',
        'aila_settings',
        'aila-download-modal'
    );
    add_settings_field(
        'aila-download-thank-you-title',
        'Thank You Title',
        'render_download_thank_you_title',
        'aila_settings',
        'aila-download-modal'
    );
    add_settings_field(
        'aila-download-thank-you-message',
        'Thank You Message',
        'render_download_thank_you_message',
        'aila_settings',
        'aila-download-modal'
    );
}

function register_contact_form_options() {
    register_setting(
        'aila-modal-options',
        'aila_contact_recip_sales'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_recip_support'
    );
    register_setting(
        'aila-modal-options',
        'aila_contact_recip_partner'
    );

    // Section //
    add_settings_section(
        'aila-contact-recipients',
        'Contact Form Recipient Emails',
        'aila_contact_form_sales_settings',
        'aila_settings'
    );

    add_settings_field(
        'aila-contact-sales-recip',
        'Sales Recipient Email',
        'render_contact_recip_sales',
        'aila_settings',
        'aila-contact-recipients'
    );
    add_settings_field(
        'aila-contact-support-recip',
        'Support Recipient Email',
        'render_contact_recip_support',
        'aila_settings',
        'aila-contact-recipients'
    );
    add_settings_field(
        'aila-contact-partner-recip',
        'Partner Recipient Email',
        'render_contact_recip_partner',
        'aila_settings',
        'aila-contact-recipients'
    );
}

function aila_contact_form_modal_settings($args) {
    // echo 'Customize the Contact Form modal.';
    return $args;
}

function aila_download_modal_settings($args) {
    // echo 'Customize the File Download modal.';
    return $args;
}

function aila_contact_form_sales_settings($args) {
    return $args;
}

function render_contact_form_title() {
    $title = esc_attr(get_option('aila_contact_form_title'));
    echo '<input type="text" name="aila_contact_form_title" value="' . $title . '" class="admin_settings">';
}

function render_contact_form_sub_title() {
    echo '<textarea class="admin_settings" rows="6" name="aila_contact_form_sub_title">';
    echo esc_attr(get_option('aila_contact_form_sub_title'));
    echo '</textarea>';
}

function render_contact_form_shortcode() {
    $shortcode = esc_attr(get_option('aila_contact_form_shortcode'));
    echo '<input type="text" name="aila_contact_form_shortcode" value="' . $shortcode . '" class="admin_settings">';
}

function render_contact_form_thank_you_title() {
    $title = esc_attr(get_option('aila_contact_form_thank_you_title'));
    echo '<input type="text" name="aila_contact_form_thank_you_title" value="' . $title . '" class="admin_settings">';
}

function render_contact_form_thank_you_message() {
    echo '<textarea class="admin_settings" rows="6" name="aila_contact_form_thank_you_message">';
    echo esc_attr(get_option('aila_contact_form_thank_you_message'));
    echo '</textarea>';
}

function render_download_title() {
    $title = esc_attr(get_option('aila_download_title'));
    echo '<input type="text" name="aila_download_title" value="' . $title . '" class="admin_settings">';
}

function render_download_sub_title() {
    echo '<textarea class="admin_settings" rows="6" name="aila_download_sub_title">';
    echo esc_attr(get_option('aila_download_sub_title'));
    echo '</textarea>';
}

function render_download_shortcode() {
    $shortcode = esc_attr(get_option('aila_download_shortcode'));
    echo '<input type="text" name="aila_download_shortcode" value="' . $shortcode . '" class="admin_settings">';
}

function render_download_thank_you_title() {
    $title = esc_attr(get_option('aila_download_thank_you_title'));
    echo '<input type="text" name="aila_download_thank_you_title" value="' . $title . '" class="admin_settings">';
}

function render_download_thank_you_message() {
    echo '<textarea class="admin_settings" rows="6" name="aila_download_thank_you_message">';
    echo esc_attr(get_option('aila_download_thank_you_message'));
    echo '</textarea>';
}

function render_contact_recip_sales() {
    $email = esc_attr(get_option('aila_contact_recip_sales'));
    echo '<input type="email" name="aila_contact_recip_sales" value="' . $email . '" class="admin_settings">';
}

function render_contact_recip_support() {
    $email = esc_attr(get_option('aila_contact_recip_support'));
    echo '<input type="email" name="aila_contact_recip_support" value="' . $email . '" class="admin_settings">';
}

function render_contact_recip_partner() {
    $email = esc_attr(get_option('aila_contact_recip_partner'));
    echo '<input type="email" name="aila_contact_recip_partner" value="' . $email . '" class="admin_settings">';
}
