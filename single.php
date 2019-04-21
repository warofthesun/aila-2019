<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


global $post;

get_header();

if (!post_password_required($post)) {
    while (have_posts()) : the_post();
        get_template_part('template-parts/content-post');
    endwhile;
} else {
    echo '<div id="password_protected__login" class="page_container">' . get_the_password_form() . '</div>';
}

get_footer();
