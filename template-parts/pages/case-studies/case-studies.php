<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($case_studies = get_field('case_studies')) {
        $title = $case_studies['title'];

        $shortcode = '[aila-case-study-posts';
        if (!empty($title)) $shortcode .= ' title="' . $title . '"';
        $shortcode .= ']';

        echo do_shortcode($shortcode);
    }
