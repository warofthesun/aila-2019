<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    if ($video = get_field('video')) :
        $title = $video['title'];
        $video_id = $video['youtube_video_id'];

        if ($video_id) :
?>
    <div id="product__video" class="page_container page_section">
        <?php if ($title) { ?><h2><?= $title ?></h2><?php } ?>
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

<?php
      endif;
    endif;
