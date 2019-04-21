<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $detect = new Mobile_Detect;
    $is_mobile = $detect->isMobile() || $detect->isTablet() ? true : false;

    global $post;

    $title = get_field('hero_title');
    $heading = get_field('hero_heading');
    $text = get_field('hero_text');
    $button = get_button(get_field('hero_button'));
    $is_full_screen = get_field('hero_is_full_screen');
    $color_overlay = get_field('color_overlay');

    $bg_type = get_field('background_type');
    $bg_image = get_field('hero_background_image');
    $bg_video = get_field('hero_background_video');
    $video_url = '';
    $image_url = '';
    $has_bg_asset = false;
    $has_bg_video = false;

    if ($bg_type === 'image' && $bg_image) $image_url = $bg_image['url'];
    if ($bg_type === 'video' && $bg_video) $video_url = $bg_video['url'];

    if (!empty($image_url) || !empty($video_url)) $has_bg_asset = true;
    if (!empty($video_url)) $has_bg_video = true;

    $classes = get_bg_classes($has_bg_asset, $color_overlay, $is_full_screen);
    $button_color = $color_overlay == 'darkened' ? '' : 'inverted';

    if ($is_mobile) $classes []= 'is_mobile';
    if ($has_bg_video) $classes []= 'has_video';
?>
    <div id="hero" class="home bg_overlay_compatible <?= implode(' ', $classes) ?>">
        <?php if ($bg_type === 'video' && !empty($video_url)) : ?>
        <div id="hero__video">
            <video muted loop autoplay data-object-fit="cover">
                <source src="<?= $video_url ?>" type="video/mp4">
            </video>
        </div>
        <?php elseif ($bg_type === 'image' && !empty($image_url)) : ?>
            <div class="banner_bg_img" style="background-image: url(<?= $image_url ?>);"></div>
        <?php endif;?>

        <?php
            line('v', 'hero_1', 'white');
            line('h', 'hero_7', 'white');
        ?>

        <div id="hero_content">
            <?php if (!empty($title)) { ?><h5><?= $title ?></h5><?php } ?>
            <?php if (!empty($heading)) : ?>
                <h1 <?php if (empty($text)) echo 'class="no_margin"'; ?>><?= $heading ?></h1>
            <?php endif; ?>
            <?php if (!empty($text)) { ?><p><?= $text ?></p><?php } ?>
            <?php if (!empty($button['text'])) : ?>
                <div class="button_container">
                    <?php print_button($button, $button_color, '#home_intro'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php // get_icon('down-arrow'); ?>
        <?php
            line('h', 'hero_2', 'white');
            bend('l-u', 'hero_3', 'white');
            line('v', 'hero_4', 'white');
            line('v', 'hero_5');

            line('h', 'hero_6', 'white');
        ?>
    </div>
<?php
