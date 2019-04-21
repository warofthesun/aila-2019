<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $heading = '';

    if (is_author()) {
        $author_id = get_query_var('author');
        $heading = get_the_author_meta('display_name', $author);
    } else if (is_category()) {
        $cat = get_category(get_query_var('cat'));
        $heading = $cat->name;
    } else if (is_tag()) {
        $heading = single_tag_title(null, false);
    } else if (is_tax()) {
        $query = get_queried_object();
        $heading = $query->name;
    } else if (is_search()) {
        $heading = 'Search Results: ' . get_search_query();
    } else if (is_404()) {
        $heading = 'Oops! That page can&rsquo;t be found.';
    } else {
        $heading = trim(single_month_title(' ',false));
    }

    $blog = get_page_by_path('blog');
    $blog_id = $blog->ID;
    $hero = get_field('hero', $blog_id);

    $color_overlay = $hero['color_overlay'];
    $bg_image = $hero['background_image'];
    $image_url = '';

    if ($bg_image) {
        $image_url = $bg_image['url'];
    }

    $classes = get_bg_classes($image_url, $color_overlay, false);
?>
    <div id="hero" class="archive bg_overlay_compatible <?= implode(' ', $classes) ?>">
        <?php if (!empty($image_url)) : ?>
            <div class="banner_bg_img" style="background-image: url(<?= $image_url ?>);"></div>
        <?php endif;?>

        <div id="hero_content" class="post">
            <h1><?= $heading ?></h1>
        </div>

        <?php render_hero_lines(); ?>
    </div>
<?php
