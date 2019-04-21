<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($industries_section = get_field('industries_section')) :
        $media_type = $industries_section['media_type'];

        $image = $industries_section['image'];
        $image_url = !empty($image) ? $image['url'] : null;
        $image_mobile = $industries_section['mobile_image'];
        $image_url_mobile = !empty($image_mobile) ? $image_mobile['url'] : null;

        $video_title = $industries_section['video_title'];
        $video = $industries_section['video'];
        $cover_image = $industries_section['cover_image'];
        $cover_image_mobile = $industries_section['cover_image_mobile'];
        $video_url = !empty($video) ? $video['url'] : null;
        $cover_image_url = !empty($cover_image) ? $cover_image['url'] : null;
        $cover_image_mobile_url = !empty($cover_image_mobile) ? $cover_image_mobile['url'] : null;

        $title = $industries_section['title'];
        $heading = $industries_section['heading'];
        $sub_heading = $industries_section['sub-heading'];

        $industries_group = $industries_section['industries_group'];
?>
    <div id="home__industries" class="page_section">
        <?php
            line('h', 'home_9');
            line('h', 'home_10');
            bend('l-d', 'home_11');
            line('v', 'home_12');
        ?>
        <div class="table">
            <div class="row">
                <div
                    id="home__industries__image"
                    class="col_40"
                >
                    <?php if ($media_type === 'image' && !empty($image_url)) : ?>
                    <!-- <div class="image_wrapper"> -->
                        <div class="desktop" style="background-image: url(<?= $image_url ?>);"></div>
                        <div class="mobile" style="background-image: url(<?= $image_url_mobile ?>);"></div>
                    <!-- </div> -->
                    <?php endif; ?>
                    <?php if ($media_type === 'video' && !empty($cover_image_url) && !empty($video_url)) : ?>
                        <div class="video_cover_image">
                            <img src="<?= get_template_directory_uri() . '/images/video-play.png' ?>" class="video_play_button">
                            <div class="desktop" style="background-image: url(<?= $cover_image_url ?>);"></div>
                            <div class="mobile" style="background-image: url(<?= $cover_image_mobile_url ?>);"></div>
                        </div>
                        <div class="modal_overlay">
                            <div class="modal video <?= $video_title ? 'has_title' : '' ?>">
                                <i class="closer close_modal" aria-hidden="true"></i>
                                <?php if ($video_title) { ?><h3><?= $video_title ?></h3><?php } ?>
                                <video controls>
                                    <source src="<?= $video_url ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div
                    id="home__industries__content"
                    class="col_60"
                >
                    <?php if ($title) { ?><h5><?= $title ?></h5><?php } ?>
                    <?php if ($heading) { ?><h2><?= $heading ?></h2><?php } ?>
                    <?php if ($sub_heading) { ?><p><?= $sub_heading ?></p><?php } ?>
                    <?php if ($title || $heading || $sub_heading) { ?><hr><?php } ?>

                    <div>
                        <h4><?= $industries_group['title'] ?></h4>
                        <?php
                            $industries = $industries_group['industries'];

                            if (count($industries) > 0) :
                        ?>
                        <div id="home__industries__industry_details">
                            <?php
                                foreach ($industries as $industry) :
                                    $icon = $industry['icon'];
                                    $title = $industry['title'];
                                    $text = $industry['text'];
                                    $link = $industry['link'];
                                    $link_text = $link['text'];
                                    $link_url_array = $link['url'];
                                    $link_url = !empty($link_url_array) ? $link_url_array['url'] : null;
                            ?>
                                <div class="industry">
                                    <?php get_icon($icon); ?>
                                    <h3><?= $title ?></h3>
                                    <p><?= $text ?></p>
                                    <?php if ($link_url) { ?><a href="<?= $link_url ?>"><?php } ?>
                                        <h5><?= $link_text ?></h5>
                                    <?php if ($link_url) { ?></a><?php } ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    endif;
