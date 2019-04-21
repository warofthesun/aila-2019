<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($contact_us = get_field('contact_us')) :
        $heading = $contact_us['heading'];
        $button = get_button($contact_us['button']);
?>

<div id="home_contact_us" class="banner_container">
    <?php
        line('h', 'banner_1');
        bend('r-u', 'banner_2');
        line('v', 'banner_3');

        line('h', 'banner_4');
        bend('r-u', 'banner_5');
        line('v', 'banner_6');
        line('v', 'banner_7', 'white');
    ?>
    <h2><?= $heading ?></h2>
    <div class="button_container">
        <?php print_button($button, 'inverted'); ?>
    </div>

    <?php
        line('h', 'banner_8', 'white');
        bend('l-u', 'banner_9', 'white');
        line('v', 'banner_10', 'white');
        line('v', 'banner_11');
        line('v', 'banner_12', 'white');

        line('h', 'banner_13', 'white');
        bend('r-u', 'banner_14', 'white');
        line('v', 'banner_15', 'white');
        line('h', 'banner_16', 'white');
    ?>
    <script>window.hasBannerLines = true;</script>
</div>

<?php
    endif;
