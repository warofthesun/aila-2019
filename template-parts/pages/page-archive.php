<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $posts_shortcode = '[aila-blog-posts';

    if (is_author()) {
        $author = get_query_var('author');
        $posts_shortcode .= ' author="' . $author . '"';
        $posts_shortcode .= ' post_type="post"';
    } else if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $posts_shortcode .= ' categories="' . $category->name . '"';
        $posts_shortcode .= ' post_type="post"';
    } else if (is_tag()) {
        $tag = get_queried_object();
        $posts_shortcode .= ' tag="' . $tag->slug . '"';
        $posts_shortcode .= ' post_type="post"';
    } else if (is_tax()) {
        $query = get_queried_object();
        $posts_shortcode .= ' categories="' . $query->slug . '"';
        $posts_shortcode .= ' taxonomy="' . $query->taxonomy . '"';
        $posts_shortcode .= ' post_type="' . get_post_type() . '"';
    } else {
        $year = get_query_var('year');
        $month = get_query_var('monthnum');
        $posts_shortcode .= ' year="' . $year . '"';
        $posts_shortcode .= ' month="' . $month . '"';
        $posts_shortcode .= ' post_type="post"';
    }

    $posts_shortcode .= ']';

    get_template_part('/template-parts/global/blog-filter-bar');
?>
    <div id="blog_post__archive" class="page_container">
        <?php
            echo do_shortcode($posts_shortcode);
            get_template_part('template-parts/pages/blog/load-more');
        ?>
    </div>
<?php
