<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

if (is_single()) {
    get_template_part('template-parts/pages/blog/single-content');
    get_template_part('template-parts/pages/blog/might-also-like');
} else {
    get_template_part('template-parts/global/blog-filter-bar');
    ?>
        <div id="tools__container" class="page_container page_section">
            <?= do_shortcode('[aila-blog-posts post_type="tools"]') ?>
        </div>
    <?php
}

get_footer_divider();
