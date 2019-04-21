<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $heading = get_field('intro_heading');
    $story = get_field('story');
    // $link = get_button(get_field('intro_link'));

    $bg_img_1 = get_field('image_1');
    $bg_img_2 = get_field('image_2');
    $bg_img_1_url = '';
    $bg_img_2_url = '';
    if ($bg_img_1) $bg_img_1_url = $bg_img_1['url'];
    if ($bg_img_2) $bg_img_2_url = $bg_img_2['url'];

    function get_image_banner($image_url) {
        $banner = '<div class="company__banner_image"';
        $banner .= ' style="background-image: url(' . $image_url . ');"';
        $banner .= '></div>';
        return $banner;
    }
?>
    <div id="company__content_container">
        <div id="company__content">
            <div class="page_container page_section">
                <?php
                    $story_col_l = $story['left_column_text'];
                    $story_col_r = $story['right_column_text'];
                    $cta = get_button($story['story_link']);
                ?>
                <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>

                <div class="columns">
                    <?php if (!empty($story_col_l)) : ?>
                    <div class="col_half">
                        <p <?= empty($cta['text']) ? 'class="no_button"' : '' ?>><?= $story_col_l ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($story_col_r)) : ?>
                    <div class="col_half">
                        <p <?= empty($cta['text']) ? 'class="no_button"' : '' ?>><?= $story_col_r ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($cta['text'])) : ?>
                    <div class="button_container">
                        <?php print_button($cta); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
            if (!empty($bg_img_1_url)) echo get_image_banner($bg_img_1_url);

            get_template_part('template-parts/pages/company/leadership');

            if (!empty($bg_img_2_url)) echo get_image_banner($bg_img_2_url);

            get_template_part('template-parts/global/latest-news');
            // get_template_part('template-parts/pages/company/careers');
        ?>
    </div>
    <script>window.hasCompanyLines = true;</script>
<?php
