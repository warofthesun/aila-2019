<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

$quote_section = get_field('quote');

get_template_part('template-parts/pages/product/features');
get_template_part('template-parts/pages/product/video');
get_template_part('template-parts/pages/product/solutions');
get_template_part('template-parts/global/quote');
if (empty($quote_section) || empty($quote_section['quote'])) echo '<hr>';
get_template_part('template-parts/global/contact-form');
