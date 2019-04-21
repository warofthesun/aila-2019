<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $hero = get_field('hero');
    $title = $hero['title'];
    $case_studies_link = $hero['case_studies_link'];

    $color_overlay = $hero['color_overlay'];

    $bg_image = $hero['background_image'];
    $image_url = '';

    if ($bg_image) {
        $image_url = $bg_image['url'];
    }

    $classes = get_bg_classes($image_url, $color_overlay, false);
?>

<div id="hero" class="case_studies_hero bg_overlay_compatible <?= implode(' ', $classes) ?>">

    <?php
        line('v', 'hero_1', 'white');
        line('h', 'hero_7', 'white');
    ?>

    <div id="hero_content__container">
        <div id="hero_content">
            <h1><?= $title ?></h1>
            <?php if ($case_studies_link) : ?>
                <a href="#" id="scroll_to_case_studies" class="scroll_button button inverted" data-target="#case_studies__container">
                    See Case Studies
                </a><br>
                <?php get_icon('down-arrow'); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
        line('h', 'hero_2', 'white');
        bend('l-u', 'hero_3', 'white');
        line('v', 'hero_4', 'white');
        line('v', 'hero_5');

        line('h', 'hero_6', 'white');
    ?>
    <script>window.hasHeroLines = true;</script>
</div>
