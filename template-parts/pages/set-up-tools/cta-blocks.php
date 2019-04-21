<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */


    if ($blocks = get_field('cta_blocks')) {
        foreach ($blocks as $block) {
            echo render_cta($block['cta_banner_type'], [
                'full_width' => $block['full_width_banner'],
                'split_left' => $block['split_banner_left'],
                'split_right' => $block['split_banner_right'],
                'installations' => $block['installations']
            ]);
        }
    }
