<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;
    $post_id = $post->ID;
    $post_type = get_post_type();

    $heading = get_the_title();
    $image_url = get_the_post_thumbnail_url();
    $image_positioned = get_field('featured_image_position');

    $is_blog = $post_type == 'post';

    $post_date = get_the_date();
    $post_date_url = get_post_date_url($post_date);
    $categories = $is_blog ? get_the_category() : wp_get_post_terms($post_id, ['tools-product']);

    $page = $is_blog ? 'blog' : 'tools';
    $more_url = $is_blog ? '/blog/categories/' : '/tools/products/';

    $cta_button = get_button(get_field('cta_button'));

    get_template_part('/template-parts/global/blog-filter-bar');
?>
    <div id="blog_post" class="page_container">
        <?php if (!empty($image_url) && $image_positioned) : ?>
            <img src="<?= $image_url ?>" class="installation_image" alt="<?= $heading ?>">
        <?php endif; ?>
        <p id="blog_post__date"><a href="<?= $post_date_url ?>"><?= $post_date ?></a></p>
        <div id="blog_post__content">
            <?php the_content(); ?>
        </div>
        <?php if (!empty($cta_button['text'])) : ?>
            <div id="blog_post__content_cta">
                <?php print_button($cta_button); ?>
            </div>
        <?php endif; ?>
    </div>

    <div id="blog_post__links">
        <div class="page_container float_clear">
            <a href="/<?= $page ?>/" class="float_left">
                <?php get_icon('left-arrow'); ?>Back to <?= $page ?> <span class="hide_on_mobile">homepage</span>
            </a>
            <?php if (!empty($categories) && $categories[0]) : ?>
            <a href="<?= $more_url . $categories[0]->slug ?>" class="float_right">
                More on this topic <?php get_icon('right-arrow'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
<?php
