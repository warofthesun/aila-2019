<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


add_action('wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('theme-style', get_stylesheet_uri());

    wp_enqueue_style('font-awesome',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        ['theme-style'],
        $theme_version
    );

    wp_enqueue_style('main-style',
        get_stylesheet_directory_uri() . '/css/main.css',
        ['theme-style'],
        time()
    );

    // wp_enqueue_style('jQuery-mobile-style',
    //     'https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css',
    //     ['theme-style']
    // );
});


add_action('wp_footer', function () {
    wp_enqueue_script('civana-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js'
    );

    // wp_enqueue_script('jQuery-mobile',
    //     'https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js',
    //     ['jquery']
    // );
    wp_enqueue_script('helpers-script',
        get_stylesheet_directory_uri() . '/js/helpers.js',
        ['jquery'],
        time()
    );
    wp_enqueue_script('vendor-script',
        get_stylesheet_directory_uri() . '/js/vendor.js',
        ['jquery'],
        time()
    );
    wp_enqueue_script('product-animations-script',
        get_stylesheet_directory_uri() . '/js/products.js',
        [
            'jquery',
            'helpers-script',
            'vendor-script'
        ],
        time()
    );
    wp_enqueue_script('animations-script',
        get_stylesheet_directory_uri() . '/js/animations.js',
        ['product-animations-script'],
        time()
    );
    wp_enqueue_script('main-script',
        get_stylesheet_directory_uri() . '/js/main.js',
        ['animations-script'],
        time()
    );
});


// Admin //

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin-style',
        get_stylesheet_directory_uri() . '/css/admin/admin.css',
        [],
        time()
    );
});
