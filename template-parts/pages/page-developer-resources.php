<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */



echo '<div id="resources__developer" class="page_container">';
    get_template_part('template-parts/pages/resources/resources');
echo '</div>';

get_template_part('template-parts/global/contact-form');

get_footer_divider();
