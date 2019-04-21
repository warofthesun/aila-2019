<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($download = get_field('download')) :
        $heading = $download['heading'];
        $button = get_button($download['button']);
?>

<div id="case_study__download" class="cta_full">
    <?php
        line('v', 'study_2');
        line('v', 'study_3', 'white');

        line('v', 'study_4');
        line('v', 'study_5', 'white');

        line('v', 'study_6');
        line('v', 'study_7', 'white');
    ?>
    <h2><?= $heading ?></h2>
    <?php if (!empty($button['text'])) : ?>
    <div class="button_container">
        <?php print_button($button, 'inverted'); ?>
    </div>
    <?php
        endif;

        line('h', 'study_8', 'white');
        bend('r-u', 'study_9', 'white');
        line('v', 'study_10', 'white');
        line('h', 'study_11', 'white');
    ?>
</div>

<?php
    endif;
