<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($highlights_section = get_field('highlights')) :
        $heading = $highlights_section['heading'];
        $highlights = $highlights_section['highlight_blocks'];
?>
    <div id="partners__highlights">
        <?php if (!empty($heading)) { ?><p class="highlight_heading"><?= $heading ?></p><?php } ?>

        <?php if (!empty($highlights)) : ?>
        <ul>
            <?php
                foreach ($highlights as $highlight) :
                    $icon = $highlight['icon'];
                    $heading = $highlight['heading'];
                    $text = $highlight['text'];
                    $button = get_button($highlight['button']);
            ?>
            <li>
                <?php get_icon($icon); ?>
                <h4><?= $heading ?></h4>
                <p><?= $text ?></p>
                <?php print_button($button, 'download_button'); ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
<?php
    endif;
