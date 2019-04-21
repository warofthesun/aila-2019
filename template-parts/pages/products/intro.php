<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($intro = get_field('intro')) :
        $heading = $intro['heading'];
        $text = $intro['text'];
        $button = $intro['button'];
?>

    <div id="home_intro" class="page_container page_section">
        <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>
        <?php if (!empty($text)) { ?><p><?= $text ?></p><?php } ?>
        <span class="button scroll_button" data-target="#product_sections">
            <?= $button['button_text'] ?><?php get_icon('down-arrow'); ?>
        </span>
    </div>

<?php
    endif;
