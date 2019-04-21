<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;

    $post_id = $post->ID;

    $field_banner_type = 'cta_banner_type';
    $field_full_width = 'full_width_banner';
    $field_split_left = 'split_banner_left';
    $field_split_right = 'split_banner_right';
    $field_installations = 'installations';

    if ($post->post_type == 'post') {
        $blog = get_page_by_path('blog');
        $post_id = $blog->ID;

        $field_banner_type .= '_post';
        $field_full_width .= '_post';
        $field_split_left .= '_post';
        $field_split_right .= '_post';
        $field_installations .= '_post';
    }

    $banner_type = get_field($field_banner_type, $post_id);

    $content = [
        'full_width' => get_field($field_full_width, $post_id),
        'split_left' => get_field($field_split_left, $post_id),
        'split_right' => get_field($field_split_right, $post_id),
        'installations' => get_field($field_installations, $post_id),
        'mobile_side' => get_field('mobile_cta', $post_id)
    ];

    echo render_cta($banner_type, $content);
