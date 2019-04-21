<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

     if ($why = get_field('why_aila')) :
         $heading = $why['heading'];
         $text = $why['text'];
         $button = get_button($why['button']);

         $highlights = $why['highlights'];
 ?>

<div id="solutions__why_aila">
    <div class="columns">
        <div class="col_half info">
            <h2><?= $heading ?></h2>
            <p><?= $text ?></p>
            <?php if (!empty($button['text'])) : ?>
            <div class="button_container">
                <?php print_button($button, '', '#solutions__blocks'); ?>
            </div>
            <?php endif; ?>
        </div>
        <ul id="solutions__why_aila__highlights" class="col_half">
            <?php foreach ($highlights as $highlight) : ?>
            <li>
                <?php get_icon($highlight['icon']) ?>
                <h4><?= $highlight['heading'] ?></h4>
                <p><?= $highlight['text'] ?></p>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php
    endif;
