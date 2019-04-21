<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */



echo '<div id="resources__partner" class="page_container page_section">';
    get_template_part('template-parts/pages/resources/partner/video');
    get_template_part('template-parts/pages/resources/resources');
    get_template_part('template-parts/pages/resources/partner/in-the-wild');
echo '</div>';

get_footer_divider();
