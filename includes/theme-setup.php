<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


require 'admin-setup.php';

// Theme Init //
add_action('after_setup_theme', function () {
    load_theme_textdomain('hex', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ]);
});

function hex_content_width() {
	$GLOBALS['content_width'] = apply_filters('hex_content_width', 640);
}
add_action('after_setup_theme', 'hex_content_width', 0);


// Force https in media library //
add_filter('wp_get_attachment_url', function ($url) {
    if (is_ssl()) {
        $url = str_replace('http://', 'https://', $url);
    }
	return $url;
});


// Register menus //
add_action('init', function () {
	register_nav_menu('main-menu', __('Main Menu'));
});

add_action('init', function () {
	register_nav_menu('social-menu', __('Social Menu'));
});

add_action('init', function () {
	register_nav_menu('footer-menu', __('Footer Menu'));
});

add_action('init', function () {
	register_nav_menu('policy-menu', __('Footer Policy Menu'));
});


// Un-register Default Fields //
add_action('admin_init', function () {
    remove_post_type_support('page', 'editor');
    // remove_post_type_support('post', 'thumbnail');
});


// ACF Setup //
add_filter('acf/settings/path', function ($path) {
    return get_stylesheet_directory() . '/plugins/acf/';
});
add_filter('acf/settings/dir', function ($dir) {
    return get_stylesheet_directory_uri() . '/plugins/acf/';
});


// SVG Support //
add_action('upload_mimes', function ($file_types) {
    return array_merge($file_types, [
        'svg' => 'image/svg+xml',
        'eps' => 'application/postscript'
    ]);
});

// display all posts for search results //
add_filter('pre_get_posts', function ($query) {
    if ($query->is_search) $query->query_vars['posts_per_page'] = -1;
    return $query;
});


// password protected page form //
add_filter('the_password_form', function () {
    global $post;
    $id = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

    ob_start();
    ?>
    <form
        action="<?= esc_url(site_url('wp-login.php?action=postpass', 'login_post')) ?>"
        method="post"
        class="float_clear"
    >
        <div class="form_row full">
            <p>Please log in to view the content.</p>
        </div>
        <div class="form_row full">
            <label for="<?= $id ?>">Password</label><br>
            <input type="password" name="post_password" id="<?= $id ?>">
        </div>
        <div class="form_row full login">
            <input
                type="submit"
                name="Submit"
                value="<?= esc_attr__('Log In') ?>"
                class="button"
            >
        </div>
    </form>
    <?php
    return ob_get_clean();
});

// File Downloading //

function download_file($file_id) {
    $file = wp_get_attachment_url($file_id);

    if (!$file) return;

    $file_url  = stripslashes(trim($file));
    $file_name = basename($file);
    $file_extension = pathinfo($file_name);

    $whitelist = [
        'png',
        'gif',
        'tiff',
        'jpeg',
        'jpg',
        'bmp',
        'svg',
        'pdf'
    ];

    if (!in_array($file_extension['extension'], $whitelist)) exit('133 ' . $file_extension['extension']);
    if (strpos( $file_url , '.php' ) == true) die('134 ' . $file_url);

    $content_type = '';

    switch ($file_extension['extension']) {
        case 'png':
            $content_type = 'image/png';
            break;
        case 'gif':
            $content_type = 'image/gif';
            break;
        case 'tiff':
            $content_type = 'image/tiff';
            break;
        case 'jpeg':
        case 'jpg':
            $content_type = 'image/jpg';
            break;
        default:
            $content_type = 'application/force-download';
    }

    header('Expires: 0');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
    header('Pragma: no-cache');
    // header('Content-Type: ' . $content_type);
    header('Content-Type: application/force-download');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . $file_name);

    readfile($file_url);
    exit();
}

add_action('init', function () {
    if (isset($_GET['attachment_id']) && isset($_GET['download_file'])) {
        download_file($_GET['attachment_id']);
    }
});


// Dynamic Contact Form Recipients //

add_action('wpcf7_before_send_mail', function ($form) {
    if ($submission = WPCF7_Submission::get_instance()) {
        $posted_data = $submission->get_posted_data();

        if (empty($posted_data['how-can-we-help'])) return $form;

        $mail = $form->prop('mail');
        $type = $posted_data['how-can-we-help'];

        $recipients = [
            $mail['recipient']
        ];

        switch ($type) {
            case 'sales':
                if ($sales = esc_attr(get_option('aila_contact_recip_sales'))) {
                    $recipients []= $sales;
                }
                break;
            case 'support':
                if ($support = esc_attr(get_option('aila_contact_recip_support'))) {
                    $recipients []= $support;
                }
                break;
            case 'partners':
                if ($partners = esc_attr(get_option('aila_contact_recip_partner'))) {
                    $recipients []= $partners;
                }
                break;
        }

        $mail['recipient'] = implode(',', $recipients);
        $form->set_properties(['mail' => $mail]);
    }

    return $form;
});

// Free Email Exclusions //

include 'email-exclusion.php';

function custom_form_validation($result, $tag) {
    $name = $tag['name'];

    switch ($name) {
        case 'business-email':
            $value = $_POST[$name];
            $email = explode('@', $value);
            $domain = $email[count($email) - 1];

            if (is_blocked_email_domain($domain)) {
                $result->invalidate($tag,
                    'Please enter your business email address. This form does not accept addresses from ' . $domain . '.'
                );
            }
            break;

        // case 'phone-number':
        //     $value = $_POST[$name];
        //
        //     if (!empty($value)) {
        //         $result->invalidate($tag,
        //             'You\'ve been honeypotted!'
        //         );
        //     }
        //     break;
    }

    return $result;
}

add_filter('wpcf7_validate_email','custom_form_validation', 10, 2);
add_filter('wpcf7_validate_email*', 'custom_form_validation', 10, 2);


// Honeypot //

add_filter('wpcf7_validate', function ($result, $tags) {
    $form = WPCF7_Submission::get_instance();
    $honeypot = $form->get_posted_data('title');

    if (!empty($honeypot)) $result->invalidate('title', 'Please enter a correct title.');

    return $result;
}, 10, 2);
