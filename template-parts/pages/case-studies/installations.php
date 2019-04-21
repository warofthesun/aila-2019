<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($installations = get_field('installations')) {
        $title = $installations['title'];

        $display_type = $installations['installations_to_display'];

        $shortcode = '[aila-installation-posts';
        if (!empty($title)) $shortcode .= ' title="' . $title . '"';

        if ($display_type == 'latest') {
            $shortcode .= ' display="latest"';
        } else {
            $shortcode .= ' display="featured"';
            $featured_installations = $installations['installations'];
            $ids = '';

            foreach ($featured_installations as $i => $installation) {
                $ids .= $installation['installation']->ID;
                if ($i < count($featured_installations) - 1) $ids .= ',';
            }

            $shortcode .= ' post_ids="' . $ids . '"';
        }

        $shortcode .= ']';

        echo do_shortcode($shortcode);
    }
