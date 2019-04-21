<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($challenge = get_field('the_challenge')) :
        $title = $challenge['title'];
        $caption = $challenge['caption'];
        $stats = $challenge['stats_list'];
        $products = $challenge['products_list'];
        $video_id = $challenge['youtube_video_id'];
?>

    <div id="case_study__challenge__wrapper" class="page_container page_section">
        <div id="case_study__challenge" class="float_clear">
            <div class="float_left float_half caption">
                <h3><?= $title ?></h3>
                <p><?= $caption ?></p>
            </div>
            <div class="float_left float_half lists">
                <?php if (!empty($stats)) : ?>
                    <?php if (!empty($stats['title'])) { ?><h4><?= $stats['title'] ?></h4><?php } ?>
                    <?php if (!empty($stats['stats'])) : ?>
                    <ul class="stats">
                        <?php foreach ($stats['stats'] as $stat) : ?>
                            <?php $link = $stat['link']; ?>
                            <li>
                                <?php if (!empty($link)) { ?><a href="<?= $link['url'] ?>"><?php } ?>
                                    <?= $stat['label'] ?>
                                <?php if (!empty($link)) { ?></a><?php } ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!empty($products)) : ?>
                    <?php if (!empty($products['title'])) { ?><h4><?= $products['title'] ?></h4><?php } ?>
                    <?php if (!empty($products['products'])) : ?>
                    <ul class="products">
                        <?php foreach ($products['products'] as $product) : ?>
                            <?php $link = $product['link']; ?>
                            <li>
                                <?php if (!empty($link)) { ?><a href="<?= $link['url'] ?>"><?php } ?>
                                    <?= $product['label'] ?>
                                <?php if (!empty($link)) { ?></a><?php } ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty($video_id)) : ?>
        <div id="case_study__video">
            <div class="embedded_video_container">
                <div>
                    <iframe
                        src="https://www.youtube.com/embed/<?= $video_id ?>?rel=0&amp;showinfo=0"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <i class="section_divider"></i>
    </div>
<?php
    endif;
