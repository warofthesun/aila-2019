<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;
    $post_id = $post->ID;
    $post_type = $post->post_type;
    $is_blog = $post_type == 'post';

    $taxonomy = $is_blog ? 'category' : 'tools-product';

    $categories = $is_blog ? get_the_category() : wp_get_post_terms($post_id, [$taxonomy]);
    $categories_list = get_category_list($categories, ',');
    $post_id = get_the_ID();


    $posts_shortcode = '[aila-blog-posts post_type="' . $post_type . '" categories="' . $categories_list . '"';
    $posts_shortcode .= ' taxonomy="' . $taxonomy . '" posts_per_page="2" exclude_post="' . $post_id . '"]';
?>
    <div id="blog_post__might_also_like" class="page_container">
        <h2>You may also like...</h2>

        <?= do_shortcode($posts_shortcode); ?>
    </div>
<?php
