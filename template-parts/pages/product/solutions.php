<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($solutions = get_field('solutions')) :
        $title = $solutions['title'];
        $sub_title = $solutions['sub-title'];
        $solutions_blocks = $solutions['solutions_blocks'];
        $button = get_button($solutions['button']);

        $class = empty($title) && empty($sub_title) ? 'no_top_padding' : '';
?>

    <div id="product__solutions" class="page_container page_section <?= $class ?>">
        <?php if ($title) { ?><h2><?= $title ?></h2><?php } ?>
        <?php if ($sub_title) { ?><p class="sub_heading"><?= $sub_title ?></p><?php } ?>
        <?php print_hover_tables($solutions_blocks); ?>
        <script>window.hasHoverTableBlocks = true;</script>

        <?php
            if ($button && $button['text']) {
                echo '<div id="product__solutions__cta">';
                print_button($button);
                echo '</div>';
            }
        ?>
    </div>

<?php
    endif;
