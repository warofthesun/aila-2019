<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

get_template_part('template-parts/pages/page-archive');
if (is_object($post)) get_template_part('template-parts/global/cta');
