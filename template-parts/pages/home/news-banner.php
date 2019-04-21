<?php
    if ($news_banner = get_field('news_banner')) :
        $display_banner = $news_banner['display_banner'];
        $title = $news_banner['title'];
        $text = $news_banner['text'];
        $button = get_button($news_banner['button']);

        $class_list = [];

        if (empty($title)) $class_list []= 'no_title';
        if (empty($button['text'])) $class_list []= 'no_button';

        if ($display_banner) :
?>

<div id="home__news_banner" class="<?= implode(' ', $class_list) ?>">
    <div class="page_container">
        <?php if ($title) { ?><h5><?= $title ?></h5><?php } ?>
        <?php if ($text) { ?><p class="<?= implode(' ', $class_list) ?>"><?= $text ?></p><?php } ?>
        <?php print_button($button); ?>
    </div>
</div>

<?php
        endif;
    endif;
?>
