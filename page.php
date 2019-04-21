<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

global $post;

get_header();

if (post_password_required($post)) {
    get_template_part('template-parts/global/password-protect');
}

while (have_posts()) : the_post();
    get_template_part('template-parts/content-page');
endwhile;

get_footer();
