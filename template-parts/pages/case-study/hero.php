<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $heading = get_the_title();
    $hero = get_field('hero');
    $caption = $hero['caption'];

    $bg_image = $hero['image'];
    $image_url = '';

    if ($bg_image) {
        $image_url = $bg_image['url'];
    }
?>
    <div id="case_study__hero">
        <div class="page_container">
            <div id="case_study__hero__title">
                <h5>Case Study</h5>
                <h1><?= $heading ?></h1>
            </div>
            <div id="case_study__hero__caption">
                <p><?= $caption ?></p>
            </div>
        </div>
        <div
            id="case_study__hero__image"
            style="background-image: url(<?= $image_url ?>)"
        ></div>
    </div>
<?php
