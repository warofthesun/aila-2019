<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $blog_type = get_blog_type();
?>
<div id="blog__filter_bar">
    <div id="blog__filter_bar__container" class="page_container float_clear">
        <?php
            get_search_form(true);

            switch ($blog_type) {
                case 'post':
                    get_taxonomy_dropdown('tags', 'filter_post_tag');
                    get_taxonomy_dropdown('categories', 'filter_post_category');
                    break;
                case 'tools':
                    get_taxonomy_dropdown('products', 'filter_post_products');
                    break;
            }
        ?>
    </div>
</div>
