<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

     if ($why = get_field('why_aila')) :
         $heading = $why['heading'];
         $text = $why['text'];
         $logos = $why['logos'];
         $button = get_button($why['button']);
 ?>

<div id="home__why_aila" class="page_container page_section">
    <?php if (!empty($heading)) { ?><h2><?= $heading ?></h2><?php } ?>
    <?php if (!empty($text)) { ?><p><?= $text ?></p><?php } ?>
    <ul>
    <?php
        foreach ($logos as $logo) :
            $image = $logo['logo'];
            if (!empty($image)) :
    ?>
        <li>
            <img src="<?= $image['url'] ?>">
        </li>
    <?php endif; endforeach; ?>
    </ul>
    <div class="button_container">
        <?php print_button($button); ?>
    </div>
</div>

<?php
    endif;
