<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $blog_posts;
    $blog_posts = $wp_query;

    get_template_part('/template-parts/global/blog-filter-bar');
?>
<div id="blog_post__archive" class="page_container">
    <?php
        if (have_posts()) : ?>
            <?= get_blog_posts_table($wp_query); ?>
        <?php else : ?>
            <h4 id="no_search_results">Sorry, no articles were found that match "<?= get_search_query() ?>".</h4>
        <?php
        endif;
    ?>
</div>
<?php
    if (is_object($post)) get_template_part('template-parts/global/cta');
