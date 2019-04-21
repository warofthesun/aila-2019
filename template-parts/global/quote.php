<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($quote_section = get_field('quote')) :
        $bg_img = $quote_section['background_image'];
        $bg_url = !empty($bg_img) ? $bg_img['url'] : null;

        $quote = $quote_section['quote'];
        $remove_quotations = $quote_section['remove_quotations'];
        $quote_credit = $quote_section['quote_credit'];

        $button = get_button($quote_section['button']);

        $color_overlay = $quote_section['color_overlay'];
        $button_color = $color_overlay == 'darkened' ? '' : 'inverted';
        $classes = get_bg_classes($bg_url, $color_overlay, null);

        if (!empty($quote)) :
?>

<div class="quote_section bg_overlay_compatible <?= implode(' ', $classes) ?>">
    <?php
        line('v', 'quote_1');
        line('v', 'quote_2', 'white');

        if (!empty($bg_url)) :
    ?>
    <div class="banner_bg_img" style="background-image: url(<?= $bg_url ?>);"></div>
    <?php endif;?>
    <div class="quote_section__content">
        <q <?= $remove_quotations ? 'class="no_quotes"' : '' ?>><?= $quote ?></q>
        <cite class="<?= $button['text'] ? 'has_button' : '' ?>"><?= $quote_credit ?></cite>
        <?php if ($button['text']) : ?>
        <div class="button_container">
            <?php print_button($button, $button_color); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
        line('v', 'quote_3', 'white');
        line('v', 'quote_4');
    ?>
    <script>window.hasQuoteLines = true;</script>
</div>

<?php
        endif;
    endif;
