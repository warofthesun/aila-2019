<?php
/**
 * @package WordPress
 * @subpackage Aila
 * @since 1.0.0
 */

    $posts_shortcode = '[aila-blog-posts posts_per_page="2"]';
?>
    <div id="latest_news" class="page_container page_section">
        <h2>Latest news</h2>

        <?= do_shortcode($posts_shortcode); ?>
    </div>
<?php
