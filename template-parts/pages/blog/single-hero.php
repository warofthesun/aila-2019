<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    global $post;
    setup_postdata($post);

    $post_type = get_post_type();
    $categories = get_the_category();
    $heading = get_the_title();
    $author = get_post_field('post_author');
    $author_name = get_the_author_meta('display_name', $author);
    $author_nicename = get_the_author_meta('nicename', $author);

    $color_overlay = get_field('color_overlay');
    // $bg_image = get_field('background_image');
    // $image_url = '';
    //
    // if ($bg_image) {
    //     $image_url = $bg_image['url'];
    // }
    $image_url = get_the_post_thumbnail_url();
    $image_positioned = get_field('featured_image_position');

    $classes = get_bg_classes($image_url, $color_overlay, false);
?>
    <div id="hero" class="bg_overlay_compatible blog_single <?= implode(' ', $classes) ?>">
        <?php if (!empty($image_url)) : ?>
            <div class="banner_bg_overlay" <?= $image_positioned ? 'data-no-fade' : '' ?>></div>
            <?php if (!$image_positioned) : ?>
            <div class="banner_bg_img" style="background-image: url(<?= $image_url ?>);"></div>
        <?php endif; endif; ?>

        <div id="hero_content" class="<?= $post_type ?>">
            <?php if (!empty($categories)) : ?>
                <h5><?php print_category_link_list($categories); ?></h5>
            <?php endif; ?>
            <?php if (!empty($heading)) { ?><h1><?= $heading ?></h1><?php } ?>
            <?php if (!empty($author_name) && $post_type == 'post') : ?>
                <p class="author">
                    By <a href="/blog/author/<?= $author_nicename ?>"><?= $author_name ?></a>
                </p>
            <?php endif; ?>
        </div>

        <?php render_hero_lines(); ?>
    </div>
<?php
