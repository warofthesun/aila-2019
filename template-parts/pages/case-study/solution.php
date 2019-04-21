<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($solution = get_field('solution')) :
        $bg_image = $solution['image'];
        $image_url = '';

        if ($bg_image) {
            $image_url = $bg_image['url'];
        }

        $title = $solution['title'];
        $sub_title = $solution['sub-title'];
        $description = $solution['description'];
?>

<div id="case_study__solution">
    <?php
        line('v', 'study_1');
    ?>
    <div
        id="case_study__solution__image"
        style="background-image: url(<?= $image_url ?>)"
    ></div>
    <div id="case_study__solution__content" class="page_container page_section float_clear">
        <h3 class="float_left"><?= $title ?></h3>
        <div class="float_left content">
            <?php if (!empty($sub_title)) { ?><h5><?= $sub_title ?></h5><?php } ?>
            <p><?= $description ?></p>
        </div>
    </div>
    <script>window.hasCaseStudyLines = true;</script>
</div>

<?php
    endif;
