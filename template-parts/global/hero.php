<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;
    $slug = '';

    if (is_object($post)) $slug = $post->post_name;

    if (is_search() || is_404()) $slug = 'search';

    switch ($slug) {
        case 'home':
            get_template_part('template-parts/pages/home/home-hero');
            break;
        case 'blog':
            get_template_part('template-parts/pages/blog/blog-hero');
            break;
        // case 'tools':
        //     get_template_part('template-parts/pages/tools/tools-hero');
        //     break;
        case 'case-studies':
            get_template_part('template-parts/pages/case-studies/case-studies-hero');
            break;
        case 'search':
            get_template_part('template-parts/pages/blog/archive-hero');
            break;
        default:
            get_template_part('template-parts/global/page-hero');
    }
