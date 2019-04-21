<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $hero = get_field('hero');
    $featured_post = $hero['featured_article'];
    $heading = $hero['fallback_heading'];


    $is_full_screen = $hero['full_screen'];
    $color_overlay = $hero['color_overlay'];

    $bg_type = $hero['background_type'];
    $bg_image = $hero['background_image'];
    $bg_video = $hero['background_video'];
    $image_url = '';
    $video_url = '';
    $has_bg_asset = false;

    if ($bg_image) $image_url = $bg_image['url'];
    if ($bg_video) $video_url = $bg_video['url'];

    if (!empty($image_url) || !empty($video_url)) $has_bg_asset = true;

    $classes = get_bg_classes($has_bg_asset, $color_overlay, $is_full_screen);
    $button_color = $color_overlay == 'darkened' ? '' : 'inverted';
?>

<div id="hero" class="bg_overlay_compatible blog_hero <?= implode(' ', $classes) ?> <?= empty($featured_post) ? 'no_featured_post' : '' ?>">
    <?php if ($bg_type === 'video' && !empty($video_url)) : ?>
    <div id="hero__video">
        <video muted loop autoplay data-object-fit="cover">
            <source src="<?= $video_url ?>" type="video/mp4">
        </video>
    </div>
    <?php elseif ($bg_type === 'image' && !empty($image_url)) : ?>
        <div class="banner_bg_img" style="background-image: url(<?= $image_url ?>);"></div>
    <?php endif;?>

    <div id="hero_content">
        <?php if (!empty($featured_post)) : ?>
            <?php
                $title = $featured_post->post_title;
                $author = $featured_post->post_author;
                $author_name = get_the_author_meta('display_name', $author);
                $author_nicename = get_the_author_meta('nicename', $author);
                $url = get_permalink($featured_post->ID);
            ?>
            <h5>Featured Article</h5>
            <h1><?= $featured_post->post_title ?></h1>
            <?php if (!empty($author_name)) : ?>
                <p class="author">
                    By <a href="/blog/author/<?= $author_nicename ?>"><?= $author_name ?></a>
                </p>
            <?php endif; ?>
            <a href="<?= $url ?>" class="read_now">Read Now</a>
        <?php else : ?>
            <h1><?= $heading ?></h1>
        <?php endif; ?>
    </div>
    <?php render_hero_lines(); ?>
</div>
